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
        Schema::create('ac_moneytransfer', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('count_id')->nullable();
            $table->string('transfer_code')->nullable();
            $table->string('transfer_date')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('debit_account_id')->nullable();
            $table->string('credit_account_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('note')->nullable();
            $table->string('status')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ac_moneytransfer');
    }
};