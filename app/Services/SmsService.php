<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SmsService
{
    public function send($mobile, $msg)
    {
        $siteData = DB::table('site_config')->where('id', 1)->first();

        if (!$siteData) {
            return false;
        }

        if ($siteData->mg91_status == 1) {
            $postData = [
                'mobiles' => $mobile,
                'message' => urlencode($msg),
                'sender' => $siteData->sms_senderid,
                'route' => 4,
                'DLT_TE_ID' => $siteData->sms_dltid
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "http://api.msg91.com/api/v2/sendsms",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_HTTPHEADER => [
                    "authkey: $siteData->msg91_apikey",
                    "content-type: multipart/form-data"
                ],
            ]);
            $response = curl_exec($curl);
            curl_close($curl);

            return $response;

        } elseif ($siteData->if_textlocal == 1) {
            $data = [
                'apikey' => urlencode($siteData->textlocal_apikey),
                'numbers' => $mobile,
                'sender' => urlencode($siteData->sms_senderid),
                'message' => rawurlencode($msg),
            ];

            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            return $response;

        } elseif ($siteData->if_greensms == 1) {
            $expire = strtotime("+1 minute");
            $accessToken = $siteData->greensms_accessToken;
            $accessTokenKey = $siteData->greensms_accessTokenKey;
            $requestFor = "send-sms";

            $signature = md5(
                md5($accessToken . md5($requestFor . "sms@rits-v1.0" . $expire)) .
                $accessTokenKey
            );

            $params = [
                'accessToken' => $accessToken,
                'expire' => $expire,
                'authSignature' => $signature,
                'route' => "transactional",
                'smsHeader' => $siteData->sms_senderid,
                'messageContent' => $msg,
                'recipients' => $mobile,
                'contentType' => "text",
                'entityId' => $siteData->sms_entityId,
                'templateId' => $siteData->sms_dltid,
                'removeDuplicateNumbers' => "1"
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://sms.greencreon.com/api/sms/v1.0/send-sms',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_HTTPHEADER => [
                    "accept: application/json"
                ]
            ]);
            $response = curl_exec($curl);
            curl_close($curl);

            return $response;
        }

        return false;
    }
}