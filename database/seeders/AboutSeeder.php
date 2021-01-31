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
                'content' => 'SMK BPI Bandung adalah sebuah sekolah kejuruan yang dibawahi [Yayasan Badan Perguruan Indonesia](http://www.bpiedu.id/), yang mempunyai 3 Program Studi keahlian yang sudah terakreditasi antara lain :
- Otomatisasi dan Tata Kelola Perkantoran
- Rekayasa Perangkat Lunak
- Teknik Komputer Jaringan

[Profil SMK BPI]('.feUrl('profile/public').')',
                'url' => 'homepage/about.webp'
            ]);
    }
}
