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
        Schema::create('itemserial_number', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->string('serialno')->nullable();
            $table->integer('purchase_id')->nullable();
            $table->integer('purchase_return_id')->nullable();
            $table->integer('sales_id')->nullable();
            $table->integer('sales_return_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itemserial_number');
    }
};
