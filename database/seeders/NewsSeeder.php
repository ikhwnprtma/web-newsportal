<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'title' => 'Judul',
                'slug' => 'berita-pertama',
                'content' => 'Isi Konten Berita',
                'image' => 'images.jpg',
                'user_id' => 1,
                'category_id' => 1,
            ]
        ];

        foreach ($data as $item) {
            News::create($item);
        };
    }
    
}
