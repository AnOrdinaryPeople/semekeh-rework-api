<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Footer::truncate();
        \App\Models\Footer::insert([
            [
                'key' => 'Website',
                'value' => 'www.smkbpi.sch.id',
                'created_at' => now('-4 hours'),
                'updated_at' => now('-4 hours')
            ], [
                'key' => 'Fax',
                'value' => '(022) 7305835',
                'created_at' => now('-3 hours'),
                'updated_at' => now('-3 hours')
            ], [
                'key' => 'Email',
                'value' => 'info@smkbpi.sch.id',
                'created_at' => now('-2 hours'),
                'updated_at' => now('-2 hours')
            ], [
                'key' => 'Telepon',
                'value' => '(022) 7301739 - 7305735',
                'created_at' => now('-1 hours'),
                'updated_at' => now('-1 hours')
            ], [
                'key' => 'Alamat',
                'value' => 'Jl. Burangrang No. 8 Bandung',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
