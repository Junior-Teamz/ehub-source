<?php

namespace App\Http\Controllers\Dashboard;

use App\Constants\DestinationDisk;
use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\Collaborator;
use App\Models\Expert;
use App\Models\MentorExpert;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentUser = auth()->user();
        $userOwner = $currentUser->created_by != 0 ? $currentUser->created_by : $currentUser->id;

        $keyword = $data['keyword'] = $params['keyword'] = $request->keyword ?? null;
        $mentors = Mentor::with(['hasCollaborator']);
        $perPage = $request->perPage ?? 10;

        if ($currentUser->hasRole(['collaborator', 'institution'])) {
            $userOwner = User::find($userOwner);
            $mentors->where('collaborator_id', $userOwner->hasCollaborator->id);
        }

        if ($keyword) {
            $mentors->where(function($query) use($keyword) {
                $query->where('fullname', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('expertise', 'LIKE', '%'.$keyword.'%');
                $query->orWhereHas('hasCollaborator', function($city) use($keyword) {
                    $city->where('name', 'LIKE', '%'.$keyword.'%');
                });
            });
        }

        $data['mentors'] = $mentors->latest()->paginate($perPage)->setPath(route('dashboard.mentors.index', $params));
        return view('dashboard.mentors.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['collaborators'] = Collaborator::where('status', true)->get();
        $data['experts'] = Expert::all();
        return view('dashboard.mentors.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentUser = auth()->user();
        $userOwner = $currentUser->created_by != 0 ? $currentUser->created_by : $currentUser->id;
        $userOwner = User::find($userOwner);

        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'phone_number' => 'required',
                'fullname' => 'required',
                'expertise' => 'required',
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192',
                'gender' => 'required',
                'expert_id' => 'required'
            ]);

            if ($validator->fails()) {
                $inputWithoutStatus = $request->input();
                unset($inputWithoutStatus['status']);
                return back()->withErrors($validator)->withInput($inputWithoutStatus);
            }

            DB::beginTransaction();
            $dataUser = [
                'email' => $request->email,
                'fullname' => $request->name,
                'username' => $request->email,
                'phone' => $request->phone_number,
                'gender' => $request->gender,
                'password' => bcrypt('EHUB-'.$request->phone_number),
            ];
            $saveUser = User::create($dataUser);
            $saveUser->assignRole('mentor');

            $dataMentor = [
                'user_id' => $saveUser->id,
                'fullname' => $request->fullname,
                'collaborator_id' => auth()->user()->hasRole(['collaborator', 'institution']) ? $userOwner->hasCollaborator->id : $request->collaborator_id,
                'expertise' => $request->expertise,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'created_by' => auth()->user()->id,
                'status' => $request->status ?? false,
            ];

            $saveMentor = Mentor::create($dataMentor);
            if ($request->hasFile('avatar')) {
                $fileName = time().'_'.$request->file('avatar')->getClientOriginalName();
                $filePath = $request->file('avatar')->storeAs(DestinationDisk::MENTOR_AVATAR . "/{$saveMentor->id}", $fileName, 'public');
                $mentorAvatar = '/storage/' . $filePath;
                $mentors = Mentor::find($saveMentor->id);
                $mentors->update(['avatar_url' => $mentorAvatar]);
            }

            if ($request->has('expert_id')) {
                foreach ($request->expert_id as $expertId) {
                    MentorExpert::create(['expert_id' => $expertId, 'mentor_id' => $saveMentor->id ]);
                }
            }

            DB::commit();
            Alert::success('Sukses', 'Data berhasil disimpan!');
            return redirect(route('dashboard.mentors.index'));
        } catch(\Exception $e) {
            DB::rollBack();
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            Alert::error('Error', 'Terjadi kesalahan teknis, silakan kontak customer service kami');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['mentor'] = Mentor::find($id);
        $data['collaborators'] = Collaborator::where('status', true)->get();
        $data['experts'] = Expert::all();
        return view('dashboard.mentors.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currentUser = auth()->user();
        $userOwner = $currentUser->created_by != 0 ? $currentUser->created_by : $currentUser->id;
        $userOwner = User::find($userOwner);

        try {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'expertise' => 'required',
                'gender' => 'required',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
                'expert_id' => 'required',
                'email' => 'required|email',
                'phone_number' => 'required'
            ]);

            if ($validator->fails()) {
                $inputWithoutStatus = $request->input();
                unset($inputWithoutStatus['status']);

                return back()->withErrors($validator)->withInput($inputWithoutStatus);
            }

            DB::beginTransaction();
            $currentMentor = Mentor::find($id);
            $mentorUser = User::find($currentMentor->user_id);

            $dataUser = [
                'fullname' => $request->fullname,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone_number
            ];
            $mentorUser->update($dataUser);

            $dataMentor = [
                'fullname' => $request->fullname,
                'collaborator_id' => auth()->user()->hasRole(['collaborator', 'institution']) ? $userOwner->hasCollaborator->id : $request->collaborator_id,
                'expertise' => $request->expertise,
                'gender' => $request->gender,
                'status' => $request->status ?? false,
                'phone_number' => $request->phone_number
            ];
            
            if ($request->hasFile('avatar')) {
                if (Storage::exists($currentMentor->avatar_url)) {
                    Storage::delete($currentMentor->avatar_url);
                }
                $fileName = time().'_'.$request->file('avatar')->getClientOriginalName();
                $filePath = $request->file('avatar')->storeAs(DestinationDisk::MENTOR_AVATAR . "/{$currentMentor->id}", $fileName, 'public');
                $dataMentor['avatar_url'] = '/storage/' . $filePath;
            }

            $currentMentor->update($dataMentor);

            if ($request->has('expert_id')) {
                $currentMentorExpert = MentorExpert::where('mentor_id', $currentMentor->id);
                $currentMentorExpert->delete();
                foreach ($request->expert_id as $expertId) {
                    MentorExpert::create(['expert_id' => $expertId, 'mentor_id' => $currentMentor->id ]);
                }
            }

            DB::commit();
            Alert::success('Sukses', 'Data berhasil disimpan!');
            return redirect(route('dashboard.mentors.index'));
        } catch(\Exception $e) {
            DB::rollBack();
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            Alert::error('Error', 'Terjadi kesalahan teknis, silakan kontak customer service kami');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $currentMentor = Mentor::find($id);
            if ($currentMentor->delete()) {
                if (Storage::exists($currentMentor->avatar_url)) {
                    $disk = Storage::disk('public');
                    $disk->deleteDirectory(DestinationDisk::MENTOR_AVATAR . "/{$currentMentor->id}");
                }
            }
            DB::commit();
            Alert::success('Sukses', 'Data berhasil dihapus');
            return redirect(route('dashboard.mentors.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            Alert::error('Error', 'Terjadi kesalahan teknis. silakan kontak customer service kami.');
            return back();
        }
    }
}