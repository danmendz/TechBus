<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioBoleto extends Model
{
    use HasFactory;
    protected $table = 'precios_boletos';
    protected $fillable = ['id_tipo_boleto', 'precio'];
    public function precios()
    {
        return $this->hasMany(PrecioBoleto::class, 'id_tipo_boleto');
    }
}
