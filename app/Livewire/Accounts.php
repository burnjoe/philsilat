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
    public $selectedSex = [];
    public $selectedRole = [];
    public $selectedStatus = [];
    public $isSexDropdownOpen = false;
    public $isRoleDropdownOpen = false;
    public $isStatusDropdownOpen = false;

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.accounts', [
            'users' => User::with('profileable')
                ->where(function ($query) {
                    $query->search($this->search)
                        ->orWhereHas('profileable', function ($subquery) {
                            $subquery->search($this->search);
                        });
                })
                ->when($this->selectedSex, function ($query) {
                    return $query->sex($this->selectedSex);
                })
                ->when($this->selectedRole, function ($query) {
                    return $query->role($this->selectedRole);
                })
                ->when($this->selectedStatus, function ($query) {
                    return $query->status($this->selectedStatus);
                })
                ->latest()
                ->paginate(15)
        ]);
    }

    // Clear all filters
    public function clearAllFilters()
    {
        $this->selectedSex = [];
        $this->selectedRole = [];
        $this->selectedStatus = [];
    }

    // Toggle dropdown state
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

    // Close all dropdowns when clicking outside
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
