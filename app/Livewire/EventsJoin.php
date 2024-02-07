<?php

namespace App\Livewire;

use App\Models\Athlete;
use App\Models\Event;
use App\Models\Game;
use App\Models\Team;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EventsJoin extends Component
{
    use WithPagination, WithFileUploads;

    public $event;
    public $games;

    public $name;
    public $athletes = [];

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
            'games' => $this->games =  Game::with('category')
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
            'name' => 'required|string|min:2|max:50',
            'athletes.*.profile_photo' => 'required|file|mimes:png,jpg|max:2048',
            'athletes.*.last_name' => 'required|string|min:2|max:50',
            'athletes.*.first_name' => 'required|string|min:2|max:50',
            'athletes.*.birthdate' => 'required|date|after_or_equal:1950-01-01|before_or_equal:today',
            'athletes.*.sex' => 'required|in:Male,Female',
            'athletes.*.weight' => 'required|numeric',
            'athletes.*.school_name' => 'required|string|min:2|max:100',
            'athletes.*.grade_level' => 'required|integer',
            'athletes.*.lrn' => 'required|digits:12',
        ];
    }

    /**
     * Validation messages
     */
    public function messages()
    {
        return [
            'athletes.*.profile_photo.mimes' => 'The :attribute must be in PNG or JPG format.',
            'athletes.*.profile_photo.max' => 'The :attribute file size must not exceed 2MB.',
        ];
    }

    /**
     * Validation attributes
     */
    public function validationAttributes()
    {
        return [
            'athletes.*.profile_photo' => 'profile photo',
            'name' => 'team name',
            'athletes.*.last_name' => 'last name',
            'athletes.*.first_name' => 'first name',
            'athletes.*.birthdate' => 'date of birth',
            'athletes.*.sex' => 'sex',
            'athletes.*.weight' => 'weight',
            'athletes.*.school_name' => 'school name',
            'athletes.*.grade_level' => 'grade level',
            'athletes.*.lrn' => 'lrn',
        ];
    }

    public function updatedProfilePhoto()
    {
        $this->validate(
            ['athletes.*.profile_photo' => 'required|file|mimes:png,jpg|max:2048'],
            [
                'athletes.*.profile_photo.mimes' => 'The :attribute must be in PNG or JPG format.',
                'athletes.*.profile_photo.max' => 'The :attribute file size must not exceed 2MB.',
            ],
            ['athletes.*.profile_photo' => 'profile photo']
        );

        // $this->temporaryUrls = $this->athletes[$index]['profile_photo']->temporaryUrl();
    }

    /**
     * Join Event
     */
    public function joinEvent()
    {
        try {
            $this->authorize('participate events');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return $this->redirectRoute('events', navigate: true);
        }

        $validated = $this->validate();

        $team = Team::create([
            'name' => $validated['name'],
            'event_id' => $this->event->id,
        ]);

        $team->coaches()->attach(auth()->user()->profileable->id);
        $index = 0;

        foreach ($validated['athletes'] as $athlete) {
            $profile_photo = $athlete['profile_photo']
                ->store('photos', 'public');

            Athlete::create([
                'profile_photo' => $profile_photo,
                'last_name' => $athlete['last_name'],
                'first_name' => $athlete['first_name'],
                'birthdate' => $athlete['birthdate'],
                'sex' => $athlete['sex'],
                'weight' => $athlete['weight'],
                'school_name' => $athlete['school_name'],
                'grade_level' => $athlete['grade_level'],
                'lrn' => $athlete['lrn'],
                'game_id' => $this->games[$index++]->id,
                'team_id' => $team->id,
            ]);
        }

        session()->flash('success', 'Successfully joined the event.');
        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }
}
