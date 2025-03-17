<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'id_corrida',
        'id_usuario',
        'codigo_referencia',
        'detalles_compra',
    ];

    protected $casts = [
        'detalles_compra' => 'array',
    ];

    // Relación con la corrida
    public function corrida()
    {
        return $this->belongsTo(Corrida::class, 'id_corrida');
    }

    // Relación con el usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relación con el pago
    public function pago()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}