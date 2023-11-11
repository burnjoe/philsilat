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
    public $selectedSex = [];


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::orderBy('id', 'desc')
                ->when($this->search, function ($query) {
                    return $query->search($this->search);
                })
                ->when($this->selectedSex, function ($query) {
                    return $query->sex($this->selectedSex);
                })
                ->paginate(15),
        ]);
    }
}
