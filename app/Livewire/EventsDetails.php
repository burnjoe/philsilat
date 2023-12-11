<?php

namespace App\Livewire;

use App\Models\Admin;
use App\Models\Game;
use App\Models\Coach;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class EventsDetails extends Component
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
        $user = Auth::user();

        $game = Game::with([
            'category' =>
            fn ($query) =>
            $query->orderBy('class_label', 'asc')
        ])
            ->where('event_id', $this->event->id)
            ->get();

        // if user is admin
        if ($user->profileable instanceof Admin) {
            return view('livewire.events.details', [
                'maleGames' => $game->filter(fn ($game) => $game->category->sex === 'Male'),
                'femaleGames' => $game->filter(fn ($game) => $game->category->sex === 'Female'),
                'registeredTeams' => $this->event->loadCount('teams')->teams_count,
            ]);
        }

        // otherwise
        return view('livewire.events.details', [
            'maleGames' => $game->filter(fn ($game) => $game->category->sex === 'Male'),
            'femaleGames' => $game->filter(fn ($game) => $game->category->sex === 'Female'),
            'registeredTeams' => $this->event->loadCount('teams')->teams_count,
            'isJoined' => Coach::where('id', $user->profileable->id)
                ->whereHas(
                    'teams.event',
                    fn ($query) =>
                    $query->where('events.id', $this->event->id)
                )
                ->exists(),
        ]);
    }
}
