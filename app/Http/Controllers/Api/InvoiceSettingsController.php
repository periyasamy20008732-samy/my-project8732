<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvoiceSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceSettingsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = auth()->user();
            $storeId = $request->query('store_id'); // fetch store_id from query params

            if (in_array($user->user_level, [1, 4])) {
                // Store admin can see all stores OR a specific one if store_id is passed
                $query = InvoiceSettings::query();
                if ($storeId) {
                    $query->where('store_id', $storeId);
                }
                $invoicesettings = $query->get();
            } else {
                // Other users see only their own store(s)
                $query = InvoiceSettings::where('user_id', $user->id);
                if ($storeId) {
                    $query->where('store_id', $storeId);
                }
                $invoicesettings = $query->get();
            }

            return response()->json([
                'message' => 'Invoice Settings fetched successfully',
                'status'  => 1,
                'data'    => $invoicesettings,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 0,
                'message' => 'Failed to retrieve Invoice Settings: Unauthorized or data not found',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {

        try {
            $result = DB::transaction(function () use ($request) {

                $lastInvoiceNo = InvoiceSettings::max('start_number') ?? 0;
                $nextInvoiceNo = $lastInvoiceNo + 1;

                $start_number = str_pad($nextInvoiceNo, 3, '0', STR_PAD_LEFT);

                $invoicesettings = $request->all();
                $invoicesettings['user_id'] = auth()->id();
                $invoicesettings['store_id'] = auth()->user()->store_id;
                $invoicesettings['start_number'] = $start_number;


                $invoicesettings = InvoiceSettings::create($invoicesettings);

                return [
                    'message' => 'InvoiceSettings Created Successfully',
                    'data' => $invoicesettings,
                    'status' => 1
                ];
            });

            return response()->json($result, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating InvoiceSettings',
                'error' => $e->getMessage(),
                'status' => 0
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $invoicesettings = InvoiceSettings::findOrFail($id);

        $invoicesettings->update($request->all());

        return response()->json([
            'message' => 'InvoiceSettings updated successfully',
            'data' => $invoicesettings
        ]);
    }
}
