<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\Sector;
use App\Models\Village;

class RegionController
{
    public function states(Request $request)
    {
        try {
            $states = State::orderBy('state_name', 'asc')->get();
            return sendApiResponse(true, 'Daftar Kota/Kabupaten', $states);
        } catch (\Exception $e) {
            return sendApiResponse(false, 'Terjadi kesalahan teknis, silakan kontak customer service kami', null, 400);
        }
    }

    public function cities(Request $request, $state_code)
    {
        try {
            $list = City::where('state_code', $state_code)->orderBy('city_name', 'asc')->get();
            return sendApiResponse(true, 'Daftar Kota/Kabupaten', $list);
        } catch (\Exception $e) {
            return sendApiResponse(false, 'Terjadi kesalahan teknis, silakan kontak customer service kami', null, 400);
        }
    }

    public function sectors(Request $request, $city_code)
    {
        try {
            $list = Sector::where('city_code', $city_code)->orderBy('sector_name', 'asc')->get();
            return sendApiResponse(true, 'Daftar Kecamatan', $list);
        } catch (\Exception $e) {
            return sendApiResponse(false, 'Terjadi kesalahan teknis, silakan kontak customer service kami', null, 400);
        }
    }

    public function villages(Request $request, $sector_code)
    {
        try {
            $list = Village::where('sector_code', $sector_code)->orderBy('village_name', 'asc')->get();
            return sendApiResponse(true, 'Daftar Kelurahan', $list);
        } catch (\Exception $e) {
            return sendApiResponse(false, 'Terjadi kesalahan teknis, silakan kontak customer service kami', null, 400);
        }
    }
}