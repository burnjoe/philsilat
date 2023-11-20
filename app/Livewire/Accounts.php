<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Auth\Access\AuthorizationException;

class Accounts extends Component
{
    use WithPagination;

    public $search = "";
    public $selectedSexes = [];
    public $selectedRoles = [];
    public $selectedStatuses = [];

    public $isSexDropdownOpen = false;
    public $isRoleDropdownOpen = false;
    public $isStatusDropdownOpen = false;

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.accounts', [
            'users' => User::with(['profileable', 'roles'])
                ->when(
                    $this->search,
                    fn ($query) =>
                    $query->search($this->search)
                        ->orWhereHas(
                            'profileable',
                            fn ($subquery) =>
                            $subquery->search($this->search)
                        )
                )
                ->when(
                    $this->selectedSexes,
                    fn ($query) =>
                    $query->whereHas(
                        'profileable',
                        fn ($subquery) =>
                        $subquery->sex($this->selectedSexes)
                    )
                )
                ->when(
                    $this->selectedRoles,
                    fn ($query) =>
                    $query->whereHas(
                        'roles',
                        fn ($subquery) =>
                        $subquery->whereIn('name', $this->selectedRoles)
                    )
                )
                ->when(
                    $this->selectedStatuses,
                    fn ($query) =>
                    $query->status($this->selectedStatuses)
                )
                ->latest()
                ->paginate(15)
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
        $this->selectedRoles = [];
        $this->selectedStatuses = [];
    }

    /**
     * Toggle dropdown state
     */
    public function toggleSexDropdown()
    {
        $this->isSexDropdownOpen = !$this->isSexDropdownOpen;
    }

    public function toggleRoleDropdown()
    {
        $this->isRoleDropdownOpen = !$this->isRoleDropdownOpen;
    }

    public function toggleStatusDropdown()
    {
        $this->isStatusDropdownOpen = !$this->isStatusDropdownOpen;
    }

    /**
     * Close all dropdowns when clicking outside
     */
    public function closeSexDropdown()
    {
        $this->isSexDropdownOpen = false;
    }

    public function closeRoleDropdown()
    {
        $this->isRoleDropdownOpen = false;
    }

    public function closeStatusDropdown()
    {
        $this->isStatusDropdownOpen = false;
    }
}
