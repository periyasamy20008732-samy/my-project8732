<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseItemReturn;


class PurchaseItemReturnController extends Controller
{
    // View all Purchaseitem
    public function index()
    {
        $purchaseitem = PurchaseitemReturn::all();
        //$result= User::find($id);return response()->json($packages);

        if ($purchaseitem->isEmpty()) {

            return response()->json([
                'message' => 'Purchase item Return details Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Purchase item Return List',
                'data' => $purchaseitem,
                'status' => 1
            ], 200);

        }
    }

    // Store a new Purchaseitem
    public function store(Request $request)
    {
        $request->validate([
            'stock' => 'required|string',
            'if_batch' => 'required|string',
            'batch_no' => 'required|string',
            'if_expirydate' => 'required|string',
        ]);

        $purchaseitem = PurchaseitemReturn::create($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Purchaseitem created successfully',
            'data' => $purchaseitem
        ], 201);
    }

    // Update an existing PurchaseitemReturn                                        
    public function update(Request $request, $id)
    {
        $purchaseitem = PurchaseitemReturn::findOrFail($id);

        $purchaseitem->update($request->all());

        return response()->json([
            'status' => '1',
            'message' => 'Purchaseitem Return  updated successfully',
            'data' => $purchaseitem
        ]);
    }

    // View a single Purchaseitem
    public function show($id)
    {
        $purchaseitem = PurchaseitemReturn::findOrFail($id);
        return response()->json($purchaseitem);
    }
    public function destroy($id)
    {
        $purchaseitem = PurchaseitemReturn::findOrFail($id);
        $purchaseitem->delete();
        return response()->json([
            'status' => '1',
            'message' => 'Purchaseitem Deleted'
        ]);
    }
}