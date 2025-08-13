<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesItemReturn;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\WarehouseItem;
use Illuminate\Support\Facades\DB;
use Exception;

class SalesItemReturnController extends Controller
{
    // View all SalesItem
    public function index()
    {
        $salesitem = SalesItemReturn::all();


        if ($salesitem->isEmpty()) {

            return response()->json([
                'message' => 'Sales Item Return Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {

            return response()->json([
                'message' => 'Sales Item Return List',
                'data' => $salesitem,
                'status' => 1
            ], 200);
        }
    }


    // Store a new SalesItem


    public function store(Request $request)
    {
        $request->validate([
            'sales_qty'    => 'required|numeric',
            'item_id'      => 'required|numeric|exists:items,id',
            'store_id'     => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();


            $salesitem = SalesItemReturn::create($request->all());

            // Fetch item & warehouse item
            $item = Item::find($request->item_id);
            $warehouseitem = WarehouseItem::where([
                'item_id'      => $request->item_id,
                'store_id'     => $request->store_id,
                'warehouse_id' => $request->warehouse_id,
            ])->first();

            if ($warehouseitem) {
                // Update existing stock
                $newstock = $warehouseitem->available_qty + $request->sales_qty;
                $warehouseitem->update(['available_qty' => $newstock]);
                $item->update(['Opening_Stock' => $newstock]);
            } else {
                // Create new warehouse item
                WarehouseItem::create([
                    'store_id'      => $request->store_id,
                    'warehouse_id'  => $request->warehouse_id,
                    'item_id'       => $request->item_id,
                    'available_qty' => $request->sales_qty,
                ]);
                $item->update(['Opening_Stock' => $request->sales_qty]);
            }

            DB::commit();

            return response()->json([
                'status'  => 1,
                'message' => 'Sales Item Return Added successfully',
                'data'    => $salesitem
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 0,
                'message' => 'An error occurred while adding sales item return',
                'error'   => $e->getMessage()
            ], 500);
        }
    }



    // Update an existing SalesItem
    public function update(Request $request, $id)
    {
        $salesitem = SalesItemReturn::findOrFail($id);

        $salesitem->update($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Sales Item Return updated successfully',
            'data' => $salesitem
        ]);
    }

    // View a single SalesItem
    public function show($id)
    {
        $salesitem = SalesItemReturn::findOrFail($id);
        return response()->json($salesitem);
    }
    public function destroy($id)
    {
        $salesitem = SalesItemReturn::findOrFail($id);
        $salesitem->delete();
        return response()->json(['message' => 'Sales Item Return deleted']);
    }
}
