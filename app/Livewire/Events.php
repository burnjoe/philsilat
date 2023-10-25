<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Auth\Access\AuthorizationException;

class Events extends Component
{
    use WithPagination;

    public $statusColor = [
        'UPCOMING' => '#1b1a70',
        'REGISTRATION OPEN' => '#1da121',
        'CANCELLED' => '#b34d47',
        'ONGOING' => '#9c9917',
        'COMPLETED' => '#1da121',
    ];

    public $search = "";


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.events', [
            'events' => Event::orderBy('starts_at', 'desc')
                ->search($this->search)
                ->paginate(16)
        ]);
    }
}