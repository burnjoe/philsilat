<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Calls out other seeder
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CoachSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(GameSeeder::class);
        $this->call(AthleteSeeder::class);
        $this->call(GameMatchSeeder::class);
        $this->call(SignUpCodeSeeder::class);
    }
}
