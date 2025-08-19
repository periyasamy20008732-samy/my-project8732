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
        Schema::create('sales_settings', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('account')->nullable();
            $table->string('discount')->nullable();
            $table->string('show_mrp')->nullable();
            $table->string('show_paidamount')->nullable();
            $table->string('show_return')->nullable();
            $table->string('footer_text')->nullable();
            $table->string('sale_invoice')->nullable();
            $table->string('pos_invoice')->nullable();
            $table->string('number_to_word')->nullable();
            $table->string('show_previous_balance')->nullable();
            $table->string('show_invoice')->nullable();
            $table->string('show_pos_invoice')->nullable();
            $table->string('term_conditions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_settings');
    }
};
