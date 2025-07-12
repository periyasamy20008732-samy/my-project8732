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
        Schema::create('online_payment', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('order_id');
            $table->string('payment_id');
            $table->string('gateway');
            $table->string('price');
            $table->string('tax');
            $table->string('tax_amount');
            $table->string('price_tax');
            $table->string('payment_status');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_payment');
    }
};
