<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesReturn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesReturnController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized',
                'status'  => 0
            ], 401);
        }

        // Resolve store IDs
        $storeId = $request->query('store_id');
        $storeIds = [];

        if ($storeId) {
            $storeIds = [trim($storeId)];
        } elseif (!empty($user->store_id) && $user->store_id != '0' && $user->store_id != 0) {
            $storeIds = [trim($user->store_id)];
        } else {
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
        }

        // Fetch sales returns with customer
        $salesreturns = SalesReturn::with('customer')
            ->whereIn('store_id', $storeIds)
            ->get();

        if ($salesreturns->isEmpty()) {
            return response()->json([
                'message' => 'Sales Return Details Not Found',
                'data'    => [],
                'totals'  => [
                    'total_return_count' => 0,
                    'total_return_amount' => 0,
                    'balance_due' => 0,
                ],
                'status'  => 0
            ], 200);
        }

        // Totals
        $totalReturnCount  = $salesreturns->count();
        $totalReturnAmount = $salesreturns->sum('grand_total');
        $balanceDue        = $salesreturns->sum(function ($sr) {
            return floatval($sr->grand_total) - floatval($sr->paid_amount ?? 0);
        });

        // Transform response to append customer details
        $data = $salesreturns->map(function ($sr) {
            return [
                'id'             => $sr->id,
                'store_id'       => $sr->store_id,
                'sales_id'       => $sr->sales_id,
                'return_code'    => $sr->return_code,
                'return_date'    => $sr->return_date,
                'grand_total'    => $sr->grand_total,
                'paid_amount'    => $sr->paid_amount,
                'customer_id'    => $sr->customer_id,
                'customer_name'  => $sr->customer->customer_name ?? null,
                'customer_email' => $sr->customer->email ?? null,
                'customer_phone' => $sr->customer->phone ?? $sr->customer->mobile ?? null,
                'created_by'     => $sr->created_by,
                'created_at'     => $sr->created_at,
            ];
        });

        return response()->json([
            'message' => 'Sales Return Details',
            'data'    => $data,
            'totals'  => [
                'total_return_count'  => $totalReturnCount,
                'total_return_amount' => $totalReturnAmount,
                'balance_due'         => $balanceDue,
            ],
            'status'  => 1
        ], 200);
    }

    // Store Sales Return
    public function store(Request $request)
    {
        $request->validate([
            'store_id'    => 'required|numeric',
            'sales_id'    => 'required|string',
            'return_code' => 'required|string',
            'grand_total' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::id();

        $salesreturn = SalesReturn::create($data);

        return response()->json([
            'message' => 'Sales Return Detail Created Successfully',
            'data'    => $salesreturn,
            'status'  => 1
        ], 201);
    }

    // Show by ID
    public function show($id)
    {
        $salesreturn = SalesReturn::find($id);

        if (!$salesreturn) {
            return response()->json([
                'message' => 'Sales Return Not Found',
                'status'  => 0
            ], 404);
        }

        return response()->json([
            'message' => 'Sales Return Detail',
            'data'    => $salesreturn,
            'status'  => 1
        ]);
    }

    // Update Sales Return
    public function update(Request $request, $id)
    {
        $salesreturn = SalesReturn::findOrFail($id);

        $salesreturn->update($request->all());

        return response()->json([
            'message' => 'Sales Return Details Updated Successfully',
            'data'    => $salesreturn,
            'status'  => 1
        ]);
    }

    // Delete Sales Return
    public function destroy($id)
    {
        $salesreturn = SalesReturn::findOrFail($id);
        $salesreturn->delete();

        return response()->json([
            'message' => 'Sales Return Detail Deleted Successfully',
            'status'  => 1
        ]);
    }
}
