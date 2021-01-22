<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = [
            ['{yayasan_url}', 'http://www.bpiedu.id'],
            ['{bpi}', 'Badan Perguruan Indonesia'],
            ['{otkp}', 'Otomatisasi dan Tata Kelola Perkantoran'],
            ['{rpl}', 'Rekayasa Perangkat Lunak'],
            ['{tkj}', 'Teknik Komputer dan Jaringan'],
        ];
        $t = now();

        foreach($a as $b) $data[] = [
            'key' => $b[0],
            'value' => $b[1],
            'created_at' => $t,
            'updated_at' => $t
        ];

        \App\Models\Keyword::truncate();
        \App\Models\Keyword::insert($data);
    }
}
