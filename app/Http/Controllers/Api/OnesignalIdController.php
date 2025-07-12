<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OnesignalId;

class OnesignalIdController extends Controller
{
    public function index()
    {
        $signal = OnesignalId::all();
        if ($signal->isEmpty()) {
            return response()->json([
                'message' => 'Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        } else {
            return response()->json([
                'message' => 'OnesignalId Details',
                'data' => $signal,
                'status' => 1
            ], 200);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'store_id' => 'required|string',
            'player_id' => 'required|string',
            'external_id' => 'required|string'
        ]);

        $signal = OnesignalId::create($request->all());

        return response()->json([
            'message' => 'OnesignalId Detail Created Successfully',
            'data' => $signal,
            'status' => 1

        ], 201);
    }
    public function update(Request $request, $id)
    {
        $signal = OnesignalId::findOrFail($id);

        $signal->update($request->all());

        return response()->json([
            'message' => 'OnesignalId Details Updated Successfully',
            'data' => $signal,
            'status' => 1
        ]);
    }
    public function destroy($id)
    {
        $signal = OnesignalId::findOrFail($id);
        $signal->delete();

        return response()->json([
            'message' => 'OnesignalId Detail Deleted Successfully',
            'status' => 1

        ]);
    }

    public function single_show(Request $request)
    {
        $storeid = $request->query('store_id');
        $userid = $request->query('user_id');

        $signal = OnesignalId::where('store_id', $storeid)
            ->where('user_id', $userid)
            ->get();

        if ($signal->isNotEmpty()) {
            return response()->json([
                'message' => 'OnesignalId Detail',
                'data' => $signal,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'OnesignalId Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }
}