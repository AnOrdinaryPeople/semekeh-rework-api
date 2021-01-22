<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Alumni::truncate();
        \App\Models\Alumni::insert([
            [
                'name' => 'Meta Rahayu',
                'company' => 'Manajemen UPI',
                'content' => 'Alhamdulillah, banyak ilmu dan manfaat yang saya dapatkan selama belajar di SMK BPI, berkat program yang dilakukan di sekolah, saya dapat menjadi pribadi yang lebih baik.',
                'url' => 'homepage/alumni-3.webp',
                'is_publish' => true,
                'created_at' => now('-2 hours'),
                'updated_at' => now('-2 hours')
            ], [
                'name' => 'Achmad Try August',
                'company' => 'Teknisi IT di PT.BIT',
                'content' => 'Luar biasa, karena saya sangat menikmati setiap detik saat bersekolah di SMK BPI. Banyak hal dan kenangan menarik yang saya bisa dapat di SMK BPI.',
                'url' => 'homepage/alumni-2.webp',
                'is_publish' => true,
                'created_at' => now('-1 hours'),
                'updated_at' => now('-1 hours')
            ], [
                'name' => 'Hamdan Hanafi',
                'company' => 'PT. Smooets',
                'content' => 'SMK BPI adalah sekolah yang menyenangkan, Alhamdulillah, saya dibimbing dan dididik oleh guru-guru yang berpengalaman serta selalu disiplin penuh terhadap siswanya.',
                'url' => 'homepage/alumni-1.webp',
                'is_publish' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
