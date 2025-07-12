<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesPaymentsReturn;

class SalesPaymentsReturnController extends Controller
{

    // View all SalesItem
    public function index()
    {
        $sales = SalesPaymentsReturn::all();


        if ($sales->isEmpty()) {

            return response()->json([
                'message' => 'Sales Payments Return Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Sales Payments Return List',
                'data' => $sales,
                'status' => 1
            ], 200);

        }
    }


    // Store a new SalesItem
    public function store(Request $request)
    {

        $sales = SalesPaymentsReturn::create($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Sales Payments Return Added successfully',
            'data' => $sales
        ], 201);
    }

    // Update an existing SalesItem
    public function update(Request $request, $id)
    {
        $salesitem = SalesPaymentsReturn::findOrFail($id);

        $salesitem->update($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Sales Payments Return updated successfully',
            'data' => $salesitem
        ]);
    }

    // View a single SalesItem
    public function show($id)
    {
        $salesitem = SalesPaymentsReturn::findOrFail($id);
        return response()->json($salesitem);
    }
    public function destroy($id)
    {
        $salesitem = SalesPaymentsReturn::findOrFail($id);
        $salesitem->delete();
        return response()->json(['message' => 'Sales Payments Return deleted']);
    }

}