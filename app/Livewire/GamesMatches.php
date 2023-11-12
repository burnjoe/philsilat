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

    public $round = '1';
    public $winner_id;

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
                ->when($this->search, function ($query) {
                    $query->whereHas('athlete1', fn ($query) => $query->search($this->search))
                        ->orWhereHas('athlete2', fn ($query) => $query->search($this->search))
                        ->orWhereHas('winner', fn ($query) => $query->search($this->search))
                        ->orWhereHas('athlete1.team', fn ($query) => $query->search($this->search))
                        ->orWhereHas('athlete2.team', fn ($query) => $query->search($this->search))
                        ->orWhereHas('winner.team', fn ($query) => $query->search($this->search));
                })
                ->where(function ($query) {
                    $query->round($this->round);
                })
                ->paginate(15)
        ]);
    }

    /**
     * Validation rules
     */
    public function rules()
    {
        return [
            'winner_id' => 'required',
        ];
    }

    /**
     * Validation messages
     */
    public function messages()
    {
        return [];
    }

    /**
     * Validation attributes
     */
    public function validationAttributes()
    {
        return [
            'winner_id' => 'round winner',
        ];
    }

    /**
     * Update some attributes when sex field is updated
     */
    public function updatedWinnerId()
    {
        try {
            $this->announceWinner($this->winner_id);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Generate matches
     */
    public function generateMatches()
    {
        /**
         * Matchmaking Rules:
         * 
         * If Matchmake for round 1:
         * 1. Athlete must be a different athlete
         * 2. Athlete must be on a different team
         * 3. Athlete must be on the same event
         * 4. Athlete must be on the same game (that includes its sex and weight category) + (age range: to follow)
         * 5. Athlete must have no existing match on this event
         * 
         * If Matchmake for round >= 2:
         * 1. Athlete must be a different athlete
         * 2. Athlete must be on a different team
         * 3. Athlete must be on the same event
         * 4. Athlete must be on the same game (that includes its sex and weight category) + (age range: to follow)
         * 5. Athlete must be a winner athlete of the previous round (current round - 1)
         * 
         * Before to proceed to next round:
         * 1. Check if all current round matches has winner
         * 2. Check if round number is valid and not skipping round (e.g. Round 1 -> Round 4) 
         */






        // Shuffle the athletes randomly
        // $athletes = Athlete::all()->shuffle();

        // $athletes = Athlete::where('game_id', $this->game->id)->get()->shuffle();

        $athletes = Athlete::noMatchesInSameGame($this->game->id)->get()->shuffle();
        // dd($athletes);

        // Create match pairings
        $matches = [];

        while ($athletes->count() >= 2) {
            $athlete = $athletes->shift();

            // Randomly select an opponent from the remaining athletes
            // $opponent = $athletes->random();
            $opponent = $athletes->shift();

            // Remove the opponent from the remaining athletes
            // $athletes = $athletes->reject(function ($athlete) use ($opponent) {
            //     return $athlete->id === $opponent->id;
            // });

            // Create a match between $athlete and $opponent
            $match = GameMatch::create([
                'round' => $this->round,
                'game_id' => $this->game->id,
                'athlete1_id' => $athlete->id,
                'athlete2_id' => $opponent->id,
            ]);

            $matches[] = $match;
        }

        // dd($matches);

        // Handle any remaining athlete (if the number of athletes is odd)
        if ($athletes->count() === 1) {
            GameMatch::create([
                'round' => $this->round,
                'game_id' => $this->game->id,
                'athlete1_id' => $athletes->first()->id,
            ]);
            // $unmatchedAthlete = $athletes->first();
            // You can either assign them a bye or handle it as needed for your specific tournament rules.
        }
    }

    /**
     * Announce round winner
     */
    public function announceWinner($winner_id)
    {
        try {
            $this->authorize('manage events');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return $this->redirectRoute('games.matches', ['event' => $this->event->id, 'game' => $this->game->id], navigate: true);
        }

        $validated = $this->validate();

        $winner = GameMatch::where('round', $this->round)
            ->where('game_id', $this->game->id)
            ->where('athlete1_id', $winner_id)
            ->orWhere('athlete2_id', $this->winner_id)
            ->first();

        $winner->update($validated);

        $this->reset('winner_id');
    }

    /**
     * Denounce round winner, this undo the announcement of winner
     */
    public function denounceWinner($winner_id)
    {
        try {
            $this->authorize('manage events');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return $this->redirectRoute('games.matches', ['event' => $this->event->id, 'game' => $this->game->id], navigate: true);
        }

        $winner = GameMatch::where('round', $this->round)
            ->where('game_id', $this->game->id)
            ->where('winner_id', $winner_id)
            ->first();

        if ($winner) {
            $winner->update([
                'winner_id' => null,
            ]);

            $this->reset('winner_id');
        }
    }

    /**
     * Proceed to next round, creates new round for new matches
     */
    public function proceedNextRound()
    {
    }
}
