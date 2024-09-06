<?php

namespace App\Http\Controllers\Dashboard;

use App\Constants\DestinationDisk;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Collaborator;
use App\Models\CollaboratorTag;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $data['keyword'] = $params['keyword'] = $request->keyword ?? null;
        $collaborators = Collaborator::with(['hasCity', 'hasTags']);
        $perPage = $request->perPage ?? 10;

        if ($keyword) {
            $collaborators->where(function($query) use($keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('director_name', 'LIKE', '%'.$keyword.'%');
                $query->orWhereHas('hasTags', function($tags) use($keyword) {
                    $tags->where('name', 'LIKE', '%'.$keyword.'%');
                });
                $query->orWhereHas('hasCity', function($city) use($keyword) {
                    $city->where('city_name', 'LIKE', '%'.$keyword.'%');
                });
            });
        }

        $data['collaborators'] = $collaborators->latest()->paginate($perPage)->setPath(route('dashboard.collaborators.index', $params));
        return view('dashboard.collaborators.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['states'] = State::all();
        $data['collaborators'] = Collaborator::all();
        $data['tags'] = Tag::where('type', 'collaborator')->get();
        return view('dashboard.collaborators.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'phone_number' => 'required',
                'name' => 'required',
                'director_name' => 'required',
                'tag_id' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
                'logo' => 'required|file|mimes:jpeg,jpg,png,svg|max:8192',
                'cover' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:8192',
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
                'password' => bcrypt('EHUB-'.$request->phone_number),
            ];
            $saveUser = User::create($dataUser);
            $saveUser->assignRole('collaborator');

            $dataCollaborator = [
                'user_id' => $saveUser->id,
                'name' => $request->name,
                'slug' => Str::slug(preg_replace('/[^\da-z]/i', ' ', $request->name), '-'),
                'director_name' => $request->director_name,
                'description' => $request->description,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'site' => $request->site,
                'status' => $request->status ?? false,
            ];

            $saveCollaborator = Collaborator::create($dataCollaborator);
            if ($request->hasFile('logo')) {
                $fileName = time().'_'.$request->file('logo')->getClientOriginalName();
                $filePath = $request->file('logo')->storeAs(DestinationDisk::COLLABORATOR_LOGO . "/{$saveCollaborator->id}", $fileName, 'public');
                $collaboratorLogo = '/storage/' . $filePath;
                $collaborators = Collaborator::find($saveCollaborator->id);
                $collaborators->update(['logo_url' => $collaboratorLogo]);
            }

            if ($request->hasFile('cover')) {
                $fileName = time().'_'.$request->file('cover')->getClientOriginalName();
                $filePath = $request->file('cover')->storeAs(DestinationDisk::COLLABORATOR_COVER . "/{$saveCollaborator->id}", $fileName, 'public');
                $collaboratorCover = '/storage/' . $filePath;
                $collaborators = Collaborator::find($saveCollaborator->id);
                $collaborators->update(['cover_url' => $collaboratorCover]);
            }

            if ($request->has('tag_id')) {
                foreach ($request->tag_id as $tagId) {
                    CollaboratorTag::create(['tag_id' => $tagId, 'collaborator_id' => $saveCollaborator->id ]);
                }
            }
            DB::commit();
            Alert::success('Sukses', 'Data berhasil disimpan!');
            return redirect(route('dashboard.collaborators.index'));
        } catch(\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }

            DB::rollBack();
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
        $data['collaborator'] = Collaborator::find($id);
        $data['states'] = State::all();
        $data['cities'] = $data['collaborator']->state_id ? City::where('state_code', $data['collaborator']->state_id)->get() : [];
        $data['tags'] = Tag::where('type', 'collaborator')->get();
        return view('dashboard.collaborators.edit', $data);
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
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'director_name' => 'required',
                'tag_id' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
                'logo' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:8192',
                'cover' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:8192',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            $currentCollaborator = Collaborator::find($id);
            $collaboratorUser = User::find($currentCollaborator->user_id);

            $dataUser = [
                'fullname' => $request->name,
            ];
            $collaboratorUser->update($dataUser);

            $dataCollaborator = [
                'name' => $request->name,
                'slug' => Str::slug(preg_replace('/[^\da-z]/i', ' ', $request->name), '-'),
                'director_name' => $request->director_name,
                'description' => $request->description,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'site' => $request->site,
                'status' => $request->status ?? false,
            ];

            if ($request->hasFile('logo')) {
                if (Storage::exists($currentCollaborator->logo_url)) {
                    Storage::delete($currentCollaborator->logo_url);
                }
                $fileName = time().'_'.$request->file('logo')->getClientOriginalName();
                $filePath = $request->file('logo')->storeAs(DestinationDisk::COLLABORATOR_LOGO . "/{$currentCollaborator->id}", $fileName, 'public');
                $dataCollaborator['logo_url'] = '/storage/' . $filePath;
            }

            if ($request->hasFile('cover')) {
                if (Storage::exists($currentCollaborator->cover_url)) {
                    Storage::delete($currentCollaborator->cover_url);
                }
                $fileName = time().'_'.$request->file('cover')->getClientOriginalName();
                $filePath = $request->file('cover')->storeAs(DestinationDisk::COLLABORATOR_COVER . "/{$currentCollaborator->id}", $fileName, 'public');
                $dataCollaborator['cover_url'] = '/storage/' . $filePath;
            }

            $currentCollaborator->update($dataCollaborator);

            if ($request->has('tag_id')) {
                $currentCollaboratorTag = CollaboratorTag::where('collaborator_id', $currentCollaborator->id);
                $currentCollaboratorTag->delete();
                foreach ($request->tag_id as $tagId) {
                    CollaboratorTag::create(['tag_id' => $tagId, 'collaborator_id' => $currentCollaborator->id ]);
                }
            }

            DB::commit();
            Alert::success('Sukses', 'Data berhasil disimpan!');
            return redirect(route('dashboard.collaborators.index'));
        } catch(\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }

            DB::rollBack();
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
    // public function destroy($id)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $currentCollaborator = Collaborator::find($id);
    //         if ($currentCollaborator->delete()) {
    //             if (Storage::exists($currentCollaborator->logo_url)) {
    //                 $disk = Storage::disk('public');
    //                 $disk->deleteDirectory(DestinationDisk::COLLABORATOR_LOGO . "/{$currentCollaborator->id}");
    //             }
    //             if (Storage::exists($currentCollaborator->cover_url)) {
    //                 $disk = Storage::disk('public');
    //                 $disk->deleteDirectory(DestinationDisk::COLLABORATOR_COVER . "/{$currentCollaborator->id}");
    //             }
    //         }
    //         DB::commit();
    //         Alert::success('Sukses', 'Data berhasil dihapus');
    //         return redirect(route('dashboard.collaborators.index'));
    //     } catch (\Exception $e) {
    //         if (App::environment('production')) {
    //             errorLog(basename(__FILE__), __LINE__, $e->getMessage());
    //         }

    //         DB::rollBack();
    //         Alert::error('Error', 'Terjadi kesalahan teknis. silakan kontak customer service kami.');
    //         return back();
    //     }
    // }
}
