<?php

namespace Database\Seeders;

use App\Models\Athlete;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AthleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();

        foreach ($teams as $team) {
            Athlete::factory()->create([
                'team_id' => $team->id,
            ]);
        }

        // Athlete::factory(1000)->create();
    }
}
