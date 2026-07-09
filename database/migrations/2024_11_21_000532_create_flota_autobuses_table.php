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
        Schema::create('flota_autobuses', function (Blueprint $table) {
            $table->id();
            $table->string('marca', 255);
            $table->string('dueño', 255)->nullable();
            $table->bigInteger('numero_asientos');
            $table->foreignId('id_categoria')->references('id')->on('categorias_autobuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flota_autobuses');
    }
};
