<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationHistory extends Model
{
    use HasFactory;

    protected $table = 'notification_history';

    protected $fillable = [
        'id_notificacion',
        'id_corrida',
    ];

    // Relación con la corrida
    public function notificacion()
    {
        return $this->belongsTo(Notificacion::class, 'id_notificacion');
    }

    // Relación con la corrida
    public function corrida()
    {
        return $this->belongsTo(Corrida::class, 'id_corrida');
    }
}
