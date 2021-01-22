<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Employee::truncate();
        \App\Models\Employee::insert([
            [
                'type' => 1,
                'child_type' => 1,
                'name' => 'Dedi Indrayana, S.Pd., M.Si.',
                'title' => 'Kepala Sekolah',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'type' => 1,
                'child_type' => 1,
                'name' => 'Tatang, M.Pd',
                'title' => 'Waka. Bidang Kurikulum',
                'created_at' => now('-1 minutes'),
                'updated_at' => now('-1 minutes'),
            ], [
                'type' => 1,
                'child_type' => 1,
                'name' => 'Ade Aso, S.Pd.',
                'title' => 'Waka. Bidang Kesiswaan',
                'created_at' => now('-2 minutes'),
                'updated_at' => now('-2 minutes'),
            ], [
                'type' => 1,
                'child_type' => 1,
                'name' => 'Dra. Hj. Anggani',
                'title' => 'Waka. Bidang Hubungan Industri',
                'created_at' => now('-3 minutes'),
                'updated_at' => now('-3 minutes'),
            ], [
                'type' => 1,
                'child_type' => 1,
                'name' => 'Doni Agus Maulana, S.Pd.',
                'title' => 'Wakil Manajemen Mutu',
                'created_at' => now('-4 minutes'),
                'updated_at' => now('-4 minutes'),
            ], [
                'type' => 1,
                'child_type' => 2,
                'name' => 'M. Noor Basuki, S.Si.',
                'title' => 'Kepala Program Kejuruan RPL',
                'created_at' => now('-5 minutes'),
                'updated_at' => now('-5 minutes'),
            ], [
                'type' => 1,
                'child_type' => 2,
                'name' => 'Acep Komarudin, S.Si.',
                'title' => 'Kepala Program Kejuruan TKJ',
                'created_at' => now('-6 minutes'),
                'updated_at' => now('-6 minutes'),
            ], [
                'type' => 1,
                'child_type' => 2,
                'name' => 'Yayan Himawan, S.Pd.',
                'title' => 'Kepala Program Kejuruan OTKP',
                'created_at' => now('-7 minutes'),
                'updated_at' => now('-7 minutes'),
            ], [
                'type' => 1,
                'child_type' => 3,
                'name' => 'Muhammad Rifky Firdaus, S.Pd.',
                'title' => 'Guru Produktif RPL',
                'created_at' => now('-8 minutes'),
                'updated_at' => now('-8 minutes'),
            ], [
                'type' => 1,
                'child_type' => 3,
                'name' => 'Annisa Rahmayanti, S.Pd.',
                'title' => 'Guru Produktif RPL',
                'created_at' => now('-9 minutes'),
                'updated_at' => now('-9 minutes'),
            ], [
                'type' => 1,
                'child_type' => 3,
                'name' => 'Galih Nalapraya, S.Si.',
                'title' => 'Guru Produktif TKJ',
                'created_at' => now('-10 minutes'),
                'updated_at' => now('-10 minutes'),
            ], [
                'type' => 1,
                'child_type' => 3,
                'name' => 'Uga Nugraha Syafari, S.Pd.',
                'title' => 'Guru Produktif TKJ',
                'created_at' => now('-11 minutes'),
                'updated_at' => now('-11 minutes'),
            ], [
                'type' => 1,
                'child_type' => 3,
                'name' => 'Fani Setiani, S.Pd.',
                'title' => 'Guru Produktif OTKP',
                'created_at' => now('-12 minutes'),
                'updated_at' => now('-12 minutes'),
            ], [
                'type' => 1,
                'child_type' => 3,
                'name' => 'Ignur Oktaviani, S.Pd.',
                'title' => 'Guru Produktif OTKP',
                'created_at' => now('-13 minutes'),
                'updated_at' => now('-13 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Agus Salim, M.Pd.I',
                'title' => 'Pendidikan Agama Islam',
                'created_at' => now('-14 minutes'),
                'updated_at' => now('-14 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Agus Nugroho, S.Pd.',
                'title' => 'Sejarah Indonesia',
                'created_at' => now('-15 minutes'),
                'updated_at' => now('-15 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Andry Refianto',
                'title' => 'Pendidikan Kewarganegaraan',
                'created_at' => now('-16 minutes'),
                'updated_at' => now('-16 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Wahyu Sinarningsih, S.Pd.',
                'title' => 'Bahasa Indonesia',
                'created_at' => now('-17 minutes'),
                'updated_at' => now('-17 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Vera Aldhilah, S.Pd.',
                'title' => 'Bahasa Indonesia',
                'created_at' => now('-18 minutes'),
                'updated_at' => now('-18 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Agista Akbari Wulandari, S.S.',
                'title' => 'Bahasa Inggris',
                'created_at' => now('-19 minutes'),
                'updated_at' => now('-19 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Novarida Maisha, S.Pd.',
                'title' => 'Bahasa Inggris',
                'created_at' => now('-20 minutes'),
                'updated_at' => now('-20 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Taufan Hikhaiat, S.Pd.',
                'title' => 'Bahasa Sunda',
                'created_at' => now('-21 minutes'),
                'updated_at' => now('-21 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Resti Khairun Nissa, S.Pd.',
                'title' => 'Matematika',
                'created_at' => now('-22 minutes'),
                'updated_at' => now('-22 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Inri Rahmawati, M.Pd.',
                'title' => 'Matematika',
                'created_at' => now('-23 minutes'),
                'updated_at' => now('-23 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Kystri Yanuar Putri, S.Si.',
                'title' => 'Kimia / IPA',
                'created_at' => now('-24 minutes'),
                'updated_at' => now('-24 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Asep Ediyana Sulaksana, S.Sn.',
                'title' => 'Seni Budaya',
                'created_at' => now('-25 minutes'),
                'updated_at' => now('-25 minutes'),
            ], [
                'type' => 2,
                'child_type' => 0,
                'name' => 'Luby Tsani Ahwady, S.Si.',
                'title' => 'Pendidikan Jasmani',
                'created_at' => now('-26 minutes'),
                'updated_at' => now('-26 minutes'),
            ], [
                'type' => 3,
                'child_type' => 0,
                'name' => 'N. Dedeh Sumiati',
                'title' => 'Tenaga Administrasi Sekolah',
                'created_at' => now('-27 minutes'),
                'updated_at' => now('-27 minutes'),
            ], [
                'type' => 3,
                'child_type' => 0,
                'name' => 'Tri Muldiyanto',
                'title' => 'Tenaga Administrasi Sekolah',
                'created_at' => now('-28 minutes'),
                'updated_at' => now('-28 minutes'),
            ], [
                'type' => 3,
                'child_type' => 0,
                'name' => 'Kristina Hasanah, A.Md.',
                'title' => 'Tenaga Administrasi Sekolah',
                'created_at' => now('-29 minutes'),
                'updated_at' => now('-29 minutes'),
            ], [
                'type' => 3,
                'child_type' => 0,
                'name' => 'Wawan Juansyah',
                'title' => 'Karyawan',
                'created_at' => now('-29 minutes'),
                'updated_at' => now('-29 minutes'),
            ],
        ]);
        \App\Models\Gallery::whereTarget(4)->delete();
        \App\Models\Gallery::insert([
            [
                'target' => 4,
                'url' => 'employees/employee-1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'target' => 4,
                'url' => 'employees/employee-2.png',
                'created_at' => now('-1 minutes'),
                'updated_at' => now('-1 minutes'),
            ], [
                'target' => 4,
                'url' => 'employees/employee-3.png',
                'created_at' => now('-2 minutes'),
                'updated_at' => now('-2 minutes'),
            ],
        ]);
    }
}
