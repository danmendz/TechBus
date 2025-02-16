<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    use HasFactory;
    protected $table = 'precios';
    protected $fillable = ['id_tipo_boleto', 'precio'];
    public function precios()
    {
        return $this->hasMany(Precio::class, 'id_tipo_boleto');
    }
}
