<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\Event;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Validation\Rule;
use App\Models\Athlete;

class GamesSettings extends Component
{
    public $event;
    public $game;
    public $categories;

    public $name;
    public $sex;
    public $min_weight;
    public $max_weight;
    public $category_id;
    public $event_id;


    /**
     * Initializes attributes at load
     */
    public function mount(Event $event, Game $game)
    {
        $this->event = $event;
        $this->game = $game;

        $this->name = $game->name;
        $this->sex = $game->category->sex;
        $this->min_weight = $game->category->min_weight;
        $this->max_weight = $game->category->max_weight;
        $this->category_id = $game->category->id;
        $this->event_id = $event->id;

        $this->categories = Category::where('sex', $this->sex)->get();
    }

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.games.settings', [
            'roundsCount' => ceil(log(Athlete::where('game_id', $this->game->id)->count(), 2)),
        ]);
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
                })->ignore($this->game->id),
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
     * Update the selected game
     */
    public function update()
    {
        try {
            $this->authorize('manage events');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return;
        }

        $validated = $this->validate();

        if ($this->game->athletes()->exists()) {
            session()->flash('danger', 'Unable to update the game. It already have teams registered in it and cannot be updated.');
            return;
        }

        $this->game->update($validated);

        session()->flash('success', 'The game has been updated successfully.');
    }
}
