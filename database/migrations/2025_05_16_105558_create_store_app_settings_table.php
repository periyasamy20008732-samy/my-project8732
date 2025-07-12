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
        Schema::create('store_app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('store_id');
            $table->string('home_block1');
            $table->string('home_block2');
            $table->string('home_block3');
            $table->string('home_block4');
            $table->string('home_block5');
            $table->string('home_block6');
            $table->string('status');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_app_settings');
    }
};
