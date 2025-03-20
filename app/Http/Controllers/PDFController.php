<?php
namespace App\Http\Controllers;

use App\Mail\NotificationEmail;
use App\Models\Autobus;
use App\Models\Corrida;
use App\Models\Ticket;
use App\Services\PdfService;
use App\Services\QrCodeService;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

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

    public function generatePdf(Ticket $ticket)
    {
        // Obtener los datos del ticket
        $data = $this->getTicketData($ticket);

        // Generar el código QR
        $data['qrCode'] = $this->qrCodeService->generateQrCode($data);

        // Generar el PDF
        $pdfFile = $this->pdfService->generatePdf('utilities.ticket-pdf', $data);

        // Enviar el PDF por correo electrónico
        $this->emailService->sendTicketEmail($this->getUserName(), $this->getUserEmail(), $pdfFile);

        return response()->json(['message' => 'PDF generado y enviado por correo electrónico.']);
    }

    protected function getUserName() {
        $userName = Auth::user()->name;
        return $userName;
    }

    protected function getUserEmail() {
        $userEmail = Auth::user()->email;
        return $userEmail;
    }

    protected function getBus($corrida)
    {
        if ($corrida && $corrida->id_autobus) {
            return Autobus::find($corrida->id_autobus);
        }

        return null;
    }

    protected function findCorrida($idCorrida)
    {
        return Corrida::find($idCorrida);
    }

    protected function getTicketData(Ticket $ticket)
    {
        // Buscar la corrida asociada al ticket
        $corrida = $this->findCorrida($ticket->id_corrida);

        // Obtener el autobús asociado a la corrida
        $autobus = $this->getBus($corrida);
        
        // Decodificar el JSON de detalles_compra
        $detallesCompra = json_decode($ticket->detalles_compra, true);

        // Obtener los tipos de boleto y sus precios
        $tiposBoleto = [];
        $precioTotal = 0;

        foreach ($detallesCompra['resumen_boletos'] as $boleto) {
            $tipoBoleto = $boleto['tipo_boleto'];
            $precioUnitario = $detallesCompra['precios'][$tipoBoleto]['precio_unitario'];
            $precioTotal += $detallesCompra['precios'][$tipoBoleto]['precio_total'];

            if (!isset($tiposBoleto[$tipoBoleto])) {
                $tiposBoleto[$tipoBoleto] = [
                    'cantidad' => 0,
                    'precio_unitario' => $precioUnitario,
                    'precio_total' => 0,
                ];
            }

            $tiposBoleto[$tipoBoleto]['cantidad']++;
            $tiposBoleto[$tipoBoleto]['precio_total'] += $precioUnitario;
        }

        // Mapear los datos del JSON a las variables del HTML
        return [
            'id_boleto' => $ticket->id,
            'codigoReferencia' => $ticket->codigo_referencia,
            'fecha' => $detallesCompra['detalles_corrida']['fecha'],
            'hora' => $detallesCompra['detalles_corrida']['hora'],
            'autobus' => $autobus->modelo. '-' . $autobus->numero_serie, // Puedes obtener este dato de otra tabla si es necesario
            'origen' => $detallesCompra['detalles_corrida']['origen'],
            'destino' => $detallesCompra['detalles_corrida']['destino'],
            'tiposBoleto' => $tiposBoleto, // Array con tipos de boleto, cantidad y precios
            'resumenBoletos' => $detallesCompra['resumen_boletos'], // Array con detalles de cada boleto
            'precioTotal' => $precioTotal,
            'nombrePasajero' => $this->getUserName(), // Puedes obtener este dato de otra tabla si es necesario
            'numeroTicket' => $ticket->id,
            'asientos' => implode(', ', array_column($detallesCompra['resumen_boletos'], 'asiento')),
            'metodoPago' => 'Tarjeta de Crédito', // Puedes obtener este dato de otra tabla si es necesario
            'numeroTransaccion' => '123456789', // Puedes obtener este dato de otra tabla si es necesario
        ];
    }

    //http://127.0.0.1:8000/generate-ticket?fecha=2025-03-17&hora=14:00&autobus=Autob%C3%BAs%201&origen=Ciudad%20A&destino=Ciudad%20B&tipoBoleto=Normal&cantidad=2&precio=50&precioTotal=100&nombrePasajero=Juan%20Perez&numeroTicket=987654&asiento=12A&metodoPago=Tarjeta&numeroTransaccion=TXN123456
}