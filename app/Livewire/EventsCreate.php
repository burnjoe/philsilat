<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class EventsCreate extends Component
{
    public $host_name;
    public $name;
    public $description;
    public $starts_at;
    public $ends_at;
    public $registration_starts_at;
    public $venue;
    public $address;
    public $barangay;
    public $city;
    public $province;


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events.create');
    }

    /**
     * Validation rules
     */
    public function rules()
    {
        return [
            'host_name' => ['required', 'string', 'min:2', 'max:50'],
            'name' => ['required', 'string', 'min:2', 'max:20'],
            'description' => ['max:255'],
            'registration_starts_at' => ['required', 'date', 'after_or_equal:now'],
            'starts_at' => ['required', 'date', 'after:registration_starts_at'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'venue' => ['required', 'string', 'min:2', 'max:30'],
            'address' => ['required', 'string', 'min:2', 'max:255'],
            'barangay' => ['required', 'string', 'min:2', 'max:20'],
            'city' => ['required', 'string', 'min:2', 'max:20'],
            'province' => ['required', 'string', 'min:2', 'max:20'],
        ];
    }

    /**
     * Validation messages
     */
    public function messages()
    {
        return [
            'registration_starts_at.after_or_equal' => 'The registration must start at valid date and time.',
            'starts_at.after' => 'The event must start after registration date and time.',
            'ends_at.after' => 'The event must end at valid date and time.',
        ];
    }

    /**
     * Validation attributes
     */
    public function validationAttributes()
    {
        return [
            'registration_starts_at' => 'registration date',
            'starts_at' => 'event starting schedule',
            'ends_at' => 'event ending schedule',
        ];
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
            return $this->redirectRoute('events', navigate: true);
        }

        $validated = $this->validate();

        Event::create($validated);

        session()->flash('success', 'The event has been added successfully.');
        return $this->redirectRoute('events', navigate: true);
    }
}
