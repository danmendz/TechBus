<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfService
{
    public function generatePdf(string $view, array $data)
    {
        // Generar el PDF
        $pdf = Pdf::loadView($view, $data);
        $pdfContent = $pdf->output();

        // Guardar el PDF temporalmente
        $pdfPath = storage_path('app/public/ticket.pdf');
        file_put_contents($pdfPath, $pdfContent);

        return $pdfPath;
    }
}