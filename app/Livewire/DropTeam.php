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
            return redirect()->route('events.teams', ['event' => $this->event->id])
                ->with('danger', 'Unauthorized action.');
        }

        try {
            $this->team->delete();

            return redirect()->route('events.teams', ['event' => $this->event->id])
                ->with('success', 'The team has been dropped successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('events.teams', ['event' => $this->event->id])
                ->with('danger', 'Something unexpected happened. Please refresh the page and try again.');
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
            return redirect()->route('events.teams', ['event' => $this->event->id])
                ->with('danger', 'Unauthorized action.');
        }

        try {
            if(!$this->team->exists) {
                Team::where('event_id', $this->event->id)->delete();
    
                return redirect()->route('events.teams', ['event' => $this->event->id])
                    ->with('success', 'All teams have been dropped successfully.');
            } else {
                throw new \Throwable;
            }
        } catch (\Throwable $th) {
            return redirect()->route('events.teams', ['event' => $this->event->id])
                ->with('danger', 'Something unexpected happened. Please refresh the page and try again.');
        }
    }
}
