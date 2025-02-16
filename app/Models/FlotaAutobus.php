<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlotaAutobus extends Model
{
    use HasFactory;

    protected $table = 'flota_autobuses';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'marca',
        'dueño',
        'numero_asientos',
        'id_categoría',
    ];
    
}
