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
        Schema::create('orders_items', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('user_id');
            $table->string('store_id');
            $table->string('item_id');
            $table->string('selling_price');
            $table->string('qty');
            $table->string('tax_rate');
            $table->string('tax_type');
            $table->string('tax_amt');
            $table->string('total_price');
            $table->string('if_offer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_items');
    }
};