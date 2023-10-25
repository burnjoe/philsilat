<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Game;
use Livewire\Component;
use Livewire\WithPagination;

class EventsShow extends Component
{
    use WithPagination;

    public $event;

    public $search = "";

    
    /**
     * Initializes attributes upon load
     */
    public function mount(Event $event) {
        $this->event = $event;
    }

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events.show', [
            'games' => Game::with('category')
                ->where('event_id', $this->event->id)
                ->latest()
                ->search($this->search)
                ->paginate(16)
        ]);
    }
}
