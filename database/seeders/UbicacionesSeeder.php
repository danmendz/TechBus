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
                
                'nombre' => 'Parque Central',
                'calle' => 'Avenida Principal',
                'numero' => '123',
                'ciudad' => 'Ciudad de México',
                'estado' => 'CDMX',
                'codigo_postal' => '01000'
            ],
            [
                
                'nombre' => 'Biblioteca Nacional',
                'calle' => 'Calle de la Sabiduría',
                'numero' => '456',
                'ciudad' => 'Guadalajara',
                'estado' => 'Jalisco',
                'codigo_postal' => '44100'
            ],
            [
                
                'nombre' => 'Museo de Arte',
                'calle' => null,
                'numero' => null,
                'ciudad' => 'Monterrey',
                'estado' => 'Nuevo León',
                'codigo_postal' => null
            ],
            [
                
                'nombre' => 'Estadio Olímpico',
                'calle' => 'Avenida de los Deportes',
                'numero' => '789',
                'ciudad' => 'Puebla',
                'estado' => 'Puebla',
                'codigo_postal' => '72000'
            ],
            [
                
                'nombre' => 'Centro Comercial',
                'calle' => 'Boulevard Principal',
                'numero' => null,
                'ciudad' => 'Tijuana',
                'estado' => 'Baja California',
                'codigo_postal' => '22000'
            ],
        ]);
    }
}
