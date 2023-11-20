<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $search = "";
    public $selectedSexes = [];

    public $isSexDropdownOpen = false;

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::orderBy('id', 'desc')
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
                ->paginate(15),
        ]);
    }

    /**
     * Checks if there are filters
     */
    public function hasFilters()
    {
        return !empty($this->selectedSexes);
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
