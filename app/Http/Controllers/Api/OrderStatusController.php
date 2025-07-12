<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderStatus;


class OrderStatusController extends Controller
{

    public function index()
    {
        $order = OrderStatus::all();
        //$result= User::find($id);return response()->json($order);

        if ($order->isEmpty()) {

            return response()->json([
                'message' => 'Order Status Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Order Status List',
                'data' => $order,
                'status' => 1
            ], 200);

        }
    }

    // Store a new order
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $order = OrderStatus::create($request->all());

        return response()->json([
            'message' => 'Order Status created successfully',
            'data' => $order
        ], 201);
    }

    // Update an existing order
    public function update(Request $request, $id)
    {
        $order = OrderStatus::findOrFail($id);

        $order->update($request->all());

        return response()->json([
            'message' => 'Order Status updated successfully',
            'data' => $order
        ]);
    }

    // View a single order
    public function show($id)
    {
        $order = OrderStatus::findOrFail($id);
        return response()->json($order);
    }
}