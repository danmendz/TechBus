<?php

namespace Database\Seeders;

use App\Models\PrecioBoleto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrecioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrecioBoleto::insert([
            [
                'id_tipo_boleto' => 1,
                'precio' => 78.56
            ],
            [
                'id_tipo_boleto' => 2,
                'precio' => 145.35
            ],
            [
                'id_tipo_boleto' => 3,
                'precio' => 54.78
            ]
        ]);
    }
}
