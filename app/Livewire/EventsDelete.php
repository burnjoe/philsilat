<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class EventsDelete extends Component
{
    public $event;


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events.delete');
    }

    /**
     * Initializes attributes upon load
     */
    public function mount(Event $event)
    {
        $this->event = $event;
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
            return $this->redirectRoute('events.settings', ['event' => $this->event->id], navigate: true);
        }

        if (in_array($this->event->status, ["COMPLETED", "CANCELLED"])) {
            $this->event->delete();

            session()->flash('success', 'The game has been deleted successfully.');
            return $this->redirectRoute('events', navigate: true);
        } else {
            switch ($this->event->status) {
                case 'ONGOING':
                    session()->flash('danger', 'Unable to delete the event. It is currently an ongoing event and cannot be deleted.');
                    break;
                default:
                    session()->flash('danger', 'Unable to delete the event. If you still want to delete the event, cancel the event first.');
                    break;
            }
            return $this->redirectRoute('events.settings', ['event' => $this->event->id], navigate: true);
        }
    }
}
