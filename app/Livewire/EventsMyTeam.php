<?php

namespace App\Livewire;

use App\Models\Athlete;
use App\Models\Coach;
use App\Models\Event;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EventsMyTeam extends Component
{
    use WithPagination;

    public $event;
    public $team;

    public $search = "";
    public $selectedSexes = [];

    public $isSexDropdownOpen = false;


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
        return view('livewire.events.my-team', [
            'athletes' => Athlete::where('team_id', $this->team->id)
                ->when(
                    $this->search,
                    fn ($query) =>
                    $query->search($this->search)
                )
                ->when(
                    $this->selectedSexes,
                    fn ($query) =>
                    $query->sex($this->selectedSexes)
                )
                ->orderBy('weight', 'asc')
                ->paginate(16),
            'coaches' => Coach::with(['user' => fn ($query) => $query->select('id', 'email', 'profileable_id', 'profileable_type')])
                ->whereHas(
                    'teams',
                    fn ($query) =>
                    $query->where('id', $this->team->id)
                )
                ->latest()
                ->get(),
            'isJoined' => $this->team->exists(),
        ]);
    }

    /**
     * Checks if there are filters
     */
    public function hasFilters()
    {
        return !empty($this->selectedSexes) || !empty($this->selectedRoles) || !empty($this->selectedStatuses);
    }

    /**
     * Clear all filters
     */
    public function clearAllFilters()
    {
        $this->selectedSexes = [];
    }

    /**
     * Toggle dropdown state
     */
    public function toggleSexDropdown()
    {
        $this->isSexDropdownOpen = !$this->isSexDropdownOpen;
    }

    /**
     * Close all dropdowns when clicking outside
     */
    public function closeSexDropdown()
    {
        $this->isSexDropdownOpen = false;
    }
}
