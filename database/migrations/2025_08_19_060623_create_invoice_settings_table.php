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
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('business_name')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('prefix')->nullable();
            $table->string('start_number')->nullable();
            $table->string('invoice_numbering')->nullable();
            $table->string('invoice_notes')->nullable();
            $table->string('include_notes')->nullable();
            $table->string('taxrate')->nullable();
            $table->string('payment_details')->nullable();
            $table->string('copy_customer')->nullable();
            $table->string('bussiness_logo')->nullable();
            $table->string('template')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_settings');
    }
};
