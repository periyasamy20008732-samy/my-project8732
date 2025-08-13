<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\WarehouseItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{

    public function index(Request $request, $storeId = null)
    {
        $user = auth()->user();
        $storeId = $storeId ?? $request->query('store_id');

        // Determine effective store IDs
        $storeIds = [];

        if ($storeId) {
            $storeIds = [trim($storeId)];
        } elseif (!empty($user->store_id) && $user->store_id !== '0') {
            $storeIds = [trim($user->store_id)];
        } else {
            // fallback to stores owned by user
            $storeIds = DB::table('store')
                ->where('user_id', $user->id)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
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

        // Join items with store, category, and brand to fetch names
        $items = DB::table('items')
            ->select(
                'items.*',
                'store.store_name',
                'categories.category_name',
                'brands.brand_name'
            )
            ->leftJoin('store', 'items.store_id', '=', 'store.id')
            ->leftJoin('categories', 'items.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'items.brand_id', '=', 'brands.id')
            ->whereIn('items.store_id', $storeIds)
            ->get();

        if ($items->isEmpty()) {
            return response()->json([
                'message' => 'Item Detail Not Found',
                'data' => [],
                'status' => 0,
            ], 200);
        } else {

            return response()->json([
                'message' => 'Item List',
                'data' => $items,
                'status' => 1,
            ], 200);
        }
    }


    public function store_show(Request $request)
    {
        $storeid = $request->input('store_id'); // Get store_code from Postman

        if ($storeid) {
            $item = Item::where('store_id', $storeid)->get();

            if (!$item) {
                return response()->json([
                    'message' => 'Item Not Found',
                    'data' => [],
                    'status' => 0
                ], 200);
            }

            return response()->json([
                'message' => 'Item  Details',
                'data' => $item,
                'status' => 1
            ], 200);
        }

        // If no store_code is passed, return all stores
        $item = Item::all();

        if ($item->isEmpty()) {
            return response()->json([
                'message' => 'No Item List Found',
                'data' => [],
                'status' => 0
            ], 200);
        }

        return response()->json([
            'message' => 'Item List',
            'data' => $item,
            'status' => 1
        ], 200);
    }

    /*    public function store(Request $request)
    {


        try {
            $request->validate([
                'store_id' => 'required|string',
                'user_id' => 'required|string',
                'category_id' => 'required|string',
                'brand_id' => 'required|string',
                'item_name' => 'required|string',
                'item_image' => 'nullable|file|image|max:5120',
                'SKU' => 'required|string',
                'HSN_code' => 'required|string',
                'Item_code' => 'required|string',
                'Barcode' => 'required|string',
                'Unit' => 'required|string',
                'Purchase_price' => 'required|string',
                'Tax_type' => 'required|string',
                'Tax_rate' => 'required|string',
                'Sales_Price' => 'required|string',
                'MRP' => 'required|string',
                'Discount_type' => 'required|string',
                'Discount' => 'required|string',
                'Profit_margin' => 'required|numeric|min:0|max:99999.99',
                'Opening_Stock' => 'required|string',
                'Alert_Quantity' => 'required|string',
            ]);

            $data = $request->all();

            // Handle file upload
            if ($request->hasFile('item_image')) {
                $file = $request->file('item_image');
                $directory = 'storage/item_images/';
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($directory), $filename);

                // Save the path
                $data['item_image'] = $directory . $filename;
            }

            $item = Item::create($data);
            if ($item) {

                $lastId = $item->id;
                $opening_stack = $request->Opening_stock;
                if ($opening_stack > 0) {
                    warehouseItem::firstOrCreate(attributes: [
                        'store_id' => $request->store_id,
                        'warehouse_id' => $request->Warhouse,
                        'available_qty' => $request->Opening_stock,
                        'item_id' => $lastId,
                    ]);
                }
            }

            return response()->json([
                'status' => 1,
                'message' => 'Item created successfully',
                'data' => $item
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Item Store Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());

            return response()->json([
                'status' => 0,
                'message' => 'Failed to create item',
                'error' => $e->getMessage()
            ], 500);
        }
    } */


    public function store(Request $request)
    {
        try {
            $request->validate([
                'store_id' => 'required|string',
                'user_id' => 'required|string',
                'category_id' => 'required|string',
                'brand_id' => 'required|string',
                'item_name' => 'required|string',
                'item_image' => 'nullable|file|image|max:5120',
                'SKU' => 'required|string',
                'HSN_code' => 'required|string',
                'Item_code' => 'required|string',
                'Barcode' => 'required|string',
                'Unit' => 'required|string',
                'Purchase_price' => 'required|string',
                'Tax_type' => 'required|string',
                'Tax_rate' => 'required|string',
                'Sales_Price' => 'required|string',
                'MRP' => 'required|string',
                'Discount_type' => 'required|string',
                'Discount' => 'required|string',
                'Profit_margin' => 'required|numeric|min:0|max:99999.99',
                'Opening_Stock' => 'required|numeric',
                'Alert_Quantity' => 'required|string',
                'Warehouse' => 'required|string', // Added to store in warehouse table
            ]);

            $data = $request->all();

            // Handle file upload
            if ($request->hasFile('item_image')) {
                $file = $request->file('item_image');
                $directory = 'storage/item_images/';
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($directory), $filename);
                $data['item_image'] = $directory . $filename;
            }

            // Create item
            $item = Item::create($data);

            if ($item && $request->Opening_Stock > 0) {
                WarehouseItem::firstOrCreate(
                    [
                        'store_id' => $request->store_id,
                        'warehouse_id' => $request->Warehouse,
                        'item_id' => $item->id,
                    ],
                    [
                        'available_qty' => $request->Opening_Stock
                    ]
                );
            }

            return response()->json([
                'status' => 1,
                'message' => 'Item created successfully',
                'data' => $item
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Item Store Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());

            return response()->json([
                'status' => 0,
                'message' => 'Failed to create item',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    // Update an existing Item
    public function update(Request $request, $id)
    {
        try {

            $validated = $request->validate([
                'store_id' => 'required|integer',
                'Warehouse' => 'required|integer',
                'Opening_Stock' => 'required|numeric',

            ]);

            // Find item
            $item = Item::findOrFail($id);
            $item->update($validated + $request->only([
                // other allowed fields here
                'item_name',
                'SKU',
                'HSN_code'
            ]));

            // Update or create warehouse item
            WarehouseItem::updateOrCreate(
                [
                    'store_id' => $validated['store_id'],
                    'warehouse_id' => $validated['Warehouse'],
                    'item_id' => $item->id,
                ],
                [
                    'available_qty' => $validated['Opening_Stock']
                ]
            );

            return response()->json([
                'status' => 1,
                'message' => 'Item updated successfully',
                'data' => $item
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Error updating item: ' . $e->getMessage()
            ], 500);
        }
    }


    // View a single Item
    public function show($storeid, $userid)
    {
        try {
            $item = Item::where('store_id', $storeid)
                ->where('user_id', $userid)
                ->firstOrFail();

            return response()->json($item);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Item not found'], 404);
        }
    }
    public function single_show(Request $request)
    {
        $storeid = $request->query('store_id');
        $userid = $request->query('user_id');

        //  \Log::info("store_id = $storeid, user_id = $userid"); // Debug log

        $items = Item::where('store_id', $storeid)
            ->where('user_id', $userid)
            ->get();

        if ($items->isNotEmpty()) {
            return response()->json([
                'message' => 'Item Detail',
                'data' => $items,
                'status' => 1
            ], 200);
        }

        return response()->json(['message' => 'Item not found', 'data' => [], 'status' => 0], 404);
    }




    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Item deleted']);
    }
}
