<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesReturn;
use Illuminate\Support\Facades\Auth;

class SalesReturnController extends Controller
{
    // List Sales Returns
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized',
                'status'  => 0
            ], 401);
        }

        // User level filter
        if (in_array($user->user_level, [1, 4])) {
            // Admin/Supervisor can see all
            $salesreturns = SalesReturn::all();
        } else {
            // Others see only their created ones
            $salesreturns = SalesReturn::where('created_by', $user->id)->get();
        }

        if ($salesreturns->isEmpty()) {
            return response()->json([
                'message' => 'Sales Return Details Not Found',
                'data'    => [],
                'status'  => 0
            ], 200);
        }

        return response()->json([
            'message' => 'Sales Return Details',
            'data'    => $salesreturns,
            'status'  => 1
        ], 200);
    }

    // Store Sales Return
    public function store(Request $request)
    {
        $request->validate([
            'store_id'    => 'required|numeric',
            'sales_id'    => 'required|numeric',
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
