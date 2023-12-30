<?php

namespace App\Livewire;

use App\Models\Athlete;
use App\Models\Event;
use App\Models\Game;
use Livewire\Component;
use Livewire\WithPagination;

class GamesAthletes extends Component
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
        $athletes = Athlete::with('team')
            ->where('game_id', $this->game->id)
            ->when(
                $this->search,
                fn ($query) =>
                $query->search($this->search)
            )
            ->paginate(15);

        return view('livewire.games.athletes', [
            'athletes' => $athletes,
            'roundsCount' => ceil(log($athletes->total(), 2)),
        ]);
    }
}
