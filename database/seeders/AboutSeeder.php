<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\About::truncate();
        \App\Models\About::create([
                'content' => 'SMK BPI Bandung adalah sebuah sekolah kejuruan yang dibawahi [Yayasan Badan Perguruan Indonesia]({yayasan_url}) , yang mempunyai 3 Program Studi keahlian yang sudah terakreditasi antara lain :
- {otkp}
- {rpl}
- {tkj}

[Profil SMK BPI]('.url('profile/public').')',
                'url' => 'homepage/about.webp'
            ]);
    }
}
