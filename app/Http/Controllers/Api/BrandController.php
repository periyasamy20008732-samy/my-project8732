<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    // View all brand
    public function index()
    {
        $brand = Brand::all();


        if ($brand->isEmpty()) {

            return response()->json([
                'message' => 'Brand Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Brand List',
                'data' => $brand,
                'status' => 1
            ], 200);

        }
    }


    public function store_show(Request $request)
    {
        $storeid = $request->input('store_id'); // Get store_code from Postman

        if ($storeid) {
            $brand = Brand::where('store_id', $storeid)->get();

            if (!$brand) {
                return response()->json([
                    'message' => 'Brand  Not Found',
                    'data' => [],
                    'status' => 0
                ], 200);
            }

            return response()->json([
                'message' => 'Brand  Details',
                'data' => $brand,
                'status' => 1
            ], 200);
        }

        // If no store_code is passed, return all stores
        $brand = Brand::all();

        if ($brand->isEmpty()) {
            return response()->json([
                'message' => 'No Brand List Found',
                'data' => [],
                'status' => 0
            ], 200);
        }

        return response()->json([
            'message' => 'Brand List',
            'data' => $brand,
            'status' => 1
        ], 200);
    }

    // Store a new Brand
    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string',
            'brand_code' => 'required|string',
            'brand_image' => 'required'

        ]);


        $file = $request->brand_image;
        $directory = 'storage/public/brand/';
        $imageName = time() . '.' . $file->getClientOriginalname();
        $file->move(public_path($directory), $imageName);
        //  $data -> image = $directory.$imageName;
        $data = $request->all();
        $data['brand_image'] = $directory . $imageName;

        //  $brand = Brand::create($request->all());

        $brand = Brand::create($data);
        return response()->json([
            'status' => 1,
            'message' => 'Brand created successfully',
            'data' => $brand
        ], 201);
    }

    // Update an existing Brand
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $brand->update($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Brand updated successfully',
            'data' => $brand
        ]);
    }

    // View a single Brand
    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return response()->json($brand);
    }
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return response()->json(['message' => 'Brand deleted']);
    }

    public function single_show(Request $request)
    {
        $storeid = $request->query('store_id');
        //$userid = $request->query('user_id');

        $brand = Brand::where('store_id', $storeid)
            //->where('user_id', $userid)
            ->get();

        if ($brand->isNotEmpty()) {
            return response()->json([
                'message' => 'Brand Detail',
                'data' => $brand,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'Brand Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }



}