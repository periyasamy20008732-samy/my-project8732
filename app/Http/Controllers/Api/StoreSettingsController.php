<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreSettings;
class StoreSettingsController extends Controller
{
    
    public function index()
    {
        $store = StoreSettings::all();
        

                if ($store->isEmpty()) {

                    return response()->json([
                        'message' => 'Detail Not Found',
                         'data'=>[],                       
                        'status' => 0
                    ], 200);

                }else{
                     
                     return response()->json([
                        'message' => 'StoreSettings Details',
                        'data'=>$store,
                        'status' => 1
                    ], 200);
                    
                }
    }

    // Store a new store
    public function store(Request $request)
    {
    
        $store = StoreSettings::create($request->all());
        return response()->json([
            'status'=>1,
            'message' => 'StoreSettings Details created successfully',
            'data' => $store
        ], 200);
    }

    // Update an existing Store
    public function update(Request $request, $id)
    {
        $store= StoreSettings::findOrFail($id);

        $store->update($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'StoreSettings Details updated successfully',
            'data' => $store
        ]);
    }

    // View a single Store
    public function show($id)
    {
        $store = StoreSettings::findOrFail($id);
        return response()->json($store);
    }
      public function destroy($id)
    {
        $store = StoreSettings::findOrFail($id);
        $store->delete();
        return response()->json(['message' => 'StoreSettings deleted']);
    }
}



