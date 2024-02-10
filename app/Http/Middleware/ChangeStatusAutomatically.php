<?php

namespace App\Http\Middleware;

use App\Models\Event;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeStatusAutomatically
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get all registration open and upcoming events
        $events = Event::whereIn('status', ['UPCOMING', 'REGISTRATION OPEN'])
            ->get();

        // Checks if retrieved events are upcoming or registration event; then update status if within the datetime
        foreach ($events as $event) {
            if ($event->status === 'UPCOMING') {
                if (
                    now()->greaterThanOrEqualTo(Carbon::parse($event->registration_starts_at)) &&
                    now()->lessThan(Carbon::parse($event->starts_at))
                ) {
                    // Event must have at least 1 game to automatically open registration
                    if ($event->games()->count() > 0) {
                        $event->update([
                            'status' => 'REGISTRATION OPEN',
                        ]);
                    }
                }
            } else {
                if (
                    now()->greaterThanOrEqualTo(Carbon::parse($event->starts_at)) &&
                    now()->lessThanOrEqualTo(Carbon::parse($event->ends_at))
                ) {
                    // Event must have at least 3 participating athletes to automatically start
                    if (!$event->games()
                        ->select('id')
                        ->has('athletes', '<', 3)
                        ->exists()) {
                        $event->update([
                            'status' => 'ONGOING',
                        ]);
                    }
                }
            }
        }

        return $next($request);
    }
}
