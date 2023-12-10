<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Event;
use App\Models\Game;

class PdfController extends Controller
{

    public function list() {
        $events=Event::get();
        return view('events', ['users' => $events]);
    }

    public function export_event_results_pdf(Event $event)
    {
        $events=Event::get();
        $pdf = Pdf::loadView('pdf.event-results-pdf', ['event' => $event]);
        return $pdf->stream('Event-Results.pdf');
    }

    public function export_game_results_pdf(Event $event, Game $game) 
    {
        $pdf = Pdf::loadView('pdf.game-results-pdf', ['event' => $event, 'game' => $game]);
        return $pdf->stream('Game-Results.pdf');
    }
}
