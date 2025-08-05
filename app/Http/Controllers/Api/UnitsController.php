<?php

namespace App\Http\Controllers\Api;

use App\Models\Units;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UnitsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = auth()->user();
            $storeId = $request->query('store_id');

            // Resolve effective store IDs
            $storeIds = [];
            if ($storeId && $storeId !== '0' && trim($storeId) !== '') {
                $storeIds = [trim($storeId)];
            } elseif (!empty($user->store_id) && $user->store_id !== '0') {
                $storeIds = [trim($user->store_id)];
            } else {
                // fallback to stores owned by user
                $storeIds = DB::table('store')
                    ->where('user_id', $user->id)
                    ->pluck('id')
                    ->filter(fn($v) => !is_null($v) && $v !== '')
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

            // Fetch units belonging to those store IDs
            $units = DB::table('units')
                ->whereIn('store_id', $storeIds)
                ->get();

            if ($units->isEmpty()) {
                return response()->json([
                    'message' => 'Units Detail Not Found',
                    'data' => [],
                    'total' => 0,
                    'status' => 0,
                ], 200);
            }

            return response()->json([
                'message' => 'Units List',
                'data' => $units,
                'total' => $units->count(),
                'status' => 1,
            ], 200);
        } catch (\Throwable $e) {
            print_r($e);
            return response()->json([
                'message' => 'Internal server error',
                'data' => [],
                'total' => 0,
                'status' => 500,
            ], 500);
        }
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'store_id' => 'required|string',
                'unit_name' => 'required|string',
                'unit_value' => 'required|string',
                'description' => 'required|string'
            ]);

            $unit = Units::create($request->all());

            return response()->json([
                'message' => 'Units Detail Created Successfully',
                'data' => $unit,
                'status' => 1

            ], 201);
        } catch (\Throwable $e) {
            print_r($e);
            Log::error('Brand index failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => optional(auth()->user())->id,
                'store_id' => $request->query('store_id'),
            ]);
            return response()->json([
                'message' => 'Internal server error',
                'data' => [],
                'total' => 0,
                'status' => 500,
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $unit = Units::findOrFail($id);

        $unit->update($request->all());

        return response()->json([
            'message' => 'Unit Details Updated Successfully',
            'data' => $unit,
            'status' => 1
        ]);
    }
    public function destroy($id)
    {
        $unit = Units::findOrFail($id);
        $unit->delete();

        return response()->json([
            'message' => 'Units Detail Deleted Successfully',
            'status' => 1

        ]);
    }
}
