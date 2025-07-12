<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
class ItemController extends Controller
{


    // View all Item
    public function index()
    {
        $item = Item::all();
        // $item = Item::where('user_id', Auth::id())->get();


        if ($item->isEmpty()) {

            return response()->json([
                'message' => 'Item Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Item List',
                'data' => $item,
                'status' => 1
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

    // Store a new Item
    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|string',
            'user_id' => 'required|string',
            'category_id' => 'required|string',
            'brand_id' => 'required|string',
            'item_name' => 'required|string',
            'item_image' => '',
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
            'Profit_margin' => 'required|string',
            'Warhouse' => 'required|string',
            'Opening_stock' => 'required|string',
            'Alert_Quantity' => 'required|string',

        ]);

        /* $file = $request->item_image;
          $directory = 'storage/public/item/';
          $imageName = time() . '.' . $file->getClientOriginalname();
          $file->move(public_path($directory), $imageName);
          //  $data -> image = $directory.$imageName;
          $data = $request->all();
          $data['item_image'] = $directory . $imageName;*/
        $data = $request->all();
        $item = Item::create($data);


        //  $item = Item::create($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Item created successfully',
            'data' => $item
        ], 201);
    }
    // Update an existing Item
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $item->update($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Item updated successfully',
            'data' => $item
        ]);
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