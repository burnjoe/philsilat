<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SignUpCode;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Auth\Access\AuthorizationException;

class AccountsIndex extends Component
{
    use WithPagination;

    public $num_codes;
    public $role;

    public $search = "";


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.accounts.index', [
            'codes' => SignUpCode::latest()
                ->search($this->search)
                ->paginate(15)
        ]);
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
            $this->authorize('generate codes');

            $this->validate();

            for ($i = 0; $i < $this->num_codes; $i++) {
                SignUpCode::create([
                    'code' => $this->uniqueRandomCode(),
                    'role' => $this->role,
                ]);
            }

            session()->flash('success', 'The ' . $this->num_codes . ' signup code(s) has been added successfully.');

            $this->reset();
        } catch (\Throwable $th) {
            if ($th instanceof AuthorizationException) {
                redirect()->route('accounts.index')
                    ->with('danger', 'Unauthorized action.');
            }
        }
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
