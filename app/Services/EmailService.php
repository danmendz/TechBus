<?php
namespace App\Services;

use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendTicketEmail(string $userEmail, string $pdfPath)
    {
        $messageBody = "Aquí está tu boleto. Gracias por viajar con nosotros.";

        Mail::to($userEmail)
            ->send(new NotificationEmail('Usuario', $messageBody, $pdfPath));

        // Eliminar el archivo temporal después de enviar el correo
        unlink($pdfPath);
    }
}