<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SignUpCode;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class AccountsIndex extends Component
{
    use WithPagination;

    public $num_codes;
    public $role;

    public $search = "";
    public $selectedRoles = [];

    public $isRoleDropdownOpen = false;

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.accounts.index', [
            'codes' => SignUpCode::latest()
                ->when(
                    $this->search,
                    fn ($query) =>
                    $query->search($this->search)
                )
                ->when(
                    $this->selectedRoles,
                    fn ($query) =>
                    $query->role($this->selectedRoles)
                )
                ->paginate(15)
        ]);
    }

    /**
     * Checks if there are filters
     */
    public function hasFilters()
    {
        return !empty($this->selectedRoles);
    }

    /**
     * Clear all filters
     */
    public function clearAllFilters()
    {
        $this->selectedRoles = [];
    }

    /**
     * Toggle dropdown state
     */
    public function toggleRoleDropdown()
    {
        $this->isRoleDropdownOpen = !$this->isRoleDropdownOpen;
    }

    /**
     * Close all dropdowns when clicking outside
     */
    public function closeRoleDropdown()
    {
        $this->isRoleDropdownOpen = false;
    }

    /**
     * Validation rules
     */
    public function rules()
    {
        return [
            'num_codes' => ['required', 'integer', 'min:1', 'max:10'],
            'role' => ['required', 'string', 'in:Admin,Coach'],
        ];
    }

    /**
     * Validation attributes
     */
    public function validationAttributes()
    {
        return [
            'num_codes' => 'number of signup codes'
        ];
    }

    /**
     * Adds the record to the database
     */
    public function store()
    {
        try {
            $this->authorize('manage codes');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return $this->redirectRoute('accounts.index', navigate: true);
        }

        $this->validate();

        for ($i = 0; $i < $this->num_codes; $i++) {
            SignUpCode::create([
                'code' => $this->uniqueRandomCode(),
                'role' => $this->role,
            ]);
        }

        session()->flash('success', 'The ' . $this->num_codes . ' signup code(s) has been added successfully.');

        $this->reset();
    }

    /**
     * Generates unique random code
     */
    private function uniqueRandomCode()
    {
        do {
            $code = Str::random(8);
        } while (SignUpCode::where('code', $code)->exists());

        return $code;
    }
}
