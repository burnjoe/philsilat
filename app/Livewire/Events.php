<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Events extends Component
{
    use WithPagination;

    public $search = "";
    public $selectedStatus = [];
    public $isStatusDropdownOpen = false; // Add a property to manage dropdown state

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events', [
            'events' => Event::orderBy('starts_at', 'desc')
                ->when($this->search, function ($query) {
                    return $query->search($this->search);
                })
                ->when($this->selectedStatus, function ($query) {
                    return $query->status($this->selectedStatus);
                })
                ->paginate(16),
        ]);
    }

    // Clear all filters
    public function clearAllFilters()
    {
        $this->selectedStatus = [];
    }

    // Toggle dropdown state
    public function toggleSexDropdown()
    {
        $this->isStatusDropdownOpen = !$this->isStatusDropdownOpen;
    }

    // Close dropdown when clicking outside
    public function closeStatusDropdown()
    {
        $this->isStatusDropdownOpen = false;
    }
}
