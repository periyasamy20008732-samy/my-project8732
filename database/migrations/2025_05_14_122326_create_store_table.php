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
        Schema::create('store', function (Blueprint $table) {
            $table->id();

            // Foreign-like IDs (no constraints yet)
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('store_code')->nullable();
            $table->string('slug')->nullable();

            // Store info
            $table->string('store_name')->nullable();
            $table->string('store_website')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('website')->nullable();
            $table->string('store_logo')->nullable();
            $table->string('logo')->nullable();

            // Location
            $table->string('country')->nullable();
            $table->string('state')->nullable();

            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->integer('postcode')->nullable();

            // Legal / Tax info
            $table->integer('if_gst')->nullable();
            $table->string('gst_no')->nullable();
            $table->integer('if_vat')->nullable();
            $table->string('vat_no')->nullable();
            $table->string('pan_no')->nullable();


            // UPI & bank
            $table->string('upi_id')->nullable();
            $table->string('upi_code')->nullable();
            $table->text('bank_details')->nullable();

            // Initialization codes
            $table->string('cid')->nullable();
            $table->string('category_init')->nullable();
            $table->string('item_init')->nullable();
            $table->string('supplier_init')->nullable();
            $table->string('purchase_init')->nullable();
            $table->string('purchase_return_init')->nullable();
            $table->string('customer_init')->nullable();
            $table->string('sales_init')->nullable();
            $table->string('sales_return_init')->nullable();
            $table->string('expense_init')->nullable();
            $table->string('accounts_init')->nullable();
            $table->string('journal_init')->nullable();
            $table->string('cust_advance_init')->nullable();
            $table->string('quotation_init')->nullable();
            $table->string('money_transfer_init')->nullable();
            $table->string('sales_payment_init')->nullable();
            $table->string('sales_return_payment_init')->nullable();
            $table->string('purchase_payment_init')->nullable();
            $table->string('purchase_return_payment_init')->nullable();
            $table->string('expense_payment_init')->nullable();

            // Config & preferences
            $table->boolean('sms_status')->default(false);
            $table->unsignedBigInteger('language_id')->nullable();
            $table->string('currency_id')->nullable();
            $table->string('currency_placement')->default('left');
            $table->string('timezone')->nullable();
            $table->string('date_format')->default('Y-m-d');
            $table->string('time_format')->default('H:i');
            $table->string('default_sales_discount')->default('0');
            $table->unsignedBigInteger('currencywsymbol_id')->nullable();
            $table->string('regno_key')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('purchase_code')->nullable();
            $table->boolean('change_return')->default(false);
            $table->unsignedBigInteger('sales_invoice_format_id')->nullable();
            $table->unsignedBigInteger('pos_invoice_format_id')->nullable();
            $table->text('sales_invoice_footer_text')->nullable();
            $table->integer('if_serialno')->nullable();
            $table->integer('if_modelno')->nullable();
            $table->integer('if_expiry')->nullable();
            $table->integer('if_batchno')->nullable();
            $table->boolean('round_off')->default(false);
            $table->integer('decimals')->default(2);
            $table->integer('qty_decimals')->default(2);

            // Email config
            $table->string('smtp_host')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_user')->nullable();
            $table->string('smtp_pass')->nullable();
            $table->boolean('smtp_status')->default(false);

            // SMS config
            $table->boolean('if_otp')->default(false);
            $table->text('sms_url')->nullable();
            $table->boolean('if_msg91')->default(false);
            $table->string('msg91_apikey')->nullable();
            $table->string('sms_senderid')->nullable();
            $table->string('sms_dltid')->nullable();
            $table->text('sms_msg')->nullable();

            // Optional features

            $table->boolean('if_cod')->default(false);
            $table->boolean('if_pickupatestore')->default(false);
            $table->boolean('if_fixeddelivery')->default(false);
            $table->decimal('delivery_charge', 10, 2)->default(0);
            $table->boolean('if_handlingcharge')->default(false);
            $table->decimal('handling_charge', 10, 2)->default(0);
            $table->string('signature')->nullable();
            $table->boolean('show_signature')->default(false);
            $table->boolean('t_and_c_status')->default(false);
            $table->boolean('t_and_c_status_pos')->default(false);
            $table->boolean('number_to_words')->default(false);

            // App integration
            $table->boolean('if_exictiveapp')->default(false);
            $table->boolean('if_customerapp')->default(false);
            $table->boolean('if_deliveryapp')->default(false);
            $table->boolean('if_onesignal')->default(false);
            $table->string('onesignal_id')->nullable();
            $table->string('onesignal_key')->nullable();


            // Subscription & account
            $table->unsignedBigInteger('current_subscription_id')->nullable();
            $table->string('invoice_view')->nullable();
            $table->boolean('previous_balancebit')->default(false);
            $table->unsignedBigInteger('default_account_id')->nullable();

            // Status & metadata
            $table->string('status')->default('active');
            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store');
    }
};
