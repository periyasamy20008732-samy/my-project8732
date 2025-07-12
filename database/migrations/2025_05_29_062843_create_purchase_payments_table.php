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
        Schema::create('purchase_payments', function (Blueprint $table) {
            $table->id();
            $table->string('count_id')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('store_id')->nullable();
            $table->string('purchase_id')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment')->nullable();
            $table->string('payment_note')->nullable();
            $table->string('status')->nullable();
            $table->string('account_id')->nullable();
            $table->string('supplier_id')->nullable();
            $table->string('short_code')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_payments');
    }
};