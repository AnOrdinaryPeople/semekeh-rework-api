<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$e = '@smkbpi.sch.id';
    	$p = '$2y$10$yvz16qcGlfgI0RkfhYrm6.JWLfqxNm28f2CTbbiuzqMs9fJ630Wfi'; // 12345678

        \App\Models\User::truncate();
        \App\Models\User::create([
            'name' => 'Zuperrrradmin',
            'email' => 'super'.$e,
            'email_verified_at' => now(),
            'password' => $p,
            'role_id' => 1,
        ]);
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin'.$e,
            'email_verified_at' => now(),
            'password' => $p,
            'role_id' => 2,
        ]);
    }
}
