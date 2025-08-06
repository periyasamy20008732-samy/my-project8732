<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Store;
use App\Models\Item;



class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        

        $user = auth()->user();
        $storeId = $request->input('store_id');

        $query = Warehouse::query();

        if ($storeId) {
            // Case 1: store_id is provided
            $query->where('store_id', $storeId);
        } else {
            // Case 2: store_id not provided
            if (!empty($user->store_id)) {
                $query->where('store_id', $user->store_id);
            } else {
                // Fetch all stores for this user
                $storeIds = Store::where('user_id', $user->id)->pluck('id')->toArray();
                if (!empty($storeIds)) {
                    $query->whereIn('store_id', $storeIds);
                } else {
                    // No stores found for user
                    return response()->json([
                        'message' => 'No stores found for this user',
                        'data' => [],
                        'status' => 0
                    ], 200);
                }
            }
        }

        $warehouses = $query->get();

        if ($warehouses->isEmpty()) {
            return response()->json([
                'message' => 'Warehouse Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        }

        // Add items_count to each warehouse
        $warehouses = $warehouses->map(function ($warehouse) {
            $itemCount = Item::where(function ($q) use ($warehouse) {
                $q->where('store_id', $warehouse->store_id)
                    ->orWhere('Warehouse', $warehouse->id);
            })->count();

            $warehouse->items_count = $itemCount;
            return $warehouse;
        });

        return response()->json([
            'message' => 'Warehouse List',
            'data' => $warehouses,
            'status' => 1
        ], 200);
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'warehouse_name' => 'required|string|unique:warehouse,warehouse_name',
        ]);

        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $data = $request->all();
        $data['user_id'] = $user->id;

        $warehouse = Warehouse::create($data);

        return response()->json([
            'message' => 'Warehouse created successfully',
            'data' => $warehouse
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);

    } catch (\Exception $e) {
        \Log::error('Warehouse store error', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'request' => $request->all(),
        ]);

        return response()->json([
            'message' => 'Internal server error',
            'error' => $e->getMessage()
        ], 500);
    }
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

    public function warehouseitemupdate() {}

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