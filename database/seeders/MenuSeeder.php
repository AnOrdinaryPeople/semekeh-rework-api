<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * icon link = https://fontawesome.com/icons?d=gallery&s=solid&m=free
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'icon' => null,
                'name' => 'Homepage',
                'link' => '/homepage',
                'parent_id' => false,
            ], [
                'icon' => null,
                'name' => 'Profile',
                'link' => '/profile',
                'parent_id' => false,
            ], [
                'icon' => null,
                'name' => 'Public Profile',
                'link' => '/public-profile',
                'parent_id' => true,
            ], [
                'icon' => null,
                'name' => 'Vision Mission',
                'link' => '/vision-mission',
                'parent_id' => true,
            ], [
                'icon' => null,
                'name' => 'Student Council',
                'link' => '/student-council',
                'parent_id' => true,
            ], [
                'icon' => null,
                'name' => 'Extracurricular',
                'link' => '/extracurricular',
                'parent_id' => true,
            ], [
                'icon' => null,
                'name' => 'Study Program',
                'link' => '/study-program',
                'parent_id' => false,
            ], [
                'icon' => null,
                'name' => 'Information Media',
                'link' => '/information-media',
                'parent_id' => false,
            ], [
                'icon' => null,
                'name' => 'Agenda',
                'link' => '/agenda',
                'parent_id' => true,
            ],
            // [
            //     'icon' => null,
            //     'name' => 'News',
            //     'link' => '/news',
            //     'parent_id' => true,
            // ],
            [
                'icon' => null,
                'name' => 'Prestation',
                'link' => '/prestation',
                'parent_id' => true,
            ], [
                'icon' => null,
                'name' => 'Gallery',
                'link' => '/gallery',
                'parent_id' => true,
            ], [
                'icon' => null,
                'name' => 'Employees',
                'link' => '/employees',
                'parent_id' => false,
            ], [
                'icon' => null,
                'name' => 'User Management',
                'link' => '/user-management',
                'parent_id' => false,
            ], [
                'icon' => null,
                'name' => 'Users',
                'link' => '/users',
                'parent_id' => true,
            ], [
                'icon' => null,
                'name' => 'Role',
                'link' => '/role',
                'parent_id' => true,
            ], [
                'icon' => null,
                'name' => 'Keywords',
                'link' => '/keywords',
                'parent_id' => false
            ], [
                'icon' => null,
                'name' => 'Meta Tags',
                'link' => '/meta-tags',
                'parent_id' => false
            ], [
                'icon' => null,
                'name' => 'Audits',
                'link' => '/audits',
                'parent_id' => false
            ],
        ];

        $temp = 0;
        $t = now();

        for($i = 0; $i < count($data); $i++){
            // $d = $data[$i]; idk why this shit not working :'v

            if($data[$i]['parent_id'] === false)
                $temp = $i + 1;

            $data[$i]['parent_id'] = $data[$i]['parent_id'] ? $temp : 0;
            $data[$i]['created_at'] = $t;
            $data[$i]['updated_at'] = $t;
        }

        \App\Models\Menu::truncate();
        \App\Models\Menu::insert($data);
    }
}
