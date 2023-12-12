<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\Event;
use App\Models\Athlete;
use Livewire\Component;
use App\Models\GameMatch;
use Livewire\WithPagination;

class MatchList extends Component
{
    use WithPagination;

    public $event;
    public $game;

    public $round;
    public $winner_id;

    public $search = "";


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.components.match-list', [
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
                ->round($this->round)
                ->paginate(15),
            'round' => $this->round,
            'rounds' => GameMatch::select('round')
                ->where('game_id', $this->game->id)
                ->groupBy('round')
                ->get(),
            'is_round_completed' => !GameMatch::select('winner_id')
                ->where('game_id', $this->game->id)
                ->where('round', $this->round)
                ->where('winner_id', null)
                ->count() > 0,
        ]);
    }

    /**
     * Validation rules
     */
    public function rules()
    {
        return [
            'winner_id' => 'required|integer',
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
     * Generate match pairings
     *
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
     *
     */
    public function generateMatches()
    {
        // Only generate match pairings for ongoing events
        if ($this->event->status !== "ONGOING") {
            switch ($this->event->status) {
                case 'UPCOMING':
                case 'REGISTRATION OPEN':
                    session()->flash('danger', 'Unable to generate matches. The event has not even started yet. Please start the event first.');
                    break;
                case 'COMPLETED':
                    session()->flash('danger', 'Unable to generate matches. The event has already been completed.');
                    break;
                case 'CANCELLED':
                    session()->flash('danger', 'Unable to generate matches. The event has already been cancelled.');
                    break;
                default:
                    session()->flash('danger', 'Something unexpected happened. Please refresh the page and try again.');
            }
            return $this->redirectRoute('games.matches', ['event' => $this->event->id, 'game' => $this->game->id], navigate: true);
        }

        // Get latest round number
        $this->round = GameMatch::select('round')
            ->where('game_id', $this->game->id)
            ->groupBy('round')
            ->latest('round')
            ->first();

        // Shuffle the athletes randomly
        if (!$this->round) {
            $athletes = Athlete::noMatchesInSameGame($this->game->id)->get()->shuffle();
        } else {
            $this->round = $this->round->round;
            $athletes = Athlete::winnersOfSameRound($this->game->id, $this->round)->get()->shuffle();
            $this->closeMatchesOfRound($this->round);
        }

        // Use to check if all match pairings of this round is closed
        $checkMatch = GameMatch::where('game_id', $this->game->id)
            ->where('round', $this->round)
            ->value('is_closed') ?? true;

        // Checks if there's an athlete and ensure all pairs have winners
        if ($athletes->isEmpty() || !$checkMatch) {
            session()->flash('danger', 'Something unexpected happened. Please refresh the page and try again.');
            return $this->redirectRoute('games.matches', ['event' => $this->event->id, 'game' => $this->game->id], navigate: true);
        }

        // Create match pairings for new round
        $this->round += 1;

        // Gets last game number
        $game_no = GameMatch::where('game_id', $this->game->id)
            ->count();

        // Create match pairings
        while ($athletes->count() >= 2) {
            $game_no++;
            $athlete = $athletes->shift();
            $opponent = $athletes->shift();

            // Create a match between $athlete and $opponent
            GameMatch::create([
                'round' => $this->round,
                'game_no' => $game_no,
                'game_id' => $this->game->id,
                'athlete1_id' => $athlete->id,
                'athlete2_id' => $opponent->id,
            ]);
        }

        // Handle any remaining athlete
        if ($athletes->isNotEmpty()) {
            $game_no++;

            GameMatch::create([
                'round' => $this->round,
                'game_no' => $game_no,
                'game_id' => $this->game->id,
                'athlete1_id' => $athletes->first()->id,
            ]);
        }

        session()->flash('success', 'The pairings for the round have been successfully generated.');
        return $this->redirectRoute('games.matches', ['event' => $this->event->id, 'game' => $this->game->id], navigate: true);
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

        $winner = GameMatch::where('game_id', $this->game->id)
            ->where('round', $this->round)
            ->where(function ($query) use ($winner_id) {
                $query->where('athlete1_id', $winner_id)
                    ->orWhere('athlete2_id', $winner_id);
            })
            ->first();

        if ($winner) {
            $winner->update($validated);

            $this->reset('winner_id');
        }
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
     * Close matches, means that action made to this match will be irreversible
     */
    public function closeMatchesOfRound($round)
    {
        $matches = GameMatch::where('game_id', $this->game->id)
            ->where('round', $round);

        // Checks if all match pairs of the current round has winner
        if (!$matches->get()->where('winner_id', null)->count() > 0) {
            if ($matches->count() === 1) {
                $this->game->update(['is_completed' => true]);


                // Create table for winners

                $matches->where('is_closed', false)
                    ->update(['is_closed' => true]);

                session()->flash('success', 'The game has been successfully completed.');
                return $this->redirectRoute('games.matches', ['event' => $this->event->id, 'game' => $this->game->id], navigate: true);
            }

            $matches->where('is_closed', false)
                ->update(['is_closed' => true]);
        }
    }
}
