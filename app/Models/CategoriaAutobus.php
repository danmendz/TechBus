<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaAutobus extends Model
{
    protected $table = 'categorias_autobuses';
    protected $fillable = ['nombre', 'descripcion'];
}
