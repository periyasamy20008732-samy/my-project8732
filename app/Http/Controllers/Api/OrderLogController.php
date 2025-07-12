<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderLog;


class OrderLogController extends Controller
{

    public function index()
    {
        $order = OrderLog::all();
        //$result= User::find($id);return response()->json($order);

        if ($order->isEmpty()) {

            return response()->json([
                'message' => 'Order Log Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Order Log Status List',
                'data' => $order,
                'status' => 1
            ], 200);

        }
    }

    // Store a new order
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string',
            'description' => 'required|string',
            'subject' => 'required|string',
            'order_status' => 'required|string',
            'log_by' => 'required|string'
        ]);

        $order = OrderLog::create($request->all());

        return response()->json([
            'message' => 'Order Log created successfully',
            'data' => $order
        ], 201);
    }

    // Update an existing order
    public function update(Request $request, $id)
    {
        $order = OrderLog::findOrFail($id);

        $order->update($request->all());

        return response()->json([
            'message' => 'Order Log updated successfully',
            'data' => $order
        ]);
    }

    // View a single order
    public function show($id)
    {
        $order = OrderLog::findOrFail($id);
        return response()->json($order);
    }
}