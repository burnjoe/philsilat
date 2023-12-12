<?php

namespace App\Livewire;

use App\Models\Athlete;
use App\Models\Coach;
use App\Models\Event;
use App\Models\Team;
use Livewire\Component;
use Livewire\WithPagination;

class ViewTeam extends Component
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
    public function mount(Event $event, Team $team)
    {
        $this->event = $event;
        $this->team = $team;
    }

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events.view-team', [
            'athletes' => Athlete::with([
                'game' => fn ($query) => $query->select('id', 'name', 'category_id'),
                'game.category' => fn ($query) => $query->select('id', 'class_label', 'sex')
            ])
                ->where('team_id', $this->team->id)
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
