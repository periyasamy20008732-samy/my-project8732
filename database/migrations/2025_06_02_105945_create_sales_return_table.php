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
        Schema::create('sales_return', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('count_id')->nullable();
            $table->string('sales_id')->nullable();
            $table->string('warehouse_id')->nullable();
            $table->string('return_code')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('return_date')->nullable();
            $table->string('return_status')->nullable();
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
            $table->string('return_note')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('pos')->nullable();
            $table->string('status')->nullable();
            $table->string('return_bit')->nullable();
            $table->string('coupon_id')->nullable();
            $table->string('coupon_amt')->nullable();
            $table->string('app_order')->nullable();
            $table->string('order_id')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_return');
    }
};