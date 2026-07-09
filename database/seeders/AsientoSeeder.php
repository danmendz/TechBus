<?php

namespace Database\Seeders;

use App\Models\Asiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Asiento::insert([
            [
                'id_autobus' => 1,
                'numero_asiento' => 1,
                'estatus_asiento' => 'disponible'
            ],
            [
                'id_autobus' => 1,
                'numero_asiento' => 2,
                'estatus_asiento' => 'disponible'
            ],
            [
                'id_autobus' => 1,
                'numero_asiento' => 3,
                'estatus_asiento' => 'disponible'
            ],
            [
                'id_autobus' => 2,
                'numero_asiento' => 4,
                'estatus_asiento' => 'disponible'
            ],
            [
                'id_autobus' => 2,
                'numero_asiento' => 5,
                'estatus_asiento' => 'disponible'
            ]
        ]);
    }
}
