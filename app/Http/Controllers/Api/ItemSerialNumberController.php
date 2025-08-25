<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemSerialNumber;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class ItemSerialNumberController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->user();

            if (in_array($user->user_level, [1, 4])) {
                $item_serial = ItemSerialNumber::all();
                $totalitem_serial = $item_serial->count();
            } else {
                //user item based on user id   
                $item_serial = ItemSerialNumber::where('created_by', $user->id)->get();
                $totalitem_serial = $item_serial->count();
            }
            return response()->json([
                'message' => 'Detail Fetch Successfully',
                'status' => 1,
                'item_serial' => $item_serial,
                'totalitem_serial' => $totalitem_serial,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to retrieve ItemSerialNumber: Unauthorozied or data not found',
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $data = $request->validate([
                'store_id' => 'required|integer',
                'item_id' => 'required|integer',
                'serialno' => 'required|string|unique:itemserial_number,serialno,',
                'purchase_id' => 'required|integer',
                'sales_id' => 'required|integer'
            ]);
            $data = $request->all();
            $data['created_by'] = $user->id;
            $data['status'] = 1;
            $item_serial = ItemSerialNumber::create($data);
            return response()->json([
                'status' => true,
                'message' => 'ItemSerialNumber Added Successfully',
                'data' => $item_serial,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Add: ' . $e->getMessage(),
            ], 500);
        }
    }
}
