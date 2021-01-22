<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t = now();

        \App\Models\Study::truncate();
        \App\Models\Study::insert([
            [
                'banner' => 'study/study-1.webp',
                'title' => 'Otomatisasi dan Tata Kelola Perkantoran',
                'content' => '**Otomatisasi dan Tata Kelola Perkantoran** adalah kompetensi keahlian yang membekali siswa pada kegiatan perkantoran dan ketata usahaan berbasis ICT. Menekankan kegiatan administrasi yang mahir dalam melaksanakan tugas : Sekertariat junior, Public Relation, Arsiparis, Typing, Resepsionis. dan Wirausahawan yang tangguh dengan sikap Bermartabat, Berkualitas dan Terpercaya.

Otomatisasi dan Tata Kelola Perkantoran SMK BPI merupakan salah satu Kompetensi Keahlian pada Kelompok Bidang Bisnis dan Manajemen yang membekali siswa dalam kegiatan perkantoran dan ketata usahaan berbasis ICT.

# Kompetensi Keahlian OTKP
**Kompetensi keahlian OTKP SMK BPI sebagai Jurusan yang bergerak di bidang Bisnis dan Manajemen** yang membekali siswa dalam kegiatan perkantoran dan ketata usahaan berbasis ICT. Kompetensi ini menekankan pada kegiatan dan ruang lingkup pekerjaan administrasi meliputi :
- Sekretaris Junior.
- Public Relations.
- Arsiparis.
- Resepsionis.
- Wirausahawan.

**Kurikulum dan Materi pembelajaran** pada kompetensi ini diselaraskan dengan kebutuhan Dunia Usaha dan Dunia Industri, seperti :
- Penerapan Teknologi Perkantoran.
- Typing.
- Kehumasaan.
- Penataan Surat Menyurat dan Kearsipan.
- Tata Kelola Keuangan.

> Untuk keterserapan lulusan, memiliki peluang yang luas untuk dapat Bekerja, Melanjutkan Kuliah, dan Wirausaha.

# Keunggulan Kompetensi Keahlian OTKP SMK BPI
**Dari segi pendidikan**
- Pembelajaran mudah dipahami.
- Dibekali kemampuan mengetik cepat dengan menggunakan 10 jari.
- Dibekali cara administrasi yang baik dan benar.
- Terbiasa dengan susunan bahasa dan kata yang baik dan benar.
- Dibekali keterampilan pembawa acara, jurnalistik table manner, dan merias diri.
- Lulusan mendapatkan Sertifikat Kompetensi, bekerjasama dengan Asosiasi Sarjana dan Praktisi Administrasi Perkantoran (ASPAPI)

**Dari segi pekerjaan**
- Dapat menjadi sekretaris yang handal dan ideal.
- Dapat menjadi Resepsionis, Publik Relasi dan Customer service.
- Dapat melakukan pekerjaan di bidang administrasi dan keuangan.
- Dapat melanjutkan kuliah dengan jurusan yang berkaitan.',
                'content_2' => '{"title":"Fasilitas OTKP SMK BPI","url":"study/study-1-1.jpg","content":"Adapun **Fasilitas** yang ada di Jurusan Otomatisasi dan Tata Kelola Perkantoran adalah:\n- Lab Komputer.\n- Hardware Pendukung.\n- Alat Tulis Kantor Lengkap.\n- Peralatan Pembelajaran Lengkap."}',
                'slug' => kebabCase('Otomatisasi dan Tata Kelola Perkantoran'),
                'created_at' => $t,
                'updated_at' => $t
            ], [
                'banner' => 'study/study-2.webp',
                'title' => 'Rekayasa Perangkat Lunak',
                'content' => 'Rekayasa Perangkat Lunak (RPL) merupakan salah satu program keahlian di SMK BPI, dimana pada program ini siswa belajar bagaimana cara membuat program komputer dan cara berpikir dalam menyelesaikan masalah. Keahlian ini mencetak siswa-siswi yang handal di bidang Aplikasi Mobile, Aplikasi Web dan Web Design yang merupakan profesi menjanjikan di masa depan.

Kompetensi Keahlian RPL mempelajari dan mendalami semua cara-cara pengembangan perangkat lunak termasuk pembuatan, pemeliharaan, manajemen organisasi pengembangan perangkat lunak dan manajemen kualitas. Adapun yang dipelajari pada Program Keahlian RPL yaitu mulai dari pembuatan website, aplikasi, game dan semua yang berkaitan dengan pemrograman. Bukan hanya itu, pada program ini juga dapat dipelajari materi yang berkaitan di bidang desain, video dan fotografi.

# Kompetensi Keahlian RPL
**Kompetensi keahlian RPL SMK BPI sebagai Jurusan yang bergerak di bidang IT dan Programming.** Kompetensi Keahlian dan Materi Pembelajaran menyesuaikan dengan teknologi diantaranya adalah :
- Teknik pemrograman komputer.
- Perancangan perangkat lunak komputer.
- Perancangan basis data komputer.
- Pemrograman Aplikasi mobile.
- Pemrograman Website.
- Produk kreatif digital (Startup).

**Ruang Lingkup Kerja** berbagai pekerjaan yang dapat dipilih oleh lulusan RPL :
- Web Application Programmer
- Mobile Application Programmer (Java and Android)
- Database Programmer
- Interfacing Programmer
- Desktop Application Programmer
- Game Programmer
- Hardware and Software Technicians
- IT Support and IT Staff
- Pekerjaan di bidang IT lainnya

> Dari segi peluang kerja setelah lulus sangat banyak peluangnya. Mulai dari menjadi programmer, designer, membuka startup sendiri dan melanjutkan ke Perguruan Tinggi.

# Keunggulan Kompetensi Keahlian RPL SMK BPI
**Dari segi pendidikan**
- Pembelajaran mudah dipahami.
- Masih berstatus siswa sudah bisa menghasilkan uang (proyek situs web, desain, dll).
- Dapat memperdalam jurusan lain yang serumpun (seperti Animasi, Multimedia, Desain grafis, Pemrograman).
- Menjadi jurusan yang memperdalam ilmu Teknologi, baik Software ataupun Hardware.
- Bekerjasama dengan beberapa Perusahaan IT ternama.
- Lulusan Selain dapat Ijazah juga dapat Sertifikat yang diakui

**Dari segi pekerjaan**
- Dapat menjadi seorang ahli IT di bidang Programming.
- Dapat membuka usaha startup.
- Dapat membuat atau mengembangkan aplikasi sendiri.
- Dapat melanjutkan kuliah dengan jurusan serumpun.
- Peluang kerja sangat luas dengan gaji menjanjikan.',
                'content_2' => '{"title":"Fasilitas RPL SMK BPI","url":"study/study-2-1.jpg","content":"Adapun **Fasilitas** yang ada di Jurusan Rekayasa Perangkat Lunak adalah:\n- Laboratorium Komputer RPL.\n- Akses Internet cepat\n- Hotspot Area di seluruh wilayah sekolah.\n- Hardware dan Software pendukung.\n- Peralatan Pembelajaran Lengkap."}',
                'slug' => kebabCase('Rekayasa Perangkat Lunak'),
                'created_at' => $t,
                'updated_at' => $t
            ], [
                'banner' => 'study/study-3.webp',
                'title' => 'Teknik Komputer Jaringan',
                'content' => 'Teknologi Informasi dan Komputer telah menjadi bagian dalam kehidupan masyarakat di era globalisasi dan pasar bebas. Masyarakat saat ini tidak lagi bisa menghindar dari zaman digital. Sebagai jembatan menuju penguasaan teknologi Informasi dan Komunikasi.

Program Studi Teknik Komputer dan Jaringan di BPI Bandung telah dirancang untuk selalu Up To date. Didukung oleh pengajar yang telah memenuhi Standar Kompetensi di bidang IT dan sarana/ prasarana di atas rata-rata serta model pembelajaran berbasis IT (media Online) siap mengantar anda menuju pintu gerbang zona digital.

Salah satu keunggulan TKJ adalah penggunaan Metode Praktik Langsung sehingga mampu menyediakan sumber belajar yang tidak terbatas, penilaian transparan serta mendidik siswa untuk berfikir ilmiah dengan memperhatikan potensi masing-masing individu. Dengan dukungan fasilitas belajar yang memadai dan dukungan ruang praktik yang cukup luas untuk memfasilitasi keinginan siswa/siswi dalam mengembangkan ilmu komputer.

# Kompetensi Keahlian TKJ
**Kompetensi keahlian TKJ SMK BPI sebagai Jurusan yang bergerak di bidang Hardware dan Networking** juga memberikan ruang dan fasilitas yang baik bagi siswa yang memiliki minat di bidang Administrator Jaringan Komputer, Technical Support, Computer Network Maintenance/teknisi maupun Keamanan Jaringan Komputer. Dengan didukung berbagai Fasilitas Online yang dapat diakses di Lokal maupun di Luar Sekolah / Internet, diantaranya adalah :
- Akses Internet cepat.
- Hotspot Area di seluruh wilayah sekolah.

**Materi Pembelajaran** menyesuaikan dengan teknologi terkini berbasis pada :
- Open Source.
- Mikrotik.
- Web Design.
- LSP Telematika.

> Dari segi peluang kerja setelah lulus sangat banyak peluangnya. Mulai dari menjadi teknisi komputer, teknisi jaringan, membuka toko komputer, atau bisa juga membuka warnet sendiri dan melanjutkan ke Perguruan Tinggi.

# Keunggulan Kompetensi Keahlian TKJ SMK BPI
**Dari segi pendidikan**
- Mudah Dipahami.
- Masih Kelas XI, sudah bisa menghasilkan uang (dengan hanya berbekal kompetensi Instalasi OS dan perakitan PC.
- Dapat memperdalam jurusan lain (seperti Animasi, Multimedia, Desain grafis, Pemrograman).
- Menjadi jurusan yang memperdalam ilmu Teknologi, baik Software ataupun Hardware.
- Bekerjasama dengan beberapa Perusahaan IT (Axioo, Netkrom).
- Lulusan Selain dapat Ijazah juga dapat Sertifikat yang diakui oleh Internasional. Dalam hal ini Sertifikasinya IT Networking dari MIKROTIK.

**Dari segi pekerjaan**
- Dapat menjadi seorang ahli IT Networking.
- Dapat membuka usaha jaringan.
- Dapat melanjutkan kuliah dengan jurusan berbeda.
- Dapat menjadi teknisi baik jaringan internet maupun PC/Laptop.

# Prestasi TKJ SMK BPI
| No | Prestasi | Penyelenggara | Tahun |
| --- | --- | --- | --- |
| 1 | Instalasi Jaringan Komputer di SMK BPI Bandung dan Perbaikan PC | SMK BPI Bandung | 2011 |
| 2 | Peserta lomba Perakitan PC se Jawa Barat dan Jakarta | Ilmu Komputer UPI Bandung | 2012 |
| 3 | Konfigurasi server data menggunakan Linux Fedora | ISMK BPI Bandung | 2011 |
| 4 | Peserta LKS Kota Bandung | Dinas Kota Bandung | 2011, 2012, 2013 |
| 5 | Juara Lomba IT Networking Mikrotik | UIN Sunan Gunung Djati | 2014 |
| 6 | Juara Lomba IT Networking Mikrotik | UIN Sunan Gunung Djati | 2015 |
| 7 | Tim IT Konfigurasi UNBK 2016 | SMK BPI Bandung | 2016 |
| 8 | Juara 1 Lomba Karya Ilmiah bidang Sumber Daya Air 2018 | Kementerian Pekerjaan Umum dan Perumahan Rakyat | 2018 |
| 9 | Juara 3 Lomba Karya Ilmiah bidang Sumber Daya Air 2019 | Kementerian Pekerjaan Umum dan Perumahan Rakyat | 2019 |',
                'content_2' => '{"title":"Fasilitas TKJ SMK BPI","url":"study/study-3-1.jpg","content":"Adapun **Fasilitas** yang ada di Jurusan Teknik Komputer dan Jaringan adalah:\n- Lab Komputer TKJ.\n- Lab Komputer Software.\n-  Lab Komputer Hardware.\n- Tower Wireless.\n- Peralatan Pembelajaran Lengkap."}',
                'slug' => kebabCase('Teknik Komputer Jaringan'),
                'created_at' => $t,
                'updated_at' => $t
            ]
        ]);
    }
}
