<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Boleto</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .ticket {
            width: 320px;
            margin: 20px auto;
            padding: 15px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .header {
            border-bottom: 2px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }
        .details, .passenger-info {
            margin-bottom: 15px;
            text-align: left;
        }
        .details p, .passenger-info p {
            margin: 5px 0;
            font-size: 14px;
        }
        .footer {
            border-top: 2px dashed #000;
            padding-top: 10px;
            margin-top: 15px;
        }
        .footer p {
            margin: 5px 0;
            font-size: 12px;
            color: #777;
        }
        .qr-code {
            margin-top: 15px;
        }
        .qr-code img {
            width: 120px;
            height: auto;
        }
        .cut-line {
            margin-top: 15px;
            font-size: 12px;
            color: #555;
        }
        .cut-line::before, .cut-line::after {
            content: '------------------------';
            display: inline-block;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <!-- Encabezado -->
        <div class="header">
            <h1>ADEO</h1>
            <p>Ticket de Viaje</p>
        </div>

        <!-- Información del pasajero -->
        <div class="passenger-info">
            <p><strong>Pasajero:</strong> {{ $nombrePasajero }}</p>
            <p><strong>Número de Ticket:</strong> #{{ $numeroTicket }}</p>
            <p><strong>Código de Referencia:</strong> {{ $codigoReferencia }}</p>
            <p><strong>Asiento(s):</strong> {{ $asientos }}</p>
        </div>

        <!-- Detalles del boleto -->
        <div class="details">
            <p><strong>Fecha y Hora:</strong> 
                {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }} -
                {{ \Carbon\Carbon::parse($hora)->format('h:i A') }}
            </p>
            <p><strong>Autobús:</strong> {{ $autobus }}</p>
            <p><strong>Trayecto:</strong> {{ $origen }} - {{ $destino }}</p>

            <!-- Detalles de los boletos -->
            @foreach($tiposBoleto as $tipo => $detalles)
                <p>
                    <strong>Boleto:</strong> {{ $tipo }} |
                    <strong>Cantidad:</strong> {{ $detalles['cantidad'] }} |
                    <strong>Precio Unitario:</strong> ${{ number_format($detalles['precio_unitario'], 2) }} |
                    <strong>Subtotal:</strong> ${{ number_format($detalles['precio_total'], 2) }}
                </p>
            @endforeach

            <p><strong>Método de Pago:</strong> {{ $metodoPago }}</p>
            <p><strong>Número de Transacción:</strong> {{ $numeroTransaccion }}</p>
            <p><strong>Total:</strong> <span style="font-size: 16px; font-weight: bold;">${{ number_format($precioTotal, 2) }}</span></p>
        </div>

        <!-- Código QR -->
        <div class="qr-code">
            <img src="{{ $qrCode }}" alt="Código QR">
        </div>

        <!-- Pie de página -->
        <div class="footer">
            <p>*Este boleto no es reembolsable después de la fecha de salida.*</p>
            <p>En caso de dudas, contáctenos:</p>
            <p><strong>Teléfono:</strong> +52 123 456 7890</p>
            <p><strong>Email:</strong> soporte@adeo.com</p>
            <p>¡Gracias por viajar con nosotros!</p>
            <p>www.adeo.com</p>
        </div>

        <!-- Línea de corte -->
        <div class="cut-line">Cortar aquí</div>
    </div>
</body>
</html>