<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
    // Show settings page
    public function index()
    {
        $setting = Settings::latest()->get();
        return view('admin.settings', compact('setting'));
    }

    // Update settings
    public function update(Request $request, $id)
    {
        $setting = Settings::findOrFail($id);

        // Handle file uploads
        $fileFields = ['logo', 'min_logo', 'fav_icon', 'app_logo', 'web_logo'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $request->validate([
                    $field => 'required|image|mimes:jpeg,png,jpg,webp,svg,gif|max:2048',
                ]);

                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/core/'), $filename);

                // Delete old image if exists
                $oldFile = $setting->$field;
                if (!empty($oldFile) && file_exists(public_path('storage/core/' . $oldFile))) {
                    @unlink(public_path('storage/core/' . $oldFile));
                }

                // Save new filename
                $setting->$field = $filename;
            }
        }

        // Update other fields (text inputs, SEO, etc.)
        $setting->site_title       = $request->input('site_title');
        $setting->meta_keyword    = $request->input('meta_keyword');
        $setting->meta_details = $request->input('meta_details');
        $setting->version      = $request->input('version');
        $setting->app_maintenance_mode = $request->has('maintenance_mode') ? 1 : 0;
        $setting->site_description        = $request->input('site_description');
        $setting->siteurl                 = $request->input('siteurl');
        $setting->site_email        = $request->input('site_email');
        $setting->whatsapp_no        = $request->input('whatsapp_no');
        $setting->address        = $request->input('address');
        $setting->if_googlemap        = $request->input('if_google_map');
        $setting->google_map_API        = $request->input('google_map_API');
        $setting->if_firebase        = $request->input('if_firebase');
        $setting->firebase_API        = $request->input('firebase_API');
        $setting->firebase_config        = $request->input('firebase_config');
        $setting->if_onesignal        = $request->input('if_onesignal');

        $setting->if_smtp        = $request->input('if_smtp');
        $setting->smtp_host        = $request->input('smtp_host');
        $setting->smtp_port        = $request->input('smtp_port');
        $setting->smtp_username        = $request->input('smtp_username');
        $setting->smtp_password        = $request->input('smtp_password');
        $setting->if_sendgrid        = $request->input('if_sendgrid');
        $setting->sendgrid_API        = $request->input('sendgrid_API');
        $setting->if_testotp        = $request->input('if_testotp');
        $setting->if_msg91        = $request->input('if_msg91');
        $setting->msg91_apikey        = $request->input('msg91_apikey');
        $setting->if_textlocal        = $request->input('if_textlocal');
        $setting->textlocal_apikey        = $request->input('textlocal_apikey');
        $setting->if_greensms        = $request->input('if_greensms');
        $setting->greensms_accessToken        = $request->input('greensms_accessToken');
        $setting->greensms_accessTokenKey        = $request->input('greensms_accessTokenKey');
        $setting->sms_senderid        = $request->input('sms_senderid');
        $setting->sms_entityId        = $request->input('sms_entityId');
        $setting->sms_dltid        = $request->input('sms_dltid');
        $setting->sms_msg        = $request->input('sms_msg');
        $setting->razorpay_status        = $request->input('razorpay_status');
        $setting->razo_key_id        = $request->input('razo_key_id');
        $setting->razo_key_secret        = $request->input('razo_key_secret');
        $setting->ccavenue_status        = $request->input('ccavenue_status');
        $setting->ccavenue_testmode        = $request->input('ccavenue_testmode');
        $setting->ccavenue_merchant_id        = $request->input('ccavenue_merchant_id');
        $setting->ccavenue_access_code        = $request->input('ccavenue_access_code');
        $setting->ccavenue_working_key        = $request->input('ccavenue_working_key');
        $setting->if_phonepe        = $request->input('if_phonepe');
        $setting->phonepe_mode        = $request->input('phonepe_mode');
        $setting->phonepe_merchantId        = $request->input('phonepe_merchantId');
        $setting->phonepe_saltkey        = $request->input('phonepe_saltkey');


        $setting->if_agora        = $request->input('if_agora');
        $setting->agora_appid        = $request->input('agora_appid');
        $setting->if_zigocloud        = $request->input('if_zigocloud');

        $setting->zigocloud_app_id        = $request->input('zigocloud_app_id');
        $setting->zigocloud_app_signin        = $request->input('zigocloud_app_signin');
        // $setting->if_onesignal     = $request->input('if_onesignal');
        $setting->onesignal_id     = $request->input('onesignal_id');
        $setting->onesignal_key    = $request->input('onesignal_key');
        $setting->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
