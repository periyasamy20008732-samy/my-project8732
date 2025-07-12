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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('warehouse_id')->nullable();
            $table->string('init_code')->nullable();
            $table->string('count_id')->nullable();
            $table->string('sales_code')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('sales_date')->nullable();
            $table->string('due_date')->nullable();
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
            $table->string('payment_status')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('company_id')->nullable();
            $table->string('pos')->nullable();
            $table->string('return_bit')->nullable();
            $table->string('customer_previous_due')->nullable();
            $table->string('customer_total_due')->nullable();
            $table->string('quotation_id')->nullable();
            $table->string('coupon_id')->nullable();
            $table->string('coupon_amt')->nullable();
            $table->string('invoice_terms')->nullable();
            $table->string('status');
            $table->string('app_order');
            $table->string('order_id');
            $table->string('tax_report');
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};