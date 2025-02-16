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
        Schema::create('ticket_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ticket');
            $table->unsignedBigInteger('id_payment');
            
            $table->foreign('id_ticket')->references('id')->on('tickets');
            $table->foreign('id_payment')->references('id')->on('payments');
            
            $table->dateTime('date_transaction');
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_transactions');
    }
};
