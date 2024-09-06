<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\BusinessType;
use App\Models\ParticipantUser;
use App\Models\ParticipantBusiness;
use App\Models\State;
use App\Models\Workshop;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $current_user = Auth::user();

            DB::beginTransaction();

            $participantUser = ParticipantUser::create([
                'user_id' => $current_user->id,
                'fullname' => $request->fullname,
                'phone_number' => $request->phone,
                'born_place' => $request->born_place,
                'born_date' => $request->born_date,
                'gender' => $request->gender,
                'state_code' => $request->state,
                'city_code' => $request->city,
                'sector_code' => $request->sector,
                'village_code' => $request->village,
            ]);

            $participantBusiness = ParticipantBusiness::create([
                'participant_id' => $participantUser->id,
                'business_type_id' => $request->business_type,
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

            DB::commit();

            Alert::success('Sukses', 'Profil berhasil diperbarui');

            if ($request->has('next_name') && $request->has('next_value')) {
                $next_name = $request->input('next_name');
                $next_value = $request->input('next_value');

                return redirect()->route($next_name . '.detail', $next_value);
            }

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            Alert::error('Error', 'Terjadi kesalahan teknis, silahkan kontak customer service kami');
            return redirect()->back();
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
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (is_profile_updated()) {
            return redirect()->intended();
        }

        $data['user'] = Auth::user();
        $data['business_types'] = BusinessType::all();
        $data['states'] = State::all();
        return view('landing.profile', $data);
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
        //
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
}
