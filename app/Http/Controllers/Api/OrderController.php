<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index(Request $request)
    {
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
            $storeIds = DB::table('store')
                ->where('user_id', $user->id)
                ->pluck('id')
                ->map(fn($id) => (string)$id)
                ->toArray();
        }

        if (empty($storeIds)) {
            return response()->json([
                'message' => 'No stores found for this user',
                'data' => [],
                'total' => 0,
                'status' => 0,
            ], 200);

        } else {

        }

        // Fetch orders belonging to the allowed store IDs
        $orders = Order::whereIn('store_id', $storeIds)
            ->with('items') // assumes you have an OrderItem relationship
            ->get();


        if ($orders->isEmpty()) {
            return response()->json([
                'message' => 'Order Detail Not Found',
                'data' => [],
                'status' => 0,
            ], 200);
        }

        return response()->json([
            'message' => 'Order List',
            'data' => $orders,
            'status' => 1,
        ], 200);
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
