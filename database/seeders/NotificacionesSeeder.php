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
                'tipo' => 'incidencia',
                'estatus_notificacion' => 'cancelado',
                'descripcion' => 'El autobús se ha descompuesto',
                'imagen' => 'https://i.ibb.co/fYydz30N/landpage.png'
            ],
            [
                'tipo' => 'incidencia',
                'estatus_notificacion' => 'retrasado',
                'descripcion' => 'Condiciones climáticas adversas',
                'imagen' => 'https://i.ibb.co/fYydz30N/landpage.png'
            ],
            [
                'tipo' => 'incidencia',
                'estatus_notificacion' => 'en curso',
                'descripcion' => 'El autobús ha salido de la terminal',
                'imagen' => 'https://i.ibb.co/fYydz30N/landpage.png'
            ],
            [
                'tipo' => 'incidencia',
                'estatus_notificacion' => 'finalizado',
                'descripcion' => 'El viaje ha llegado a su destino',
                'imagen' => 'https://i.ibb.co/fYydz30N/landpage.png'
            ],
            [
                'tipo' => 'incidencia',
                'estatus_notificacion' => 'reprogramado',
                'descripcion' => 'Cambio en el horario del viaje',
                'imagen' => 'https://i.ibb.co/fYydz30N/landpage.png'
            ],
        ]);        
    }
}
