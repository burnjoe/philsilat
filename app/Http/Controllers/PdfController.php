<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function export_event_results_pdf()
    {
        $pdf = Pdf::loadView('pdf.event-results-pdf');
        return $pdf->stream('Event-Results.pdf');
    }

    public function export_match_results_pdf() 
    {
        $pdf = Pdf::loadView('pdf.match-results-pdf');
        return $pdf->stream('Match-Results.pdf');
    }
}
