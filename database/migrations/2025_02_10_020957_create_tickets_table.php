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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_corrida');
            $table->unsignedBigInteger('id_asiento');
            $table->unsignedBigInteger('id_precio');
            $table->unsignedBigInteger('id_usuario');
            
            $table->foreign('id_corrida')->references('id')->on('corridas');
            $table->foreign('id_asiento')->references('id')->on('asientos');
            $table->foreign('id_precio')->references('id')->on('precios');
            $table->foreign('id_usuario')->references('id')->on('users');
            
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
