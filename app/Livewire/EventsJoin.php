<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class EventsJoin extends Component
{
    use WithPagination;

    public $event;

    public $search;


    /**
     * Initializes attributes upon load
     */
    public function mount(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events.join');
    }

    /**
     * Join Event
     */
    public function joinEvent()
    {
        // operation that makes you join an event
    }
}
