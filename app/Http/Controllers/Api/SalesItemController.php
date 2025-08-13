<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesItem;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\WarehouseItem;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SalesItemController extends Controller
{
    // View all SalesItem
    public function index()
    {
        $salesitem = SalesItem::where('user_id', Auth::id())->get();


        if ($salesitem->isEmpty()) {

            return response()->json([
                'message' => 'SalesItem Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {


            return response()->json([
                'message' => 'User categories fetched successfully',
                'data' => $salesitem,
            ]);
        }
    }



    // Store a new SalesItem
    public function store(Request $request)
    {
        $request->validate([
            'sales_qty' => 'required|numeric',
            'item_id' => 'required|numeric',
            'store_id' => 'required|numeric',
        ]);

        $salesitem = SalesItem::create($request->all());

        // Fetch actual models
        $item = Item::find($request->item_id);
        $warehouseitem = WarehouseItem::where('item_id', $request->item_id)->first();

        if ($warehouseitem) {
            // Update existing stock
            $newstock = $warehouseitem->available_qty - $request->sales_qty;
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
                    'available_qty' => $request->sales_qty
                ]
            );

            // Sync Opening_Stock in items table
            $item->update(['Opening_Stock' => $request->sales_qty]);
        }

        return response()->json([
            'status' => 1,
            'message' => 'Salesitem created successfully',
            'data' => $salesitem
        ], 201);
    }

    // Update an existing SalesItem
    public function update(Request $request, $id)
    {
        $salesitem = SalesItem::findOrFail($id);

        $salesitem->update($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'SalesItem updated successfully',
            'data' => $salesitem
        ]);
    }

    // View a single SalesItem
    public function show($id)
    {
        $salesitem = SalesItem::findOrFail($id);
        return response()->json($salesitem);
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $salesitem = SalesItem::findOrFail($id);

            $item = Item::find($salesitem->item_id);
            $warehouseitem = WarehouseItem::where('item_id', $salesitem->item_id)->first();

            if ($item) {
                if ($warehouseitem) {
                    // Update existing stock
                    $newstock = $warehouseitem->available_qty + $salesitem->purchase_qty;
                    $warehouseitem->update(['available_qty' => $newstock]);
                    $item->update(['Opening_Stock' => $newstock]);
                } else {
                    // Create new warehouse stock entry
                    WarehouseItem::firstOrCreate(
                        [
                            'store_id' => $salesitem->store_id,
                            'warehouse_id' => $item->Warehouse, // ensure correct column
                            'item_id' => $salesitem->item_id,
                        ],
                        [
                            'available_qty' => $salesitem->purchase_qty
                        ]
                    );

                    // Sync Opening_Stock in items table
                    $item->update(['Opening_Stock' => $salesitem->purchase_qty]);
                }
            }

            // Delete after stock update
            $salesitem->delete();

            DB::commit();
            return response()->json(['message' => 'SalesItem deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function single_show(Request $request)
    {
        $storeid = $request->query('sales_id');
        //  $userid = $request->query('user_id');

        $sales = SalesItem::where('sales_id', $storeid)
            //  ->where('user_id', $userid)
            ->get();

        if ($sales->isNotEmpty()) {
            return response()->json([
                'message' => 'SalesItem Detail',
                'data' => $sales,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'SalesItem Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }
}
