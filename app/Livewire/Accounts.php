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


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.accounts', [
            'users' => User::with('profileable')
                ->whereHas('profileable', function ($query) {
                    $query->where('last_name', 'like', "%{$this->search}%")
                        ->orWhere('first_name', 'like', "%{$this->search}%")
                        ->orWhere('phone', 'like', "%{$this->search}%");
                })
                ->latest()
                ->paginate(15)
        ]);
    }
}
