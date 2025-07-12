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
        Schema::create('ac_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('count_id')->nullable();
            $table->string('store_id')->nullable(); 
            $table->string('parent_id')->nullable(); 
            $table->string('sort_code')->nullable(); 
            $table->string('account_code')->nullable(); 
            $table->string('balance')->nullable(); 
            $table->string('note')->nullable(); 
            $table->string('status')->nullable(); 
            $table->string('delete_bit')->nullable(); 
            $table->string('account_selection_name')->nullable(); 
            $table->string('paymenttypes_id')->nullable(); 
            $table->string('customer_id')->nullable(); 
            $table->string('supplier_id')->nullable(); 
            $table->string('expense_id')->nullable(); 
            $table->string('created_by')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ac_accounts');
    }
};
