<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Purchase;

class PurchaseController extends Controller
{

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
        try {
            $purchase = Purchase::with([
                'items.item:id,item_name',
                'payments',
                'supplier:id,supplier_name',
                'store:id,store_name',
                'warehouse:id,warehouse_name'
            ])->findOrFail($id);

            return response()->json([
                'status'  => 1,
                'message' => 'Purchase details retrieved successfully',
                'data'    => $purchase
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status'  => 0,
                'message' => 'Purchase not found',
                'error'   => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching purchase: ' . $e->getMessage());

            return response()->json([
                'status'  => 0,
                'message' => 'An error occurred while retrieving purchase details',
                'error'   => $e->getMessage()
            ], 500);
        }
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
    //()s for the windows app created by save
    // View all Purchase
    public function index()
    {
        try {
            $user = auth()->user();

            // Step 1: Get store IDs linked to this user
            if (!empty($user->store_id) && ($user->store_id != '0' && $user->store_id != 0)) {
                // Store user (assigned to one store)
                $storeIds = [trim($user->store_id)];
            } else {
                // Store admin (owns one or more stores)
                $storeIds = DB::table('store')
                    ->where('user_id', $user->id)
                    ->pluck('id')
                    ->map(fn($id) => (string)$id)
                    ->toArray();
            }

            // Step 2: Fetch purchase list for these store IDs
            $purchases = Purchase::whereIn('store_id', $storeIds)->get();

            // Step 3: Return JSON response
            if ($purchases->isEmpty()) {
                return response()->json([
                    'message' => 'Purchase Details Not Found',
                    'data'    => [],
                    'status'  => 0
                ], 200);
            }

            return response()->json([
                'message' => 'Purchase Details List',
                'data'    => $purchases,
                'status'  => 1
            ], 200);
        } catch (\Throwable $e) {
            // Log the error for debugging
            Log::error('Error in PurchaseController@index', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Something went wrong while fetching purchase details',
                'error'   => $e->getMessage(), // optional: remove in production for security
                'status'  => 0
            ], 500);
        }
    }
}
