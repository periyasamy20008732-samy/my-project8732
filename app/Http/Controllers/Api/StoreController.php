<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use App\Models\AcAccount;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = auth()->user();
            $storeId = $request->query('store_id');

            // Determine effective store IDs
            $storeIds = [];

            if ($storeId) {
                $storeIds = [trim($storeId)];
            } elseif (!empty($user->store_id) && $user->store_id != '0' && $user->store_id != 0) {
                $storeIds = [trim($user->store_id)];
            } else {
                // fallback to stores owned by user
                $storeIds = \App\Models\Store::where('user_id', $user->id)
                    ->pluck('id')
                    ->toArray();
            }

            if (empty($storeIds)) {
                return response()->json([
                    'message' => 'No stores found for this user',
                    'data'    => [],
                    'total'   => 0,
                    'status'  => 0,
                ], 200);
            }

            // Fetch stores with relations + counts
            $stores = \App\Models\Store::with('user:id,name,email')
                ->withCount([
                    'suppliers',
                    'customers',
                    'purchases',
                    'purchaseReturns',
                    'sales',
                    'salesReturns',
                    'warehouses',
                    'categories'
                ])
                ->whereIn('id', $storeIds)
                ->orderBy('store_name')
                ->get()
                ->map(function ($store) {
                    return [
                        'id'                => $store->id,
                        'store_name'        => $store->store_name,
                        'store_code'        => $store->store_code,
                        'store_logo'        => $store->store_logo,
                        'store_phone'       => $store->mobile ?? $store->phone,
                        'store_email'       => $store->email,
                        'store_address'     => $store->address,
                        'store_city'        => $store->city,
                        'store_state'       => $store->state,
                        'store_country'     => $store->country,
                        'store_postal_code' => $store->postcode,
                        'currency'          => $store->currency_id,
                        'currency_symbol'   => $store->currencywsymbol_id,
                        'currency_position' => $store->currency_placement,
                        'timezone'          => $store->timezone,
                        'language'          => $store->language_id,
                        'date_format'       => $store->date_format,
                        'time_format'       => $store->time_format,
                        'fiscal_year'       => null, // not in schema
                        'tax_number'        => $store->gst_no ?? $store->vat_no ?? $store->pan_no,
                        'website'           => $store->website ?? $store->store_website,
                        'status'            => $store->status,
                        'created_at'        => $store->created_at,
                        'updated_at'        => $store->updated_at,
                        'owner_name'        => $store->user->name ?? null,
                        'owner_email'       => $store->user->email ?? null,

                        // Counts
                        'suppliers_count'       => $store->suppliers_count,
                        'customers_count'       => $store->customers_count,
                        'purchases_count'       => $store->purchases_count,
                        'purchase_returns_count' => $store->purchase_returns_count,
                        'sales_count'           => $store->sales_count,
                        'sales_returns_count'   => $store->sales_returns_count,
                        'warehouses_count'       => $store->warehouses_count,
                        'categories_count'       => $store->categories_count,
                    ];
                });

            $totalstores = $stores->count();

            return response()->json([
                'message'     => $totalstores > 0 ? 'Store List' : 'No Stores Found',
                'data'        => $stores,
                'totalstore'  => $totalstores,
                'status'      => $totalstores > 0 ? 1 : 0
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message'     => 'Internal server error',
                'error'       => $e->getMessage(),
                'file'        => $e->getFile(),
                'line'        => $e->getLine(),
                'data'        => [],
                'totalstore'  => 0,
                'status'      => 0,
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
            // 1. Validate the mandatory fields
            $request->validate([
                'user_id'    => 'required|integer|exists:users,id',
                'store_code' => 'required|string',
                'slug'       => 'required|string',
                'store_logo' => 'sometimes|file|image|max:2048'
            ]);

            // 2. Take all request data
            $data = $request->all();

            // 3. Check if store already exists
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

            // 4. Handle file upload (if present)
            if ($request->hasFile('store_logo')) {
                $file = $request->file('store_logo');
                $directory = 'storage/store/';
                $imageName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($directory), $imageName);

                $data['store_logo'] = $directory . $imageName;
            }

            // 5. Create Store (all fillable fields allowed)
            $store = Store::create($data);

            // 6. Create related Account (if needed)
            AcAccount::create([
                'store_id' => $store->id,
                // Add other required fields
            ]);

            return response()->json([
                'status'  => 1,
                'message' => 'Store created successfully',
                'data'    => $store
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 0,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
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
