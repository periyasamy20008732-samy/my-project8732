<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
class WarehouseController extends Controller
{
    public function index()
    {
        $warehouse = Warehouse::all();


        if ($warehouse->isEmpty()) {

            return response()->json([
                'message' => 'Warehouse  Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Warehouse List',
                'data' => $warehouse,
                'status' => 1
            ], 200);

        }
    }

    // Store a new Warehouse
    public function store(Request $request)
    {
        $request->validate([
            'warehouse_name' => 'required|string|unique:warehouse,warehouse_name',
        ]);

        $warehouse = Warehouse::create($request->all());

        return response()->json([
            'message' => 'Warehouse created successfully',
            'data' => $warehouse
        ], 201);
    }

    // Update an existing Warehouse
    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $request->validate([
            'warehouse_name' => 'required|string|unique:warehouse,warehouse_name',
        ]);

        $warehouse->update($request->all());

        return response()->json([
            'message' => 'Warehouse Details updated successfully',
            'data' => $warehouse
        ]);
    }

    // View a single Warehouse
    public function show($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return response()->json($warehouse);
    }
    public function destroy($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();
        return response()->json(['message' => 'Warehouse deleted']);
    }

    public function warehouseitemupdate()
    {

    }

    public function single_show(Request $request)
    {
        $storeid = $request->query('store_id');
        //  $userid = $request->query('user_id');

        $warehouse = Warehouse::where('store_id', $storeid)
            // ->where('user_id', $userid)
            ->get();

        if ($warehouse->isNotEmpty()) {
            return response()->json([
                'message' => 'Warehouse Detail',
                'data' => $warehouse,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'Warehouse Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }

}