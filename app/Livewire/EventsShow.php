<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\Admin;
use App\Models\Coach;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class EventsShow extends Component
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

        $games = Game::with('category')
            ->where('event_id', $this->event->id)
            ->when(
                $this->search,
                fn ($query) =>
                $query->search($this->search)
                    ->orWhereHas(
                        'category',
                        fn ($subquery) =>
                        $subquery->search($this->search)
                    )
            )
            ->orderByRaw("(SELECT CONCAT(sex, class_label) FROM categories WHERE categories.id = games.category_id) ASC")
            ->paginate(16);

        // if user is admin
        if ($user->profileable instanceof Admin) {
            return view('livewire.events.show', [
                'games' => $games,
            ]);
        }

        // otherwise
        return view('livewire.events.show', [
            'games' => $games,
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
