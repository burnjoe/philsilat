<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class EventsShow extends Component
{
    public $event;

    
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
        return view('livewire.events.show');
    }
}
