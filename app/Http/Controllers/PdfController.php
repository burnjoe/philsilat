<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Event;
use App\Models\GameMatch;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{

    public function list()
    {
        $events = Event::get();
        return view('events', ['users' => $events]);
    }

    public function export_event_results_pdf(Event $event, Game $game)
    {
        $pdf = Pdf::loadView('pdf.event-results-pdf', ['event' => $event, 'game' => $game]);
        return $pdf->stream('Event-Results.pdf');
    }

    public function export_game_results_pdf(Event $event, Game $game)
    {
        $pdf = Pdf::loadView('pdf.game-results-pdf', [
            'event' => $event,
            'game' => $game,
            'matches' => GameMatch::where('game_id', $game->id)->get(),
            'rounds' => GameMatch::select('round')->groupBy('round')->get()
        ]);
        return $pdf->stream('Game-Results.pdf');
    }
}
