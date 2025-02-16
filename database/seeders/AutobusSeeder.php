<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Autobus;

class AutobusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Autobus::insert([
            [
                
                'id_usuario' => null,
                'id_flota' => 1,
                'numero_serie' => '1234567890',
                'placa' => 'ABC-123',
                'modelo' => 'Volvo 2023',
                'estatus_autobus' => 'Disponible',
            ],
            [
                
                'id_usuario' => null,
                'id_flota' => 2,
                'numero_serie' => '0987654321',
                'placa' => 'XYZ-789',
                'modelo' => 'Mercedes-Benz 2020',
                'estatus_autobus' => 'En reparación',
            ],
        ]);
    }
}
