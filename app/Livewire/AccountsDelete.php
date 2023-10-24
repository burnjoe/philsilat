<?php

namespace App\Livewire;

use Throwable;
use App\Models\User;
use Livewire\Component;
use Illuminate\Auth\Access\AuthorizationException;

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
            $this->authorize('manage accounts');

            $this->user->delete();

            redirect()->route('accounts')
                ->with('success', 'The user account has been updated successfully.');
        } catch (\Throwable $th) {
            // Error here
            if ($th instanceof AuthorizationException) {
                redirect()->route('accounts')
                    ->with('danger', 'Unauthorized action.');
            }
        }
    }
}
