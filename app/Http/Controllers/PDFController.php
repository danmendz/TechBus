<?php
namespace App\Http\Controllers;

use App\Mail\NotificationEmail;
use App\Services\PdfService;
use App\Services\QrCodeService;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    protected $pdfService;
    protected $qrCodeService;
    protected $emailService;

    public function __construct(
        PdfService $pdfService,
        QrCodeService $qrCodeService,
        EmailService $emailService
    ) {
        $this->pdfService = $pdfService;
        $this->qrCodeService = $qrCodeService;
        $this->emailService = $emailService;
    }

    public function generatePdf(Request $request)
    {
        // Obtener y validar los datos del ticket
        $data = $this->getTicketData($request);

        // Generar el código QR
        $data['qrCode'] = $this->qrCodeService->generateQrCode($data);

        // Generar el PDF
        $pdfFile = $this->pdfService->generatePdf('utilities.ticket-pdf', $data);

        // Enviar el PDF por correo electrónico
        $this->emailService->sendTicketEmail('dan@gmail.com', $pdfFile);

        return response()->json(['message' => 'PDF generado y enviado por correo electrónico.']);
    }

    protected function getTicketData(Request $request)
    {
        return [
            'id_boleto' => '12345678',
            'fecha' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'autobus' => $request->input('autobus'),
            'origen' => $request->input('origen'),
            'destino' => $request->input('destino'),
            'tipoBoleto' => $request->input('tipoBoleto'),
            'cantidad' => $request->input('cantidad'),
            'precio' => $request->input('precio'),
            'precioTotal' => $request->input('precioTotal'),
            'nombrePasajero' => 'Daniel',
            'numeroTicket' => $request->input('numeroTicket'),
            'asiento' => $request->input('asiento'),
            'metodoPago' => $request->input('metodoPago'),
            'numeroTransaccion' => $request->input('numeroTransaccion'),
        ];
    }
    //http://127.0.0.1:8000/generate-ticket?fecha=2025-03-17&hora=14:00&autobus=Autob%C3%BAs%201&origen=Ciudad%20A&destino=Ciudad%20B&tipoBoleto=Normal&cantidad=2&precio=50&precioTotal=100&nombrePasajero=Juan%20Perez&numeroTicket=987654&asiento=12A&metodoPago=Tarjeta&numeroTransaccion=TXN123456
}