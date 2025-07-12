<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesItem;
use Illuminate\Support\Facades\Auth;
class SalesItemController extends Controller
{
    // View all SalesItem
    public function index()
    {/*
   $salesitem = SalesItem::all();


   if ($salesitem->isEmpty()) {

       return response()->json([
           'message' => 'SalesItem Detail Not Found',
           'data' => [],
           'status' => 0
       ], 200); 

   } else {

       return response()->json([
           'message' => 'SalesItem List',
           'data' => $salesitem,
           'status' => 1
       ], 200);

   }*/
        $salesitem = SalesItem::where('user_id', Auth::id())->get();


        if ($salesitem->isEmpty()) {

            return response()->json([
                'message' => 'SalesItem Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {


            return response()->json([
                'message' => 'User categories fetched successfully',
                'data' => $salesitem,
            ]);

        }

    }



    // Store a new SalesItem
    public function store(Request $request)
    {

        $salesitem = SalesItem::create($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'SalesItem Added successfully',
            'data' => $salesitem
        ], 201);
    }

    // Update an existing SalesItem
    public function update(Request $request, $id)
    {
        $salesitem = SalesItem::findOrFail($id);

        $salesitem->update($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'SalesItem updated successfully',
            'data' => $salesitem
        ]);
    }

    // View a single SalesItem
    public function show($id)
    {
        $salesitem = SalesItem::findOrFail($id);
        return response()->json($salesitem);
    }
    public function destroy($id)
    {
        $salesitem = SalesItem::findOrFail($id);
        $salesitem->delete();
        return response()->json(['message' => 'SalesItem deleted']);
    }

    public function single_show(Request $request)
    {
        $storeid = $request->query('sales_id');
        //  $userid = $request->query('user_id');

        $sales = SalesItem::where('sales_id', $storeid)
            //  ->where('user_id', $userid)
            ->get();

        if ($sales->isNotEmpty()) {
            return response()->json([
                'message' => 'SalesItem Detail',
                'data' => $sales,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'SalesItem Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }

}