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
        Schema::create('warehouseitems', function (Blueprint $table) {
            $table->id();
            $table->string('store_id');
            $table->string('warehouse_id');
            $table->string('item_id');
            $table->string('available_qty');
            $table->string('batch_no');
            $table->string('expiry_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouseitems');
    }
};
