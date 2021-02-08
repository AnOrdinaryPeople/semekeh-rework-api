<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(MenuSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CarouselSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(KeywordSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(AlumniSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(SocialSeeder::class);
        $this->call(FooterSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(CouncilSeeder::class);
        $this->call(StudySeeder::class);
        $this->call(AgendaSeeder::class);
        $this->call(PrestationSeeder::class);
        $this->call(EmployeeSeeder::class);
        // $this->call(MetaSeeder::class);
    }
}
