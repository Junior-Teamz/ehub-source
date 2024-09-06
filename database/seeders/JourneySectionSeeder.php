<?php

namespace Database\Seeders;

use App\Models\JourneyPage;
use App\Models\JourneySection;
use Illuminate\Database\Seeder;

class JourneySectionSeeder extends Seeder
{
    public function run()
    {
        $sections = [
            ['name' => 'Ide Usaha', 'page' => 'plan'],
            ['name' => 'Riset Pasar', 'page' => 'plan'],
            ['name' => 'Inkubasi Ide dan Rencana', 'page' => 'plan'],
            ['name' => 'Badan Hukum & Izin Usaha', 'page' => 'launch'],
            ['name' => 'Produksi Usaha', 'page' => 'launch'],
            ['name' => 'Distribusi dan Pengiriman', 'page' => 'launch'],
            ['name' => 'Pemasaran', 'page' => 'launch'],
            ['name' => 'Keuangan', 'page' => 'launch'],
            ['name' => 'Enabler', 'page' => 'growth'],
            ['name' => 'Ekspor', 'page' => 'growth'],
            ['name' => 'Funding', 'page' => 'growth'],
        ];

        foreach ($sections as $sectionData) {
            $pageName = $sectionData['page'];
            $page = JourneyPage::where('page_name', $pageName)->first();

            JourneySection::updateOrCreate([
                'section_name' => $sectionData['name'],
                'page_id' => $page->id,
            ]);
        }
    }
}
