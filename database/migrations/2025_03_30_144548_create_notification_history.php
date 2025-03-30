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
        Schema::create('notification_history', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_notificacion');
            $table->unsignedBigInteger('id_corrida');
            
            $table->foreign('id_notificacion')->references('id')->on('notificaciones');
            $table->foreign('id_corrida')->references('id')->on('corridas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_history');
    }
};
