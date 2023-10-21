<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Male
        for ($i = 0; $i < 6; $i++) {
            Category::factory()->create([
                'sex' => 'Male'
            ]);
        }

        // Female
        Category::factory()->create([
            'class_label' => 'A',
            'sex' => 'Female',
            'min_weight' => 39,
            'max_weight' => 42,
        ]);
        Category::factory()->create([
            'class_label' => 'B',
            'sex' => 'Female',
            'min_weight' => 42,
            'max_weight' => 45,
        ]);
        Category::factory()->create([
            'class_label' => 'C',
            'sex' => 'Female',
            'min_weight' => 45,
            'max_weight' => 48,
        ]);
        Category::factory()->create([
            'class_label' => 'D',
            'sex' => 'Female',
            'min_weight' => 48,
            'max_weight' => 51,
        ]);
        Category::factory()->create([
            'class_label' => 'E',
            'sex' => 'Female',
            'min_weight' => 51,
            'max_weight' => 54,
        ]);
        Category::factory()->create([
            'class_label' => 'F',
            'sex' => 'Female',
            'min_weight' => 54,
            'max_weight' => 57,
        ]);
    }
}
