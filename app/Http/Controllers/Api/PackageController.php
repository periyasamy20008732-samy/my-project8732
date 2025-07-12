<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // ✅ This line is required
use Illuminate\Http\Request;
use App\Models\Packages;

class PackageController extends Controller
{
    // View all packages
    public function index()
    {
        $packages = Packages::all();
        //$result= User::find($id);return response()->json($packages);

                if ($packages->isEmpty()) {

                    return response()->json([
                        'message' => 'Detail Not Found',
                         'data'=>[],                       
                        'status' => 0
                    ], 200);

                }else{
                     
                     return response()->json([
                        'message' => 'Package List',
                        'data'=>$packages,
                        'status' => 1
                    ], 200);
                    
                }
    }

    // Store a new package
    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required|string|unique:packages,package_name',
            'validity_date' => 'required|string',
            'if_webpanel' => 'required|string',
            'if_android' => 'required|string',
            'if_ios' => 'required|string',
            'if_windows' => 'required|string',
            'price' => 'required|string',
            'if_customerapp' => 'required|string',
            'if_deliveryapp' => 'required|string',
            'if_exicutiveapp' => 'required|string',
            'if_multistore' => 'required|string',
            'if_numberof_store' => 'required|string',
            'status' => 'required|string',
        ]);

        $package = Packages::create($request->all());

        return response()->json([
            'message' => 'Package created successfully',
            'data' => $package
        ], 201);
    }

    // Update an existing package
    public function update(Request $request, $id)
    {
        $package = Packages::findOrFail($id);

        $package->update($request->all());

        return response()->json([
            'message' => 'Package updated successfully',
            'data' => $package
        ]);
    }

    // View a single package
    public function show($id)
    {
        $package = Packages::findOrFail($id);
        return response()->json($package);
    }
}
