<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ubicacion;

class UbicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ubicacion::insert([
            [
                'estado' => 'Puebla',
                'ciudad' => 'Puebla',
                'municipio' => 'San Felipe',
                'nombre_ubicacion' => 'CAPU Puebla',
            ],
            [
                'estado' => 'Puebla',
                'ciudad' => 'Puebla',
                'municipio' => 'San Martín Texmelucan',
                'nombre_ubicacion' => 'San Martín Texmelucan',
            ],
            [
                'estado' => 'Ciudad de México',
                'ciudad' => 'Ciudad de México',
                'municipio' => 'Iztapalapa',
                'nombre_ubicacion' => 'Itztapalapa',
            ],
        ]);
    }
}
