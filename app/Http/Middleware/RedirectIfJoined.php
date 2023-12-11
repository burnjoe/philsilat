<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use App\Models\Coach;
use App\Models\Event;
use Illuminate\Console\View\Components\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component as LivewireComponent;
use Livewire\Livewire;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfJoined
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // checks first if the authenticated user is Admin
        if ($user->profileable instanceof Admin) {
            return $next($request);
        }

        /**
         * if authenticated user is Coach
         * check if that coach is already joined to this event
         */
        $eventId = $request->route('event');
        $isCoachJoined = Coach::where('id', $user->profileable->id)
            ->whereHas('teams.event', function ($query) use ($eventId) {
                $query->where('events.id', $eventId);
            })
            ->exists();

        // Proceed to the route if coach is joined to this event
        if ($isCoachJoined) {
            return $next($request);
        }

        // Redirect to event details (view for not yet joined coaches)
        return redirect(route('events.details', ['event' => $eventId]));
    }
}
