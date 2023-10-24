<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Auth\Access\AuthorizationException;

class Categories extends Component
{
    use WithPagination;

    public $search = "";


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::orderBy('id', 'desc')
                ->search($this->search)
                ->paginate(15),
        ]);
    }

    /**
     * Redirects user to create record page
     */
    public function create()
    {
        try {
            $this->authorize('manage categories');
        } catch (\Throwable $th) {
            if ($th instanceof AuthorizationException) {
                redirect()->route('categories')
                    ->with('danger', 'Unauthorized action.');
            }
        }

        redirect()->route('categories.create');
    }

    /**
     * Redirects user to edit record page
     */
    public function edit(int $id)
    {
        try {
            $this->authorize('manage categories');
        } catch (\Throwable $th) {
            if ($th instanceof AuthorizationException) {
                redirect()->route('categories')
                    ->with('danger', 'Unauthorized action.');
            }
        }

        redirect()->route('categories.edit')
            ->with('id', $id);
    }

    /**
     * Redirects user to delete record page
     */
    public function delete(int $id)
    {
        try {
            $this->authorize('manage categories');
        } catch (\Throwable $th) {
            if ($th instanceof AuthorizationException) {
                redirect()->route('categories')
                    ->with('danger', 'Unauthorized action.');
            }
        }

        redirect()->route('categories.delete')
            ->with('id', $id);
    }
}
