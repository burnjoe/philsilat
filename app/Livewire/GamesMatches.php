<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\Event;
use App\Models\Athlete;
use Livewire\Component;
use App\Models\GameMatch;
use Livewire\WithPagination;

class GamesMatches extends Component
{
    use WithPagination;

    public $event;
    public $game;

    public $search = "";


    /**
     * Initializes attributes at load
     */
    public function mount(Event $event, Game $game)
    {
        $this->event = $event;
        $this->game = $game;
    }

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.games.matches', [
            'matches' => GameMatch::with('athlete1', 'athlete2', 'winner', 'athlete1.team', 'athlete2.team', 'winner.team')
                ->where('game_id', $this->game->id)
                ->where(function ($query) {
                    $query->whereHas('athlete1', function ($subquery) {
                        $subquery->search($this->search);
                    })
                        ->orWhereHas('athlete2', function ($subquery) {
                            $subquery->search($this->search);
                        })
                        ->orWhereHas('winner', function ($subquery) {
                            $subquery->search($this->search);
                        })
                        ->orWhereHas('athlete1.team', function ($subquery) {
                            $subquery->search($this->search);
                        })
                        ->orWhereHas('athlete2.team', function ($subquery) {
                            $subquery->search($this->search);
                        })
                        ->orWhereHas('winner.team', function ($subquery) {
                            $subquery->search($this->search);
                        });
                })
                ->paginate(15)
        ]);
    }

    /**
     * Generate matches
     */
    public function generateMatches() {
        $athletes = Athlete::all()->shuffle(); // Shuffle the athletes randomly

        // Create match pairings
        $matches = [];

        while ($athletes->count() >= 2) {
            $athlete1 = $athletes->shift();

            // Randomly select an opponent from the remaining athletes
            $opponent = $athletes->random();

            // Remove the opponent from the remaining athletes
            $athletes = $athletes->reject(function ($athlete) use ($opponent) {
                return $athlete->id === $opponent->id;
            });

            // Create a match between $athlete1 and $opponent
            $match = GameMatch::create([
                'round' => 1, // You can adjust the round as needed
                'athlete1_id' => $athlete1->id,
                'athlete2_id' => $opponent->id,
                'winner_id' => null, // Winner not set initially
            ]);

            $matches[] = $match;
        }

        // Handle any remaining athlete (if the number of athletes is odd)
        if ($athletes->count() === 1) {
            $unmatchedAthlete = $athletes->first();
            // You can either assign them a bye or handle it as needed for your specific tournament rules.
        }
    }
}
