<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Team;
use Livewire\Component;
use Throwable;

class DropTeam extends Component
{
    public $event;
    public $team;


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events.drop-team');
    }

    /**
     * Initializes attributes upon load
     */
    public function mount(Event $event, Team $team)
    {
        $this->event = $event;
        $this->team = $team;
    }

    /**
     * Drops the record from the database
     */
    public function destroy()
    {
        try {
            $this->authorize('manage categories');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return $this->redirectRoute('events.teams', ['event' => $this->event->id], navigate: true);
        }

        try {
            $this->team->delete();

            session()->flash('success', 'The team has been dropped successfully.');
            return $this->redirectRoute('events.teams', ['event' => $this->event->id], navigate: true);
        } catch (\Throwable $th) {
            session()->flash('danger', 'Something unexpected happened. Please refresh the page and try again.');
            return $this->redirectRoute('events.teams', ['event' => $this->event->id], navigate: true);
        }
    }

    /**
     * Drops all the record from the database
     */
    public function destroyAll()
    {
        try {
            $this->authorize('manage categories');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return $this->redirectRoute('events.teams', ['event' => $this->event->id], navigate: true);
        }

        try {
            if (!$this->team->exists) {
                Team::where('event_id', $this->event->id)->delete();

                session()->flash('success', 'All teams have been dropped successfully.');
                return $this->redirectRoute('events.teams', ['event' => $this->event->id], navigate: true);
            } else {
                throw new \Throwable;
            }
        } catch (\Throwable $th) {
            session()->flash('danger', 'Something unexpected happened. Please refresh the page and try again.');
            return $this->redirectRoute('events.teams', ['event' => $this->event->id], navigate: true);
        }
    }
}
