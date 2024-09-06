<?php

namespace Database\Seeders;

use App\Models\Expert;
use Illuminate\Database\Seeder;

class ExpertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $experts = [
            [ 'name' => 'Legalitas & Perizinan' ],
            [ 'name' => 'Produksi' ],
            [ 'name' => 'Distribusi' ],
            [ 'name' => 'Marketing' ],
            [ 'name' => 'Finance' ],
            [ 'name' => 'Enabler' ], 
            [ 'name' => 'Funding' ],
            [ 'name' => 'Ekspor' ],
            [ 'name' => 'Inkubator' ],
            [ 'name' => 'Human Resource' ], 
            [ 'name' => 'Operasional' ],
            [ 'name' => 'Akselerator' ],
            [ 'name' => 'IT (Teknologi)' ],
        ];

        foreach ($experts as $expert) {
            $existExpert = Expert::where('name', $expert['name'])->first();
            if (!$existExpert) {
                Expert::create(['name' => $expert['name']]);
            }
        }
    }
}
