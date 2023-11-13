<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $search = "";
    public $selectedSex = [];
    public $isSexDropdownOpen = false;

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::orderBy('id', 'desc')
                ->when($this->search, function ($query) {
                    return $query->search($this->search);
                })
                ->when($this->selectedSex, function ($query) {
                    return $query->sex($this->selectedSex);
                })
                ->paginate(15),
        ]);
    }

    // Clear all filters
    public function clearAllFilters()
    {
        $this->selectedSex = [];
    }

    // Toggle dropdown state
    public function toggleSexDropdown()
    {
        $this->isSexDropdownOpen = !$this->isSexDropdownOpen;
    }

    // Close all dropdowns when clicking outside
    public function closeSexDropdown()
    {
        $this->isSexDropdownOpen = false;
    }
}
