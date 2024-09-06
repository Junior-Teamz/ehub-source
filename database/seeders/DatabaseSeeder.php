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
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(ExpertSeeder::class);
        $this->call(NewsTagSeeder::class);
        $this->call(WorkshopSeeder::class);
        $this->call(BusinessSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(JourneyPageSeeder::class);
        $this->call(JourneySectionSeeder::class);
        $this->call(JourneyLogoSeeder::class);
    }
}
