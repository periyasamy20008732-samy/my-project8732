<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::all();
        if ($sales->isEmpty()) {
            return response()->json([
                'message' => 'Sales Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {
            return response()->json([
                'message' => 'Sales Details',
                'data' => $sales,
                'status' => 1
            ], 200);
        }
    }
    public function store(Request $request)
    {


        $sales = Sales::create($request->all());

        return response()->json([
            'message' => 'Sales Detail Created Successfully',
            'data' => $sales,
            'status' => 1

        ], 201);
    }
    public function update(Request $request, $id)
    {
        $sales = Sales::findOrFail($id);

        $sales->update($request->all());

        return response()->json([
            'message' => 'Sales Details Updated Successfully',
            'data' => $sales,
            'status' => 1
        ]);
    }
    public function destroy($id)
    {
        $sales = Sales::findOrFail($id);
        $sales->delete();

        return response()->json([
            'message' => 'Sales Detail Deleted Successfully',
            'status' => 1

        ]);
    }

    public function single_show(Request $request)
    {
        $storeid = $request->query('store_id');
        // $userid = $request->query('user_id');

        $sales = Sales::where('store_id', $storeid)
            // ->where('user_id', $userid)
            ->get();

        if ($sales->isNotEmpty()) {
            return response()->json([
                'message' => 'Sales Detail',
                'data' => $sales,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'Sales Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }
}