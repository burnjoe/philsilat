<?php

namespace App\Livewire;

use App\Models\Admin;
use App\Models\Coach;
use App\Models\Event;
use App\Models\GameMatch;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        $events = Event::with('teams')->get();

        if ($user->profileable instanceof Admin) {
            return view('livewire.dashboard', [
                'todayEvents' => $events->filter(
                    fn ($event) =>
                    now()->startOfDay()->greaterThanOrEqualTo(Carbon::parse($event->starts_at)->startOfDay()) &&
                        now()->startOfDay()->lessThanOrEqualTo(Carbon::parse($event->ends_at)->startOfDay())
                )->sortBy('starts_at'),
                'upcomingEvents' => $events->filter(
                    fn ($event) =>
                    in_array($event->status, ["UPCOMING", "REGISTRATION OPEN"]) && !Carbon::parse($event->starts_at)->isSameDay(now())
                )->sortBy('starts_at'),
                'eventsCount' => $events->count(),
                'coachesCount' => Coach::all()->count(),
                'teamsCount' => $events->pluck('teams')->flatten()->count(),
                'roundWinners' => GameMatch::with('athlete1', 'athlete2', 'winner', 'game', 'game.event')
                    ->whereNot('winner_id', null)
                    ->whereHas('game', fn ($query) => $query->where('is_completed', false))
                    ->orderBy('round', 'asc')
                    ->paginate(20),
            ]);
        }

        return view('livewire.dashboard', [
            'todayEvents' => $events->filter(
                fn ($event) =>
                now()->startOfDay()->greaterThanOrEqualTo(Carbon::parse($event->starts_at)->startOfDay()) &&
                    now()->startOfDay()->lessThanOrEqualTo(Carbon::parse($event->ends_at)->startOfDay())
            )->sortBy('starts_at'),
            'upcomingEvents' => $events->filter(
                fn ($event) =>
                in_array($event->status, ["UPCOMING", "REGISTRATION OPEN"]) && !Carbon::parse($event->starts_at)->isSameDay(now())
            )->sortBy('starts_at'),
            'eventsJoinedCount' => Coach::where('id', $user->profileable->id)
                ->withCount(['teams as events_count' => function ($query) {
                    $query->distinct('event_id');
                }])
                ->value('events_count'),
            'myMatches' => GameMatch::with('athlete1', 'athlete2', 'game', 'game.event')
                ->where('is_closed', false)
                ->where(function ($query) use ($user) {
                    $query->whereHas('athlete1.team.coaches', function ($subQuery) use ($user) {
                        $subQuery->where('id', $user->profileable->id);
                    })->orWhereHas('athlete2.team.coaches', function ($subQuery) use ($user) {
                        $subQuery->where('id', $user->profileable->id);
                    });
                })
                ->orderBy('round', 'asc')
                ->paginate(20),
        ]);
    }
}
