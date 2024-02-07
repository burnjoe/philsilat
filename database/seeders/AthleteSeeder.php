<?php

namespace Database\Seeders;

use App\Models\Athlete;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AthleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::with('teams')->get();
        
        foreach ($events as $event) {
            if (in_array($event->status, ['REGISTRATION OPEN'])) {
                foreach ($event->teams as $team) {
                    Athlete::factory()->create([
                        'team_id' => $team->id,
                    ]);
                }
            }
        }
    }
}
