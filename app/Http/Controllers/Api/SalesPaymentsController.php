<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesPayments;

class SalesPaymentsController extends Controller
{

    // View all SalesItem
    public function index()
    {
        $sales = SalesPayments::all();


        if ($sales->isEmpty()) {

            return response()->json([
                'message' => 'Sales Payments Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Sales Payments List',
                'data' => $sales,
                'status' => 1
            ], 200);

        }
    }


    // Store a new SalesItem
    public function store(Request $request)
    {

        $sales = SalesPayments::create($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Sales Payments Added successfully',
            'data' => $sales
        ], 201);
    }

    // Update an existing SalesItem
    public function update(Request $request, $id)
    {
        $salesitem = SalesPayments::findOrFail($id);

        $salesitem->update($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Sales Payments updated successfully',
            'data' => $salesitem
        ]);
    }

    // View a single SalesItem
    public function show($id)
    {
        $salesitem = SalesPayments::findOrFail($id);
        return response()->json($salesitem);
    }
    public function destroy($id)
    {
        $salesitem = SalesPayments::findOrFail($id);
        $salesitem->delete();
        return response()->json(['message' => 'Sales Payments deleted']);
    }

}