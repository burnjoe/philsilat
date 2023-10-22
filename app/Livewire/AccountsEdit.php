<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class AccountsEdit extends Component
{
    public $user;

    public $last_name;
    public $first_name;
    public $sex;
    public $email;
    public $password;
    public $phone;
    public $role;
    public $status;


    /**
     * Validation rules
     */
    public function rules()
    {
        return [];
    }

    /**
     * Validation messages
     */
    public function messages()
    {
        return [];
    }

    /**
     * Validation attributes
     */
    public function validationAttributes()
    {
        return [];
    }

    /**
     * Initializes attributes upon load
     */
    public function mount()
    {
        try {
            $this->user = User::with('profileable')->find(session('id'));

            $this->last_name = $this->user->profileable->last_name;
            $this->first_name = $this->user->profileable->first_name;
            $this->sex = $this->user->profileable->sex;
            $this->email = $this->user->email;
            $this->phone = $this->user->profileable->phone;
            $this->role = $this->user->getRoleNames()->first();
            $this->status = $this->user->status;
        } catch (\Throwable $th) {
            redirect()->route('accounts');
        }
    }

    /**
     * Update the selected category
     */
    public function update()
    {
        $validated = $this->validate();

        $this->category->update($validated);

        redirect()->route('accounts');
    }

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.accounts.edit');
    }
}
