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
            session()->flash('danger', 'Unauthorized action.');
            return $this->redirectRoute('categories', navigate: true);
        }

        try {
            $this->category->delete();

            session()->flash('success', 'The category has been deleted successfully.');
            return $this->redirectRoute('categories', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unable to delete the category. It is currently in use and cannot be removed.');
            return $this->redirectRoute('categories', navigate: true);
        }
    }
}
