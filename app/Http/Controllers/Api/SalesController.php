<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\WarehouseItem;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalesController extends Controller
{

    public function index(Request $request)
    {
        try {
            $user = auth()->user();
            $storeId = $request->query('store_id');

            // Determine effective store IDs
            $storeIds = [];

            if ($storeId) {
                $storeIds = [trim($storeId)];
            } elseif (!empty($user->store_id) && $user->store_id != '0' && $user->store_id != 0) {
                $storeIds = [trim($user->store_id)];
            } else {
                // fallback to stores owned by this user
                $storeIds = DB::table('store')
                    ->where('user_id', $user->id)
                    ->pluck('id')
                    ->map(fn($id) => (string)$id)
                    ->toArray();
            }

            if (empty($storeIds)) {
                return response()->json([
                    'message' => 'No stores found for this user',
                    'data' => [],
                    'total' => 0,
                    'status' => 0,
                ], 200);
            }

            // Fetch sales for matching stores
            $sales = Sales::whereIn('store_id', $storeIds)
                ->with(['store', 'customer', 'item', 'warehouseitem']) // eager load relationships
                ->get();

            return response()->json([
                'message' => 'Sales Detail Fetch Successfully',
                'status' => 1,
                'total' => $sales->count(),
                'data' => $sales
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to retrieve Sales: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'store_id' => 'required|integer',
                // 'item_id' => 'required|integer',
                // 'sale_qty' => 'required|numeric',
            ]);

            $result = DB::transaction(function () use ($request) {
                // Create sales record
                $salesData = $request->all();
                $salesData['created_by'] = auth()->id();
                $salesData['status'] = 1;

                $sales = Sales::create($salesData);

                if ($sales) {
                    return [
                        'message' => 'Sales Created Successfully',
                        'data'    => $sales,
                        'status'  => 1
                    ];
                } else {
                    return [
                        'message' => 'Sales Creation Failed',
                        'data'    => null,
                        'status'  => 0
                    ];
                }
            });

            return response()->json($result, 201);
        } catch (\Exception $e) {
            // log error into storage/logs/laravel.log
            Log::error('Sales store error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_id' => auth()->id(),
                'input' => $request->all()
            ]);

            return response()->json([
                'message' => 'An error occurred while creating sales',
                'error'   => $e->getMessage(),   // only message returned
                'status'  => 0
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'store_id' => 'required|integer',
            'item_id' => 'required|integer',
            'sale_qty' => 'required|numeric'
        ]);

        try {
            $result = DB::transaction(function () use ($request, $id) {
                $sales = Sales::findOrFail($id);

                // Old stock before update
                $oldStock = $sales->sale_qty;
                $item = Item::findOrFail($sales->item_id);
                $warehouseitem = WarehouseItem::where('item_id', $sales->item_id)->first();

                // First return old stock (undo previous sale)
                if ($warehouseitem) {
                    $warehouseitem->update(['available_qty' => $warehouseitem->available_qty + $oldStock]);
                    $item->update(['Opening_Stock' => $warehouseitem->available_qty]);
                }

                // Now apply new sale
                $sales->update($request->all());

                $item = Item::findOrFail($request->item_id);
                $warehouseitem = WarehouseItem::where('item_id', $request->item_id)->first();

                if ($warehouseitem) {
                    $newStock = max(0, $warehouseitem->available_qty - $request->sale_qty);
                    $warehouseitem->update(['available_qty' => $newStock]);
                    $item->update(['Opening_Stock' => $newStock]);
                }

                return [
                    'message' => 'Sales Updated Successfully',
                    'data' => $sales,
                    'status' => 1
                ];
            });

            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating sales',
                'error' => $e->getMessage(),
                'status' => 0
            ], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $result = DB::transaction(function () use ($id) {
                $sales = Sales::findOrFail($id);
                $item = Item::findOrFail($sales->item_id);
                $warehouseitem = WarehouseItem::where('item_id', $sales->item_id)->first();

                if ($warehouseitem) {
                    // Return stock back on delete
                    $warehouseitem->update(['available_qty' => $warehouseitem->available_qty + $sales->sale_qty]);
                    $item->update(['Opening_Stock' => $warehouseitem->available_qty]);
                }

                $sales->delete();

                return [
                    'message' => 'Sales Deleted Successfully',
                    'status' => 1
                ];
            });

            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting sales',
                'error' => $e->getMessage(),
                'status' => 0
            ], 500);
        }
    }


    public function single_show(Request $request)
    {
        $storeid = $request->query('store_id');
        // $userid = $request->query('user_id');

        $sales = Sales::where('store_id', $storeid)
            // ->where('user_id', $userid)
            ->get();

        if ($sales->isNotEmpty()) {
            return response()->json([
                'message' => 'Sales Detail',
                'data' => $sales,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'Sales Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }
}
