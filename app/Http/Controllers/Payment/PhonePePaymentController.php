<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class PhonePePaymentController extends Controller
{
    //
    public function initiatePayment(Request $request)
    {
        $merchantId = env('PHONEPE_MERCHANT_ID');
        $saltKey = env('PHONEPE_SALT_KEY');
        $saltIndex = env('PHONEPE_SALT_INDEX');
        $callbackUrl = env('PHONEPE_CALLBACK_URL');
        $baseUrl = env('PHONEPE_BASE_URL');

        $txnId = 'TXN' . time();
        $amount = 10000; // ₹100 in paise

        $payload = [
            "merchantId" => $merchantId,
            "merchantTransactionId" => $txnId,
            "merchantUserId" => "user-001",
            "amount" => $amount,
            "redirectUrl" => $callbackUrl,
            "redirectMode" => "POST",
            "callbackUrl" => $callbackUrl,
            "paymentInstrument" => [
                "type" => "PAY_PAGE"
            ]
        ];

        $payloadJson = json_encode($payload);
        $base64Payload = base64_encode($payloadJson);
        $checksum = hash('sha256', $base64Payload . "/pg/v1/pay" . $saltKey) . "###" . $saltIndex;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-VERIFY' => $checksum,
            'X-MERCHANT-ID' => $merchantId
        ])->post($baseUrl . '/pg/v1/pay', [
                    'request' => $base64Payload
                ]);

        $res = $response->json();

        if ($res['success'] ?? false) {
            $url = $res['data']['instrumentResponse']['redirectInfo']['url'];
            return redirect()->away($url);
        }

        return response()->json($res);
    }

    public function handleCallback(Request $request)
    {
        Log::info("PhonePe Callback Received", $request->all());
        // Optional: store in DB
        // $txn = PhonePeTransaction::where('transaction_id', $data['merchantTransactionId'])->first();
        // if ($txn) {
        //     $txn->status = $data['state'];
        //     $txn->save();
        // }

        // Optional: send email or notification
        // if ($data['state'] === 'COMPLETED') {
        //     // Notify user of success
        // }
        // return response("Callback Received", 200);
        //$res = $response->json();
        return response()->json();
    }

    public function status($txnId)
    {
        $merchantId = env('PHONEPE_MERCHANT_ID');
        $saltKey = env('PHONEPE_SALT_KEY');
        $saltIndex = env('PHONEPE_SALT_INDEX');
        $baseUrl = env('PHONEPE_BASE_URL');

        $path = "/pg/v1/status/{$merchantId}/{$txnId}";
        $checksum = hash('sha256', $path . $saltKey) . "###" . $saltIndex;

        $response = Http::withHeaders([
            'X-VERIFY' => $checksum,
            'X-MERCHANT-ID' => $merchantId
        ])->get($baseUrl . $path);

        return response()->json($response->json());
    }

}