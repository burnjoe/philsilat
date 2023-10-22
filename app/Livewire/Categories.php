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


    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::latest()
                ->search($this->search)
                ->paginate(10),
        ]);
    }

    public function create()
    {
        redirect()->route('categories.create');
    }

    public function edit($id)
    {
        redirect()->route('categories.edit')
            ->with('id', $id);
    }

    public function delete(int $id)
    {
        redirect()->route('categories.delete')
            ->with('id', $id);
    }
}
