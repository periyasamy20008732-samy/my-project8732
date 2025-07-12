<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerShippingAddress;

class CustomerShippingAddressController extends Controller
{
    public function index()
    {
        $customer = CustomerShippingAddress::all();


        if ($customer->isEmpty()) {

            return response()->json([
                'message' => 'Customer Shipping Address  Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Customer Shipping AddressList',
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

        $customer = CustomerShippingAddress::create($request->all());

        return response()->json([
            'message' => 'Customer Shipping Address created successfully',
            'data' => $customer
        ], 201);
    }

    // Update an existing AcAccount
    public function update(Request $request, $id)
    {
        $customer = CustomerShippingAddress::findOrFail($id);
        /// $request->validate([
        //    'customer_name' => 'required|string|unique:customers,customer_name',
        //  ]);

        $customer->update($request->all());

        return response()->json([
            'message' => 'Customer Shipping Address Details updated successfully',
            'data' => $customer
        ]);
    }

    // View a single Customer
    public function show($store_id)
    {
        try {
            // Get customer where store_id matches
            $customer = CustomerShippingAddress::where('store_id', $store_id)->get();

            // Return customer as JSON
            return response()->json([
                'success' => true,
                'data' => $customer
            ]);
        } catch (ModelNotFoundException $e) {
            // Return 404 if no customer found
            return response()->json([
                'success' => false,
                'message' => 'Customer Shipping Address not found for store_id: ' . $store_id
            ], 404);
        }
    }

    public function destroy($id)
    {
        $customer = CustomerShippingAddress::findOrFail($id);
        $customer->delete();
        return response()->json(['message' => 'Customer Shipping Address Details deleted']);
    }


    public function single_show(Request $request)
    {
        //$storeid = $request->query('store_id');
        $userid = $request->query('customer_id');

        $customer = CustomerShippingAddress::where('customer_id', $userid)
            //   ->where('user_id', $userid)
            ->get();

        if ($customer->isNotEmpty()) {
            return response()->json([
                'message' => 'CustomerShippingAddress Detail',
                'data' => $customer,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'CustomerShippingAddress Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }



}