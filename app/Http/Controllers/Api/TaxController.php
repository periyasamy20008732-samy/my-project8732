<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tax;


class TaxController extends Controller
{

    public function index()
    {
        $tax = Tax::all();
        if ($tax->isEmpty()) {
            return response()->json([
                'message' => 'Tax Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {
            return response()->json([
                'message' => 'Tax Details',
                'data' => $tax,
                'status' => 1
            ], 200);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|string',
            'tax_name' => 'required|string',
            'tax' => 'required|string',
            'if_group' => 'required|string',
            'subtax_ids' => 'required|string',
            'status' => 'required|string'
        ]);

        $tax = Tax::create($request->all());

        return response()->json([
            'message' => 'Tax Detail Created Successfully',
            'data' => $tax,
            'status' => 1

        ], 201);
    }
    public function update(Request $request, $id)
    {
        $tax = tax::findOrFail($id);

        $tax->update($request->all());

        return response()->json([
            'message' => 'Tax Details Updated Successfully',
            'data' => $tax,
            'status' => 1
        ]);
    }
    public function destroy($id)
    {
        $tax = tax::findOrFail($id);
        $tax->delete();

        return response()->json([
            'message' => 'Tax Detail Deleted Successfully',
            'status' => 1

        ]);
    }
}