<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockAdjustment;

class StockAdjustmentController extends Controller
{

    public function index()
    {
        $stock = StockAdjustment::all();
        if ($stock->isEmpty()) {
            return response()->json([
                'message' => 'StockAdjustment Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {
            return response()->json([
                'message' => 'StockAdjustment Details',
                'data' => $stock,
                'status' => 1
            ], 200);
        }
    }
    public function store(Request $request)
    {


        $stock = StockAdjustment::create($request->all());

        return response()->json([
            'message' => 'StockAdjustment Detail Created Successfully',
            'data' => $stock,
            'status' => 1

        ], 201);
    }
    public function update(Request $request, $id)
    {
        $stock = StockAdjustment::findOrFail($id);

        $stock->update($request->all());

        return response()->json([
            'message' => 'StockAdjustment Details Updated Successfully',
            'data' => $stock,
            'status' => 1
        ]);
    }
    public function destroy($id)
    {
        $stock = StockAdjustment::findOrFail($id);
        $stock->delete();

        return response()->json([
            'message' => 'StockAdjustment Detail Deleted Successfully',
            'status' => 1

        ]);
    }
}