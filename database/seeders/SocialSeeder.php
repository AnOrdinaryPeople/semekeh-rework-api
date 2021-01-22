<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t = now();

        \App\Models\Social::truncate();
        \App\Models\Social::insert([
            [
                'icon' => 'facebook-f',
                'link' => 'https://www.facebook.com/SmkBpiBandung',
                'created_at' => $t,
                'updated_at' => $t
            ], [
                'icon' => 'twitter',
                'link' => 'https://www.twitter.com/smkbpibdg',
                'created_at' => $t,
                'updated_at' => $t
            ], [
                'icon' => 'google-plus-g',
                'link' => 'https://plus.google.com/u/0/114124411410825383869',
                'created_at' => $t,
                'updated_at' => $t
            ], [
                'icon' => 'instagram',
                'link' => 'https://www.instagram.com/smkbpibandung',
                'created_at' => $t,
                'updated_at' => $t
            ],
        ]);
    }
}
