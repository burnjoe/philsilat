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

    public $round;
    public $winner_id;

    public $search = "";

    public $isRoundDropdownOpen = false;

    /**
     * Initializes attributes at load
     */
    public function mount(Event $event, Game $game)
    {
        $this->event = $event;
        $this->game = $game;
        $this->round = GameMatch::select('round')
            ->where('game_id', $game->id)
            ->groupBy('round')
            ->latest('round')
            ->first()
            ->round ?? 1;
    }

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.games.matches', [
            'rounds' => GameMatch::select('round')
                ->where('game_id', $this->game->id)
                ->groupBy('round')
                ->orderBy('round', 'desc')
                ->get(),
        ]);
    }
}