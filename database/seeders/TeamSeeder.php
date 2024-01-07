<?php

namespace Database\Seeders;

use App\Models\Coach;
use App\Models\Event;
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
        Team::factory()->create();

        Team::factory()->create([
            'name' => 'Blue Eagles'
        ]);

        Team::factory()->create([
            'name' => 'Grey Wolves'
        ]);

        Team::factory()->create([
            'name' => 'Laguna Fighters'
        ]);

        foreach (Event::with('teams')->get() as $event) {
            $coaches = Coach::inRandomOrder()->get()->toArray();
            $size = count($coaches);
            $i = 0;

            foreach ($event->teams as $team) {
                if($i < $size) {
                    $team->coaches()->attach($coaches[$i++]['id']);
                }
            }
        }
    }
}
