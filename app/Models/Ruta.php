<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    protected $table = 'rutas';

    protected $fillable = [
        'id_origen',
        'id_destino',
        'distancia',
        'duracion_aproximada',
    ];

    protected $with = ['origen', 'destino'];

    public function origen()
    {
        return $this->belongsTo(Ubicacion::class, 'id_origen');
    }

    public function destino()
    {
        return $this->belongsTo(Ubicacion::class, 'id_destino');
    }
}
