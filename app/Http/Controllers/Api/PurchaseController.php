<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    // View all Purchase
    public function index()
    {
        $purchase = Purchase::all();

        if ($purchase->isEmpty()) {

            return response()->json([
                'message' => 'Purchase Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Purchase Details List',
                'data' => $purchase,
                'status' => 1
            ], 200);

        }
    }

    // Store a new Purchase
    public function store(Request $request)
    {
        /* $request->validate([
             'stock' => 'required|string',
             'if_batch' => 'required|string',
             'batch_no' => 'required|string',
             'if_expirydate' => 'required|string',
         ]);*/

        $purchase = Purchase::create($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Purchase Added successfully',
            'data' => $purchase
        ], 201);
    }

    // Update an existing Purchase
    public function update(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);

        $purchase->update($request->all());

        return response()->json([
            'status' => '1',
            'message' => 'Purchase Details updated successfully',
            'data' => $purchase
        ]);
    }

    // View a single Purchase
    public function show($id)
    {
        $purchase = Purchase::findOrFail($id);
        return response()->json($purchase);
    }
    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();
        return response()->json([
            'status' => '1',
            'message' => 'Purchase Details  Deleted'
        ]);
    }

    public function single_show(Request $request)
    {
        $storeid = $request->query('store_id');
        //    $userid = $request->query('user_id');

        $purchase = Purchase::where('store_id', $storeid)
            // ->where('user_id', $userid)
            ->get();

        if ($purchase->isNotEmpty()) {
            return response()->json([
                'message' => 'Purchase Detail',
                'data' => $purchase,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'Purchase Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }
}