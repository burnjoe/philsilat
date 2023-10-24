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

    /**
     * Redirects user to view all signup codes
     */
    public function index()
    {
        try {
            $this->authorize('view codes');

            redirect()->route('accounts.index');
        } catch (\Throwable $th) {
            if ($th instanceof AuthorizationException) {
                redirect()->route('accounts')
                    ->with('danger', 'Unauthorized action.');
            }
        }
    }

    /**
     * Redirects user to edit record page
     */
    public function edit(int $id)
    {
        try {
            $this->authorize('edit accounts');

            redirect()->route('accounts.edit')
                ->with('id', $id);
        } catch (\Throwable $th) {
            if ($th instanceof AuthorizationException) {
                redirect()->route('accounts')
                    ->with('danger', 'Unauthorized action.');
            }
        }
    }

    /**
     * Redirects user to delete record page
     */
    public function delete(int $id)
    {
        try {
            $this->authorize('delete accounts');

            redirect()->route('accounts.delete')
                ->with('id', $id);
        } catch (\Throwable $th) {
            if ($th instanceof AuthorizationException) {
                redirect()->route('accounts')
                    ->with('danger', 'Unauthorized action.');
            }
        }
    }
}
