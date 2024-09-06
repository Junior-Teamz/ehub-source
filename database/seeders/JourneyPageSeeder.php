<?php

namespace Database\Seeders;

use App\Models\JourneyPage;
use Illuminate\Database\Seeder;

class JourneyPageSeeder extends Seeder
{
    public function run()
    {
        $pages = ['plan', 'launch', 'growth'];

        foreach ($pages as $pageName) {
            JourneyPage::updateOrCreate([
                'page_name' => $pageName,
            ]);
        }
    }
}
