<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FlotaAutobus;

class FlotaAutobusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FlotaAutobus::insert([
            [
                'marca' => 'Volvo',
                'dueño' => 'AU',
                'numero_asientos' => 30,
                'clase' => 'Primera clase',
            ],
            [
                'marca' => 'Mercedes-Benz',
                'dueño' => 'OCC',
                'numero_asientos' => 45,
                'clase' => 'Económico',
            ],
        ]);
    }
}
