<?php

namespace App\Livewire;

use App\Models\Coach;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $events = Event::with('teams')->get();

        if (Auth::user()->hasRole('admin')) {
            return view('livewire.dashboard', [
                'todayEvents' => $events->filter(
                    fn ($event) =>
                    Carbon::parse($event->starts_at)->startOfDay() == Carbon::now()->startOfDay()
                )->sortBy('starts_at'),
                'upcomingEvents' => $events->filter(
                    fn ($event) =>
                    in_array($event->status, ["UPCOMING", "REGISTRATION OPEN"])
                )->sortBy('starts_at'),
                'eventsCount' => $events->count(),
                'coachesCount' => Coach::all()->count(),
                'teamsCount' => $events->pluck('teams')->flatten()->count(),
                'roundWinners' => $events->filter(
                    fn ($event) =>
                    $event->name == null
                ),
            ]);
        }

        return view('livewire.dashboard', [
            'todayEvents' => $events->filter(
                fn ($event) =>
                Carbon::parse($event->starts_at)->startOfDay() == Carbon::now()->startOfDay()
            )->sortBy('starts_at'),
            'upcomingEvents' => $events->filter(
                fn ($event) =>
                in_array($event->status, ["UPCOMING", "REGISTRATION OPEN"])
            )->sortBy('starts_at'),
            'eventsJoinedCount' => $events->count(),
            'myMatches' => $events->filter(
                fn ($event) =>
                $event->name == null
            ),
        ]);
    }
}
