<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::factory(50)->create();
        
        Team::factory()->create([
            'name' => 'Blue Eagles'
        ]);

        Team::factory()->create([
            'name' => 'Grey Wolves'
        ]);

        Team::factory()->create([
            'name' => 'Laguna Fighters'
        ]);
    }
}
