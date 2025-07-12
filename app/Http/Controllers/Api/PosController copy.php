<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pos;

class PosController extends Controller
{

    // View all pos
    public function index()
    {
        $pos = Pos::all();

        if ($pos->isEmpty()) {

            return response()->json([
                'message' => 'Pos Details Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Pos Details List',
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

        $pos = Pos::create($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Pos Added successfully',
            'data' => $pos
        ], 201);
    }

    // Update an existing Pos 
    public function update(Request $request, $id)
    {
        $pos = Pos::findOrFail($id);

        $pos->update($request->all());

        return response()->json([
            'status' => '1',
            'message' => 'Pos Details updated successfully',
            'data' => $pos
        ]);
    }

    // View a single pos
    public function show($id)
    {
        $purchase = Pos::findOrFail($id);
        return response()->json($purchase);
    }
    public function destroy($id)
    {
        $purchase = Pos::findOrFail($id);
        $purchase->delete();
        return response()->json([
            'status' => '1',
            'message' => 'Pos Details  Deleted'
        ]);
    }
}