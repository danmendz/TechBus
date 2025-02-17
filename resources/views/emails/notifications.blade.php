<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación</title>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" style="padding: 20px;">
                <table role="presentation" width="100%" max-width="600px" cellspacing="0" cellpadding="0"
                    border="0"
                    style="background-color: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <h2 style="margin: 0; color: #333;">{{ $title ?? 'Notificación' }}</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 20px;">
                            <p style="font-size: 16px; color: #555;">Hola, <strong>{{ $name }}</strong></p>
                            <p style="font-size: 16px; color: #555;">{{ $messageBody }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 20px 10px;">
                            <p style="font-size: 14px; color: #777;">Si no solicitaste esta notificación, puedes ignorar
                                este mensaje.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 20px; font-size: 14px; color: #888;">
                            <p>Saludos,<br>{{ $companyName ?? 'Tu Empresa' }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>
