<?php

namespace Database\Seeders;

use App\Models\Notificacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notificacion::insert([
            [
                'estatus_notificacion' => 'cancelado',
                'motivo' => 'El autobús se ha descompuesto',
                'imagen' => 'https://i.ibb.co/fYydz30N/landpage.png'
            ],
            [
                'estatus_notificacion' => 'retrasado',
                'motivo' => 'Condiciones climáticas adversas',
                'imagen' => 'https://i.ibb.co/fYydz30N/landpage.png'
            ],
            [
                'estatus_notificacion' => 'en curso',
                'motivo' => 'El autobús ha salido de la terminal',
                'imagen' => 'https://i.ibb.co/fYydz30N/landpage.png'
            ],
            [
                'estatus_notificacion' => 'finalizado',
                'motivo' => 'El viaje ha llegado a su destino',
                'imagen' => 'https://i.ibb.co/fYydz30N/landpage.png'
            ],
            [
                'estatus_notificacion' => 'reprogramado',
                'motivo' => 'Cambio en el horario del viaje',
                'imagen' => 'https://i.ibb.co/fYydz30N/landpage.png'
            ],
        ]);        
    }
}
