<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t = now();

        \App\Models\Section::truncate();
        \App\Models\Section::insert([
            [
                'title' => 'SMK BPI Video',
                'subtitle' => 'Video seputar SMK BPI',
                'created_at' => $t,
                'updated_at' => $t
            ], [
                'title' => 'Profil SMK BPI Bandung',
                'subtitle' => 'Bermartabat, Berkualitas, dan Tepercaya!',
                'created_at' => $t,
                'updated_at' => $t
            ], [
                'title' => 'AGENDA KEGIATAN',
                'subtitle' => 'Agenda Kegiatan yang Akan Datang',
                'created_at' => $t,
                'updated_at' => $t
            ], [
                'title' => 'PRESTASI SMK BPI',
                'subtitle' => 'Tulisan terupdate dari SMK BPI',
                'created_at' => $t,
                'updated_at' => $t
            ], [
                'title' => 'ALUMNI SMK BPI',
                'subtitle' => 'Alumni side',
                'created_at' => $t,
                'updated_at' => $t
            ], [
                'title' => 'MITRA PERUSAHAAN',
                'subtitle' => 'Kita bekerja sama dan mitra dengan Perusahaan',
                'created_at' => $t,
                'updated_at' => $t
            ],
        ]);
    }
}
