<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{

    public function index(Request $request)
    {
        try {

            $user = auth()->user();
           
            $storeId = $request->query('store_id');

            // Resolve effective store IDs
            $storeIds = [];

            if ($storeId) {
                $storeIds = [trim($storeId)];
            } elseif (!empty($user->store_id) && $user->store_id !== '0') {
                $storeIds = [trim($user->store_id)];
            } else {
                $storeIds = DB::table('store')
                    ->where('user_id', $user->id)
                    ->pluck('id')
                    ->filter(fn($v) => !is_null($v) && $v !== '')
                    ->map(fn($id) => (string)$id)
                    ->toArray();
            }

            if (empty($storeIds)) {
                return response()->json([
                    'message' => 'No stores found for this user',
                    'data' => [],
                    'total' => 0,
                    'status' => 0,
                ], 200);
            }

            // Fetch brands for resolved store IDs
            $brands = DB::table('brands as b')
                ->select([
                    'b.id',
                    'b.brand_code',
                    'b.brand_name',
                    'b.brand_image',
                    'b.description',
                    'b.slug',
                    'b.count_id',
                    'b.status',
                    'b.store_id',
                    'b.created_at',
                    'b.updated_at',
                ])
                ->whereIn('b.store_id', $storeIds)
                ->get();

            if ($brands->isEmpty()) {
                return response()->json([
                    'message' => 'Brand Detail Not Found',
                    'data' => [],
                    'total' => 0,
                    'status' => 0,
                ], 200);
            }

            return response()->json([
                'message' => 'Brand List',
                'data' => $brands,
                'total' => $brands->count(),
                'status' => 1,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Brand index failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => optional(auth()->user())->id,
                'store_id' => $request->query('store_id'),
            ]);
            return response()->json([
                'message' => 'Internal server error',
                'data' => [],
                'total' => 0,
                'status' => 500,
            ], 500);
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

    public function store(Request $request)
    {
        // Validate required fields
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required|string',
            'brand_code' => 'required|string',
            'store_id' => 'required', // optional: enforce if needed
            // other fields can be validated as needed
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Prepare data to insert
            $data = $request->only([
                'store_id',
                'slug',
                'count_id',
                'brand_code',
                'brand_name',
                'description',
                'status',
                'inapp_view',
            ]);

            // Handle brand image only if a valid file is uploaded
            if ($request->hasFile('brand_image') && $request->file('brand_image')->isValid()) {
                $file = $request->file('brand_image');
                $directory = 'storage/public/brand/';
                $imageName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($directory), $imageName);
                $data['brand_image'] = $directory . $imageName;
            }

            // Create brand
            $brand = Brand::create($data);

            return response()->json([
                'status' => 1,
                'message' => 'Brand created successfully',
                'data' => $brand,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Brand creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payload' => $request->all(),
            ]);

            return response()->json([
                'status' => 0,
                'message' => 'Failed to create brand',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error',
            ], 500);
        }
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
