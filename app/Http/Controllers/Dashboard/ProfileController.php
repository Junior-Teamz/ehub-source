<?php

namespace App\Http\Controllers\Dashboard;

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $states = State::all();
        return view('dashboard.profile.index', compact('user', 'states'));
    }

    public function edit()
    {
        // Mengambil data dari database berdasarkan user yang sedang login
        $user = User::where('id', auth()->user()->id)->first();
        $types = BusinessType::all();
        $states = State::all();
        $sectors = Sector::all();
        $cities = City::all();
        $villages = Village::all();
        // Mengirim data ke view edit profile
        return view('dashboard.profile.edit', compact('states', 'sectors', 'cities', 'villages', 'user', 'types'));
    }

    public function update(Request $request)
    {
        try {
            // Validasi data yang dikirim oleh form
            $user = User::where('id', auth()->user()->id)->first();
            DB::beginTransaction();

            $validatedData = $request->validate([
                'fullname' => 'required',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:8192',
                'phone_number' => 'required',
                'email' => 'required',
                'born_place' => 'nullable',
                'born_date' => 'nullable',
                'gender' => 'nullable',
                'state' => 'nullable',
                'city' => 'nullable',
                'sector' => 'nullable',
                'village' => 'nullable',
                'business_type_id' => 'nullable',
                'name' => 'nullable',
                'address' => 'nullable',
                'nib' => 'nullable',
                'nib_created_at' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
                'business_site' => 'nullable',
                'community' => 'nullable',
                'platforms' => 'nullable|array',
                'ig_account' => 'nullable',
                'fb_account' => 'nullable',
                'tiktok_account' => 'nullable',
            ]);

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
            }

            // Data untuk disimpan atau diperbarui di tabel participant_businesses
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

            // Simpan perubahan pada model participantUser, participantBusiness, dan user
            $participantUser->save();
            $participantBusiness->save();
            $user->save();
            DB::commit();

            Alert::success('Sukses', 'Profile berhasil disimpan!');
            // Mengirim pesan berhasil dan redirect ke halaman view profile
            return redirect()->route('dashboard.profile.index');
        } catch (\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis, silahkan kontak customer service kami');
            return redirect()->back();
        }
    }
}
