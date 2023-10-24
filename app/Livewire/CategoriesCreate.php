<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;

class CategoriesCreate extends Component
{
    public $class_label;
    public $sex;
    public $min_weight;
    public $max_weight;


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.categories.create');
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
     * Adds the record to the database
     */
    public function store()
    {
        try {
            $this->authorize('manage categories');
        } catch (\Throwable $th) {
            if ($th instanceof AuthorizationException) {
                redirect()->route('categories')
                ->with('danger', 'Unauthorized action.');
            }
        }

        $validated = $this->validate();

        Category::create($validated);

        redirect()->route('categories')
            ->with('success', 'The category has been added successfully.');
    }
}
