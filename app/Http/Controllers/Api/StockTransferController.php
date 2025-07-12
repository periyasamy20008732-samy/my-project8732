<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockTransfer;

class StockTransferController extends Controller
{

    public function index()
    {
        $stock = StockTransfer::all();
        if ($stock->isEmpty()) {
            return response()->json([
                'message' => 'Stock Transfer Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {
            return response()->json([
                'message' => 'Stock Transfer    Details',
                'data' => $stock,
                'status' => 1
            ], 200);
        }
    }
    public function store(Request $request)
    {


        $stock = StockTransfer::create($request->all());

        return response()->json([
            'message' => 'Stock Transfer Detail Created Successfully',
            'data' => $stock,
            'status' => 1

        ], 201);
    }
    public function update(Request $request, $id)
    {
        $stock = StockTransfer::findOrFail($id);

        $stock->update($request->all());

        return response()->json([
            'message' => 'Stock  Transfer Details Updated Successfully',
            'data' => $stock,
            'status' => 1
        ]);
    }
    public function destroy($id)
    {
        $stock = StockTransfer::findOrFail($id);
        $stock->delete();

        return response()->json([
            'message' => 'Stock Transfer Detail Deleted Successfully',
            'status' => 1

        ]);
    }
}