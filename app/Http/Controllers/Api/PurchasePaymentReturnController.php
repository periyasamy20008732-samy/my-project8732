<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PurchasePaymentReturn;

class PurchasePaymentReturnController extends Controller
{

    // View all Purchase Payment
    public function index()
    {
        $purchasepayment_return = PurchasePaymentReturn::all();
        //$result= User::find($id);return response()->json($packages);

        if ($purchasepayment_return->isEmpty()) {

            return response()->json([
                'message' => 'Purchase Payment Return Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Purchase Payment Return List',
                'data' => $purchasepayment_return,
                'status' => 1
            ], 200);

        }
    }
    public function store(Request $request)
    {
        $purchasepayment_return = PurchasePaymentReturn::create($request->all());
        return response()->json([
            'status' => 1,
            'message' => 'Purchase Payment Return  Details Created',
            'data' => $purchasepayment_return
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $purchasepayment_return = PurchasePaymentReturn::findOrFail($id);

        $purchasepayment_return->update($request->all());

        return response()->json([
            'status' => '1',
            'message' => 'Purchase Payment Ruturn Details updated successfully',
            'data' => $purchasepayment_return
        ]);
    }

}