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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('count_id')->nullable();
            $table->string('expense_code')->nullable();
            $table->string('category_id')->nullable();
            $table->string('expense_date')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('expense_for')->nullable();
            $table->string('expense_amt')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('account_id')->nullable();
            $table->string('note')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
