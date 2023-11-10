<?php

namespace Database\Factories;

use App\Models\SignUpCode;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SignUpCode>
 */
class SignUpCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $code = Str::random(8);
        } while (SignUpCode::where('code', $code)->exists());
        
        return [
            'code' => $code,
            'role' => fake()->randomElement(['admin', 'coach']),
        ];
    }
}
