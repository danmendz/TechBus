<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autobus extends Model
{
    use HasFactory;

    protected $table = 'autobuses';

    protected $fillable = [
        'id_usuario',
        'id_flota',
        'numero_serie',
        'placa',
        'modelo',
        'estatus_autobus',
    ];

    public static $estatusPermitidos = ['Disponible', 'En reparacion', 'Fuera de servicio'];

    public function setEstatusAutobusAttribute($value)
    {
        if (!in_array($value, self::$estatusPermitidos)) {
            throw new \InvalidArgumentException("Estatus inválido: $value.");
        }
        $this->attributes['estatus_autobus'] = $value;
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function flota()
    {
        return $this->belongsTo(FlotaAutobus::class, 'id_flota');
    }
}