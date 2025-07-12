<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockAdjustmentItem;

class StockAdjustmentItemController extends Controller
{

    public function index()
    {
        $stock = StockAdjustmentItem::all();
        if ($stock->isEmpty()) {
            return response()->json([
                'message' => 'Stock Adjustment Item Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {
            return response()->json([
                'message' => 'Stock Adjustment Item Details',
                'data' => $stock,
                'status' => 1
            ], 200);
        }
    }
    public function store(Request $request)
    {


        $stock = StockAdjustmentItem::create($request->all());

        return response()->json([
            'message' => 'Stock Adjustment Item Detail Created Successfully',
            'data' => $stock,
            'status' => 1

        ], 201);
    }
    public function update(Request $request, $id)
    {
        $stock = StockAdjustmentItem::findOrFail($id);

        $stock->update($request->all());

        return response()->json([
            'message' => 'Stock Adjustment Item Details Updated Successfully',
            'data' => $stock,
            'status' => 1
        ]);
    }
    public function destroy($id)
    {
        $stock = StockAdjustmentItem::findOrFail($id);
        $stock->delete();

        return response()->json([
            'message' => 'Stock Adjustment Item Detail Deleted Successfully',
            'status' => 1

        ]);
    }
}