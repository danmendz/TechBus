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
        Schema::create('purchase_history', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_corrida');
            $table->unsignedBigInteger('id_payment');
            $table->unsignedBigInteger('id_ticket');
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_corrida')->references('id')->on('corridas');
            $table->foreign('id_payment')->references('id')->on('payments');
            $table->foreign('id_ticket')->references('id')->on('tickets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_history');
    }
};
