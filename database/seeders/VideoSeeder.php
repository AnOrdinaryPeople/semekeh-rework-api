<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = now();

        for($i = 1; $i <= 2; $i++) $data[] = [
            'thumbnail' => "homepage/thumbnail-$i.webp",
            'video' => "homepage/video-$i.mp4",
            'is_publish' => true,
            'created_at' => $a,
            'updated_at' => $a
        ];

        \App\Models\Video::truncate();
        \App\Models\Video::insert($data);
    }
}
