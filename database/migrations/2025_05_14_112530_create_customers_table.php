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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('user_id');
            $table->string('count_id')->nullable();
            $table->string('customer_code')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('gstin')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('vatin')->nullable();
            $table->string('opening_balance')->nullable();
            $table->string('sales_due')->nullable();
            $table->string('sales_return_due')->nullable();
            $table->string('country_id')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('address')->nullable();
            $table->string('location_link')->nullable();
            $table->string('attachment_1')->nullable();
            $table->string('price_level_type')->nullable();
            $table->string('price_level')->nullable();
            $table->string('delete_bit')->nullable();
            $table->string('tot_advance')->nullable();
            $table->string('credit_limit')->nullable();
            $table->string('status')->nullable();
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
