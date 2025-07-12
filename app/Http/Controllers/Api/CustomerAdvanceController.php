<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerAdvance;

class CustomerAdvanceController extends Controller
{
    public function index()
    {
        $customer = CustomerAdvance::all();


        if ($customer->isEmpty()) {

            return response()->json([
                'message' => 'Customer Advance  Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Customer Advance List',
                'data' => $customer,
                'status' => 1
            ], 200);

        }
    }

    // Store a new Customer
    public function store(Request $request)
    {
        //$request->validate([
        // 'customer_name' => 'required|string|unique:customers,customer_name',
        //]);

        $customer = CustomerAdvance::create($request->all());

        return response()->json([
            'message' => 'Customer  Advance   created successfully',
            'data' => $customer
        ], 201);
    }

    // Update an existing AcAccount
    public function update(Request $request, $id)
    {
        $customer = CustomerAdvance::findOrFail($id);
        /// $request->validate([
        //    'customer_name' => 'required|string|unique:customers,customer_name',
        //  ]);

        $customer->update($request->all());

        return response()->json([
            'message' => 'Customer Advance Details updated successfully',
            'data' => $customer
        ]);
    }

    // View a single Customer
    public function show($store_id)
    {
        try {
            // Get customer where store_id matches
            $customer = CustomerAdvance::where('store_id', $store_id)->get();

            // Return customer as JSON
            return response()->json([
                'success' => true,
                'data' => $customer
            ]);
        } catch (ModelNotFoundException $e) {
            // Return 404 if no customer found
            return response()->json([
                'success' => false,
                'message' => 'Customer Advance  not found for store_id: ' . $store_id
            ], 404);
        }
    }

    public function destroy($id)
    {
        $customer = CustomerAdvance::findOrFail($id);
        $customer->delete();
        return response()->json(['message' => 'Customer Advance Details deleted']);
    }
}