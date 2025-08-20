<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{

    public function index()
    {
        $order = Order::all();
        //$result= User::find($id);return response()->json($order);

        if ($order->isEmpty()) {

            return response()->json([
                'message' => 'Order Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {

            return response()->json([
                'message' => 'Order List',
                'data' => $order,
                'status' => 1
            ], 200);
        }
    }

    // Store a new order
    public function store(Request $request)
    {
        try {
            $request->validate([
                'unique_order_id' => 'required|string',
                'orderstatus_id' => 'required|string',
                'if_sales' => 'required|string',
                'sales_id' => 'required|string',
                'shipping_address_id' => 'required|string',
                'customer_id' => 'required|string',
                'paid_amount' => 'required|string',

            ]);
            $data = $request->all();
            $data['user_id'] = auth()->id();
            $data['store_id'] = auth()->user()->store_id;
            $order = Order::create($data);
            return response()->json([
                'message' => 'Order created successfully',
                'data' => $order
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Update an existing order
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update($request->all());

        return response()->json([
            'message' => 'Order updated successfully',
            'data' => $order
        ]);
    }

    // View a single order
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }


    public function single_show(Request $request)
    {
        $storeid = $request->query('store_id');
        $userid = $request->query('user_id');

        $order = Order::where('store_id', $storeid)
            ->where('user_id', $userid)
            ->get();

        if ($order->isNotEmpty()) {
            return response()->json([
                'message' => 'Order Detail',
                'data' => $order,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'Order Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }
}
