<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Throwable;

class CategoriesDelete extends Component
{
    public $category;


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.categories.delete');
    }

    /**
     * Initializes attributes upon load
     */
    public function mount()
    {
        try {
            $this->category = Category::find(session('id'));

            if (!$this->category) {
                throw new Throwable;
            }
        } catch (\Throwable $th) {
            redirect()->route('categories');
        }
    }

    /**
     * Deletes the record from the database
     */
    public function destroy()
    {
        try {
            $this->category->delete();

            redirect()->route('categories')
                ->with('success', 'The category has been deleted successfully.');
        } catch (\Throwable $th) {
            // Error here
        }
    }
}
