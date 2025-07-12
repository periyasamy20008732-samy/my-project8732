<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesReturn;

class SalesReturnController extends Controller
{

    public function index()
    {
        $salesreturn = SalesReturn::all();
        if ($salesreturn->isEmpty()) {
            return response()->json([
                'message' => 'Sales Return Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {
            return response()->json([
                'message' => 'Sales Return Details',
                'data' => $salesreturn,
                'status' => 1
            ], 200);
        }
    }
    public function store(Request $request)
    {


        $salesreturn = SalesReturn::create($request->all());

        return response()->json([
            'message' => 'Sales Return Detail Created Successfully',
            'data' => $salesreturn,
            'status' => 1

        ], 201);
    }
    public function update(Request $request, $id)
    {
        $salesreturn = SalesReturn::findOrFail($id);

        $salesreturn->update($request->all());

        return response()->json([
            'message' => 'Sales0 Return Details Updated Successfully',
            'data' => $salesreturn,
            'status' => 1
        ]);
    }
    public function destroy($id)
    {
        $salesreturn = SalesReturn::findOrFail($id);
        $salesreturn->delete();

        return response()->json([
            'message' => 'Sales Return Detail Deleted Successfully',
            'status' => 1

        ]);
    }
}