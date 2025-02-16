<?php

namespace Database\Seeders;

use App\Models\Corrida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CorridaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Corrida::insert([
            [
                'id_ruta' => 1,
                'id_autobus' => 2,
                'id_horario' => 1,
                'fecha' => '2025-02-20',
                'is_ida_vuelta' => false
            ],
            [
                'id_ruta' => 2,
                'id_autobus' => 1,
                'id_horario' => 2,
                'fecha' => '2025-02-21',
                'is_ida_vuelta' => false
            ],
            [
                'id_ruta' => 3,
                'id_autobus' => 1,
                'id_horario' => 2,
                'fecha' => '2025-02-22',
                'is_ida_vuelta' => false
            ],
            [
                'id_ruta' => 1,
                'id_autobus' => 2,
                'id_horario' => 3,
                'fecha' => '2025-02-23',
                'is_ida_vuelta' => true
            ]
        ]);
    }
}
