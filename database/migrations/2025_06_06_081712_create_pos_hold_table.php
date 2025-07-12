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
        Schema::create('pos_hold', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('warehouse_id')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('sales_date')->nullable();
            $table->string('sales_status')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('other_charges_input')->nullable();
            $table->string('other_charges_tax_id')->nullable();
            $table->string('other_charges_amt')->nullable();
            $table->string('discount_to_all_input')->nullable();
            $table->string('discount_to_all_type')->nullable();
            $table->string('tot_discount_to_all_amt')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('round_off')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('sales_note')->nullable();
            $table->string('pos')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_hold');
    }
};