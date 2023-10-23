<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

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
        redirect()->route('categories.create');
    }

    /**
     * Redirects user to edit record page
     */
    public function edit(int $id)
    {
        redirect()->route('categories.edit')
            ->with('id', $id);
    }

    /**
     * Redirects user to delete record page
     */
    public function delete(int $id)
    {
        redirect()->route('categories.delete')
            ->with('id', $id);
    }
}
