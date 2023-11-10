<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Event;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEventStatusRegistrationOpen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Assuming you have a route parameter for event ID
        $eventId = $request->route('event');
        $event = Event::find($eventId);

        // Proceed to the route
        if ($event && $event->status === 'REGISTRATION OPEN') {
            return $next($request);
        }

        // Redirect to an unauthorized page
        abort('403');
    }
}
