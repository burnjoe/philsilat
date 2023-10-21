<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Coach;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefixes = ['0921', '0918', '0927', '0938', '0947'];

        do {
            $phone = fake()->randomElement($prefixes) . fake()->unique()->numerify('#######');
        } while (Admin::where('phone', $phone)->exists() || Coach::where('phone', $phone)->exists());

        return [
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'sex' => fake()->randomElement(['Male', 'Female']),
            'phone' => $phone,
        ];
    }
}
