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
                ->where(function ($query) {
                    $query->search($this->search)
                        ->orWhereHas('profileable', function ($subquery) {
                            $subquery->search($this->search);
                        });
                })
                ->latest()
                ->paginate(15)
        ]);
    }
}
