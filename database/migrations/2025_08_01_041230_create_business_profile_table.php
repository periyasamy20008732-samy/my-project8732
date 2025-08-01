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
        Schema::create('business_profile', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('tin')->nullable();
            $table->string('email')->nullable();
            $table->string('pincode')->nullable();
            $table->string('address')->nullable();
            $table->string('businessType')->nullable();
            $table->string('category')->nullable();
            $table->string('state')->nullable();
            $table->string('gst')->nullable();
            $table->string('profileImagePath')->nullable();
            $table->string('signatureImagePath')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_profile');
    }
};