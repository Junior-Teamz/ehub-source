<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusinessType;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businesses = [
            'Kuliner',
            'Fashion',
            'Kecantikan/Kosmetik',
            'Otomotif',
            'Pendidikan',
            'Traveling/Pariwisata',
            'Produk/Jasa Kreatif',
            'Event Organizer',
            'Agribisnis',
            'Digital',
            'Lainnya',
        ];

        foreach($businesses as $business) {
            BusinessType::updateOrCreate([
                'name' => $business
            ]);
        }
    }
}
