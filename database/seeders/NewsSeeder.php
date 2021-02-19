<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
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
        		'title' => 'HUT Yayasan BPI Bandung',
        		'banner' => 'news/news-1.webp',
        		'content' => 'Bertepatan pada hari Selasa, 18 Agustus 2020 Yayasan Badan Perguruan Indonesia merayakan hari jadi yang ke-72. Dalam usianya yang cukup panjang dan hanya berselisih 3 tahun dengan Hari Kemerdekaan RI, merupakan suatu prestasi yang sangat membanggakan, karena selama periode tersebut Yayasan BPI dapat eksis menjawab tantangan zaman, perubahan sosial, budaya & teknologi, juga berbagai kebijaksanaan pemerintah di bidang pendidikan. Peringatan Hari Ulang Tahun BPI kali ini, berlangsung dalam keprihatinan berkenaan dengan pandemi Covid-19. Maka dari itu peringatan dilaksanakan secara sederhana dengan jumlah undangan yang terbatas dan tetap memperhatikan protokol kesehatan serta dapat disaksikan melalui siaran live streaming. Namun keadaan tersebut tidak mengurangi kekhidmatan acara. Melalui acara peringatan tersebut disampaikan apresiasi atas berbagai pencapaian dan harapan besar agar Yayasan BPI kedepannya dapat tumbuh dan berkembang dalam rangka memajukan Pendidikan Indonesia.',
        		'slug' => kebabCase(strtotime(now()).' HUT Yayasan BPI Bandung'),
        		'created_at' => now('-3 minutes'),
        		'updated_at' => now('-3 minutes')
        	], [
        		'title' => 'PTS Ganjil TA 20/21 secara Daring',
        		'banner' => 'news/news-2.webp',
        		'content' => 'Kegiatan Penilaian Tengah Semester Ganjil Tahun Ajaran 2020/2021 SMK BPI Bandung dilaksanakan secara daring mulai dari tanggal 21 s.d. 25 September 2020 dengan mengakses laman elearning.smkbpi.sch.id . Kegiatan tersebut diikuti oleh seluruh peserta didik kelas X, kelas XI, dan kelas XII yang bertempat di rumah masing-masing melalui telepon genggam maupun perangkat laptop atau komputer peserta didik. Meskipun dilaksanakan secara jarak jauh pelaksanaan Penilaian Tengah Semester dirancang untuk tetap disiplin terhadap tata tertib dan menjunjung tinggi kejujuran. Berkat kerja sama yang baik antara pihak sekolah, peserta didik maupun orang tua seluruh kegiatan PTS tersebut dapat berjalan dengan tertib dan lancar.',
        		'slug' => kebabCase(strtotime(now()).' PTS Ganjil TA 20/21 secara Daring'),
        		'created_at' => now('-2 minutes'),
        		'updated_at' => now('-2 minutes')
        	], [
        		'title' => 'Pelantikan Kepala Sekolah SMK BPI',
        		'banner' => 'news/news-3.webp',
        		'content' => 'Selamat atas dilantiknya Bapak Doni Agus Maulana, S.Pd. sebagai Kepala SMK BPI Bandung. Semoga Allah Swt. Memudahkan langkah beliau dalam memimpin SMK BPI Bandung.',
        		'slug' => kebabCase(strtotime(now()).' Pelantikan Kepala Sekolah SMK BPI'),
        		'created_at' => now('-1 minutes'),
        		'updated_at' => now('-1 minutes')
        	],
        ];

		\App\Models\News::truncate();
        \App\Models\News::insert($a);
    }
}
