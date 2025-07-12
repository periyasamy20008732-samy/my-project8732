<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('item_image');
            $table->string('item_name');
            $table->string('store_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('SKU')->nullable();
            $table->string('HSN_code')->nullable();
            $table->string('Item_code');
            $table->string('Barcode');
            $table->string('Unit');
            $table->string('Sub_unit')->nullable();
            $table->string('Unit_conversion')->nullable();
            $table->string('Description')->nullable();
            $table->decimal('Purchase_price', 10, 2);
            $table->string('Tax_type');
            $table->decimal('Tax_rate', 5, 2);
            $table->decimal('Sales_Price', 10, 2);
            $table->string('MRP');
            $table->string('Discount_type');
            $table->decimal('Discount', 5, 2);
            $table->decimal('Profit_margin', 5, 2);
            $table->string('Warehouse')->nullable();
            $table->decimal('Opening_Stock', 10, 2)->nullable();
            $table->decimal('Alert_Quantity', 10, 2)->nullable();
            $table->string('batch_no')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
}