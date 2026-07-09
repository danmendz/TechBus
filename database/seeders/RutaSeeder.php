<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ruta;

class RutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ruta::insert([
            [
                
                'id_origen' => 1,
                'id_destino' => 2,
                'distancia' => 23.5,
                'duracion_aproximada' => 35,
            ],
            [
                
                'id_origen' => 1,
                'id_destino' => 2,
                'distancia' => 23.5,
                'duracion_aproximada' => 35,
            ],
            [
                
                'id_origen' => 1,
                'id_destino' => 3,
                'distancia' => 50.5,
                'duracion_aproximada' => 75,
            ],
        ]);
    }
}
