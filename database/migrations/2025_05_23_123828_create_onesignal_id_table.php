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
        Schema::create('onesignal_id', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('store_id');
            $table->string('player_id');
            $table->string('external_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onesignal_id');
    }
};
