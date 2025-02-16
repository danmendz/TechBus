<?php

namespace Database\Seeders;

use App\Models\TipoBoleto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposBoletosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoBoleto::insert([
            [
                'tipo' => 'Estudiante', 
                'descripcion' => 'Boletos único para estudiantes'
            ],
            [
                'tipo' => 'Adulto', 
                'descripcion' => 'Boletos único para adultos mayores a 18 años'
            ],
            [
                'tipo' => 'Niño', 
                'descripcion' => 'Boletos único para niños menores a 18 años'
            ]
        ]);
    }
}
