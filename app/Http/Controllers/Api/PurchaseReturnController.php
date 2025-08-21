<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PurchaseReturn;

use Illuminate\Support\Facades\Log;

use App\Models\Item;
use App\Models\Warehouse;
use App\Models\WarehouseItem;


class PurchaseReturnController extends Controller
{

    public function index()
    {
        try {
            $returns = PurchaseReturn::with([
                'supplier:id,supplier_name',
                'store:id,store_name',
                'warehouse:id,warehouse_name'
            ])
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'status'  => 1,
                'message' => 'Purchase returns retrieved successfully',
                'data'    => $returns
            ], 200);

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error fetching purchase returns: ' . $e->getMessage());

            return response()->json([
                'status'  => 0,
                'message' => 'Failed to retrieve purchase returns',
                'error'   => $e->getMessage(), // remove in production if sensitive
            ], 500);

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
        $return = PurchaseReturn::with([
            'supplier',
            'store',
            'warehouse',
            'items' => function ($query) {
                $query->with(['item']);
            },
            'payments'
        ])->findOrFail($id);

        return response()->json([
            'status' => 1,
            'message' => 'Purchase return details retrieved successfully',
            'data' => $return
        ]);
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
