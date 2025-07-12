<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PurchaseReturn;


class PurchaseReturnController extends Controller
{

    // View all Purchase
    public function index()
    {
        $purchase = PurchaseReturn::all();

        if ($purchase->isEmpty()) {

            return response()->json([
                'message' => 'Purchase Return Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Purchase Return Details List',
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

        $purchase = PurchaseReturn::create($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Purchase Return Added successfully',
            'data' => $purchase
        ], 201);
    }

    // Update an existing Purchase
    public function update(Request $request, $id)
    {
        $purchase = PurchaseReturn::findOrFail($id);

        $purchase->update($request->all());

        return response()->json([
            'status' => '1',
            'message' => 'Purchase  Return Details updated successfully',
            'data' => $purchase
        ]);
    }

    // View a single Purchase
    public function show($id)
    {
        $purchase = PurchaseReturn::findOrFail($id);
        return response()->json($purchase);
    }
    public function destroy($id)
    {
        $purchase = PurchaseReturn::findOrFail($id);
        $purchase->delete();
        return response()->json([
            'status' => '1',
            'message' => 'Purchase Return Details  Deleted'
        ]);
    }
}