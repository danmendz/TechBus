<?php

namespace Database\Seeders;

use App\Models\CategoriaAutobus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoriaAutobus::insert([
            [
                'nombre' => 'Económico', 
                'descripcion' => 'Esta clase tiene autobuses económicos y sin servicios'
            ],
            [
                'nombre' => 'Primera clase', 
                'descripcion' => 'Esta clase cuenta com muchos servicios'
            ],
            [
                'nombre' => 'Ejecutivo', 
                'descripcion' => 'Esta clase cuenta con todos los servicios disponibles'
            ],
        ]);
        /**
        *INSERT INTO categorias_autobuses (nombre, descripcion) VALUES ('Primera Clase', 'Esta categoría contiene asientos más cómodos y servicios adicionales.');
        *INSERT INTO categorias_autobuses (nombre, descripcion) VALUES ('Económico', 'Esta categoría contiene asientos básicos a un precio más accesible.');
        *INSERT INTO categorias_autobuses (nombre, descripcion) VALUES ('Ejecutivo', 'Esta categoría contiene asientos espaciosos y acceso a un salón VIP.');
        *INSERT INTO categorias_autobuses (nombre, descripcion) VALUES ('Turista', 'Esta categoría contiene asientos estándar con servicios limitados.');
        *INSERT INTO categorias_autobuses (nombre, descripcion) VALUES ('Lujo', 'Esta categoría contiene asientos de lujo con servicios premium.');
         */
    }
}
