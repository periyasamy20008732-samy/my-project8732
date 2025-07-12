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
        Schema::create('ac_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('transaction_date')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('debit_account_id')->nullable();
            $table->string('credit_account_id')->nullable();
            $table->string('debit_amt')->nullable();
            $table->string('credit_amt')->nullable();
            $table->string('note')->nullable();
            $table->string('ref_accounts_id')->nullable();
            $table->string('ref_moneytransfer_id')->nullable();
            $table->string('ref_moneydeposits_id')->nullable();
            $table->string('ref_salespayments_id')->nullable();
            $table->string('ref_salespaymentsreturn_id')->nullable();
            $table->string('ref_purchasepayments_id')->nullable();
            $table->string('ref_purchasepaymentsreturn_id')->nullable();
            $table->string('ref_expense_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('supplier_id')->nullable();
            $table->string('short_code')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ac_transactions');
    }
};