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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->string('unique_order_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable(); // Better for money
            $table->string('gateway')->nullable();
            $table->string('status')->nullable()->comment('0 for pending 1 for complete 2 for fail');
            $table->string('payment_id')->nullable()->comment('Payment ID from gateway');
            $table->string('purpose')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};