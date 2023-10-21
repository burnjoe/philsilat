<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        do {
            $event = Event::with('games')->inRandomOrder()->first();
            $categoryId = Category::inRandomOrder()->value('id');
        } while($event->games->contains('category_id', $categoryId));
        
        return [
            'name' => 'Tanding',
            'category_id' => $categoryId,
            'event_id' => $event->id,
        ];
    }
}
