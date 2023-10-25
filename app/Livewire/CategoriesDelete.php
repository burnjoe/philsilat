<?php

namespace App\Livewire;

use Throwable;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;

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
            if ($th instanceof AuthorizationException) {
                redirect()->route('categories')
                    ->with('danger', 'Unauthorized action.');
            }
        }

        $this->category->delete();

        redirect()->route('categories')
            ->with('success', 'The category has been deleted successfully.');
    }
}
