<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Sector;
use App\Models\Village;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            (object)[
                'country_code' => 100,
                'name' => 'INDONESIA',
                'iso' => 'ID',
                'nicename' => 'Indonesia',
                'iso3' => 'IDN',
                'numcode' => 360,
                'phonecode' => 62,
            ]
        ];

        foreach($countries as $country) {
            Country::create([
                'country_code' => $country->country_code,
                'name' => $country->name,
                'iso' => $country->iso,
                'nicename' => $country->nicename,
                'iso3' => $country->iso3,
                'numcode' => $country->numcode,
                'phonecode' => $country->phonecode,
            ]);
        }

        $states = [
            (object)[
                'country_code' => $countries[0]->country_code,
                'state_code' => 31,
                'state_name' => 'DKI Jakarta',
            ]
        ];

        foreach($states as $state) {
            State::create([
                'country_code' => $state->country_code,
                'state_code' => $state->state_code,
                'state_name' => $state->state_name,
            ]);
        }

        $cities = [
            (object)[
                'state_code' => $states[0]->state_code,
                'city_code' => 3101,
                'city_name' => 'Kepulauan Seribu',
            ],
            (object)[
                'state_code' => $states[0]->state_code,
                'city_code' => 3171,
                'city_name' => 'Jakarta Pusat',
            ],
            (object)[
                'state_code' => $states[0]->state_code,
                'city_code' => 3172,
                'city_name' => 'Jakarta Utara',
            ],
            (object)[
                'state_code' => $states[0]->state_code,
                'city_code' => 3173,
                'city_name' => 'Jakarta Barat',
            ],
            (object)[
                'state_code' => $states[0]->state_code,
                'city_code' => 3174,
                'city_name' => 'Jakarta Selatan',
            ],
            (object)[
                'state_code' => $states[0]->state_code,
                'city_code' => 3175,
                'city_name' => 'Jakarta Timur',
            ],
        ];

        foreach($cities as $city) {
            City::create([
                'state_code' => $city->state_code,
                'city_code' => $city->city_code,
                'city_name' => $city->city_name,
            ]);
        }

        $sectors = [
            (object)[
                'city_code' => $cities[1]->city_code,
                'sector_code' => 317101,
                'sector_name' => 'Gambir',
            ],
            (object)[
                'city_code' => $cities[1]->city_code,
                'sector_code' => 317102,
                'sector_name' => 'Sawah Besar',
            ],
            (object)[
                'city_code' => $cities[1]->city_code,
                'sector_code' => 317103,
                'sector_name' => 'Kemayoran',
            ],
            (object)[
                'city_code' => $cities[1]->city_code,
                'sector_code' => 317104,
                'sector_name' => 'Senen',
            ],
            (object)[
                'city_code' => $cities[1]->city_code,
                'sector_code' => 317105,
                'sector_name' => 'Cempaka Putih',
            ],
            (object)[
                'city_code' => $cities[1]->city_code,
                'sector_code' => 317106,
                'sector_name' => 'Menteng',
            ],
            (object)[
                'city_code' => $cities[1]->city_code,
                'sector_code' => 317107,
                'sector_name' => 'Tanah Abang',
            ],
            (object)[
                'city_code' => $cities[1]->city_code,
                'sector_code' => 317108,
                'sector_name' => 'Johar Baru',
            ],
        ];

        foreach($sectors as $sector) {
            Sector::create([
                'city_code' => $sector->city_code,
                'sector_code' => $sector->sector_code,
                'sector_name' => $sector->sector_name,
            ]);
        }

        $villages = [
            (object)[
                'sector_code' => $sectors[0]->sector_code,
                'village_code' => 3171011001,
                'village_name' => 'Gambir',
            ],
            (object)[
                'sector_code' => $sectors[0]->sector_code,
                'village_code' => 3171011002,
                'village_name' => 'Cideng',
            ],
            (object)[
                'sector_code' => $sectors[0]->sector_code,
                'village_code' => 3171011003,
                'village_name' => 'Petojo Utara',
            ],
            (object)[
                'sector_code' => $sectors[0]->sector_code,
                'village_code' => 317101104,
                'village_name' => 'Petojo Selatan',
            ],
            (object)[
                'sector_code' => $sectors[0]->sector_code,
                'village_code' => 3171011005,
                'village_name' => 'Kebon Kelapa',
            ],
            (object)[
                'sector_code' => $sectors[0]->sector_code,
                'village_code' => 3171011006,
                'village_name' => 'Duri Pulo',
            ],
        ];

        foreach($villages as $village) {
            Village::create([
                'sector_code' => $village->sector_code,
                'village_code' => $village->village_code,
                'village_name' => $village->village_name,
            ]);
        }
    }
}
