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
        Schema::create('rutas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_origen');
            $table->unsignedBigInteger('id_destino');
            $table->decimal('distancia', 5, 2)->nullable();
            $table->bigInteger('duracion_estimada')->nullable();
            $table->timestamps();

            $table->foreign('id_origen')->references('id')->on('ubicaciones');
            $table->foreign('id_destino')->references('id')->on('ubicaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutas');
    }
};
