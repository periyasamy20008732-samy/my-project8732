<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;


class OrderItemController extends Controller
{

    public function index()
    {
        $order = OrderItem::all();
        //$result= User::find($id);return response()->json($order);

        if ($order->isEmpty()) {

            return response()->json([
                'message' => 'Order Item Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {

            return response()->json([
                'message' => 'Order Item Status List',
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
            'user_id' => 'required|string',
            'store_id' => 'required|string',
            'item_id' => 'required|string',
            'selling_price' => 'required|string',
            'qty' => 'required|string',
            'tax_rate' => 'required|string',
            'tax_type' => 'required|string',
            'tax_amt' => 'required|string',
            'total_price' => 'required|string',
            'if_offer' => 'required|string'
        ]);

        $order = OrderItem::create($request->all());

        return response()->json([
            'message' => 'Order Itemcreated successfully',
            'data' => $order
        ], 201);
    }

    // Update an existing order
    public function update(Request $request, $id)
    {
        $order = OrderItem::findOrFail($id);

        $order->update($request->all());

        return response()->json([
            'message' => 'Order Item updated successfully',
            'data' => $order
        ]);
    }

    // View a single order
    public function show($id)
    {
        $order = OrderItem::findOrFail($id);
        return response()->json($order);
    }


    public function single_show(Request $request)
    {
        $storeid = $request->query('store_id');
        $userid = $request->query('user_id');

        $order = OrderItem::where('store_id', $storeid)
            ->where('user_id', $userid)
            ->get();

        if ($order->isNotEmpty()) {
            return response()->json([
                'message' => 'OrderItem Detail',
                'data' => $order,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'OrderItem Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }
}
