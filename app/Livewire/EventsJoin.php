<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Game;
use Livewire\Component;
use Livewire\WithPagination;

class EventsJoin extends Component
{
    use WithPagination;

    public $event;

    // Team
    public $name;

    // Athlete
    public $last_name = [];
    public $first_name = [];
    public $birthdate;
    public $sex;
    public $weight;
    public $school_name;
    public $grade_level;
    public $lrn;

    // Teams
    public $teams = [];

    public $search = "";


    /**
     * Initializes attributes upon load
     */
    public function mount(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events.join', [
            'games' =>
            Game::with('category')
                ->where('event_id', $this->event->id)
                ->orderByRaw("(SELECT CONCAT(sex, class_label) FROM categories WHERE categories.id = games.category_id) ASC")
                ->get()

        ]);
    }

    /**
     * Validation rules
     */
    public function rules()
    {
        return [
            'teams.*.name' => 'required|string|min:2|max:50',
            'teams.*.last_name' => 'required|string|min:2|max:50',
            'teams.*.first_name' => 'required|string|min:2|max:50',
            'teams.*.birthdate' => 'required|date|after_or_equal:1950-01-01|before_or_equal:today',
            'teams.*.sex' => 'required|in:Male,Female',
            'teams.*.weight' => 'required|numeric',
            'teams.*.school_name' => 'required|string|min:2|max:100',
            'teams.*.grade_level' => 'required|integer',
            'teams.*.lrn' => 'required|digits:12',
        ];
    }

    /**
     * Validation messages
     */
    public function messages()
    {
        return [];
    }

    /**
     * Validation attributes
     */
    public function validationAttributes()
    {
        return [
            'teams.*.name' => 'team name',
            'teams.*.last_name' => 'last name',
            'teams.*.first_name' => 'first name',
            'teams.*.birthdate' => 'date of birth',
            'teams.*.sex' => 'sex',
            'teams.*.weight' => 'weight',
            'teams.*.school_name' => 'school name',
            'teams.*.grade_level' => 'grade level',
            'teams.*.lrn' => 'lrn',
        ];
    }

    /**
     * Join Event
     */
    public function joinEvent()
    {
        // operation that makes you join an event

        $validated = $this->validate();

        dd($validated);
    }
}
