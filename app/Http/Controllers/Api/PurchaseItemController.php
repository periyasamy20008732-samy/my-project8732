<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseItem;

class PurchaseItemController extends Controller
{
    // View all Purchaseitem
    public function index()
    {
        $purchaseitem = Purchaseitem::all();
        //$result= User::find($id);return response()->json($packages);

        if ($purchaseitem->isEmpty()) {

            return response()->json([
                'message' => 'Purchaseitem Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Purchaseitem List',
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

        $purchaseitem = Purchaseitem::create($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Purchaseitem created successfully',
            'data' => $purchaseitem
        ], 201);
    }

    // Update an existing Purchaseitem
    public function update(Request $request, $id)
    {
        $purchaseitem = Purchaseitem::findOrFail($id);

        $purchaseitem->update($request->all());

        return response()->json([
            'status' => '1',
            'message' => 'Purchaseitem updated successfully',
            'data' => $purchaseitem
        ]);
    }

    // View a single Purchaseitem
    public function show($id)
    {
        $purchaseitem = Purchaseitem::findOrFail($id);
        return response()->json($purchaseitem);
    }
    public function destroy($id)
    {
        $purchaseitem = Purchaseitem::findOrFail($id);
        $purchaseitem->delete();
        return response()->json([
            'status' => '1',
            'message' => 'Purchaseitem Deleted'
        ]);
    }


    public function single_show(Request $request)
    {
        $storeid = $request->query('purchase_id');
        //    $userid = $request->query('user_id');

        $purchase = Purchaseitem::where('purchase_id', $storeid)
            // ->where('user_id', $userid)
            ->get();

        if ($purchase->isNotEmpty()) {
            return response()->json([
                'message' => 'Purchaseitem Detail',
                'data' => $purchase,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'Purchaseitem Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }
}