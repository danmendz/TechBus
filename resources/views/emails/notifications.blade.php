<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #0059D1; /* Cambié el color de fondo a #0059D1 */
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-bottom: 4px solid #0047A0; /* Agregué una línea sutil */
        }
        .email-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .email-body {
            padding: 20px;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .email-body strong {
            color: #0059D1; /* Usé el color #0059D1 para los textos importantes */
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #ddd; /* Añadí una línea sutil en el pie de página */
        }
        .email-footer p {
            margin: 0;
        }
        .email-footer a {
            color: #0059D1; /* Cambié el color del enlace a #0059D1 */
            text-decoration: none;
        }
        .email-footer a:hover {
            text-decoration: underline;
        }
        .btn {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 25px;
            background-color: #0059D1; /* Usé el color para el botón */
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
        }
        .btn:hover {
            background-color: #0047A0; /* Un tono ligeramente más oscuro para el hover */
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Encabezado del correo -->
        <div class="email-header">
            <h2>{{ $title ?? 'Notificación' }}</h2>
        </div>

        <!-- Cuerpo del correo -->
        <div class="email-body">
            <p>Hola, <strong>{{ $name }}</strong>,</p>
            <p>{{ $messageBody }}</p>
            <p>Adjunto encontrarás tu boleto en formato PDF. Si tienes alguna pregunta, no dudes en contactarnos.</p>

            <p style="font-size: 14px; color: #777;">
                Si no solicitaste esta notificación, puedes ignorar este mensaje.
            </p>
        </div>

        <!-- Pie de página del correo -->
        <div class="email-footer">
            <p>Saludos,</p>
            <p><strong>{{ $companyName ?? 'Tu Empresa' }}</strong></p>
            <p>
                <a href="https://www.tuempresa.com">www.tuempresa.com</a> |
                <a href="mailto:soporte@tuempresa.com">soporte@tuempresa.com</a>
            </p>
        </div>
    </div>
</body>
</html>