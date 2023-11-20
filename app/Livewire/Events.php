<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Events extends Component
{
    use WithPagination;

    public $search = "";
    public $selectedStatuses = [];

    public $isStatusDropdownOpen = false;

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events', [
            'events' => Event::orderBy('starts_at', 'desc')
                ->when(
                    $this->search,
                    fn ($query) =>
                    $query->search($this->search)
                )
                ->when(
                    $this->selectedStatuses,
                    fn ($query) =>
                    $query->status($this->selectedStatuses)
                )
                ->paginate(16),
        ]);
    }

    /**
     * Checks if there are filters
     */
    public function hasFilters()
    {
        return !empty($this->selectedStatuses);
    }

    /**
     * Clear all filters
     */
    public function clearAllFilters()
    {
        $this->selectedStatuses = [];
    }

    /**
     * Toggle dropdown state
     */
    public function toggleSexDropdown()
    {
        $this->isStatusDropdownOpen = !$this->isStatusDropdownOpen;
    }

    /**
     * Close dropdown when clicking outside
     */
    public function closeStatusDropdown()
    {
        $this->isStatusDropdownOpen = false;
    }
}
