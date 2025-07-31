<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;

class RazorpayPaymentController extends Controller
{
    public function index()
    {
        return view('paynow');
    }

    public function createOrder(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $orderData = [
            'receipt' => 'rcptid_' . uniqid(),
            'amount' => 100, // Amount in paise (50000 = ₹500)
            'currency' => 'INR'
        ];

        $razorpayOrder = $api->order->create($orderData);

        $orderId = $razorpayOrder['id'];

        return view('paynow', [
            'orderId' => $orderId,
            'razorpayKey' => env('RAZORPAY_KEY'),
            'amount' => $orderData['amount']
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

        // Optional: verify signature here

        // Save or use payment_id as needed
        // Example: save to database or show user
        return "Transaction ID: " . $paymentId;
    }
}