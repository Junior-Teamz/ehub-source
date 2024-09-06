<?php

namespace App\Http\Controllers\Dashboard;

use App\Constants\DestinationDisk;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Jobs\ImportEntrepreneurJob;
use App\Models\BusinessType;
use App\Models\City;
use App\Models\ParticipantBusiness;
use App\Models\ParticipantUser;
use App\Models\Sector;
use App\Models\State;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class EntrepreneurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentUser = auth()->user();
        $currentRole = $currentUser->getRoleNames()->first();

        $entrepreneurs = User::role('entrepreneur')->select('id', 'fullname', 'email', 'phone');
        $keyword = $data['keyword'] = $params['keyword'] = $request->keyword ?? null;
        $perPage = $request->perPage ?? 10;

        if ($keyword) {
            $entrepreneurs->where(function($query) use($keyword) {
                $query->where('fullname', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('email', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('phone', 'LIKE', '%'.$keyword.'%');
            });
        }

        if ($currentRole === 'institution') {
            $userOwner = $currentUser->created_by != 0 ? $currentUser->created_by : $currentUser->id;
            $data['entrepreneurs'] = $entrepreneurs->where('created_by', $userOwner)->latest()->paginate($perPage);
        } else {
            $data['entrepreneurs'] = $entrepreneurs->latest()->paginate($perPage)->setPath(route('dashboard.entrepreneurs.index', $params));
        }

        return view('dashboard.entrepreneurs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['states'] = State::all();
        $data['business_types'] = BusinessType::all();
        return view('dashboard.entrepreneurs.create', $data);
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
                'email' => 'required|unique:users,email',
                'phone_number' => 'required|unique:users,phone',
                'fullname' => 'required',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $saveUser = User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone_number,
                'username' => $request->email,
                'password' => bcrypt($request->password),
                'created_by' => $userOwner
            ]);
            $saveUser->assignRole('entrepreneur');

            $participantUser = ParticipantUser::create([
                'user_id' => $saveUser->id,
                'fullname' => $request->fullname,
                'phone_number' => $request->phone_number,
                'born_place' => $request->born_place,
                'born_date' => $request->born_date,
                'gender' => $request->gender,
                'state_code' => $request->state_id,
                'city_code' => $request->city_id,
                'sector_code' => $request->sector_id,
                'village_code' => $request->village_id,
            ]);

            if ($request->hasFile('photo')) {
                $fileName = time().'_'.$request->file('photo')->getClientOriginalName();
                $filePath = $request->file('photo')->storeAs(DestinationDisk::ENTREPRENEUR_AVATAR . "/{$participantUser->id}", $fileName, 'public');
                $participantUserPhoto = '/storage/' . $filePath;
                $participantUsers = ParticipantUser::find($participantUser->id);
                $participantUsers->update(['avatar_url' => $participantUserPhoto]);
            }

            $participantBusiness = ParticipantBusiness::create([
                'participant_id' => $participantUser->id,
                'business_type_id' => $request->business_type_id,
                'name' => $request->business_name,
                'address' => $request->business_address,
                'nib' => $request->nib_number,
                'nib_created_at' => $request->nib_created_at,
                'business_site' => $request->business_site,
                'community' => $request->community,
                'platforms' => is_array($request->business_platform) ? implode(',', $request->business_platform) : null,
                'ig_account' => $request->ig_account,
                'fb_account' => $request->fb_account,
                'tiktok_account' => $request->tiktok_account
            ]);

            $token = Str::random(64);
            $url = route('email.verify', $token);
            Mail::send('landing.email-verification', ['token' => $token, 'url' => $url, 'password' => $request->password] , function($message) use ($request){
                $message->to($request->email);
                $message->subject('Verifikasi Akun EnterpreneurHub');
            });
            $newUser = User::find($saveUser->id);
            if (count(Mail::failures()) > 0) {
                $newUser->update(['is_verification_mail_sent' => false]);
            } else {
                $newUser->update(['is_verification_mail_sent' => true]);
            }
            DB::commit();
            Alert::success('Sukses', 'Data berhasil disimpan');
            return redirect(route('dashboard.entrepreneurs.index'));
        } catch (\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis, silakan kontak customer service kami');
            return back()->withInput();
        }
    }

    /**
     * Store a newly created resource in storage using import by excel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'import_entrepreneur' => 'required'
            ], [
                'import_entrepreneur.required' => 'File yang akan di unggah kosong!',
            ]);

            if ($validator->fails()) {
                Alert::error('Error', 'Error validasi');
                return back()->withErrors($validator);
            }
            $file = $request->file('import_entrepreneur');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $fileName);

            $currentUser = auth()->user();
            $userOwner = $currentUser->created_by != 0 ? $currentUser->created_by : $currentUser->id;
            ImportEntrepreneurJob::dispatch($fileName, $userOwner);
            return redirect()->back()->with('success', 'Sedang proses unggah data! Dimohon untuk sabar menunggu.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
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
            Alert::error('Error', 'Terdapat kesalahan ketika input data');
            return redirect()->back()->with('errorImports', $errors);
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
        $data['entrepreneur'] = User::find($id);
        return view('dashboard.entrepreneurs.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currentUser = User::find($id);
        $data['states'] = State::all();
        $data['business_types'] = BusinessType::all();
        $data['cities'] = $data['sectors'] = $data['villages'] = $data['platforms'] = [];
        if ($currentUser->hasParticipant) {
            $data['cities'] = $currentUser->hasParticipant->state_code ? City::where('state_code', $currentUser->hasParticipant->state_code)->get() : [];
            $data['sectors'] = $currentUser->hasParticipant->city_code ? Sector::where('city_code', $currentUser->hasParticipant->city_code)->get() : [];
            $data['villages'] = $currentUser->hasParticipant->sector_code ? Village::where('sector_code', $currentUser->hasParticipant->sector_code)->get() : [];
            if ($currentUser->hasParticipant->hasBusiness) {
                $data['platforms'] = $currentUser->hasParticipant->hasBusiness->platforms ? explode(',', $currentUser->hasParticipant->hasBusiness->platforms) : [];
            }
        }
        $data['entrepreneur'] = $currentUser;
        return view('dashboard.entrepreneurs.edit', $data);
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
            $currentUser = User::find($id);

            $validator = Validator::make($request->all(), [
                'email' => [ 'required', Rule::unique('users', 'email')->ignore($currentUser->id) ],
                'phone_number' => [ 'required', Rule::unique('users', 'phone')->ignore($currentUser->id) ],
                'fullname' => 'required',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $dataUser = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
            ];

            if ($request->has('password')) {
                $validator = Validator::make($request->only(['password', 'password_confirmation']), [
                    'password' => 'nullable|min:6|confirmed',
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                $dataUser['password'] = bcrypt($request->password);
            }
            $currentUser->update($dataUser);

            $participantUser = ParticipantUser::where('user_id', $id)->first();

            $dataParticipantUser = [
                'fullname' => $request->fullname,
                'phone_number' => $request->phone_number,
                'born_place' => $request->born_place,
                'born_date' => $request->born_date,
                'gender' => $request->gender,
                'state_code' => $request->state_id,
                'city_code' => $request->city_id,
                'sector_code' => $request->sector_id,
                'village_code' => $request->village_id,
            ];

            if ($request->hasFile('photo')) {
                $fileName = time().'_'.$request->file('photo')->getClientOriginalName();
                $filePath = $request->file('photo')->storeAs(DestinationDisk::ENTREPRENEUR_AVATAR . "/{$participantUser->id}", $fileName, 'public');
                $dataParticipantUser['avatar_url'] = '/storage/' . $filePath;
            }

            $participantUser->update($dataParticipantUser);

            $participantBusiness = ParticipantBusiness::where('participant_id', $participantUser->id)->first();

            $dataParticipantBusiness = [
                'business_type_id' => $request->business_type_id,
                'name' => $request->business_name,
                'address' => $request->business_address,
                'nib' => $request->nib_number,
                'nib_created_at' => $request->nib_created_at,
                'business_site' => $request->business_site,
                'community' => $request->community,
                'platforms' => is_array($request->business_platform) ? implode(',', $request->business_platform) : null,
                'ig_account' => $request->ig_account,
                'fb_account' => $request->fb_account,
                'tiktok_account' => $request->tiktok_account
            ];

            $participantBusiness->update($dataParticipantBusiness);

            DB::commit();
            Alert::success('Sukses', 'Data berhasil disimpan');
            return redirect(route('dashboard.entrepreneurs.index'));
        } catch (\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis, silakan kontak customer service kami');
            return back()->withInput();
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
            $currentUser = User::find($id);
            if ($currentUser->delete()) {
                if (File::exists(public_path($currentUser->file))) {
                    $disk = Storage::disk('public');
                    $disk->deleteDirectory(DestinationDisk::ENTREPRENEUR_AVATAR . "/{$currentUser->id}");
                } 
            }
            DB::commit();
            Alert::success('Sukses', 'Data berhasil dihapus');
            return redirect(route('dashboard.entrepreneurs.index'));
        } catch (\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis. silakan kontak customer service kami.');
            return back();
        }
    }
}
