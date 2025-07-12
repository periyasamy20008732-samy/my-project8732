<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WarehouseItem;
class WarehouseItemContrtoller extends Controller
{
    public function index()
    {
        $warehouse = WarehouseItem::all();


        if ($warehouse->isEmpty()) {

            return response()->json([
                'message' => 'WarehouseItem  Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'WarehouseItem List',
                'data' => $warehouse,
                'status' => 1
            ], 200);

        }
    }

    // Store a new Warehouse
    public function store(Request $request)
    {
        /*$request->validate([
            'warehouse_name' => 'required|string|unique:warehouse,warehouse_name',
        ]);*/

        $warehouse = WarehouseItem::create($request->all());

        return response()->json([
            'message' => 'WarehouseItem created successfully',
            'data' => $warehouse
        ], 201);
    }

    // Update an existing Warehouse
    public function update(Request $request, $id)
    {
        $warehouse = WarehouseItem::findOrFail($id);
        /*$request->validate([
            'warehouse_name' => 'required|string|unique:warehouse,warehouse_name',
        ]);*/

        $warehouse->update($request->all());

        return response()->json([
            'message' => 'WarehouseItem Details updated successfully',
            'data' => $warehouse
        ]);
    }

    // View a single Warehouse
    public function show($id)
    {
        $warehouse = WarehouseItem::findOrFail($id);
        return response()->json($warehouse);
    }
    public function destroy($id)
    {
        $warehouse = WarehouseItem::findOrFail($id);
        $warehouse->delete();
        return response()->json(['message' => 'WarehouseItem deleted']);
    }

    public function warehouseitemupdate()
    {

    }

    public function single_show(Request $request)
    {
        $storeid = $request->query('warehouse_id');
        //  $userid = $request->query('user_id');

        $warehouse = WarehouseItem::where('warehouse_id', $storeid)
            // ->where('user_id', $userid)
            ->get();

        if ($warehouse->isNotEmpty()) {
            return response()->json([
                'message' => 'WarehouseItem Detail',
                'data' => $warehouse,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'WarehouseItem Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }

}