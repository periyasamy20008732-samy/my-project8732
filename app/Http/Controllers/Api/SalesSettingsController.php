<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesSettingsController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->user();

            if (in_array($user->user_level, [1, 4])) {
                // Store admin sees all stores
                $salesettings = SalesSettings::all();
            } else {
                // Other users see only their own stores
                $salesettings = SalesSettings::where('user_id', $user->id)->get();
            }

            return response()->json([
                'message' => 'SalesSettings Detail Fetch Successfully',
                'status' => 1,
                'data' => $salesettings
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to retrieve SalesSettings: Unauthorozied or data not found',
            ], 500);
        }
    }
    public function store(Request $request)
    {

        try {
            $result = DB::transaction(function () use ($request) {
                // Create sales record

                $salesettings = $request->all();
                $salesettings['user_id'] = auth()->id();
                $salesettings['store_id'] = auth()->user()->store_id;

                $salesettings = SalesSettings::create($salesettings);

                return [
                    'message' => 'SalesSettings Created Successfully',
                    'data' => $salesettings,
                    'status' => 1
                ];
            });

            return response()->json($result, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating SalesSettings',
                'error' => $e->getMessage(),
                'status' => 0
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $salesettings = SalesSettings::findOrFail($id);

        $salesettings->update($request->all());

        return response()->json([
            'message' => 'SalesSettings updated successfully',
            'data' => $salesettings
        ]);
    }
}
