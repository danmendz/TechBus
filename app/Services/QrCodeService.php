<?php
namespace App\Services;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeService
{
    protected $secretKey;

    public function __construct()
    {
        $this->secretKey = "mi_clave_secreta_super_segura";
    }

    public function generateQrCode(array $data)
    {
        // Crear una cadena con los datos clave
        $dataString = "{$data['codigoReferencia']}|{$data['fecha']}|{$data['hora']}|{$data['origen']}|{$data['destino']}";

        // Generar el hash HMAC con SHA-256
        $codigo_unico = hash_hmac('sha256', $dataString, $this->secretKey);

        // Crear el contenido del QR
        $qrContent = "{$data['codigoReferencia']}, {$data['fecha']} - {$data['hora']}, {$data['origen']} - {$data['destino']}, {$codigo_unico}";

        // Crear el código QR
        $qrCode = new QrCode(
            data: $qrContent,
            size: 100,
            margin: 10,
        );

        // Convertir el código QR a una imagen base64
        $writer = new PngWriter();
        $qrCodeImage = $writer->write($qrCode);

        return 'data:image/png;base64,' . base64_encode($qrCodeImage->getString());
    }
}