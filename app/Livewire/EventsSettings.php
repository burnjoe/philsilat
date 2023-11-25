<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Game;
use App\Models\GameMatch;
use Livewire\Component;

class EventsSettings extends Component
{
    public $event;

    public $host_name;
    public $name;
    public $description;
    public $starts_at;
    public $ends_at;
    public $venue;
    public $address;
    public $barangay;
    public $city;
    public $province;


    /**
     * Initializes attributes upon load
     */
    public function mount(Event $event)
    {
        $this->event = $event;

        $this->host_name = $event->host_name;
        $this->name = $event->name;
        $this->description = $event->description;
        $this->starts_at = $event->starts_at;
        $this->ends_at = $event->ends_at;
        $this->venue = $event->venue;
        $this->address = $event->address;
        $this->barangay = $event->barangay;
        $this->city = $event->city;
        $this->province = $event->province;
    }

    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events.settings', [
            // 'status' => $this->event->status,
        ]);
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
            'starts_at' => ['required', 'date', 'after_or_equal:now'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'venue' => ['required', 'string', 'min:2', 'max:20'],
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
            'starts_at.after_or_equal' => 'The :attribute must be a valid schedule.',
            'ends_at.after' => 'The :attribute must be after start schedule.',
        ];
    }

    /**
     * Validation attributes
     */
    public function validationAttributes()
    {
        return [
            'starts_at' => 'starting date and time',
            'ends_at' => 'ending date and time',
        ];
    }

    /**
     * Update the selected event
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

        if ($this->event->teams()->exists()) {
            session()->flash('danger', 'Unable to update the event. It already have teams registered in it and cannot be updated.');
            return;
        }

        if (!in_array($this->event->status, ['UPCOMING', 'REGISTRATION OPEN'])) {
            session()->flash('danger', 'Something unexpected happened. Please refresh the page and try again.');
            return;
        }

        $this->event->update($validated);

        session()->flash('success', 'The event has been updated successfully.');
    }

    /**
     * Open registration of upcoming event
     */
    public function openRegistration()
    {
        try {
            $this->authorize('manage events');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return;
        }

        if ($this->event->status !== "UPCOMING") {
            session()->flash('danger', 'Something unexpected happened. Please refresh the page and try again.');
            return;
        }

        $this->event->update(['status' => "REGISTRATION OPEN"]);

        session()->flash('success', 'Registration for the event has been successfully opened.');
    }

    /**
     * Starting an registration open event
     */
    public function startEvent()
    {
        try {
            $this->authorize('manage events');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return;
        }

        if ($this->event->status !== "REGISTRATION OPEN") {
            session()->flash('danger', 'Something unexpected happened. Please refresh the page and try again.');
            return;
        }

        if ($this->event->games()->count() === 0) {
            session()->flash('danger', 'Unable to start the event. The event requires at least one (1) game to be created to start.');
            return;
        }

        if ($this->event->games()
            ->select('id')
            ->has('athletes', '<', 2)
            ->exists()
        ) {
            session()->flash('danger', 'Unable to start the event. Each game created requires at least two (2) participating athletes to continue.');
            return;
        }

        $this->event->update(['status' => "ONGOING"]);

        session()->flash('success', 'The event has successfully started.');
    }

    /**
     * Ending an ongoing event
     */
    public function endEvent()
    {
        try {
            $this->authorize('manage events');
        } catch (\Throwable $th) {
            session()->flash('danger', 'Unauthorized action.');
            return;
        }

        if ($this->event->status !== "ONGOING") {
            session()->flash('danger', 'Something unexpected happened. Please refresh the page and try again.');
            return;
        }

        if ($this->event->games()->where('is_completed', false)->count() > 0) {
            session()->flash('danger', 'Unable to finish and end the event. The event must finish its ongoing game matches first.');
            return;
        }

        $this->event->update(['status' => "COMPLETED"]);

        session()->flash('success', 'The event has been successfully completed.');
    }
}
