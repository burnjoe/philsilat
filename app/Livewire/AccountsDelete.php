<?php

namespace App\Livewire;

use App\Models\User;
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
    public function mount(User $user)
    {
        $this->user = $user;
    }

    /**
     * Deletes the record from the database
     */
    public function destroy()
    {
        try {
            $this->authorize('manage accounts');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return $this->redirectRoute('accounts', navigate: true);
        }

        $this->user->delete();

        session()->flash('success', 'The user account has been deleted successfully.');
        return $this->redirectRoute('accounts', navigate: true);
    }
}
