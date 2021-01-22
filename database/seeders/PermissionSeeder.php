<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * example-very-long-text.create :
     * - = spacing
     * . = process like CRUD
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'homepage-carousel.show',
            'homepage-carousel.create',
            'homepage-carousel.update',
            'homepage-carousel.delete',
            'homepage-video.show',
            'homepage-video.create',
            'homepage-video.update',
            'homepage-video.delete',
            'homepage-about.show',
            'homepage-about.update',
            'homepage-alumni.show',
            'homepage-alumni.create',
            'homepage-alumni.update',
            'homepage-alumni.delete',
            'homepage-company.show',
            'homepage-company.create',
            'homepage-company.update',
            'homepage-company.delete',
            'homepage-social-media.show',
            'homepage-social-media.create',
            'homepage-social-media.update',
            'homepage-social-media.delete',
            'homepage-footer.show',
            'homepage-footer.create',
            'homepage-footer.update',
            'homepage-footer.delete',
            'public-profile.show',
            'public-profile.update',
            'vision-mission.show',
            'vision-mission.update',
            'student-council.show',
            'student-council.update',
            'extracurricular.show',
            'extracurricular.create',
            'extracurricular.update',
            'extracurricular.delete',
            'study-program.show',
            'study-program.update',
            'agenda.show',
            'agenda.create',
            'agenda.update',
            'agenda.delete',
            // 'news.show',
            // 'news.create',
            // 'news.update',
            // 'news.delete',
            'prestation.show',
            'prestation.create',
            'prestation.update',
            'prestation.delete',
            'gallery.show',
            'gallery.create',
            // 'gallery.update',
            'gallery.delete',
            'employees.show',
            'employees.create',
            'employees.update',
            'employees.delete',
            'users.show',
            'users.create',
            'users.update',
            'users.delete',
            'role.show',
            'role.create',
            'role.update',
            'role.delete',
            'keywords.show',
            'keywords.create',
            'keywords.update',
            'keywords.delete',
            'meta-tags.show',
            'meta-tags.create',
            'meta-tags.update',
            'meta-tags.delete',
            'audits.show',
        ];
        $r = new \App\Models\Role;
        $p = new \App\Models\Permission;
        $t = now();

        $r->truncate();
        $p->truncate();
        $r->create(['name' => 'superadmin']);
        $r->create(['name' => 'admin']);

        for($i = 0; $i < count($data); $i++) $a[] = [
            'name' => $data[$i],
            'created_at' => $t,
            'updated_at' => $t
        ];
        $p->insert($a);

        foreach($r->all() as $rr){
            foreach($p->all() as $pp){
                $b[] = [
                    'role_id' => $rr->id,
                    'permission_id' => $pp->id,
                    'status' => $rr->id === 2 && matchWildcard($pp->name) ? false : true,
                    'created_at' => $t,
                    'updated_at' => $t
                ];
            }
        }
        DB::table('has_permissions')->truncate();
        DB::table('has_permissions')->insert($b);
    }
}
