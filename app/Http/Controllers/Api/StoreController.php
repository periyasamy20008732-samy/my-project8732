<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Warehouse;
use App\Models\Customer;
use App\Models\AcAccount;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



class StoreController extends Controller
{
    /**
     * List stores with category counts
     */
    public function index(Request $request)
    {
        try {
          
            $storeCode = $request->input('store_code');
            $user = auth()->user();

            // 1. If store_code provided
            if ($storeCode) {
                $stores = $this->getStoresBySql("s.store_code = ?", [$storeCode]);
                return $this->jsonResponse($stores, 'Store Details', 'Store Not Found');
            }

            // 2. Require authenticated user
            if (!$user) {
                return $this->jsonResponse([], 'Unauthenticated user', '', 401);
            }

            // 3. If user's store_id is set
            if (!empty($user->store_id) && $user->store_id !== '0') {
                $stores = $this->getStoresBySql("s.id = ?", [$user->store_id]);
                if (!empty($stores)) {
                    return $this->jsonResponse($stores, 'Store from user\'s store_id');
                }
            }

            // 4. Stores owned by user
            $stores = $this->getStoresBySql("s.user_id = ?", [$user->id]);
            return $this->jsonResponse($stores, 'Store List', 'No Stores Found');
        } catch (\Throwable $e) {
         
           
            return response()->json([
                'message' => 'Internal server error',
                'data' => [],
                'status' => 500,
            ], 500);
        }
    }

    /**
     * Store a new store
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_code' => 'required|string',
            'slug'       => 'required|string',
            'store_logo' => 'sometimes|file|image|max:2048',
        ]);

        $existingStore = Store::where('store_code', $request->store_code)
            ->orWhere('slug', $request->slug)
            ->first();

        if ($existingStore) {
            return response()->json([
                'status'  => 0,
                'message' => 'Store already exists with given store code or slug.',
                'data'    => $existingStore
            ], 409);
        }

        if ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            $directory = 'storage/public/store/';
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($directory), $imageName);
            $request['store_logo'] = $directory . $imageName;
        }

        $store = Store::create($request->all());

        if ($store) {
            AcAccount::create($request->all());
        }

        return response()->json([
            'status'  => 1,
            'message' => 'Store created successfully',
            'data'    => $store
        ], 200);
    }

    /**
     * Update an existing Store
     */
    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $store->update($request->all());

        return response()->json([
            'status'  => 1,
            'message' => 'Store Details updated successfully',
            'data'    => $store
        ]);
    }

    /**
     * View a single Store
     */
    public function show($id)
    {
        return response()->json(Store::findOrFail($id));
    }

    /**
     * Delete a Store
     */
    public function destroy($id)
    {
        Store::findOrFail($id)->delete();
        return response()->json(['message' => 'Store deleted']);
    }

    /**
     * Single store by store_code
     */
    public function single_show(Request $request)
    {
        $store = Store::where('store_code', $request->query('store_code'))->get();

        return $this->jsonResponse($store, 'Store Detail', 'Store Detail Not Found', 404);
    }

    /**
     * Helper to run SQL and fetch stores with category count
     */
 private function getStoresBySql($whereClause, $params)
{
    return DB::select("
        SELECT 
            s.id,
            s.user_id,
            s.store_code,
            s.store_name,
            s.address,
            s.phone,
            s.email,
            s.created_at,
            s.updated_at,
            COUNT(DISTINCT c.id) AS category_count,
            COUNT(DISTINCT w.id) AS warehouse_count
        FROM store s
        LEFT JOIN categories c ON c.store_id = s.id
        LEFT JOIN warehouse w ON w.store_id = s.id
        WHERE {$whereClause}
        GROUP BY 
            s.id,
            s.user_id,
            s.store_code,
            s.store_name,
            s.address,
            s.phone,
            s.email,
            s.created_at,
            s.updated_at
    ", $params);
}

    /**
     * Helper to format JSON response
     */
    private function jsonResponse($data, $successMsg, $failMsg = 'No Data Found', $failStatus = 0)
    {
        if (empty($data)) {
            return response()->json([
                'message' => $failMsg,
                'data'    => [],
                'status'  => $failStatus,
            ], 200);
        }

        return response()->json([
            'message'    => $successMsg,
            'data'       => $data,
            'totalstore' => is_array($data) ? count($data) : $data->count(),
            'status'     => 1,
        ], 200);
    }
}