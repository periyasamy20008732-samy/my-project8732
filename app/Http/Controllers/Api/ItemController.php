<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\SalesItem;
use App\Models\SalesItemReturn;
use App\Models\Purchaseitem;
use App\Models\PurchaseitemReturn;
use App\Models\WarehouseItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

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
                //   'user_id' => 'required|string',
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
            $data['user_id'] = auth()->id();

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
        try {
            $item = Item::findOrFail($id);


            SalesItem::where('item_id', $id)->delete();
            SalesItemReturn::where('item_id', $id)->delete();
            Purchaseitem::where('item_id', $id)->delete();
            PurchaseitemReturn::where('item_id', $id)->delete();
            WarehouseItem::where('item_id', $id)->delete();
            $item->delete();

            return response()->json([
                'status' => 1,
                'message' => 'Item and related records deleted successfully'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Item not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function item_bulkpost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,txt|max:5120'
        ]);


        try {

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $save_path = $file->storeAs('item_bulk_import', $filename, 'private');
            }

            $path = $request->file('file')->getRealPath();


            // Load file using PhpSpreadsheet
            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // First row is header
            $header = array_map('strtolower', array_shift($rows));

            $insertData = [];
            $skipped    = [];

            foreach ($rows as $row) {
                $data = array_combine($header, $row);
                $item_name       = trim($data['item_name'] ?? '');
                $hsn_code        = trim($data['hsn_code'] ?? '');
                $purchase_price  = is_numeric($data['purchase_price'] ?? null) ? (float)$data['purchase_price'] : 0;
                $tax_type        = trim($data['tax_type'] ?? '');
                $tax_rate        = is_numeric($data['tax_rate'] ?? null) ? (float)$data['tax_rate'] : 0;
                $sales_price     = is_numeric($data['sales_price'] ?? null) ? (float)$data['sales_price'] : 0;
                $mrp             = is_numeric($data['mrp'] ?? null) ? (float)$data['mrp'] : 0;
                $discount_type   = trim($data['discount_type'] ?? '');
                $discount        = is_numeric($data['discount'] ?? null) ? (float)$data['discount'] : 0;
                $opening_stock   = is_numeric($data['opening_stock'] ?? null) ? (float)$data['opening_stock'] : 0;
                $sku             = trim($data['sku'] ?? '');
                $description     = $data['description'] ?? null;


                // Skip empty rows
                if (!$item_name || !$sku) {
                    $skipped[] = [
                        'item_name' => $item_name,
                        'SKU'       => $sku,
                        'reason'    => 'Missing item_name or SKU'
                    ];
                    continue;
                }

                // Skip if item_name OR SKU already exists
                if (Item::where('item_name', $item_name)->orWhere('SKU', $sku)->exists()) {
                    $skipped[] = [
                        'item_name' => $item_name,
                        'SKU'       => $sku,
                        'reason'    => 'Already exists'
                    ];
                    continue;
                }

                $insertData[] = [
                    'user_id' => auth()->id(),
                    'store_id' => auth()->user()->store_id,
                    'item_name'   => $item_name,
                    'HSN_code' => $hsn_code,
                    'Purchase_price' => $purchase_price,
                    'Tax_type'  => $tax_type,
                    'Tax_rate'  => $tax_rate,
                    'Sales_Price' => $sales_price,
                    'MRP' => $mrp,
                    'Discount_type'  =>  $discount_type,
                    'Discount'  => $discount,
                    'Opening_Stock' => $opening_stock,
                    'SKU'         => $sku,
                    'description' => $description,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }

            if (!empty($insertData)) {
                Item::insert($insertData);
            }

            // if ($request->hasFile('file')) {
            //     $file = $request->file('file');
            //     $filename = time() . '_' . $file->getClientOriginalName();
            //     $save_path = $file->storeAs('item_bulk_import', $filename, 'private');
            // }

            return response()->json([
                'status'   => true,
                'message'  => 'Bulk import completed',
                'inserted_count' => count($insertData),
                'inserted' => $insertData,
                'skipped_count' => count($skipped),
                'skipped'  => $skipped,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Import failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
