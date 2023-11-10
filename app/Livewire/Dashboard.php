<?php

namespace App\Livewire;

use App\Models\Coach;
use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $events = Event::with('teams')->get();

        return view('livewire.dashboard', [
            'events' => $events,
            'todayEvents' => $events->filter(function($event) {
                    return Carbon::parse($event->starts_at)->startOfDay() == Carbon::now()->startOfDay();
                })->sortBy('starts_at'),
            'upcomingEvents' => $events->filter(function ($event) {
                return in_array($event->status, ["UPCOMING", "REGISTRATION OPEN"]);
            })->sortBy('starts_at'),
            'coachesCount' => Coach::all()->count(),
            'teamsCount' => $events->pluck('teams')->flatten()->count(),
        ]);
    }
}
