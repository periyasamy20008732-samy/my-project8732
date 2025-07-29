<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Settings extends Model
{
    protected $table='core_setting';

    protected $fillable = [ 
        'siteurl', 
        'version', 
        'app_version', 
        'app_package_name', 
        'ios_app_version', 
        'ios_packageid', 
        'site_title', 
        'site_description', 
        'meta_keyword', 
        'meta_details',
        'logo',
        'min_logo', 
        'fav_icon', 
        'web_logo',
        'app_logo', 
        'address', 
        'site_email', 
        'whatsapp_no', 
        'sendgrid_API', 
        'if_googlemap', 
        'if_firebase', 
        'firebase_config', 
        'firebase_API', 
        'cod_status', 
        'if_bank_transfer', 
        'bank_account', 
        'upi_id', 
        'if_razorpay', 
        'razo_key_id', 
        'razo_key_secret', 
        'if_ccavenue', 
        'ccavenue_testmode', 
        'ccavenue_merchant_id', 
        'ccavenue_access_code', 
        'ccavenue_working_key', 
        'if_phonepe', 
        'phonepe_merchantId', 
        'phonepe_saltkey', 
        'phonepe_mode', 
        'if_onesignal', 
        'onesignal_id', 
        'onesignal_key', 
        'smtp_host', 
        'smtp_port',
        'smtp_username',
        'smtp_password',
        'if_testotp',
        'if_msg91', 
        'msg91_apikey', 
        'if_textlocal', 
        'textlocal_apikey',
        'if_greensms', 
        'greensms_accessToken', 
        'greensms_accessTokenKey',
        'sms_senderid', 
        'sms_entityId', 
        'sms_dltid',
        'sms_msg', 
        'maintenance_mode', 
        'app_maintenance_mode', 
        'device_id_check_reg',
        'zigocloud_app_id',
        'if_sendgrid',
    ];
}