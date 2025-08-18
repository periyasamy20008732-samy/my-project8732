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

class SalesController extends Controller
{

    public function index()
    {
        try {
            $user = auth()->user();

            if (in_array($user->user_level, [1, 4])) {
                // Store admin sees all stores
                $sales = Sales::all();
            } else {
                // Other users see only their own stores
                $sales = Sales::where('created_by', $user->id)->get();
            }

            return response()->json([
                'message' => 'Sales Detail Fetch Successfully',
                'status' => 1,
                'data' => $sales
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to retrieve Sales: Unauthorozied or data not found',
            ], 500);
        }
    }


    /*  $item = Item::where('id', $request->item_id)->first();
        $warehouseitem = WarehouseItem::where('item_id', $request->item_id)->first();

        if ($warehouseitem) {
            //$warehouseid =  $item->warhouse_id;
            //$stock =  $item->Opening_Stock;
            $warehousestock = $warehouseitem->available_qty;
            $newstock = $warehousestock - $request->stock;
            WarehouseItem::where('item_id', $request->item_id)->update(['available_qty' => $newstock]);
            Item::where('id', $request->item_id)->update(['Opening_Stock' => $newstock]);
        } else {
            $available_qty = (0 - ($request->stock));
            warehouseItem::firstOrCreate(attributes: [
                'store_id' => $request->store_id,
                'warehouse_id' => $item->warhouse_id,
                'available_qty' => $available_qty,
                'item_id' => $request->item_id,

            ]);
        }*/
    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|integer',
            'item_id' => 'required|integer',
            'sale_qty' => 'required|numeric',

        ]);

        try {
            $result = DB::transaction(function () use ($request) {
                // Create sales record

                $salesData = $request->all();
                $salesData['created_by'] = auth()->id();
                $salesData['status'] = 1;

                $sales = Sales::create($salesData);


                $item = Item::findOrFail($request->item_id);
                $warehouseitem = WarehouseItem::where('item_id', $request->item_id)->first();

                if ($warehouseitem) {
                    // Update existing stock
                    $newstock = max(0, $warehouseitem->available_qty - $request->sale_qty);

                    $warehouseitem->update(['available_qty' => $newstock]);
                    $item->update(['Opening_Stock' => $newstock]);
                } else {
                    // Create new warehouse entry with adjusted stock
                    WarehouseItem::firstOrCreate(
                        [
                            'store_id' => $request->store_id,
                            'warehouse_id' => $item->warehouse_id,
                            'item_id' => $request->item_id,
                        ],
                        [
                            'available_qty' => max(0, 0 - $request->sale_qty)
                        ]
                    );

                    $item->update(['Opening_Stock' => max(0, 0 - $request->sale_qty)]);
                }

                return [
                    'message' => 'Sales Created Successfully',
                    'data' => $sales,
                    'status' => 1
                ];
            });

            return response()->json($result, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating sales',
                'error' => $e->getMessage(),
                'status' => 0
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
