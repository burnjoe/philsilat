<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;

class CategoriesEdit extends Component
{
    public $category;

    public $class_label;
    public $sex;
    public $min_weight;
    public $max_weight;


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.categories.edit');
    }

    /**
     * Validation rules
     */
    public function rules()
    {
        return [
            'class_label' => 'required|min:1|max:2|regex:/^[A-Z]+$/',
            'sex' => 'required|in:Male,Female',
            'min_weight' => 'required|numeric|between:35.00,110.00',
            'max_weight' => 'required|numeric|between:35.00,110.00|gt:min_weight',
        ];
    }

    /**
     * Validation messages
     */
    public function messages()
    {
        return [
            'class_label.regex' => 'The :attribute field must be in uppercase format.',
            'max_weight.gt' => 'The :attribute must be greater than minimum weight.',
        ];
    }

    /**
     * Validation attributes
     */
    public function validationAttributes()
    {
        return [
            'sex' => 'sex category',
            'min_weight' => 'minimum weight',
            'max_weight' => 'maximum weight',
        ];
    }

    /**
     * Initializes attributes upon load
     */
    public function mount()
    {
        try {
            $this->category = Category::find(session('id'));

            $this->class_label = $this->category->class_label;
            $this->sex = $this->category->sex;
            $this->min_weight = $this->category->min_weight;
            $this->max_weight = $this->category->max_weight;
        } catch (\Throwable $th) {
            redirect()->route('categories');
        }
    }

    /**
     * Update the selected category
     */
    public function update()
    {
        try {
            $this->authorize('edit categories');

            $validated = $this->validate();

            $this->category->update($validated);

            redirect()->route('categories')
                ->with('success', 'The category has been updated successfully.');
        } catch (\Throwable $th) {
            if ($th instanceof AuthorizationException) {
                redirect()->route('categories')
                    ->with('danger', 'Unauthorized action.');
            }
        }
    }
}
