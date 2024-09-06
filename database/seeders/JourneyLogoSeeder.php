<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JourneyLogo;

class JourneyLogoSeeder extends Seeder
{
    public function run()
    {
        // Data untuk page_id = 1 dan section_id = 1
        $businessIdeas = collect([
            (object) [
                'name' => 'Daya.id',
                'image' => 'images/communities/daya.id.jpg',
                'site' => 'https://www.daya.id/',
            ],
        ]);

        // Data untuk page_id = 1 dan section_id = 2
        $marketResearchs = collect([
            (object) [
                'name' => 'Google Trends',
                'image' => 'images/communities/google-trends.png',
                'site' => 'https://trends.google.com/trends/',
            ],
            (object) [
                'name' => 'Survey Monkey',
                'image' => 'images/communities/survey-monkey.png',
                'site' => 'https://www.surveymonkey.com/',
            ],
            (object) [
                'name' => 'Google Form',
                'image' => 'images/communities/google-form.png',
                'site' => 'https://docs.google.com/forms/',
            ],
        ]);

        // Data untuk page_id = 1 dan section_id = 3
        $businessIncubators = collect([
            (object) [
                'name' => 'Innovative Academy',
                'image' => 'images/communities/innovative-academy.jpg',
                'site' => 'https://ia.ugm.ac.id/id/halaman-muka/',
            ],
            (object) [
                'name' => 'Inkubator Universitas Hasanuddin',
                'image' => 'images/communities/inkubator-unhas.png',
                'site' => 'https://inkubator.unhas.ac.id/',
            ],
            (object) [
                'name' => 'Solo Techno Incubator',
                'image' => 'images/communities/solo-incubator.png',
                'site' => 'https://incubator.solotechnopark.id/',
            ],
            (object) [
                'name' => 'Inkubator Bisnis Stikom Bali',
                'image' => 'images/communities/inbis-bali.png',
                'site' => 'https://ibt.stikom-bali.ac.id/',
            ],
            (object) [
                'name' => 'Bandung Techno Park',
                'image' => 'images/communities/btp.png',
                'site' => 'https://btp.or.id/',
            ],
            (object) [
                'name' => 'Science Techno Park',
                'image' => 'images/communities/stpiipb.jpg',
                'site' => 'https://stp.ipb.ac.id/',
            ],
        ]);

        // Data untuk page_id = 2 dan section_id = 5
        $production = collect([
            (object) [
                'name' => 'Manuva',
                'image' => 'images/communities/manuva.jpg',
                'site' => 'https://manuva.com/',
            ],
            (object) [
                'name' => 'Skyeats',
                'image' => 'images/communities/skyeats.png',
                'site' => 'https://www.skyeats.id/',
            ],
            (object) [
                'name' => 'Surplus',
                'image' => 'images/communities/surplus.png',
                'site' => 'https://www.surplus.id/',
            ],
            (object) [
                'name' => 'Warjali',
                'image' => 'images/communities/warjali.png',
                'site' => 'https://warjali.id/',
            ],
            (object) [
                'name' => 'Beliayam.com',
                'image' => 'images/communities/beliayam.jpg',
                'site' => 'https://www.beliayam.co/',
            ],
        ]);

        // Data untuk page_id = 2 dan section_id = 4
        $legality = collect([
            (object) [
                'name' => 'Kontrak Hukum',
                'image' => 'images/communities/kontrakhukum.webp',
                'site' => 'https://kontrakhukum.com/',
            ],
            (object) [
                'name' => 'OSS',
                'image' => 'images/communities/oss.png',
                'site' => 'https://oss.go.id/',
            ],
            (object) [
                'name' => 'MUI',
                'image' => 'images/communities/mui.png',
                'site' => 'https://mui.or.id/',
            ],
            (object) [
                'name' => 'Bank BRI',
                'image' => 'images/communities/bri.webp',
                'site' => 'https://bri.co.id/',
            ],
            (object) [
                'name' => 'Bank Mandiri',
                'image' => 'images/communities/mandiri.webp',
                'site' => 'https://bankmandiri.co.id/en/home',
            ],
            (object) [
                'name' => 'Bank BNI',
                'image' => 'images/communities/bni.png',
                'site' => 'https://www.bni.co.id/id-id/',
            ],
            (object) [
                'name' => 'Bank BTN',
                'image' => 'images/communities/btn.png',
                'site' => 'https://www.btn.co.id/',
            ],
        ]);

        // Data untuk page_id = 2 dan section_id = 6
        $distribution = collect([
            (object) [
                'name' => 'Waresix',
                'image' => 'images/communities/shipper.png',
                'site' => 'https://www.waresix.com/',
            ],
            (object) [
                'name' => 'Shipper',
                'image' => 'images/communities/shipper.png',
                'site' => 'https://shipper.id/',
            ],
            (object) [
                'name' => 'Sakago',
                'image' => 'images/communities/sakago.png',
                'site' => 'https://sakago.id/',
            ],
            (object) [
                'name' => 'Praktis',
                'image' => 'images/communities/praktis.png',
                'site' => 'https://www.praktis.co/',
            ],
        ]);

        // Data untuk page_id = 2 dan section_id = 7
        $marketing = collect([
            (object) [
                'name' => 'Ayowebs',
                'image' => 'images/communities/ayowebs.png',
                'site' => 'https://ayowebs.com/',
            ],
            (object) [
                'name' => 'Uwala',
                'image' => 'images/communities/uwala.png',
                'site' => 'https://uwala.id/',
            ],
            (object) [
                'name' => 'Soodu',
                'image' => 'images/communities/soodu.png',
                'site' => 'https://soodu.id/',
            ],
            (object) [
                'name' => 'Ruanghalal',
                'image' => 'images/communities/ruanghalal.png',
                'site' => 'https://ruanghalal.com/',
            ],
            (object) [
                'name' => 'Kreatiful',
                'image' => 'images/communities/kreatiful.png',
                'site' => 'https://kreatiful.id/',
            ],
            (object) [
                'name' => 'Dynamicbuzz',
                'image' => 'images/communities/dynamicbuzz.png',
                'site' => 'https://www.dynamicbuzz.id/',
            ],
        ]);

        // Data untuk page_id = 2 dan section_id = 8
        $finances = collect([
            (object) [
                'name' => 'Credibook',
                'image' => 'images/communities/credibook.png',
                'site' => 'https://credibook.com/id',
            ],
        ]);

        // Data untuk page_id = 3 dan section_id = 9
        $enablers = collect([
            (object) [
                'name' => 'Chatbiz',
                'image' => 'images/communities/chatbiz.svg',
                'site' => 'https://www.chatbiz.id/',
            ],
            (object) [
                'name' => 'Pasar Digital UMKM',
                'image' => 'images/communities/padi-umkm.svg',
                'site' => 'https://padiumkm.id/',
            ],
            (object) [
                'name' => 'Lembaga Kebijakan Pengadaan Barang Jasa Pemerintah',
                'image' => 'images/communities/lkpp.png',
                'site' => 'http://www.lkpp.go.id/v3/',
            ],
            (object) [
                'name' => 'Instellar',
                'image' => 'images/communities/instellar.webp',
                'site' => 'http://www.instellar.id',
            ],
            (object) [
                'name' => 'Jakarta Impact Hub',
                'image' => 'images/communities/jkt-impacthub.png',
                'site' => 'https://jakarta.impacthub.net/',
            ],
        ]);

        // Data untuk page_id = 3 dan section_id = 10
        $exports = collect([
            (object) [
                'name' => 'Bisa Ekspor',
                'image' => 'images/communities/bisaekspor-logo.png',
                'site' => 'https://www.bisaekspor.com/',
            ],
            (object) [
                'name' => 'Nirmala',
                'image' => 'images/communities/nirmala.png',
                'site' => 'https://nirmalaarchipelago.com/',
            ],
            (object) [
                'name' => 'Greeneconomy',
                'image' => 'images/communities/biopac.png',
                'site' => 'https://biopac.id/?lang=id',
            ],
        ]);

        // Data untuk page_id = 3 dan section_id = 11
        $fundings = collect([
            (object) [
                'name' => 'Pintar Ventura Group',
                'image' => 'images/communities/pvg.png',
                'site' => 'https://pvg.co.id/',
            ],
            (object) [
                'name' => 'East Venture',
                'image' => 'images/communities/eastventures.jpg',
                'site' => 'https://east.vc/id/',
            ],
            (object) [
                'name' => 'Investree',
                'image' => 'images/communities/investree.png',
                'site' => 'https://investree.id/',
            ],
            (object) [
                'name' => 'Angel Invesment Network Indonesia',
                'image' => 'images/communities/angin.png',
                'site' => 'https://www.angin.id/',
            ],
            (object) [
                'name' => 'Fundex',
                'image' => 'images/communities/fundex.png',
                'site' => 'https://fundex.id/',
            ],
            (object) [
                'name' => 'Bank BTPN',
                'image' => 'images/communities/bank-btpn.jpg',
                'site' => 'https://www.skystarventures.com/',
            ],
            (object) [
                'name' => 'MDI Ventures',
                'image' => 'images/communities/mdi-ventures.png',
                'site' => 'https://www.btpn.com/',
            ],
        ]);

        // Menyimpan data dalam database
        $this->saveDataToDatabase($businessIdeas, 1, 1);
        $this->saveDataToDatabase($marketResearchs, 1, 2);
        $this->saveDataToDatabase($businessIncubators, 1, 3);
        $this->saveDataToDatabase($production, 2, 5);
        $this->saveDataToDatabase($legality, 2, 4);
        $this->saveDataToDatabase($distribution, 2, 6);
        $this->saveDataToDatabase($marketing, 2, 7);
        $this->saveDataToDatabase($finances, 2, 8);
        $this->saveDataToDatabase($enablers, 3, 9);
        $this->saveDataToDatabase($exports, 3, 10);
        $this->saveDataToDatabase($fundings, 3, 11);
    }

    private function saveDataToDatabase($data, $pageId, $sectionId)
    {
        foreach ($data as $item) {
            JourneyLogo::updateOrCreate([
                'logo_name' => $item->name,
                'url_logo' => $item->image,
                'website' => $item->site,
                'status' => 1,
                'page_id' => $pageId,
                'section_id' => $sectionId,
            ]);
        }
    }
}
