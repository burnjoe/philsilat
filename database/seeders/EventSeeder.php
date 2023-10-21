<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::factory()->create([
            'status' => 'UPCOMING'
        ]);

        Event::factory()->create([
            'status' => 'REGISTRATION OPEN'
        ]);

        Event::factory()->create([
            'status' => 'CANCELLED'
        ]);

        Event::factory()->create([
            'status' => 'ONGOING'
        ]);

        Event::factory()->create([
            'status' => 'COMPLETED'
        ]);
    }
}
