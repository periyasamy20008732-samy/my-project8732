<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerController extends Controller
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

            // Fetch customers with only the country relationship
            $customers = Customer::with(['country'])
                ->whereIn('store_id', $storeIds)
                ->orWhere('user_id', $user->id)
                ->get();

            // Get dashboard insights
            $totalCustomers = $customers->count();
            $newCustomersLast30Days = Customer::whereIn('store_id', $storeIds)
                ->where('created_at', '>=', now()->subDays(30))
                ->count();

            if ($customers->isEmpty()) {
                return response()->json([
                    'message' => 'Customer Detail Not Found',
                    'data' => [],
                    'total' => 0,
                    'status' => 0,
                    'insights' => [
                        'total_customers' => 0,
                        'new_customers_last_30_days' => 0
                    ]
                ], 200);
            }

            // Add store_name without including the full store object
            $customers->transform(function ($customer) {
                $customer->store_name = Store::find($customer->store_id)->name ?? 'No Store';
                // Remove the store relationship if it was loaded
                unset($customer->store);
                return $customer;
            });

            return response()->json([
                'message' => 'Customer List',
                'data' => $customers,
                'total' => $totalCustomers,
                'status' => 1,
                'insights' => [
                    'total_customers' => $totalCustomers,
                    'new_customers_last_30_days' => $newCustomersLast30Days
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch customers: ' . $e->getMessage(),
                'data' => [],
                'status' => 0
            ], 500);
        }
    }



    // Store a new Customer
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|unique:customers,customer_name',
        ]);

        $customer = Customer::create($request->all());

        return response()->json([
            'message' => 'Customer created successfully',
            'data' => $customer
        ], 201);
    }

    // Update an existing AcAccount
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $request->validate([
            'customer_name' => 'required|string|unique:customers,customer_name',
        ]);

        $customer->update($request->all());

        return response()->json([
            'message' => 'Customer Details updated successfully',
            'data' => $customer
        ]);
    }


    public function show(Request $request, $store_id = null)
    {
        try {
            // Get store_id from either URL parameter or query string
            $storeId = $store_id ?? $request->query('store_id');

            // If no store_id was provided at all
            if (empty($storeId)) {
                return response()->json([
                    'message' => 'Store ID is required',
                    'data' => [],
                    'total' => 0,
                    'status' => 0,
                ], 400); // Using 400 Bad Request status for missing parameter
            }

            // Fetch customers for the specific store only
            $customers = Customer::with(['country'])
                ->where('store_id', $storeId)
                ->get();

            $totalCustomers = $customers->count();

            if ($customers->isEmpty()) {
                return response()->json([
                    'message' => 'No customers found for store ID: ' . $storeId,
                    'data' => [],
                    'total' => 0,
                    'status' => 0
                ], 200);
            }

            // Add store_name without including the full store object
            $customers->transform(function ($customer) {
                $customer->store_name = Store::find($customer->store_id)->name ?? 'No Store';
                // Remove the store relationship if it was loaded
                unset($customer->store);
                return $customer;
            });

            return response()->json([
                'message' => 'Customer List for Store',
                'data' => $customers,
                'total' => $totalCustomers,
                'status' => 1
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch customers: ' . $e->getMessage(),
                'data' => [],
                'status' => 0
            ], 500);
        }
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
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(['message' => 'Customer deleted']);
    }


    public function single_show(Request $request)
    {
        $storeid = $request->query('store_id');
        // $userid = $request->query('customer_id');

        $customer = Customer::where('store_id', $storeid)
            // ->where('user_id', $userid)
            ->get();

        if ($customer->isNotEmpty()) {
            return response()->json([
                'message' => 'Customer Detail',
                'data' => $customer,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'Customer Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }
}
