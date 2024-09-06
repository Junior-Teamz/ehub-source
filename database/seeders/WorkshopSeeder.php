<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Target;
use App\Models\Workshop;
use App\Models\WorkshopTag;
use App\Models\WorkshopTarget;
use App\Models\Collaborator;
use App\Models\WorkshopCollaborator;

class WorkshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collaborator = Collaborator::updateOrCreate([
            'user_id' => 1,
            'slug' => 'kemenkopukm',
            'logo_url' => 'https://i.ibb.co/LgY7Rfj/Kemenkop-UKM-removebg-preview.png',
            'cover_url' => 'https://i.ibb.co/Gt0zkGp/clark-tibbs-oq-Stl2-L5ox-I-unsplash.jpg',
            'site' => 'https://kemenkopukm.go.id/',
            'name' => 'KemenkopUKM',
            'director_name' => 'Teten Masduki',
            'state_id' => 31,
            'city_id' => 3174,
            'address' => 'Jl. H. R. Rasuna Said No.Kav. 3-4, RT.6/RW.7, Kuningan, Karet Kuningan, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12940',
            'description' => 'Kementerian Koperasi dan Usaha Kecil dan Menengah Republik Indonesia adalah kementerian dalam Pemerintah Indonesia yang membidangi urusan koperasi dan usaha kecil dan menengah. Kementerian Koperasi, dan UKM dipimpin oleh seorang Menteri Koperasi dan Usaha Kecil dan Menengah (Menkop, dan UKM) yang sejak tanggal 23 Oktober 2019 dijabat oleh Teten Masduki.',
            'status' => 1,
        ]);

        $workshop = Workshop::updateOrCreate([
            'title' => 'Baparekraf ScaleUp Champions (BSC)',
            'slug' => 'baparekraf-scaleup-champions-bsc',
            'thumbnail' => 'https://pbs.twimg.com/media/FvBypZLaQAULB7Y?format=jpg&name=large',
            'description' => 'Baparekraf ScaleUp Champions (BSC) adalah program akselerasi startup untuk mendukung inovasi dan teknologi informasi yang menunjang perkembangan ekosistem industri startup digital di Indonesia. Program ditujukan untuk startup berbasis aplikasi digital yang mendukung perkembangan 17 Subsektor Ekonomi Kreatif melalui kegiatan workshop, mentoring, dan akses ke global partner.',
            'material_links' => '',
            'place' => 'Jakarta',
            'start_date' => '2023-05-05',
            'end_date' => '2023-05-15',
            'start_time' => '16:20',
            'end_time' => '16:20',
            'quota' => 60,
            'registrant_total' => 40,
            'registrant_accepted' => 20,
            'status' => 'publish',
            'created_by' => 1,
            'state_id' => 31,
            'city_id' => 3171,
            'organizer' => 'Kemenparekraf',
            'organizer_image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Seal_of_the_Ministry_of_Tourism_and_Creative_Economy_of_the_Republic_of_Indonesia_%28Indonesian_version%29.svg/1920px-Seal_of_the_Ministry_of_Tourism_and_Creative_Economy_of_the_Republic_of_Indonesia_%28Indonesian_version%29.svg.png',
        ]);

        WorkshopCollaborator::updateOrCreate([
            'workshop_id' => $workshop->id,
            'collaborator_id' => $collaborator->id
        ]);

        $current_tag = Tag::updateOrCreate([
            'name' => 'Akses Pasar & Fasilitas Infrastruktur',
            'type' => 'workshop'
        ]);

        WorkshopTag::updateOrCreate([
            'workshop_id' => $workshop->id,
            'tag_id' => $current_tag->id
        ]);

        $targets = ['Masyarakat Umum', 'Calon Wirausaha', 'Wirausaha Pemula', 'Wirausaha Mapan'];
        foreach($targets as $target) {
            Target::updateOrCreate([
                'name' => $target
            ]);
        }

        WorkshopTarget::updateOrCreate([
            'workshop_id' => $workshop->id,
            'target_id' => 1
        ]);
    }
}


