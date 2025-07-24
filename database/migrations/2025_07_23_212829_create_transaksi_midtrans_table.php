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
        Schema::create('transaksi_midtrans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_id');
            $table->string('transaction_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('gross_amount');
            $table->string('payment_type')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('snap_token')->nullable();
            $table->json('tagihan_ids'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_midtrans');
    }
};
