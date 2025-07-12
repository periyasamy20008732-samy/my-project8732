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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('store_id');
            $table->string('slug')->nullable();
            $table->string('count_id');
            $table->string('brand_code');
            $table->string('brand_name');
            $table->string('brand_image')->nullable();
            $table->string('description');
            $table->tinyInteger('status')->default(1); 
            $table->string('inapp_view');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
