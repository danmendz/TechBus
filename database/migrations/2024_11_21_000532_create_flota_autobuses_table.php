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
            $table->string('marca', 50);
            $table->string('dueño', 100);
            $table->integer('numero_asientos'); 
            $table->string('clase', 15);
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
