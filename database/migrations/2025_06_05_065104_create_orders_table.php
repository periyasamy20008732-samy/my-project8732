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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('unique_order_id')->nullable();
            $table->string('orderstatus_id')->nullable();
            $table->string('store_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('if_sales')->nullable();
            $table->string('sales_id')->nullable();
            $table->string('customer_latitude')->nullable();
            $table->string('customer_longitude')->nullable();
            $table->string('shipping_address_id')->nullable();
            $table->string('order_address')->nullable();
            $table->string('reward_point')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('taxrate')->nullable();
            $table->string('tax_amt')->nullable();
            $table->string('delivery_charge')->nullable();
            $table->string('discount')->nullable();
            $table->string('coupon_id')->nullable();
            $table->string('coupon_amount')->nullable();
            $table->string('handling_charge')->nullable();
            $table->string('order_totalamt')->nullable();
            $table->string('if_redeem')->nullable();
            $table->string('redeem_point')->nullable();
            $table->string('redeem_cash')->nullable();
            $table->string('after_redeem_bill_amt')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('map_distance')->nullable();
            $table->string('delivery_pin')->nullable();
            $table->string('deliveryboy_id')->nullable();
            $table->string('notifi_admin')->nullable();
            $table->string('notifi_store')->nullable();
            $table->string('notifi_deliveryboy')->nullable();
            $table->string('delivery_timeslote_id')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};