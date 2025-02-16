<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asiento extends Model
{
    use HasFactory;
    protected $table = 'asientos';
    protected $fillable = ['id_autobus', 'numero_asiento', 'estatus_asiento'];

    public function autobus() {
        return $this->belongsTo(Autobus::class, 'id_autobus');
    }
}
