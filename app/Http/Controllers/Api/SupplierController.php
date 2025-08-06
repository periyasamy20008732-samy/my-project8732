<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SupplierController extends Controller
{

    public function index(Request $request)
    {
        try {
            $user = auth()->user();
            $storeId = $request->query('store_id');

            // Determine effective store IDs
            $storeIds = $this->getStoreIds($user, $storeId);

            if (empty($storeIds)) {
                return response()->json([
                    'message' => 'No stores found for this user',
                    'data' => [],
                    'total' => 0,
                    'status' => 0,
                ], 200);
            }

            // Fetch suppliers with store name
            $suppliers = Supplier::with(['store'])
                ->whereIn('store_id', $storeIds)
                ->get();

            // Get dashboard insights
            $totalSuppliers = $suppliers->count();
            $newSuppliersLast30Days = Supplier::whereIn('store_id', $storeIds)
                ->where('created_at', '>=', now()->subDays(30))
                ->count();

            if ($suppliers->isEmpty()) {
                return response()->json([
                    'message' => 'Supplier Detail Not Found',
                    'data' => [],
                    'total' => 0,
                    'status' => 0,
                    'insights' => [
                        'total_suppliers' => 0,
                        'new_suppliers_last_30_days' => 0
                    ]
                ], 200);
            }

            // Append store name to each supplier
            $suppliers->transform(function ($supplier) {
                $supplier->store_name = $supplier->store ? $supplier->store->name : null;
                return $supplier;
            });

            return response()->json([
                'message' => 'Supplier List',
                'data' => $suppliers,
                'total' => $totalSuppliers,
                'status' => 1,
                'insights' => [
                    'total_suppliers' => $totalSuppliers,
                    'new_suppliers_last_30_days' => $newSuppliersLast30Days
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch suppliers: ' . $e->getMessage(),
                'data' => [],
                'status' => 0
            ], 500);
        }
    }

    public function show(Request $request, $store_id = null)
    {
        try {
            $storeId = $store_id ?? $request->query('store_id');
            $supplier = Supplier::with(['store'])
                ->where('store_id', $store_id) // Changed from findOrFail to where
                ->get();

            if ($supplier->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No suppliers found for store ID: ' . $store_id,
                    'data' => []
                ], 404);
            }

            // Transform each supplier to add store_name
            $supplier->transform(function ($item) {
                $item->store_name = $item->store ? $item->store->store_name : null;
                unset($item->store); // Remove the full store object
                return $item;
            });

            return response()->json([
                'success' => true,
                'data' => $supplier
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier not found with id: ' . $storeId
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch supplier: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();

            return response()->json([
                'message' => 'Supplier deleted successfully',
                'status' => 1
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Supplier not found with id: ' . $id,
                'status' => 0
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete supplier: ' . $e->getMessage(),
                'status' => 0
            ], 500);
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
    private function getStoreIds($user, $storeId = null)
    {
        $storeIds = [];

        if ($storeId) {
            $storeIds = [trim($storeId)];
        } elseif (!empty($user->store_id) && $user->store_id !== '0') {
            $storeIds = [trim($user->store_id)];
        } else {
            // fallback to stores owned by user
            $storeIds = DB::table('store')
                ->where('user_id', $user->id)
                ->pluck('id')
                ->map(fn($id) => (string)$id)
                ->toArray();
        }

        return $storeIds;
    }
}
