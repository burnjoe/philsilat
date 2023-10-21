<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::all();
        $label = 'A';
        $minWeight = 39;
        $maxWeight = 42;

        // if category is not empty
        if(!$categories->isEmpty()) {
            $label = chr(ord($categories->max('class_label')) + 1);
            $minWeight = $categories->max('max_weight');
            $maxWeight = $minWeight + 3;
        }

        return [
            'class_label' => $label,
            'sex' => fake()->randomElement(['Male', 'Female']),
            'min_weight' => $minWeight,
            'max_weight' => $maxWeight,
        ];
    }
}
