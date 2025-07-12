<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{

    public function index()
    {
        $supplier = Supplier::all();


        if ($supplier->isEmpty()) {

            return response()->json([
                'message' => 'Supplier  Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Supplier List',
                'data' => $supplier,
                'status' => 1
            ], 200);

        }
    }

    // Store a new Supplier
    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|unique:supplier,supplier_name',
        ]);

        $supplier = Supplier::create($request->all());

        return response()->json([
            'message' => 'Supplier created successfully',
            'data' => $supplier
        ], 201);
    }

    // Update an existing Supplier
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $request->validate([
            // 'supplier_name' => 'required|string|unique:supplier,supplier_name',
        ]);

        $supplier->update($request->all());

        return response()->json([
            'message' => 'Supplier Details updated successfully',
            'data' => $supplier
        ]);
    }

    // View a single Supplier
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return response()->json(['message' => 'Supplier deleted']);
    }



    public function single_show(Request $request)
    {
        $storeid = $request->query('store_id');
        //  $userid = $request->query('user_id');

        $supplier = Supplier::where('store_id', $storeid)
            // ->where('user_id', $userid)
            ->get();

        if ($supplier->isNotEmpty()) {
            return response()->json([
                'message' => 'supplier Detail',
                'data' => $supplier,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'supplier Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }

}