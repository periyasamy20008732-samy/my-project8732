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
        Schema::create('pos_holditems', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('hold_id')->nullable();
            $table->string('item_id')->nullable();
            $table->string('description')->nullable();
            $table->string('sales_qty')->nullable();
            $table->string('price_per_unit')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('tax_amt')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('discount_input')->nullable();
            $table->string('discount_amt')->nullable();
            $table->string('unit_total_cost')->nullable();
            $table->string('total_cost')->nullable();
            $table->string('ifexpire')->nullable();
            $table->string('item_purchasetable_id')->nullable();
            $table->timestamps();
        });
    }
    // pos_holditems
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_holditems');
    }
};