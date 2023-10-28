<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Event;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEventStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $eventId = $request->route('event');        // Assuming you have a route parameter for event ID
        $event = Event::find($eventId);

        if ($event && $event->status === 'UPCOMING') {
            return $next($request);                 // Proceed to the route
        }

        abort('403');                               // Redirect to an unauthorized page
    }
}
