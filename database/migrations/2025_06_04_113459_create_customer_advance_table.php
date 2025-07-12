<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_advance', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('count_id')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('note')->nullable();
            $table->string('status')->nullable();


            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_advance');
    }
};