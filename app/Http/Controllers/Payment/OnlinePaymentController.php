<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\OnlinePayment;
use Illuminate\Http\Request;


class OnlinePaymentController extends Controller
{
    // ✅ List all payments
    public function index()
    {
        $payments = OnlinePayment::all();
        return response()->json($payments);
    }

    // ✅ Insert new payment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|integer',
            'store_id' => 'nullable|integer',
            'item_id' => 'nullable|integer',
            'unique_order_id' => 'nullable|string',
            'amount' => 'required|numeric',
            'gateway' => 'nullable|string',
            'payment_status' => 'nullable|string',
            'payment_id' => 'nullable|string',
            'purpose' => 'nullable|string',
        ]);

        $payment = OnlinePayment::create($validated);
        return response()->json([
            'message' => 'Payment created successfully',
            'data' => $payment,
        ], 201);
    }

    // ✅ Update existing payment
    public function update(Request $request, $id)
    {
        $payment = OnlinePayment::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'nullable|integer',
            'store_id' => 'nullable|integer',
            'item_id' => 'nullable|integer',
            'unique_order_id' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'gateway' => 'nullable|string',
            'payment_status' => 'nullable|string',
            'payment_id' => 'nullable|string',
            'purpose' => 'nullable|string',
        ]);

        $payment->update($validated);

        return response()->json([
            'message' => 'Payment updated successfully',
            'data' => $payment,
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        $data = $request->all();

        $paymentId = $data['payment_id'] ?? null;
        $orderId = $data['order_id'] ?? null;
        $signature = $data['signature'] ?? null;

        // Save payment data to online_payment table
        OnlinePayment::create([
            'user_id' => auth()->id(), // or manually assign if no auth
            'store_id' => $request->store_id ?? null,
            'item_id' => $request->item_id ?? null,
            'unique_order_id' => $orderId,
            'amount' => $request->amount ?? 0,
            'gateway' => 'razorpay',
            'payment_status' => 'success',
            'payment_id' => $paymentId,
            'purpose' => $request->purpose ?? 'Online Payment'
        ]);

        return response()->json([
            'message' => 'Payment saved successfully!',
            'payment_id' => $paymentId
        ]);
    }
}