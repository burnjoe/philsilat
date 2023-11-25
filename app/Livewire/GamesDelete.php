<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Game;
use Livewire\Component;

class GamesDelete extends Component
{
    public $event;
    public $game;


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.games.delete');
    }

    /**
     * Initializes attributes upon load
     */
    public function mount(Event $event, Game $game)
    {
        $this->event = $event;
        $this->game = $game;
    }

    /**
     * Deletes the record from the database
     */
    public function destroy()
    {
        try {
            $this->authorize('manage events');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return $this->redirectRoute('games.settings', ['event' => $this->event->id, 'game' => $this->game->id], navigate: true);
        }

        if ($this->game->athletes()->exists()) {
            session()->flash('danger', 'Unable to delete the game. It already have teams registered in it and cannot be deleted.');
            return $this->redirectRoute('games.settings', ['event' => $this->event->id, 'game' => $this->game->id], navigate: true);
        }

        $this->game->delete();

        session()->flash('success', 'The game has been deleted successfully.');
        return $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }
}
