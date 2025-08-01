<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Account\PaymentController;
use App\Http\Controllers\OnlinePaymentController;
use App\Models\OnlinePayment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;

class RazorpayPaymentController extends Controller
{
    // public function index(Request $request)
    // {
    //     return view('paynow');
    // }

    public function createOrder(Request $request)
    {

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $orderData = [
            'receipt' => 'rcptid_' . uniqid(),
            'amount' => ($request->amount) * 100, // Amount in paise (50000 = ₹500)
            'currency' => 'INR'
        ];

        $razorpayOrder = $api->order->create($orderData);

        $orderId = $razorpayOrder['id'];
        //dd($orderId);
        return view('paynow', [
            'orderId' => $orderId,
            'razorpayKey' => env('RAZORPAY_KEY'),
            'amount' => $orderData['amount'],
            'user' => (object) [
                'id' => $request->user_id,
                'name' => $request->username,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'store_id' => $request->store_id
            ],
            'package' => (object) [
                'package_name' => 'Your Package Name',
                'price' => $request->amount / 100
            ]
        ]);
    }

    // public function paymentSuccess(Request $request)
    // {
    //     // You can verify payment here or handle post-payment logic
    //     return 'Payment Successful!';
    // }

    public function paymentSuccess(Request $request)
    {
        $data = $request->all();

        $paymentId = $data['payment_id'] ?? null;
        $orderId = $data['order_id'] ?? null;
        $signature = $data['signature'] ?? null;

        $id = $data['id'] ?? null;
        $storeId = $data['store_id'] ?? null;

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $payment = $api->payment->fetch($paymentId);

            if ($payment->status === 'captured') {
                OnlinePayment::create([
                    'user_id' => $id,
                    'store_id' => $storeId,
                    'unique_order_id' => $orderId,
                    'amount' => $payment->amount / 100,
                    'gateway' => 'Razorpay',
                    'status' => 'success',
                    'payment_id' => $paymentId,
                    'purpose' => 'Test Transaction ->' . $signature
                ]);

                return response()->json([
                    'status' => 'success',
                    'transaction_id' => $paymentId
                ]);
            } else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Payment not captured.'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 500);
        }
    }
}