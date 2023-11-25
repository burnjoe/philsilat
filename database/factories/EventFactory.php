<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a random time for logged in and a later random time for logged out
        $starts_at = fake()->randomElement([fake()->dateTimeThisMonth(), now()->modify('+' . mt_rand(0, 5) . ' days')]);
        $starts_at->setTime($starts_at->format('H'), $starts_at->format('i'), 0);
        $ends_at = clone $starts_at;
        $ends_at->modify('+' . mt_rand(1, 2) . ' days');

        if ($starts_at >= now()) {
            $status = fake()->randomElement(['UPCOMING', 'REGISTRATION OPEN', 'CANCELLED']);
        } else if ($starts_at <= now() && $ends_at <= now()) {
            $status = fake()->randomElement(["COMPLETED", "ONGOING"]);
        } else if ($starts_at <= now() && $ends_at >= now()) {
            $status = fake()->randomElement(['CANCELLED', 'ONGOING']);
        } else {
            $status = 'CANCELLED';
        }

        return [
            'host_name' => fake()->firstName(). ' ' .fake()->lastName(),
            'name' => fake()->randomElement(['Unit Meet', 'City Meet', 'District Meet']),
            'description' => fake()->randomElement(['Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus quis architecto nemo voluptatem animi ea, corrupti minima, odio laudantium ipsum itaque, voluptates eius praesentium reiciendis repellat inventore optio perferendis fugiat!', '']),
            'starts_at' => $starts_at,
            'ends_at' => $ends_at,
            'venue' => 'CABS',
            'address' => 'Cabuyao Enterprise Park',
            'barangay' => 'Banay-Banay',
            'city' => 'Cabuyao',
            'province' => 'Laguna',
            'status' => $status,
        ];
    }
}
