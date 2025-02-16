<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('corridas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ruta');
            $table->unsignedBigInteger('id_autobus');
            $table->unsignedBigInteger('id_horario');

            $table->foreign('id_ruta')->references('id')->on('rutas');
            $table->foreign('id_autobus')->references('id')->on('flota_autobuses');
            $table->foreign('id_horario')->references('id')->on('horarios');

            $table->date('fecha');
            $table->boolean('is_ida_vuelta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corridas');
    }
};
