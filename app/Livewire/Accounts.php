<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Accounts extends Component
{
    public $search = "";

    public function render()
    {
        return view('livewire.accounts', [
            'accounts' => User::with('profileable')
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
