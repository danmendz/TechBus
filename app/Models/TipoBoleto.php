<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoBoleto extends Model
{
    use HasFactory;
    protected $table = 'tipo_boletos';
    protected $fillable = ['tipo', 'descripcion'];
}
