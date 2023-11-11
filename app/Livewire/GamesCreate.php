<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\Event;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Validation\Rule;

class GamesCreate extends Component
{
    public $event;
    public $categories;

    public $name;
    public $sex;
    public $min_weight;
    public $max_weight;
    public $category_id;
    public $event_id;


    /**
     * Initializes attributes upopn load
     */
    public function mount(Event $event)
    {
        $this->event = $event;
        $this->event_id = $event->id;
    }

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.games.create');
    }

    /**
     * Validation rules
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:50',
            'sex' => 'required|in:Male,Female',
            'category_id' => [
                'required',
                Rule::unique('games', 'category_id')->where(function ($query) {
                    return $query->where('event_id', $this->event->id);
                })
            ],
            'event_id' => 'required|exists:events,id',
        ];
    }

    /**
     * Validation messages
     */
    public function messages()
    {
        return [
            'category_id' => 'The class label has already been added.'
        ];
    }

    /**
     * Validation attributes
     */
    public function validationAttributes()
    {
        return [
            'category_id' => 'class label',
            'event_id' => 'event',
        ];
    }

    /**
     * Update some attributes when sex field is updated
     */
    public function updatedSex()
    {
        try {
            $this->categories = Category::where('sex', $this->sex)->get();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update some attributes when class_label field is updated
     */
    public function updatedCategoryId($value)
    {
        $this->validateOnly(
            'category_id',
            [
                'category_id' => 'exists:categories,id'
            ],
            attributes: [
                'category_id' => 'class label'
            ]
        );
        $this->min_weight = Category::find($value)->min_weight;
        $this->max_weight = Category::find($value)->max_weight;
    }

    /**
     * Adds the record to the database
     */
    public function store()
    {
        try {
            $this->authorize('manage events');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return $this->redirectRoute('categories', navigate: true);
        }

        $validated = $this->validate();

        Game::create($validated);

        session()->flash('success', 'The game has been added successfully.');
        return $this->redirectRoute('events.show', ['event' => $this->event_id], navigate: true);
    }
}
