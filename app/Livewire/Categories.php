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
}
