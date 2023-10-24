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
            $this->authorize('delete categories');

            $this->category->delete();

            redirect()->route('categories')
                ->with('success', 'The category has been deleted successfully.');
        } catch (\Throwable $th) {
            if ($th instanceof AuthorizationException) {
                redirect()->route('categories')
                    ->with('danger', 'Unauthorized action.');
            }
        }
    }
}
