<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountrySettings;

class CountryController extends Controller
{

    // View all CountrySettings
    public function index()
    {
        $country =  CountrySettings::all();
       

                if ($country->isEmpty()) {

                    return response()->json([
                        'message' => 'Country Detail Not Found',
                         'data'=>[],                       
                        'status' => 0
                    ], 200);

                }else{
                     
                     return response()->json([
                        'message' => 'Country List',
                        'data'=>$country,
                        'status' => 1
                    ], 200);
                    
                }
    }

    // Store a new CountrySettings
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'mobile_code' => 'required|string',
            'currency_code' => 'required|string',
            'currency_symble' => 'required|string',


        ]);

        $country = CountrySettings::create($request->all());

        return response()->json([
            'message' => 'CountrySettings created successfully',
            'data' => $country,
            'status' => 1
        ], 201);
    }

    // Update an existing CountrySettings
    public function update(Request $request, $id)
    {
        $country = CountrySettings::findOrFail($id);

        $country->update($request->all());

        return response()->json([
            'message' => 'CountrySettings updated successfully',
            'data' => $country,
            'status' => 1
        ]);
    }

    // View a single CountrySettings
    public function show($id)
    {
        $country = CountrySettings::findOrFail($id);
        return response()->json($country);
    }
    public function destroy($id)
    {
        $country= CountrySettings::findOrFail($id);
        $country ->delete();
        return response()->json(['message' => 'CountrySettings deleted']); 
    }
}

