<?php

namespace App\Livewire;

use App\Models\Coach;
use App\Models\Event;
use App\Models\Team;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'events' => Event::with('teams')->get(),
            'coachesCount' => Coach::all()->count(),
        ]);
    }
}
