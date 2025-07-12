<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\units;

class UnitsController extends Controller
{
    public function index()
    {
        $unit = Units::all();
        if ($unit->isEmpty()) {
            return response()->json([
                'message' => 'Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {
            return response()->json([
                'message' => 'Units Details',
                'data' => $unit,
                'status' => 1
            ], 200);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|string',
            'parent_id' => 'required|string',
            'unit_name' => 'required|string',
            'unit_value' => 'required|string',
            'description' => 'required|string'
        ]);

        $unit = Units::create($request->all());

        return response()->json([
            'message' => 'Units Detail Created Successfully',
            'data' => $unit,
            'status' => 1

        ], 201);
    }
    public function update(Request $request, $id)
    {
        $unit = Units::findOrFail($id);

        $unit->update($request->all());

        return response()->json([
            'message' => 'Unit Details Updated Successfully',
            'data' => $unit,
            'status' => 1
        ]);
    }
    public function destroy($id)
    {
        $unit = Units::findOrFail($id);
        $unit->delete();

        return response()->json([
            'message' => 'Units Detail Deleted Successfully',
            'status' => 1

        ]);
    }
}