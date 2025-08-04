<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Account\PaymentController;
use App\Http\Controllers\OnlinePaymentController;
use App\Http\Controllers\Admin\PackageController;
use App\Models\OnlinePayment;


use App\Models\SubscriptionPurchase;
use App\Models\Packages;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
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
                'store_id' => $request->store_id,
                'package_id' => $request->package_id
            ],
            'package' => (object) [
                'id' => $request->package_id,
                'package_name' => 'Your Package Name',
                'price' => $request->amount / 100
            ]
        ]);
    }


    public function paymentSuccess(Request $request)
    {
        $data = $request->all();

        $paymentId = $data['payment_id'] ?? null;
        $orderId = $data['order_id'] ?? null;
        $signature = $data['signature'] ?? null;

        $id = $data['id'] ?? null;
        $storeId = $data['store_id'] ?? null;
        $packageId = $data['package_id'] ?? null;

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
                    'purpose' => 'Subscription Purchase ->' . $signature
                ]);

                //$package = Packages::where('id', $packageId)->first();


                $package = Packages::find($packageId);



                SubscriptionPurchase::create([
                    'user_id' => $id,
                    'package_id' => $package->id,
                    'validity_date' => $package->validity_date,
                    'payment_id' => $paymentId,
                    'payment_status' => 'success',
                    'if_webpanel' => $package->if_webpanel,
                    'if_android' => $package->if_android,
                    'if_ios' => $package->if_ios,
                    'if_windows' => $package->if_windows,
                    'price' => $payment->amount,
                    'image' => null,
                    'if_customerapp' => $package->if_customerapp,
                    'if_deliveryapp' => $package->if_deliveryapp,
                    'if_exicutiveapp' => $package->if_exicutiveapp,
                    'if_multistore' => $package->if_multistore,
                    'if_numberof_store' => $package->if_numberof_store,

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