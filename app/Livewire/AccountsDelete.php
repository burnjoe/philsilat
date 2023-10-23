<?php

namespace App\Livewire;

use App\Models\User;
use Throwable;
use Livewire\Component;

class AccountsDelete extends Component
{
    public $user;

    
    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.accounts.delete');
    }

    /**
     * Initializes attributes upon load
     */
    public function mount()
    {
        try {
            $this->user = User::find(session('id'));

            if (!$this->user) {
                throw new Throwable;
            }
        } catch (\Throwable $th) {
            redirect()->route('accounts');
        }
    }

     /**
     * Deletes the record from the database
     */
    public function destroy()
    {
        try {
            $this->user->delete();

            redirect()->route('accounts');
        } catch (\Throwable $th) {
            // Error here
        }
    }
}
