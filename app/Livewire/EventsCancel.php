<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class EventsCancel extends Component
{
    public $event;


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events.cancel');
    }

    /**
     * Initializes attributes upon load
     */
    public function mount(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Cancel an upcoming or registration open event
     */
    public function cancelEvent()
    {
        try {
            $this->authorize('manage events');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return $this->redirectRoute('events.settings', ['event' => $this->event->id], navigate: true);
        }

        if (!in_array($this->event->status, ["UPCOMING", "REGISTRATION OPEN"])) {
            session()->flash('danger', 'Something unexpected happened. Please refresh the page and try again.');
            return $this->redirectRoute('events.settings', ['event' => $this->event->id], navigate: true);
        }

        $this->event->update(['status' => "CANCELLED"]);

        session()->flash('success', 'The event has been successfully cancelled.');
        return $this->redirectRoute('events.settings', ['event' => $this->event->id], navigate: true);
    }
}
