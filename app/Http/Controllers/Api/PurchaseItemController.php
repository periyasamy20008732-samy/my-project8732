<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseItem;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\WarehouseItem;
use Illuminate\Support\Facades\DB;


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
            'purchase_qty' => 'required|numeric',
            'item_id' => 'required|numeric',
            // 'if_batch' => 'required|string',
            // 'batch_no' => 'required|string',
            //'if_expirydate' => 'required|string',
            'store_id' => 'required|numeric',
        ]);

        $purchaseitem = Purchaseitem::create($request->all());

        // Fetch actual models
        $item = Item::find($request->item_id);
        $warehouseitem = WarehouseItem::where('item_id', $request->item_id)->first();

        if ($warehouseitem) {
            // Update existing stock
            $newstock = $warehouseitem->available_qty + $request->purchase_qty;
            $warehouseitem->update(['available_qty' => $newstock]);
            $item->update(['Opening_Stock' => $newstock]);
        } else {
            // Create new warehouse stock entry
            WarehouseItem::firstOrCreate(
                [
                    'store_id' => $request->store_id,
                    'warehouse_id' => $item->warehouse_id,
                    'item_id' => $request->item_id,
                ],
                [
                    'available_qty' => $request->purchase_qty
                ]
            );

            // Sync Opening_Stock in items table
            $item->update(['Opening_Stock' => $request->purchase_qty]);
        }

        return response()->json([
            'status' => 1,
            'message' => 'Purchaseitem created successfully',
            'data' => $purchaseitem
        ], 201);
    }


    // Update an existing Purchaseitem
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'purchase_qty' => 'required|numeric',
                'item_id' => 'required|numeric',
                'store_id' => 'required|numeric',
            ]);

            $purchaseitem = Purchaseitem::findOrFail($id);

            // Get old and new qty
            $oldQty = $purchaseitem->purchase_qty;
            $newQty = $request->purchase_qty;
            $difference = $newQty - $oldQty; // positive = increase stock, negative = decrease stock

            // Update purchase record
            $purchaseitem->update($request->all());

            // Get related records
            $item = Item::findOrFail($request->item_id);
            $warehouseitem = WarehouseItem::where('item_id', $request->item_id)
                ->where('store_id', $request->store_id)
                ->firstOrFail();

            // Adjust stock correctly based on difference
            $newStock = $warehouseitem->available_qty + $difference;
            if ($newStock < 0) {
                throw new \Exception('Stock cannot be negative.');
            }

            // Update both warehouse and item table
            $warehouseitem->update(['available_qty' => $newStock]);
            $item->update(['Opening_Stock' => $newStock]);

            return response()->json([
                'status' => 1,
                'message' => 'Purchaseitem updated successfully',
                'data' => $purchaseitem
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 0,
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Purchase item or related records not found.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 500);
        }
    }



    // View a single Purchaseitem
    public function show($id)
    {
        $purchaseitem = Purchaseitem::findOrFail($id);
        return response()->json($purchaseitem);
    }


    public function destroy($id)
    {
        try {
            \DB::beginTransaction();

            $purchaseitem = Purchaseitem::findOrFail($id);

            $item = Item::findOrFail($purchaseitem->item_id);
            $warehouseitem = WarehouseItem::where('item_id', $purchaseitem->item_id)->first();

            // Delete purchase item
            $purchaseitem->delete();

            if ($warehouseitem) {
                // Reduce existing stock
                $newstock = $warehouseitem->available_qty - $purchaseitem->stock;
                $warehouseitem->update(['available_qty' => $newstock]);
                $item->update(['Opening_Stock' => $newstock]);
            } else {

                WarehouseItem::firstOrCreate(
                    [
                        'store_id' => $purchaseitem->store_id,
                        'warehouse_id' => $item->warehouse_id,
                        'item_id' => $purchaseitem->item_id,
                    ],
                    [
                        'available_qty' => $purchaseitem->stock
                    ]
                );

                $item->update(['Opening_Stock' => $purchaseitem->stock]);
            }

            \DB::commit();

            return response()->json([
                'status' => 1,
                'message' => 'Purchaseitem deleted successfully'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => 'Purchaseitem not found'
            ], 404);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => 'An error occurred while deleting the purchase item',
                'error' => $e->getMessage()
            ], 500);
        }
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
