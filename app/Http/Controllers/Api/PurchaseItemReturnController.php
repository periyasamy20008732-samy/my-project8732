<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseItemReturn;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\WarehouseItem;
use Illuminate\Support\Facades\DB;

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



    public function store(Request $request)
    {
        $request->validate([
            'return_qty'     => 'required|string',
            'item_id'        => 'required|string',
            'if_batch'       => 'required|string',
            'batch_no'       => 'required|string',
            'if_expirydate'  => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // Create purchase item return
            $purchaseitem = PurchaseitemReturn::create($request->all());

            // Fetch item and warehouse item records
            $item = Item::where('id', $request->item_id)->first();
            $warehouseitem = WarehouseItem::where('item_id', $request->item_id)->first();

            if ($warehouseitem) {
                // Update existing stock
                $warehousestock = $warehouseitem->available_qty;
                $newstock = $warehousestock - $request->return_qty;

                WarehouseItem::where('item_id', $request->item_id)
                    ->update(['available_qty' => $newstock]);

                Item::where('id', $request->item_id)
                    ->update(['Opening_Stock' => $newstock]);
            } else {
                // Create new warehouse stock record
                $available_qty = 0 - $request->return_qty;

                WarehouseItem::firstOrCreate(
                    [
                        'store_id'     => $request->store_id,
                        'warehouse_id' => $item->warhouse_id ?? null,
                        'item_id'      => $request->item_id,
                    ],
                    [
                        'available_qty' => $available_qty,
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'status'  => 1,
                'message' => 'Purchase item return created successfully',
                'data'    => $purchaseitem
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 0,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
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
    // public function destroy($id)
    // {
    //     $purchaseitem = PurchaseitemReturn::findOrFail($id);

    //     $purchaseitem->delete();
    //     $item = Item::where('id', $id);
    //     $warehouseitem = WarehouseItem::where('item_id', $purchaseitem->item_id);

    //     if ($warehouseitem) {
    //         //$warehouseid =  $item->warhouse_id;
    //         //$stock =  $item->Opening_Stock;
    //         $warehousestock = $warehouseitem->available_qty;
    //         $newstock = $warehousestock - $item->stock;
    //         WarehouseItem::where('item_id', $warehouseitem->item_id)->update(['available_qty' => $newstock]);
    //         Item::where('id', $item->id)->update(['Opening_Stock' => $newstock]);
    //     } else {
    //         $available_qty = (0 + ($warehouseitem->stock));
    //         warehouseItem::firstOrCreate(attributes: [
    //             'store_id' => $purchaseitem->store_id,
    //             'warehouse_id' => $item->warhouse_id,
    //             'available_qty' => $available_qty,
    //             'item_id' => $warehouseitem->item_id,

    //         ]);
    //     }
    //     return response()->json([
    //         'status' => '1',
    //         'message' => 'Purchaseitem Deleted'
    //     ]);
    // }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $purchaseitem = PurchaseitemReturn::findOrFail($id);

            // Get related item and warehouse record
            $item = Item::where('id', $purchaseitem->item_id)->first();
            $warehouseitem = WarehouseItem::where('item_id', $purchaseitem->item_id)->first();

            // Delete the purchase return record
            $purchaseitem->delete();

            if ($warehouseitem) {
                // Restore stock (add back the returned quantity)
                $warehousestock = $warehouseitem->available_qty;
                $newstock = $warehousestock + $purchaseitem->return_qty;

                WarehouseItem::where('item_id', $purchaseitem->item_id)
                    ->update(['available_qty' => $newstock]);

                Item::where('id', $purchaseitem->item_id)
                    ->update(['Opening_Stock' => $newstock]);
            } else {
                // If no warehouse item exists, create it with the restored stock
                WarehouseItem::firstOrCreate(
                    [
                        'store_id'     => $purchaseitem->store_id,
                        'warehouse_id' => $item->warhouse_id ?? null,
                        'item_id'      => $purchaseitem->item_id,
                    ],
                    [
                        'available_qty' => $purchaseitem->return_qty,
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'status'  => 1,
                'message' => 'Purchase item return deleted and stock updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 0,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }


    public function items($id)
    {
        $items = PurchaseItemReturn::with(['item'])
            ->where('return_id', $id)
            ->get();

        return response()->json([
            'status' => 1,
            'message' => 'Returned items retrieved successfully',
            'data' => $items
        ]);
    }

}
