<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t = now();
        $a = [
            [
                'profile' => [
                    'title' => 'Profil Umum SMK BPI Bandung',
                    'content' => 'Teknologi Informasi dan Komputer telah menjadi bagian dalam kehidupan masyarakat di era globalisasi dan pasar bebas. Masyarakat saat ini tidak lagi bisa menghindar dari zaman digital. Sebagai jembatan menuju penguasaan teknologi Informasi dan Komunikasi. Yang menjadikan SMK BPI Bandung terbentuk.

Sekolah Menegah Kejuruan BPI Bandung adalah salah satu Sekolah berbasis Teknologi yang mempunyai 3 Program Studi Unggulan Ter-Akreditasi A. Sekolah yang mengedepankan Pendidikan dan Akhlak Mulia Berbasis Penilaian Holistik, menjadikan peserta didik SMK BPI Bandung Bermartabat, Berkualitas, dan Terpercaya.

Sekolah yang mempunyai letak strategis pada pusat Kota Bandung, yang menjadikan mobilitas Sekolah Menengah Kejuruan BPI Bandung menjadi mudah diakses. Dan Di lengkapi pula dengan pendidik yang berkompeten dan ahli pada setiap Program Studinya.

Program Studi pada SMK BPI Bandung antara lain :
- {otkp}
- {rpl}
- {tkj}',
                ],
                'img' => ['public-7.jpg', 'public-6.jpg', 'public-5.jpg', 'public-4.jpg', 'public-3.jpg', 'public-2.jpg', 'public-1.jpg']
            ], [
                'profile' => [
                    'title' => 'VISI & MISI SMK BPI Bandung',
                    'subtitle' => 'Visi dan Misi SMK demi terwujudnya Sekolah yang Bermartabat, Berkualitas dan Terpercaya.',
                    'content' => '# Visi SMK BPI Bandung
- Menjadikan penyelenggara pendidikan berkualitas dan terpercaya.

# Misi SMK BPI Bandung
- Mewujudkan tata kelola, sistem pengendalian manajemen, dan sistem.pengawasan internal yang modern, efektif, dan efesien.
- Menyalurkan dan Mendukung kreativitas peserta didik dengan sarana dan prasarana yang lengkap.
- Mewujudkan budaya religi, jujur, disiplin, beretika, berestetika, pekerja keras, kreatif, inovatif, komptetitif, dan berkualitas.
- Mewujudkan dinamisasi peningkatan kualitas pendidikan barkarakter yang berkesinambungan dan berkelanjutan.
- Mewujudkan produk kompetensi keahlian bernilai Jual Pasar Global.
- Memperluas akses kemitraan dunia kerja yang menjamin lapangan kerja dan prakerin bagi peserta didik dan lulusan SMK BPI.
- Mewujudkan lulusan yang handal di bidangnya dan fasih berbahasa Inggris sehingga dipercaya oleh segenap dunia kerja pemerintah maupun swasata.
- Mewujudkan jiwa entrepreneurshing kuat yang mampu meningkatkan kualitas hidup civitas akademika SMK BPI Bandung.',
                ],
                'img' => ['vision-3.jpg', 'vision-2.jpg', 'vision-1.jpg']
            ], [
                'profile' => [
                    'title' => 'Organisasi Siswa Intra Sekolah',
                    'subtitle' => 'SMK BPI Bandung',
                    'content' => '# OSIS SMK BPI Bandung
Selamat datang pada laman Osis SMK BPI Bandung. Osis SMK BPI Bandung adalah salah satu media atau tempat organisasi yang dimiliki SMK BPI Bandung sebagai pencetak kader pemimpin, mandiri, dan berorganisasi, serta ajang silahturahmi antar Siswa/i SMK BPI Bandung.

OSIS SMK BPI Bandung mempunyai banyak sekali agenda acara yang dimiliki dan dirancang tiap tahunnya agar membuat Siswa/i SMK BPI Bandung berperan aktif dalam organisasi Internal maupun External.

# Visi Misi OSIS SMK BPI
### Visi
- Menjadikan siswa/siswi SMK BPI lebih Disiplin, Kreatif, Berahlak mulia dan memiliki Budi Pekerti yang baik.

### Misi
- Menumbuh kembangkan keimanan dan ketakwaan kepada Tuhan YME.
- Meningkatkan kesadaran siswa/siswi yang taat aturan dan disiplin.
- Menumbuhkan rasa kekeluargaan antar siswa.
- Mengembangkan bakat, minat dan potensi siswa.

# Tentang OSIS SMK BPI
Ikuti kegiatan kami di Instagram [@osissmkbpibdg](https://www.instagram.com/osissmkbpibdg)',
                ],
                'img' => ['council-4.jpg', 'council-3.jpg', 'council-2.jpg', 'council-1.png']
            ], [
                'profile' => [
                    'title' => 'Ekstrakurikuler',
                    'content' => '# Ekstrakurikuler SMK BPI Bandung
SMK BPI Bandung menyelenggarakan berbagai kegiatan ekstrakurikuler untuk memfasilitasi peserta didik agar dapat mengembangkan kemampuan, minat, dan bakat yang dimilikinya, baik di bidang kompetensi, olahraga, maupun kesenian.

# Daftar Ekstrakurikuler
**Terdapat beberapa ekstrakurikuler yang ada di SMK BPI Bandung, diantaranya adalah:**
- Akustik
- Animasi
- Futsal
- Basket
- Muaythai
- Mikrotik
- Modern Dance
- Pramuka
- Rohis
- Japanese Club
- English Club
- Panahan
- Softball',
                ],
                'img' => ['extra-2.png', 'extra-1.png']
            ]
        ];
        \App\Models\Profile::truncate();
        \App\Models\Gallery::whereTarget(1)->delete();

        for($i = 0; $i < count($a); $i++){
            \App\Models\Profile::create($a[$i]['profile']);

            foreach($a[$i]['img'] as $z)
                \App\Models\Gallery::create([
                    'target' => 1,
                    'type' => $i + 1,
                    'url' => 'profile/'.$z
                ]);
        }
    }
}
