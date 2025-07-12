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
        Schema::create('purchase_item_returns', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('purchase_id')->nullable();
            $table->string('return_id')->nullable();
            $table->string('return_status')->nullable();
            $table->string('item_id')->nullable();
            $table->string('return_qty')->nullable();
            $table->string('price_per_unit')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('tax_amt')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('discount_input')->nullable();
            $table->string('discount_amt')->nullable();
            $table->string('unit_total_cost')->nullable();
            $table->string('total_cost')->nullable();
            $table->string('profit_margin_per')->nullable();
            $table->string('unit_sales_price')->nullable();
            $table->string('stock')->nullable();
            $table->string('if_bach')->nullable();
            $table->string('bach_no')->nullable();
            $table->string('if_expirydate')->nullable();
            $table->string('expire_date')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_item_returns');
    }
};