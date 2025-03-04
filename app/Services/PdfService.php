<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfService
{
    public function generateTicket($data)
    {
        $pdf = Pdf::loadView('utilities.ticket-pdf', $data);
        return $pdf->stream('ticket.pdf');
    }
}