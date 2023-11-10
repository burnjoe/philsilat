<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory(15)->create();

        Admin::factory()->create([
            'last_name' => 'Sabana',
            'first_name' => 'Jholo',
            'sex' => 'Male',
        ]);
    }
}
