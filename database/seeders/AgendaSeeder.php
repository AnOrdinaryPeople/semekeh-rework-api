<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = [
            [
                'data' => [
                    'slug' => kebabCase(strtotime(now()).' FIESTA SMK BPI Bandung'),
                    'title' => 'FIESTA SMK BPI Bandung',
                    'time' => '9, 11-12 Februari 2017',
                    'content' => 'Lomba Kreatifitas Pelajar dengan lomba akustik tingkat SMP dan SMA/SMK dan lomba Jaipongan dari Tingkat TK, SD dan SMP.',
                    'banner' => 'agenda/agenda-5.jpg',
                    'created_at' => now('-4 hours'),
                    'updated_at' => now('-4 hours'),
                ],
                'img' => ['5-1.jpg', '5-2.jpg', '5-3.jpg', '5-4.jpg', '5-5.jpg', '5-6.jpg', '5-7.jpg', '5-8.jpg', '5-9.jpg', '5-10.jpg', '5-11.jpg']
            ], [
                'data' => [
                    'slug' => kebabCase(strtotime(now()).' Ujikom AP dan TKJ'),
                    'title' => 'Ujikom AP dan TKJ',
                    'time' => '16 Februari 2017',
                    'content' => 'Ujian Kompetensi Keahlian Untuk bidang Keahlian Administrasi Perkantoran dan Teknik Komputer Jaringan.',
                    'banner' => 'agenda/agenda-4.jpg',
                    'created_at' => now('-3 hours'),
                    'updated_at' => now('-3 hours'),
                ],
                'img' => ['4-1.jpg', '4-2.jpg', '4-3.jpg', '4-4.jpg', '4-5.jpg', '4-6.jpg']
            ], [
                'data' => [
                    'slug' => kebabCase(strtotime(now()).' Peresmian dan Sosialisasi TEFA SMK BPI'),
                    'title' => 'Peresmian dan Sosialisasi TEFA SMK BPI',
                    'time' => '22 Agustus 2019',
                    'content' => 'Peresmian ruangan Teaching Factory (TEFA) SMK BPI oleh Kepala KCD Wil. VII serta sosialisasi program TEFA.',
                    'banner' => 'agenda/agenda-3.png',
                    'created_at' => now('-2 hours'),
                    'updated_at' => now('-2 hours'),
                ],
                'img' => ['3-1.png', '3-2.png', '3-3.png', '3-4.png', '3-5.png', '3-6.png']
            ], [
                'data' => [
                    'slug' => kebabCase(strtotime(now()).' Pameran dan Workshop IoT'),
                    'title' => 'Pameran dan Workshop IoT',
                    'time' => '20 Februari 2020',
                    'content' => 'Pameran hasil karya siswa SMK BPI dan Workshop IoT tingkat SMP se-kota Bandung dalam rangkaian acara LABORA FIESTA 2020.',
                    'banner' => 'agenda/agenda-2.png',
                    'created_at' => now('-1 hours'),
                    'updated_at' => now('-1 hours'),
                ],
                'img' => ['2-1.png', '2-2.png', '2-3.png', '2-4.png', '2-5.png', '2-6.png']
            ], [
                'data' => [
                    'slug' => kebabCase(strtotime(now()).' Pasanggiri Jaipong'),
                    'title' => 'Pasanggiri Jaipong',
                    'time' => '29 Februari 2020',
                    'content' => 'Pasanggiri Jaipong tingkat SD dan SMP dalam rangkaian acara LABORA FIESTA 2020.',
                    'banner' => 'agenda/agenda-1.webp',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                'img' => ['1-1.png', '1-2.png', '1-3.png', '1-4.png', '1-5.png', '1-6.png']
            ],
        ];
        \App\Models\Agenda::truncate();
        \App\Models\Gallery::whereTarget(3)->delete();

        for($i = 0; $i < count($a); $i++){
            \App\Models\Agenda::insert($a[$i]['data']);

            for($j = 0; $j < count($a[$i]['img']); $j++)
                \App\Models\Gallery::create([
                    'target' => 3,
                    'type' => $i + 1,
                    'url' => 'agenda/agenda-'.$a[$i]['img'][$j]
                ]);
        }
    }
}
