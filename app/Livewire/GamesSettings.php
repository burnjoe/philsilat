<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Game;
use Livewire\Component;

class GamesSettings extends Component
{
    public $event;
    public $game;


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
        return view('livewire.games.settings');
    }
}
