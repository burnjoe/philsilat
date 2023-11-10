<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

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
    public function mount(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Deletes the record from the database
     */
    public function destroy()
    {
        try {
            $this->authorize('manage categories');
        } catch (\Throwable $th) {
            return redirect()->route('categories')
                ->with('danger', 'Unauthorized action.');
        }

        try {
            $this->category->delete();

            return redirect()->route('categories')
                ->with('success', 'The category has been deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('categories')
                ->with('danger', 'Unable to delete the category. It is currently in use and cannot be removed.');
        }
    }
}
