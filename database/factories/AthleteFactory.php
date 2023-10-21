<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Athlete>
 */
class AthleteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            do {
                do {
                    $category = Category::inRandomOrder()->first();
                    $game = Game::with('event')->where('category_id', $category->id)->first();
                } while(!$game);
            } while($game->event->count() == 0);
        } while($game->event->teams->count() == 0);

        return [ 
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'birthdate' => fake()->dateTimeBetween('-15 years', '-8 years')->format('Y-m-d'),
            'sex' => $category->sex,
            'weight' => fake()->randomFloat(2, $category->min_weight, $category->max_weight),
            'school_name' => fake()->randomElement([
                'Liceo De Mamatid',
                'Liceo De Cabuyao',
                'Marinig National High School',
                'Gulod National High School',
                'Our Lady of Assumption College',
                'Gulod National High School',
                'Christ the King School of Cabuyao',
                'Cabuyao Integrated National High School',
                'Pulo National High School',
                'Mamatid National High School',
                'Ridpath Academy of Mabuhay, Inc.',
                'Southville 1 Integrated National High School'
            ]),
            'grade_level' => fake()->numberBetween(7,12),
            'lrn' => fake()->unique()->numerify('############'),
            'game_id' => $game->id,
            'team_id' => $game->event->teams->random()->id,
        ];
    }
}
