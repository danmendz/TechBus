<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model
{
    use HasFactory;

    protected $table = 'purchase_history';

    protected $fillable = [
        'id_usuario',
        'id_corrida',
        'id_payment',
        'id_ticket',
    ];

    // Relación con el usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relación con el pago
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_payment');
    }

    // Relación con el ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_ticket');
    }

    // Relación con la corrida
    public function corrida()
    {
        return $this->belongsTo(Corrida::class, 'id_corrida');
    }
}