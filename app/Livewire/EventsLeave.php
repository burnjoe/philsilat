<?php

namespace App\Livewire;

use App\Models\Team;
use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EventsLeave extends Component
{
    public $event;
    public $team;


    /**
     * Initializes attributes upon load
     */
    public function mount(Event $event)
    {
        $this->event = $event;
        $this->team = Team::whereHas(
            'event',
            fn ($query) =>
            $query->where('events.id', $this->event->id)
        )
            ->whereHas(
                'coaches',
                fn ($query) =>
                $query->where('coaches.id', Auth::user()->profileable->id)
            )
            ->first();
    }

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events.leave');
    }

    /**
     * Drops the team from the event
     */
    public function leave()
    {
        try {
            $this->authorize('participate events');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
        }

        try {
            $this->team->delete();

            session()->flash('success', 'Your team successfully left the event.');
            return $this->redirectRoute('events', ['event' => $this->event->id], navigate: true);
        } catch (\Throwable $th) {
            session()->flash('danger', 'Something unexpected happened. Please refresh the page and try again.');
            return $this->redirectRoute('events', ['event' => $this->event->id], navigate: true);
        }
    }
}
