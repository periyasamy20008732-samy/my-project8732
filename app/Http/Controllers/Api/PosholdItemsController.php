<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PosholdItems;

class PosholdItemsController extends Controller
{

    // View all pos
    public function index()
    {
        $pos = PosholdItems::all();

        if ($pos->isEmpty()) {

            return response()->json([
                'message' => 'Poshold Items Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Poshold Items Details List',
                'data' => $pos,
                'status' => 1
            ], 200);

        }
    }

    // Store a new Pos
    public function store(Request $request)
    {
        /* $request->validate([
             'stock' => 'required|string',
             'if_batch' => 'required|string',
             'batch_no' => 'required|string',
             'if_expirydate' => 'required|string',
         ]);*/

        $pos = PosholdItems::create($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Poshold Items Added successfully',
            'data' => $pos
        ], 201);
    }

    // Update an existing Pos 
    public function update(Request $request, $id)
    {
        $pos = PosholdItems::findOrFail($id);

        $pos->update($request->all());

        return response()->json([
            'status' => '1',
            'message' => 'Poshold Items Details updated successfully',
            'data' => $pos
        ]);
    }

    // View a single pos
    public function show($id)
    {
        $purchase = PosholdItems::findOrFail($id);
        return response()->json($purchase);
    }
    public function destroy($id)
    {
        $purchase = PosholdItems::findOrFail($id);
        $purchase->delete();
        return response()->json([
            'status' => '1',
            'message' => 'Poshold Items Details  Deleted'
        ]);
    }
}