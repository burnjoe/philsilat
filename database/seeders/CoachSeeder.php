<?php

namespace Database\Seeders;

use App\Models\Coach;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coach::factory(8)->create();

        Coach::factory()->create([
            'last_name' => 'Derla',
            'first_name' => 'Julius',
            'sex' => 'Male',
        ]);

        Coach::factory()->create([
            'last_name' => 'Ferreras',
            'first_name' => 'Vince Austin',
            'sex' => 'Male',
        ]);
    }
}
