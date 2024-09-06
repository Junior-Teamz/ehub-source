<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\News;
use App\Models\NewsTag;

class NewsTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [ 'name' => 'Bisnis', 'type' => 'news'],
            [ 'name' => 'Wirausaha', 'type' => 'news'],
        ];

        foreach ($tags as $tag) {
            $existingTag = Tag::where('name', $tag['name'])
                              ->where('type', $tag['type'])
                              ->first();
            if (!$existingTag) {
                Tag::create($tag);
            }
        }

        $news = [
            'created_by' => 1,
            'url_thumbnail' => 'https://dev.siwira.my.id/images/dummies/news-1.png',
            'title' => 'EntrepreneurHub Ada di Setiap Kota Indonesia',
            'slug' => 'entrepreneurHub-ada-di-setiap-kota-indonesia',
            'content' => 'Pengembangan wirausaha indonesia akan menyebar ke berbagai kota di Seluruh Indonesia Pengembangan wirausaha indonesia akan menyebar ke berbagai kota di Seluruh Indonesia Pengembangan wirausaha indonesia akan menyebar ke berbagai kota di Seluruh Indonesia Pengembangan wirausaha indonesia akan menyebar ke berbagai kota di Seluruh Indonesia Pengembangan wirausaha indonesia akan menyebar ke berbagai kota di Seluruh Indonesia Pengembangan wirausaha indonesia akan menyebar ke berbagai kota di Seluruh Indonesia Pengembangan wirausaha indonesia akan menyebar ke berbagai kota di Seluruh Indonesia',
            'status' => 1,
            'viewer' => 0
        ];

        for($i = 1; $i <= 5; $i++) {
            $current_news = News::create($news);

            NewsTag::create([
                'news_id' => $current_news->id,
                'tag_id' => 1
            ]);
        }
    }
}
