<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();


        if ($customer->isEmpty()) {

            return response()->json([
                'message' => 'Customer  Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Customer List',
                'data' => $customer,
                'status' => 1
            ], 200);

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

    // View a single Customer
    public function show($store_id)
    {
        try {
            // Get customer where store_id matches
            $customer = Customer::where('store_id', $store_id)->get();

            // Return customer as JSON
            return response()->json([
                'success' => true,
                'data' => $customer
            ]);
        } catch (ModelNotFoundException $e) {
            // Return 404 if no customer found
            return response()->json([
                'success' => false,
                'message' => 'Customer not found for store_id: ' . $store_id
            ], 404);
        }
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