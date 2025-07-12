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
        Schema::create('customer_shippingaddress', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('store_id')->nullable();
            $table->string('country_id')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('address')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('status')->nullable();
            $table->string('location_link')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('default')->nullable();
            $table->timestamps();
        });
    }
    //customer_shippingaddress
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_shippingaddress');
    }
};