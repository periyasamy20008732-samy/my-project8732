<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockTransferItem;

class StockTransferItemController extends Controller
{

    public function index()
    {
        $stock = StockTransferItem::all();
        if ($stock->isEmpty()) {
            return response()->json([
                'message' => 'Stock  Transfer Item  Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {
            return response()->json([
                'message' => 'Stock Transfer Item  Details',
                'data' => $stock,
                'status' => 1
            ], 200);
        }
    }
    public function store(Request $request)
    {


        $stock = StockTransferItem::create($request->all());

        return response()->json([
            'message' => 'Stock Transfer Item  Detail Created Successfully',
            'data' => $stock,
            'status' => 1

        ], 201);
    }
    public function update(Request $request, $id)
    {
        $stock = StockTransferItem::findOrFail($id);

        $stock->update($request->all());

        return response()->json([
            'message' => 'Stock Transfer Item Details Updated Successfully',
            'data' => $stock,
            'status' => 1
        ]);
    }
    public function destroy($id)
    {
        $stock = StockTransferItem::findOrFail($id);
        $stock->delete();

        return response()->json([
            'message' => 'Stock Transfer Item Detail Deleted Successfully',
            'status' => 1

        ]);
    }
}