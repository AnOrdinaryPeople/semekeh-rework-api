<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrestationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Prestation::truncate();
        \App\Models\Prestation::insert([
            [
                'title' => 'Olimpiade Jaringan Mikrotik',
                'rank' => 'Juara 1',
                'year' => 2016,
                'url' => 'prestation/prestation-1.jpg',
                'created_at' => now('-7 minutes'),
                'updated_at' => now('-7 minutes')
            ], [
                'title' => 'Karya Ilmiah Nasional',
                'rank' => 'Juara 1',
                'year' => 2018,
                'url' => 'prestation/prestation-2.jpg',
                'created_at' => now('-6 minutes'),
                'updated_at' => now('-6 minutes')
            ], [
                'title' => 'Karya Ilmiah Nasional',
                'rank' => 'Juara 3',
                'year' => 2019,
                'url' => 'prestation/prestation-3.jpg',
                'created_at' => now('-5 minutes'),
                'updated_at' => now('-5 minutes')
            ], [
                'title' => 'Duta Mixagrip',
                'rank' => 'Juara 1',
                'year' => 2019,
                'url' => 'prestation/prestation-4.jpg',
                'created_at' => now('-4 minutes'),
                'updated_at' => now('-4 minutes')
            ], [
                'title' => 'Foto Kontes Mixagrip',
                'rank' => 'Juara 1',
                'year' => 2019,
                'url' => 'prestation/prestation-5.jpg',
                'created_at' => now('-3 minutes'),
                'updated_at' => now('-3 minutes')
            ], [
                'title' => 'Web Design STMIK AMIK Bandung',
                'rank' => 'Juara 2',
                'year' => 2018,
                'url' => 'prestation/prestation-6.webp',
                'created_at' => now('-2 minutes'),
                'updated_at' => now('-2 minutes')
            ], [
                'title' => 'Gema Ramadhan',
                'rank' => 'Juara 2',
                'year' => 2019,
                'url' => 'prestation/prestation-7.webp',
                'created_at' => now('-1 minutes'),
                'updated_at' => now('-1 minutes')
            ], [
                'title' => 'Web Development Dinamik 14 UPI',
                'rank' => 'Juara 2',
                'year' => 2019,
                'url' => 'prestation/prestation-8.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
