<?php

namespace App\Http\Controllers\Landing;

use App\Constants\DestinationDisk;
use App\Http\Controllers\Controller;
use App\Models\BusinessType;
use App\Models\City;
use App\Models\ParticipantBusiness;
use App\Models\ParticipantUser;
use App\Models\Sector;
use App\Models\State;
use App\Models\User;
use App\Models\Village;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ClientAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $states = State::all();
        return view('landing.clientarea.profile.index', compact('user', 'states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit()
    {
        $user = User::find(auth()->user()->id);
        $types = BusinessType::all();
        $states = State::all();
        $cities = $sectors = $villages = [];
        if ($user->hasParticipant && $user->hasParticipant->hasState) {
            $cities = City::where('state_code', $user->hasParticipant->state_code)->get();
        }
        if ($user->hasParticipant && $user->hasParticipant->hasCity) {
            $sectors = Sector::where('city_code', $user->hasParticipant->city_code)->get();
        }
        if ($user->hasParticipant && $user->hasParticipant->hasSector) {
            $villages = Village::where('sector_code', $user->hasParticipant->sector_code)->get();
        }
        return view('landing.clientarea.profile.edit', compact('states', 'cities', 'sectors', 'villages', 'user', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            // Validasi data yang dikirim oleh form
            $user = User::where('id', auth()->user()->id)->first();

            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'phone_number' => 'required',
                'email' => 'required',
                'nib_created_at' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
                'business_type_id' => $request->name != NULL ? 'required' : 'nullable',
                'platforms' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $participantUserData = [
                'fullname' => request('fullname'),
                'phone_number' => request('phone_number'),
                'born_place' => request('born_place'),
                'born_date' => request('born_date'),
                'gender' => request('gender'),
                'state_code' => request('state'),
                'city_code' => request('city'),
                'sector_code' => request('sector'),
                'village_code' => request('village'),
            ];

            DB::beginTransaction();

            // Simpan data pengguna ke tabel participant_users
            $participantUser = ParticipantUser::updateOrCreate(
                ['user_id' => $user->id],
                $participantUserData
            );

            if ($request->hasFile('avatar')) {
                $fileName = time().'_'.$request->file('avatar')->getClientOriginalName();
                $filePath = $request->file('avatar')->storeAs(DestinationDisk::WORKSHOP_THUMBNAIL . "/{$participantUser->id}", $fileName, 'public');
                $participantThumbnail = '/storage/' . $filePath;
                $participantUser->avatar_url = $participantThumbnail;
                $participantUser->save();
            }

            if ($request->name) {
                $participantBusinessData = [
                    'business_type_id' => request('business_type_id'),
                    'name' => request('name'),
                    'address' => request('address'),
                    'nib' => request('nib'),
                    'nib_created_at' => request('nib_created_at'),
                    'business_site' => request('business_site'),
                    'community' => request('community'),
                    'ig_account' => request('ig_account'),
                    'fb_account' => request('fb_account'),
                    'tiktok_account' => request('tiktok_account'),
                    'platforms' => is_array(request('platforms')) ? implode(',', request('platforms')) : null,
                ];

                // Simpan data bisnis pengguna ke tabel participant_businesses
                $participantBusiness = ParticipantBusiness::updateOrCreate(
                    ['participant_id' => $participantUser->id],
                    $participantBusinessData
                );
            }

            // Mengisi data pada model user
            $user->fullname = $request->input('fullname');
            $user->phone = $request->input('phone_number');
            $user->born_place = $request->input('born_place');
            $user->born_date = $request->input('born_date');
            $user->gender = $request->input('gender');
            $user->email = $request->input('email');
            $user->state = $request->input('state');
            $user->city = $request->input('city');
            $user->sector = $request->input('sector');
            $user->village = $request->input('village');

            $user->save();
            DB::commit();

            Alert::success('Sukses', 'Profile berhasil disimpan!');
            // Mengirim pesan berhasil dan redirect ke halaman view profile
            return redirect()->route('clientarea.profile.index');
        } catch (\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis, silahkan kontak customer service kami');
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
        //
    }

    public function myWorkshop(Request $request) {
        $keyword = $data['keyword'] = $request->keyword ?? null;
        $type = $data['type'] = $params['type'] = $request->type ?? 'all';
        $workshops = Workshop::with(['hasTags', 'hasCollaborators', 'hasParticipants']);
        $perPage = $request->perPage ?? 10;

        $currentParticipant = ParticipantUser::where('user_id', Auth::user()->id)->first();
        $data['participant'] = $currentParticipant;
        $workshops = $workshops->whereHas('hasParticipants', function($query) use($currentParticipant) {
            $query->where('participant_id', ($currentParticipant ? $currentParticipant->id : false));
        });

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

        $data['workshops'] = $workshops->latest()->paginate($perPage)->setPath(route('clientarea.workshops.index', $params));
        return view('landing.clientarea.workshops.index', $data);
    }
}
