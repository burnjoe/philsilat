<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Auth\Access\AuthorizationException;

class Events extends Component
{
    use WithPagination;

    public $search = "";
    public $selectedStatus = [];


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events', [
            'events' => Event::orderBy('starts_at', 'desc')
                ->when($this->search, function ($query) {
                    return $query->search($this->search);
                })
                ->when($this->selectedStatus, function ($query) {
                    return $query->status($this->selectedStatus);
                })
                ->paginate(16)
        ]);
    }
}
