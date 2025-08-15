<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Warehouse;
use App\Models\Customer;
use App\Models\AcAccount;

class StoreController extends Controller
{

    public function index(Request $request)
    {
        try {
            $storeCode = $request->input('store_code');
            $user = auth()->user();

            // Require authenticated user
            if (!$user) {
                return response()->json([
                    'message' => 'Unauthenticated user',
                    'data'    => [],
                    'totalstore' => 0,
                    'status'  => 0
                ], 401);
            }

            $stores = [];

            // 1. If store_code provided
            if ($storeCode) {
                $stores = $this->getStoresBySql("s.store_code = ?", [$storeCode]);
            }
            // 2. If user's store_id is set
            elseif (!empty($user->store_id) && $user->store_id !== '0') {
                $stores = $this->getStoresBySql("s.id = ?", [$user->store_id]);
            }
            // 3. Stores owned by user
            else {
                $stores = $this->getStoresBySql("s.user_id = ?", [$user->id]);
            }

            $totalstores = count($stores);

            return response()->json([
                'message'     => $totalstores > 0 ? 'Store List' : 'No Stores Found',
                'data'        => $stores,
                'totalstore'  => $totalstores,
                'status'      => $totalstores > 0 ? 1 : 0
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Internal server error',
                'data'    => [],
                'totalstore' => 0,
                'status'  => 500,
            ], 500);
        }
    }


    /* public function index()
    {
        try {
            $user = auth()->user();

            if (in_array($user->user_level, [1, 4])) {
                // Store admin sees all stores
                $stores = Store::all();
            } else {
                // Other users see only their own stores
                $stores = Store::where('user_id', $user->id)->get();
            }

            return response()->json([
                'message' => 'Store Detail Fetch Successfully',
                'status' => 1,
                'data' => $stores
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to retrieve stores: ' . $e->getMessage()
            ], 500);
        }
    } */


    public function store(Request $request)
    {
        try {
            // Validate request
            $data = $request->validate([
                'store_code' => 'required|string',
                'slug'       => 'required|string',
                'store_logo' => 'sometimes|file|image|max:2048'
            ]);

            //Check if store already exists
            $existingStore = Store::where('store_code', $data['store_code'])
                ->orWhere('slug', $data['slug'])
                ->first();

            if ($existingStore) {
                return response()->json([
                    'status'  => 0,
                    'message' => 'Store already exists with given store code or slug.',
                    'data'    => $existingStore
                ], 409);
            }

            //  Handle file upload (if present)
            if ($request->hasFile('store_logo')) {
                $file = $request->file('store_logo');
                $directory = 'storage/store/'; // better to avoid "public" in the path
                $imageName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($directory), $imageName);

                // Add uploaded file path to $data
                $data['store_logo'] = $directory . $imageName;
            }

            // Create Store
            $store = Store::create($data);

            // 5 Create related Account (if needed)
            AcAccount::create([
                'store_id' => $store->id,
                // Add other required fields for AcAccount
            ]);

            // 6 Return success response
            return response()->json([
                'status'  => 1,
                'message' => 'Store created successfully',
                'data'    => $store
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 0,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
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
