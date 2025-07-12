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
        Schema::create('stock_adjustment_item', function (Blueprint $table) {
            $table->id();
            $table->string('store_id');
            $table->string('warehouse_id')->nullable();
            $table->string('adjustment_id')->nullable();
            $table->string('item_id')->nullable();
            $table->string('adjustment_qty')->nullable();
            $table->string('status')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustment_item');
    }
};