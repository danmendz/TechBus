<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corrida extends Model
{
    use HasFactory;
    protected $table = 'corridas';
    protected $fillable = ['id_ruta', 'id_autobus', 'id_horario', 'fecha', 'is_ida_vuelta', 'estatus_corrida'];
    
    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'id_ruta');
    }
    public function autobus()
    {
        return $this->belongsTo(Autobus::class, 'id_autobus');
    }
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario');
    }
}
