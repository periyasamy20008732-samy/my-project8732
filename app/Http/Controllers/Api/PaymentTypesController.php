<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentTypes;

class PaymentTypesController extends Controller
{

    // View all Purchase Payment
    public function index()
    {
        $payment = PaymentTypes::all();
        //$result= User::find($id);return response()->json($packages);

        if ($payment->isEmpty()) {

            return response()->json([
                'message' => 'Payment Types Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Payment Types List',
                'data' => $payment,
                'status' => 1
            ], 200);

        }
    }
    public function store(Request $request)
    {
        $payment = PaymentTypes::create($request->all());
        return response()->json([
            'status' => 1,
            'message' => 'Payment Types Details Created',
            'data' => $payment
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $payment = PaymentTypes::findOrFail($id);

        $payment->update($request->all());

        return response()->json([
            'status' => '1',
            'message' => 'Payment Types Details updated successfully',
            'data' => $payment
        ]);
    }

}