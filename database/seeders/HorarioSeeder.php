<?php

namespace Database\Seeders;

use App\Models\Horario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Horario::insert([
            [
                
                'hora' => '14:30:00'
            ],
            [
                
                'hora' => '16:30:00'
            ],
            [
                
                'hora' => '9:00:00'
            ],
            [
                
                'hora' => '11:00:00'
            ]
        ]);
    }
}
