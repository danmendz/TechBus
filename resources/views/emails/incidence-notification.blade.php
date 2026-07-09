<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .header { color: #2d3748; }
        .details { background: #f7fafc; padding: 1rem; }
    </style>
</head>
<body>
    <h1 class="header">Hola {{ $user->name }},</h1>
    
    <p>Información sobre tu viaje:</p>
    
    <div class="details">
        <h2>Detalles del viaje</h2>
        <ul>
            <li><strong>Ruta:</strong> {{ $corrida->ruta->origen->nombre }} a {{ $corrida->ruta->destino->nombre }}</li>
            <li><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($corrida->fecha)->format('d/m/Y') }}</li>
            <li><strong>Hora:</strong> {{ $corrida->horario->hora }}</li>
        </ul>
        
        @if(!empty($notification['estatus_notificacion']))
            <h3>Estado actual: {{ $notification['estatus_notificacion'] }}</h3>
            <p>{{ $notification['descripcion'] }}</p>
        @endif
    </div>
    
    <p>Gracias por viajar con nosotros.</p>
</body>
</html>