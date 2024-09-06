<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [ 'name' => 'Legalitas & Perizinan', 'type' => 'collaborator'],
            [ 'name' => 'Produksi', 'type' => 'collaborator'],
            [ 'name' => 'Distribusi', 'type' => 'collaborator'],
            [ 'name' => 'Marketing', 'type' => 'collaborator'],
            [ 'name' => 'Finance', 'type' => 'collaborator'],
            [ 'name' => 'Enabler', 'type' => 'collaborator' ],
            [ 'name' => 'Funding', 'type' => 'collaborator' ],
            [ 'name' => 'Ekspor', 'type' => 'collaborator' ],
            [ 'name' => 'Inkubator', 'type' => 'collaborator' ],
            [ 'name' => 'Komunitas', 'type' => 'collaborator' ],
            [ 'name' => 'Asosiasi', 'type' => 'collaborator' ],
            [ 'name' => 'Lembaga Pendidikan', 'type' => 'collaborator' ],
            [ 'name' => 'Funding', 'type' => 'collaborator' ],
            [ 'name' => 'Mitra CSR', 'type' => 'collaborator' ],         
            [ 'name' => 'Pelatihan', 'type' => 'collaborator' ],
            [ 'name' => 'Human Resource', 'type' => 'collaborator' ],
            [ 'name' => 'Operasional', 'type' => 'collaborator' ],
            [ 'name' => 'Akselerator', 'type' => 'collaborator' ],
            [ 'name' => 'IT (Teknologi)', 'type' => 'collaborator' ],

            [ 'name' => 'Bisnis Proposal', 'type' => 'template' ],
            [ 'name' => 'Finansial', 'type' => 'template' ],
            [ 'name' => 'Legalitas & Perizinan', 'type' => 'template' ],
            [ 'name' => 'Produksi', 'type' => 'template' ],
            [ 'name' => 'Distribusi', 'type' => 'template' ],
            [ 'name' => 'Marketing', 'type' => 'template' ],
            [ 'name' => 'Enabler', 'type' => 'template' ],
            [ 'name' => 'Funding', 'type' => 'template' ],
            [ 'name' => 'Inkubator', 'type' => 'template' ],
            [ 'name' => 'Human Resource', 'type' => 'template' ],
            [ 'name' => 'Operasional', 'type' => 'template' ],
            [ 'name' => 'Akselerator', 'type' => 'template' ],
            [ 'name' => 'IT (Teknologi)', 'type' => 'template' ],
            
            [ 'name' => 'Bisnis', 'type' => 'news' ],
            [ 'name' => 'Wirausaha', 'type' => 'news' ],
            [ 'name' => 'Akses Pasar & Fasilitas Infrastruktur', 'type' => 'news' ],
            [ 'name' => 'Bisnis Proposal', 'type' => 'news' ],
            [ 'name' => 'Finansial', 'type' => 'news' ],
            [ 'name' => 'Legalitas & Perizinan', 'type' => 'news' ],
            [ 'name' => 'Produksi', 'type' => 'news' ],
            [ 'name' => 'Distribusi', 'type' => 'news' ],
            [ 'name' => 'Marketing', 'type' => 'news' ],
            [ 'name' => 'Enabler', 'type' => 'news' ],
            [ 'name' => 'Funding', 'type' => 'news' ],
            [ 'name' => 'Inkubator', 'type' => 'news' ],
            [ 'name' => 'Pelatihan', 'type' => 'news' ],
            [ 'name' => 'Edukasi', 'type' => 'news' ],
            [ 'name' => 'Startup', 'type' => 'news' ],
            [ 'name' => 'UMKM', 'type' => 'news' ],
            [ 'name' => 'IT (Teknologi)', 'type' => 'news' ],

            [ 'name' => 'Bisnis', 'type' => 'workshop' ],
            [ 'name' => 'Wirausaha', 'type' => 'workshop' ],
            [ 'name' => 'Akses Pasar & Fasilitas Infrastruktur', 'type' => 'workshop' ],
            [ 'name' => 'Bisnis Proposal', 'type' => 'workshop' ],
            [ 'name' => 'Finansial', 'type' => 'workshop' ],
            [ 'name' => 'Legalitas & Perizinan', 'type' => 'workshop' ],
            [ 'name' => 'Produksi', 'type' => 'workshop' ],
            [ 'name' => 'Distribusi', 'type' => 'workshop' ],
            [ 'name' => 'Marketing', 'type' => 'workshop' ],
            [ 'name' => 'Enabler', 'type' => 'workshop' ],
            [ 'name' => 'Funding', 'type' => 'workshop' ],
            [ 'name' => 'Inkubator', 'type' => 'workshop' ],
            [ 'name' => 'Pelatihan', 'type' => 'workshop' ],
            [ 'name' => 'Human Resource', 'type' => 'workshop' ],
            [ 'name' => 'Operasional', 'type' => 'workshop' ],
            [ 'name' => 'Akselerator', 'type' => 'workshop' ],
            [ 'name' => 'IT (Teknologi)', 'type' => 'workshop' ],

        ];

        foreach ($tags as $tag) {
            $existingTag = Tag::where('name', $tag['name'])
                              ->where('type', $tag['type'])
                              ->first();

            if (!$existingTag) {
                Tag::create($tag);
            }
        }
    }
}
