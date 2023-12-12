<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePassword extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.auth.change-password');
    }

    /**
     * Update the user's password.
     */
    public function update()
    {
        if (auth()->check()) {
            $validated = $this->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);
    
            auth()->user()->update([
                'password' => Hash::make($validated['password']),
            ]);
    
            session()->flash('success', 'Password has been successfully changed');
            
            $this->reset();
        } else {
            session()->flash('danger', 'Something unexpected has happened. Please try refreshing the page.');
        }
    }
}
