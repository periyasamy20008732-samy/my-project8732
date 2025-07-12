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
        Schema::create('stock_transfer_item', function (Blueprint $table) {
            $table->id();
            $table->string('stocktransfer_id')->nullable();
            $table->string('store_id')->nullable();
            $table->string('to_store_id')->nullable();
            $table->string('warehouse_from')->nullable();
            $table->string('warehouse_to')->nullable();
            $table->string('item_id')->nullable();
            $table->string('transfer_qty')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transfer_item');
    }
};