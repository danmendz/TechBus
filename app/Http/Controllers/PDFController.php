<?php

namespace App\Http\Controllers;

use App\Mail\NotificationEmail;
use Illuminate\Http\Request;
use App\Services\PdfService;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\ErrorCorrectionLevel;

class PDFController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function generatePdf(Request $request)
    {
        // Datos del ticket
        $data = [
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
        ];

        // Clave secreta (NO compartir públicamente)
        $secretKey = "mi_clave_secreta_super_segura";

        // Crear una cadena con los datos clave
        $dataString = "{$data['id_boleto']}|{$data['fecha']}|{$data['hora']}|{$data['origen']}|{$data['destino']}";

        // Generar el hash HMAC con SHA-256
        $codigo_unico = hash_hmac('sha256', $dataString, $secretKey);

        // Incluir en el QR (manteniendo $data como array)
        $qrContent = "{$data['id_boleto']}, {$data['fecha']} - {$data['hora']}, {$data['origen']} - {$data['destino']}, {$codigo_unico}";

        // Crear el código QR con parámetros nombrados
        $qrCode = new QrCode(
            data: $qrContent,
            size: 100,
            margin: 10,
        );

        // Convertir el código QR a una imagen base64
        $writer = new PngWriter();
        $qrCodeImage = $writer->write($qrCode);
        $data['qrCode'] = 'data:image/png;base64,' . base64_encode($qrCodeImage->getString());

        // Generar el PDF
        $pdf = Pdf::loadView('utilities.ticket-pdf', $data);

        // Obtener el contenido del PDF como una cadena
        $pdfContent = $pdf->output();

        // Guardar el PDF temporalmente
        $pdfPath = storage_path('app/public/ticket.pdf');
        file_put_contents($pdfPath, $pdfContent);

        // Enviar el PDF por correo electrónico
        $userEmail = 'dan@gmail.com'; // Correo del usuario
        $messageBody = "Aquí está tu boleto. Gracias por viajar con nosotros.";

        Mail::to($userEmail)
            ->send(new NotificationEmail('Usuario', $messageBody, $pdfPath));

        // Eliminar el archivo temporal después de enviar el correo
        unlink($pdfPath);

        return response()->json(['message' => 'PDF generado y enviado por correo electrónico.']);
    }
}
// /generate-ticket?fecha=2023-10-01&hora=14:00&autobus=Autobús%201&origen=Ciudad%20A&destino=Ciudad%20B&tipoBoleto=Normal&cantidad=2&precio=50&precioTotal=100
