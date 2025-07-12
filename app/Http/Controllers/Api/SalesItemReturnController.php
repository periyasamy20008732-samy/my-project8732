<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesItemReturn;

class SalesItemReturnController extends Controller
{
    // View all SalesItem
    public function index()
    {
        $salesitem = SalesItemReturn::all();


        if ($salesitem->isEmpty()) {

            return response()->json([
                'message' => 'Sales Item Return Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Sales Item Return List',
                'data' => $salesitem,
                'status' => 1
            ], 200);

        }
    }


    // Store a new SalesItem
    public function store(Request $request)
    {

        $salesitem = SalesItemReturn::create($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Sales Item Return Added successfully',
            'data' => $salesitem
        ], 201);
    }

    // Update an existing SalesItem
    public function update(Request $request, $id)
    {
        $salesitem = SalesItemReturn::findOrFail($id);

        $salesitem->update($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Sales Item Return updated successfully',
            'data' => $salesitem
        ]);
    }

    // View a single SalesItem
    public function show($id)
    {
        $salesitem = SalesItemReturn::findOrFail($id);
        return response()->json($salesitem);
    }
    public function destroy($id)
    {
        $salesitem = SalesItemReturn::findOrFail($id);
        $salesitem->delete();
        return response()->json(['message' => 'Sales Item Return deleted']);
    }

}