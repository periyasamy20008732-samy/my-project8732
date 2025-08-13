<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\WarehouseItem;
use DB;

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
                $sales = Sales::where('user_id', $user->id)->get();
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
            'stock' => 'required|numeric|min:1'
        ]);

        DB::transaction(function () use ($request) {
            // Create sales record
            $sales = Sales::create($request->all());

            $item = Item::findOrFail($request->item_id);
            $warehouseitem = WarehouseItem::where('item_id', $request->item_id)->first();

            if ($warehouseitem) {

                $newstock = max(0, $warehouseitem->available_qty - $request->stock);

                $warehouseitem->update(['available_qty' => $newstock]);
                $item->update(['Opening_Stock' => $newstock]);
            } else {
                // Create new warehouse entry with negative or zero stock
                WarehouseItem::firstOrCreate(
                    [
                        'store_id' => $request->store_id,
                        'warehouse_id' => $item->warehouse_id,
                        'item_id' => $request->item_id,
                    ],
                    [
                        'available_qty' => max(0, 0 - $request->stock)
                    ]
                );

                $item->update(['Opening_Stock' => max(0, 0 - $request->stock)]);
            }

            // Return success
            return response()->json([
                'message' => 'Sales Detail Created Successfully',
                'data' => $sales,
                'status' => 1
            ], 201);
        });
    }

    public function update(Request $request, $id)
    {
        $sales = Sales::findOrFail($id);

        $sales->update($request->all());

        return response()->json([
            'message' => 'Sales Details Updated Successfully',
            'data' => $sales,
            'status' => 1
        ]);
    }
    public function destroy($id)
    {
        $sales = Sales::findOrFail($id);
        $sales->delete();

        return response()->json([
            'message' => 'Sales Detail Deleted Successfully',
            'status' => 1

        ]);
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
