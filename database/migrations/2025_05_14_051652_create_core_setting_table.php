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
        Schema::create('core_setting', function (Blueprint $table) {
            $table->id();
            $table->string('siteurl')->nullable();
            $table->string('version')->nullable();
            $table->string('app_version')->nullable();
            $table->string('app_package_name')->nullable();
            $table->string('ios_app_version')->nullable();
            $table->string('ios_packageid')->nullable();
            $table->string('site_title')->nullable();
            $table->string('site_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_details')->nullable();
            $table->string('logo')->nullable();
            $table->string('min_logo')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('web_logo')->nullable();
            $table->string('app_logo')->nullable();
            $table->string('address')->nullable();
            $table->string('site_email')->nullable();
            $table->string('whatsapp_no')->nullable();
            $table->string('sendgrid_API')->nullable();
            $table->string('google_map_API')->nullable();

            $table->string('if_googlemap')->nullable();
            $table->string('if_firebase')->nullable();
            $table->string('firebase_config')->nullable();
            $table->string('firebase_API')->nullable();
            $table->string('cod_status')->nullable();
            $table->string('if_bank_transfer')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('upi_id')->nullable();
            $table->string('if_razorpay')->nullable();
            $table->string('razo_key_id')->nullable();
            $table->string('razo_key_secret')->nullable();
            $table->string('if_ccavenue')->nullable();
            $table->string('ccavenue_testmode')->nullable();
            $table->string('ccavenue_merchant_id')->nullable();
            $table->string('ccavenue_access_code')->nullable();
            $table->string('ccavenue_working_key')->nullable();
            $table->string('if_phonepe')->nullable();
            $table->string('phonepe_merchantId')->nullable();
            $table->string('phonepe_saltkey')->nullable();
            $table->string('phonepe_mode')->nullable();
            $table->string('if_onesignal')->nullable();
            $table->string('onesignal_id')->nullable();
            $table->string('onesignal_key')->nullable();
            $table->string('if_smtp')->nullable();
            $table->string('if_sendgrid')->nullable();



            $table->string('smtp_host')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('if_testotp')->nullable();
            $table->string('if_msg91')->nullable();
            $table->string('msg91_apikey')->nullable();
            $table->string('if_textlocal')->nullable();
            $table->string('textlocal_apikey')->nullable();
            $table->string('if_greensms')->nullable();
            $table->string('greensms_accessToken')->nullable();
            $table->string('greensms_accessTokenKey')->nullable();
            $table->string('sms_senderid')->nullable();
            $table->string('sms_entityId')->nullable();
            $table->string('sms_dltid')->nullable();
            $table->string('sms_msg')->nullable();
            $table->string('maintenance_mode')->nullable();
            $table->string('app_maintenance_mode')->nullable();
            $table->string('device_id_check_reg')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core_setting');
    }
};