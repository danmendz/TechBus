<?php
namespace App\Services;

use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendTicketEmail(string $userName, string $userEmail, string $pdfPath)
    {
        $messageBody = "Gracias por viajar con nosotros.";

        Mail::to($userEmail)
            ->send(new NotificationEmail($userName, $messageBody, $pdfPath));

        // Eliminar el archivo temporal después de enviar el correo
        unlink($pdfPath);
    }
}