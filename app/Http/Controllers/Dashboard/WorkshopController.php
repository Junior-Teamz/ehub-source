<?php

namespace App\Http\Controllers\Dashboard;

use App\Constants\DestinationDisk;
use App\Exports\WorkshopParticipantExport;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Collaborator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ParticipantUser;
use App\Models\State;
use App\Models\Tag;
use App\Models\Target;
use App\Models\User;
use App\Models\Workshop;
use App\Models\WorkshopCollaborator;
use App\Models\WorkshopParticipant;
use App\Models\WorkshopTag;
use App\Models\WorkshopTarget;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class WorkshopController extends Controller
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

        $data['participant'] = null;
        $keyword = $data['keyword'] = $request->keyword ?? null;
        $type = $data['type'] = $params['type'] = $request->type ?? 'all';
        $workshops = Workshop::with(['hasTags', 'hasCollaborators', 'hasParticipants']);
        $perPage = $request->perPage ?? 10;

        if ($currentUser->hasRole('entrepreneur')) {
            $currentParticipant = ParticipantUser::where('user_id', $currentUser->id)->first();
            $data['participant'] = $currentParticipant;
            $workshops = $workshops->whereHas('hasParticipants', function($query) use($currentParticipant) {
                $query->where('participant_id', ($currentParticipant ? $currentParticipant->id : false));
            });
        }

        if ($currentUser->hasRole(['collaborator', 'institution'])) {
            $userOwner = User::find($userOwner);
            $workshops = $workshops->whereHas('hasCollaborators', function($collaborator) use($userOwner) {
                $collaborator->where('collaborator_id', $userOwner->hasCollaborator->id);
            });
        }

        if ($type == 'new') {
            $workshops = $workshops->where('start_date', '>', date('Y-m-d'));
        } elseif ($type == 'ongoing') {
            $workshops = $workshops->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'));
        } elseif ($type == 'end') {
            $workshops = $workshops->where('end_date', '<', date('Y-m-d'));
            if ($currentUser->hasRole('admin')) {
                $updateWorkshop = $workshops;
                $updateWorkshop->update(['status' => 'finish']);
            }
        }

        if ($keyword) {
            $params['keyword'] = $keyword;
            $workshops->where(function($query) use($keyword) {
                $query->where('title', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('place', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('start_date', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('end_date', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('status', 'LIKE', '%'.$keyword.'%');
                $query->orWhereHas('hasTags', function($tags) use($keyword) {
                    $tags->where('name', 'LIKE', '%'.$keyword.'%');
                });
                $query->orWhereHas('hasCollaborators', function($collaborators) use($keyword) {
                    $collaborators->where('name', 'LIKE', '%'.$keyword.'%');
                });
            });
        }

        $data['workshops'] = $workshops->latest()->paginate($perPage)->setPath(route('dashboard.workshops.index', $params));
        return view('dashboard.workshops.index', $data);
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
        $data['tags'] = Tag::where('type', 'workshop')->get();
        $data['targets'] = Target::all();
        return view('dashboard.workshops.create', $data);
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

        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'tag_id' => 'required',
                'target_id' => 'required',
                'place' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'description' => 'required',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192',
                'quota' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                $inputWithoutStatus = $request->input();
                unset($inputWithoutStatus['status']);
                return back()->withErrors($validator)->withInput($inputWithoutStatus);
            }
            
            $dataWorkshop = [
                'title' => $request->title,
                'slug' => Str::slug(preg_replace('/[^\da-z]/i', ' ', $request->title), '-'),
                'place' => $request->place,
                'description' => $request->description,
                'start_date' => date('Y-m-d', strtotime($request->start_date)),
                'end_date' => date('Y-m-d', strtotime($request->end_date)),
                'start_time' => date('H:i:s', strtotime($request->start_date)),
                'end_time' => date('H:i:s', strtotime($request->end_date)),
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'created_by' => Auth::user()->id,
                'quota' => $request->quota,
                'status' => $request->status,
            ];
            DB::beginTransaction();
            $saveWorkshop = Workshop::create($dataWorkshop);
            if ($request->hasFile('thumbnail')) {
                $fileName = time().'_'.$request->file('thumbnail')->getClientOriginalName();
                $filePath = $request->file('thumbnail')->storeAs(DestinationDisk::WORKSHOP_THUMBNAIL . "/{$saveWorkshop->id}", $fileName, 'public');
                $workshopThumbnail = '/storage/' . $filePath;
                $workshops = Workshop::find($saveWorkshop->id);
                $workshops->update(['thumbnail' => $workshopThumbnail]);
            }

            if ($request->has('tag_id')) {
                foreach ($request->tag_id as $tagId) {
                    WorkshopTag::create(['tag_id' => $tagId, 'workshop_id' => $saveWorkshop->id ]);
                }
            }

            if ($request->has('target_id')) {
                foreach ($request->target_id as $targetId) {
                    WorkshopTarget::create(['target_id' => $targetId, 'workshop_id' => $saveWorkshop->id]);
                }
            }

            if (Auth::user()->hasRole(['collaborator', 'institution'])) {
                $userOwner = User::find($userOwner);
                WorkshopCollaborator::create(['collaborator_id' => $userOwner->hasCollaborator->id, 'workshop_id' => $saveWorkshop->id]);
            } else {
                foreach ($request->collaborator_id as $collaboratorId) {
                    WorkshopCollaborator::create(['collaborator_id' => $collaboratorId, 'workshop_id' => $saveWorkshop->id]);
                }
            }

            DB::commit();
            if ($request->status == 'ready') {
                Alert::success('Sukses', 'Program berhasil dikirim. Tunggu validasi program dari Pusat Informasi!');
            } else {
                Alert::success('Sukses', 'Data berhasil disimpan!');
            }
            return redirect(route('dashboard.workshops.index'));
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
        $data['workshop'] = Workshop::find($id);
        $data['states'] = State::all();
        $data['collaborators'] = Collaborator::all();
        $data['cities'] = $data['workshop']->state_id ? City::where('state_code', $data['workshop']->state_id)->get() : [];
        $data['tags'] = Tag::where('type', 'workshop')->get();
        $data['targets'] = Target::all();
        return view('dashboard.workshops.edit', $data);
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
                'title' => 'required',
                'tag_id' => 'required',
                'target_id' => 'required',
                'place' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'description' => 'required',
                'quota' => 'required',
                'status' => 'required',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
            ]);
            if ($validator->fails()) {
                Alert::error('Error', 'Error validasi');
                return back()->withErrors($validator)->withInput();
            }
            $dataWorkshop = [
                'title' => $request->title,
                'slug' => Str::slug(preg_replace('/[^\da-z]/i', ' ', $request->title), '-'),
                'place' => $request->place,
                'description' => $request->description,
                'start_date' => date('Y-m-d', strtotime($request->start_date)),
                'end_date' => date('Y-m-d', strtotime($request->end_date)),
                'start_time' => date('H:i:s', strtotime($request->start_date)),
                'end_time' => date('H:i:s', strtotime($request->end_date)),
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'quota' => $request->quota,
                'status' => $request->status,
            ];
            DB::beginTransaction();
            $currentWorkshop = Workshop::find($id);

            if ($request->hasFile('thumbnail')) {
                if (Storage::exists($currentWorkshop->thumbnail)) {
                    Storage::delete($currentWorkshop->thumbnail);
                }
                $fileName = time().'_'.$request->file('thumbnail')->getClientOriginalName();
                $filePath = $request->file('thumbnail')->storeAs(DestinationDisk::WORKSHOP_THUMBNAIL . "/{$currentWorkshop->id}", $fileName, 'public');
                $workshopThumbnail = '/storage/' . $filePath;
                $workshops = Workshop::find($currentWorkshop->id);
                $workshops->update(['thumbnail' => $workshopThumbnail]);
            }
            $currentWorkshop->update($dataWorkshop);
            if ($request->has('tag_id')) {
                $currentWorkshopTag = WorkshopTag::where('workshop_id', $currentWorkshop->id);
                $currentWorkshopTag->delete();
                foreach ($request->tag_id as $tagId) {
                    WorkshopTag::create(['tag_id' => $tagId, 'workshop_id' => $currentWorkshop->id ]);
                }
            }

            if ($request->has('target_id')) {
                $currentWorkshopTarget = WorkshopTarget::where('workshop_id', $currentWorkshop->id);
                $currentWorkshopTarget->delete();
                foreach ($request->target_id as $targetId) {
                    WorkshopTarget::create(['target_id' => $targetId, 'workshop_id' => $currentWorkshop->id]);
                }
            }

            if ($request->has('collaborator_id')) {
                $currentWorkshopCollaborator = WorkshopCollaborator::where('workshop_id', $currentWorkshop->id);
                $currentWorkshopCollaborator->delete();
                if ($request->has('collaborator_id')) {
                    foreach ($request->collaborator_id as $collaboratorId) {
                        WorkshopCollaborator::create(['collaborator_id' => $collaboratorId, 'workshop_id' => $currentWorkshop->id]);
                    }
                }
            }
            DB::commit();
            if ($request->status == 'ready') {
                Alert::success('Sukses', 'Program berhasil dikirim. Tunggu validasi program dari Pusat Informasi!');
            } else {
                Alert::success('Sukses', 'Data berhasil disimpan!');
            }
            return redirect(route('dashboard.workshops.index'));
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
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $currentWorkshop = Workshop::find($id);
            if ($currentWorkshop->delete()) {
                $disk = Storage::disk('public');
                $disk->deleteDirectory(DestinationDisk::WORKSHOP_THUMBNAIL . "/{$currentWorkshop->id}");
            }
            DB::commit();
            Alert::success('Sukses', 'Data berhasil dihapus');
            return redirect(route('dashboard.workshops.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis. silakan kontak customer service kami.');
            return back();
        }
    }

    public function participant(Request $request, $id)
    {
        $currentUser = auth()->user();
        $userOwner = $currentUser->created_by != 0 ? $currentUser->created_by : $currentUser->id;

        $keyword = $data['keyword'] = $request->keyword ?? null;
        $perPage = $request->perPage ?? 10;
        $data['workshop'] = Workshop::find($id);
        $participants = ParticipantUser::whereHas('hasWorkshops', function($workshop) use ($id) {
            $workshop->where('workshop_id', $id);
        });
        if (Auth::user()->hasRole(['collaborator', 'institution'])) {
            $userOwner = User::find($userOwner);
            $participants = ParticipantUser::whereHas('hasWorkshops', function($workshop) use ($id, $userOwner) {
                $workshop->where('workshop_id', $id);
                $workshop->whereHas('hasCollaborators', function($collaborator) use($userOwner) {
                    $collaborator->where('collaborator_id', $userOwner->hasCollaborator->id);
                });
            });
        }
        $params['id'] = $id;
        if ($keyword) {
            $params['keyword'] = $keyword;
            $participants->where(function($query) use($keyword) {
                $query->where('fullname', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('phone_number', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('created_at', 'LIKE', '%'.$keyword.'%');
                $query->orWhereHas('hasUser', function($user) use($keyword) {
                    $user->where('email', 'LIKE', '%'.$keyword.'%');
                });
            });
        }
        $data['participants'] = $participants->latest()->paginate($perPage)->setPath(route('dashboard.workshops.participants', $params));
        return view('dashboard.workshops.participant', $data);
    }

    public function participantConfirmation(Request $request)
    {
        try {
            DB::beginTransaction();
            $workshopParticipant = WorkshopParticipant::where('workshop_id', $request->workshop_id)->where('participant_id', $request->participant_id)->first();
            $workshopParticipant->update(['status' => $request->status]);
            DB::commit();
            Alert::success('Sukses', 'Data peserta berhasil dikonfirmasi!');
            return redirect(route('dashboard.workshops.participants', $request->workshop_id));
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis, silakan kontak customer service kami!');
            return back();
        }
    }

    public function contactParticipant(Request $request, $workshop_id)
    {
        try {
            $participantStatus = WorkshopParticipant::find($workshop_id);
            $participantStatus->update(['status' => 'contacted']);

            $whatsappUrl = "https://wa.me/{$request->input('phone')}";

            return response()->json(['whatsapp_url' => $whatsappUrl], 200);
        } catch (\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function download(Request $request, $id)
    {
        try {
            $currentUser = auth()->user();
            $workshop = Workshop::find($id);
            $userOwner = $currentUser->created_by != 0 ? $currentUser->created_by : $currentUser->id;
            $participants = ParticipantUser::whereHas('hasWorkshops', function($workshop) use ($id) {
                $workshop->where('workshop_id', $id);
            });
            if (Auth::user()->hasRole(['collaborator', 'institution'])) {
                $userOwner = User::find($userOwner);
                $participants = ParticipantUser::whereHas('hasWorkshops', function($workshop) use ($id, $userOwner) {
                    $workshop->where('workshop_id', $id);
                    $workshop->whereHas('hasCollaborators', function($collaborator) use($userOwner) {
                        $collaborator->where('collaborator_id', $userOwner->hasCollaborator->id);
                    });
                });
            }

            $participants = $participants->latest()->get();
            // return response()->json($participants);
            return Excel::download(new WorkshopParticipantExport($participants, $workshop), 'peserta-'.\Carbon\Carbon::now()->format('YmdHi').'.xlsx');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->failures());
            }

            $errors = [];
            foreach ($e->failures() as $key => $item) {
                if ($key > 0) {
                    $valueRow = $item->row();
                    $arrayColumnRows = array_column($errors, 'row');
                    $searchRowErrors = array_search($valueRow, $arrayColumnRows);
                    if ($searchRowErrors === false) {
                        $errors[$key] = [
                            'row' => $item->row(),
                            'message' => $item->errors()
                        ];
                    } else {
                        $currentErrors = $item->errors();
                        array_push($errors[$searchRowErrors]['message'], $currentErrors[0]);
                    }
                } else {
                    $errors[$key] = [
                        'row' => $item->row(),
                        'message' => $item->errors(),
                    ];
                }
            }
            Alert::error('Error', 'Terjadi kesalahan teknis silakan kontak customer service kami!');
            return redirect()->back()->with('errorExports', $errors);
       }
    }
}
