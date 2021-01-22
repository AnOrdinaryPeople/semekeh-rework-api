<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Carousel::truncate();
        \App\Models\Carousel::insert([
            [
                'type' => 1,
                'title' => 'Welcome to SMK BPI Site',
                'description' => 'BERMARTABAT, BERKUALITAS, DAN TERPERCAYA !',
                'url' => 'homepage/carousel-1.webp',
                'created_at' => now('-3 minutes'),
                'updated_at' => now('-3 minutes')
            ], [
                'type' => 2,
                'title' => 'APA ITU OTKP',
                'description' => 'Otomatisasi dan Tata Kelola Perkantoran adalah salah satu kompetensi keahlian di SMK BPI Bandung. membekali siswa pada kegiatan perkantoran serta ketata usahaan berbasis ICT. Menekankan kegiatan administrasi yang mahir dalam melaksanakan tugas Seketaris Junior, Public Relations, Arsiparis, Typing, Receptionist, dan Wirausaha yang teguh',
                'url' => 'homepage/carousel-2.webp',
                'created_at' => now('-2 minutes'),
                'updated_at' => now('-2 minutes')
            ], [
                'type' => 2,
                'title' => 'APA ITU RPL',
                'description' => 'Rekayasa Perangkat Lunak merupakan salah satu jurusan yang terdapat di SMK BPI Bandung. Dimana siswa belajar bagaimana membuat program di komputer dan mengajarkan juga cara kita berpikir. Jurusan ini mencetak siswa-siswi yang handal di bidang Aplikasi Mobile, Aplikasi Web, dan Web Desain, yang mana menjadikan profesi masa depan yang lebih cerah sebagai Talenta Muda',
                'url' => 'homepage/carousel-3.webp',
                'created_at' => now('-1 minutes'),
                'updated_at' => now('-1 minutes')
            ], [
                'type' => 2,
                'title' => 'APA ITU TKJ',
                'description' => 'Teknik Komputer dan Jaringan adalah jurusan yang mempelajari tentang cara instalasi PC dan LAN, memperbaiki PC, dan mempelajari program-program PC. Salah satu keunggulan TKJ adalah penggunaan metode praktik langsung sehingga mampu menyediakan sumber belajar yang tidak terbatas, penilaian transparan serta mendidik siswa untuk berpikir ilmiah dengan memperhatikan potensi masing-masing individu. Pembelajaran selalu update sesuai perkembangan teknologi IT Networking',
                'url' => 'homepage/carousel-4.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
