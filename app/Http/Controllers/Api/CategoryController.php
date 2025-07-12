<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
class CategoryController extends Controller
{
    // View all categories
    public function index()
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return response()->json([
                'message' => 'Category Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);
        }

        return response()->json([
            'message' => 'Category List',
            'data' => $categories,
            'status' => 1
        ], 200);
    }

    // View categories by store_id or all if no store_id
    public function store_show(Request $request)
    {
        $storeId = $request->input('store_id');

        if ($storeId) {
            $categories = Category::where('store_id', $storeId)->get();

            if ($categories->isEmpty()) {
                return response()->json([
                    'message' => 'Category Not Found',
                    'data' => [],
                    'status' => 0
                ], 200);
            }

            return response()->json([
                'message' => 'Category Details',
                'data' => $categories,
                'status' => 1
            ], 200);
        }

        // No store_id passed
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return response()->json([
                'message' => 'No Category List Found',
                'data' => [],
                'status' => 0
            ], 200);
        }

        return response()->json([
            'message' => 'Category List',
            'data' => $categories,
            'status' => 1
        ], 200);
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_code' => 'required|string|max:255',
            'image' => 'sometimes|file|image|max:2048',
            'store_id' => 'nullable|integer' // Optional, add if needed
        ]);

        $file = $request->file('image');
        $directory = 'storage/public/category/';
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $imageName);

        $data = $request->all();
        $data['image'] = $directory . $imageName;

        $category = Category::create($data);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category,
            'status' => 1
        ], 201);
    }

    // Update existing category
    public function update(Request $request, $id)
    {
        // Fetch the category by ID or fail
        $category = Category::findOrFail($id);

        // Validate incoming request
        $validatedData = $request->validate([
            'category_name' => 'sometimes|required|string|max:255',
            'category_code' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|file|image|max:2048',
            'store_id' => 'nullable|integer',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (!empty($category->image)) {
                $oldPath = str_replace('/storage', 'public', $category->image);
                Storage::delete($oldPath);
            }

            // Store new image
            $path = $request->file('image')->store('public/category');
            $validatedData['image'] = Storage::url($path); // returns /storage/category/...
        }

        // Ensure model is fillable or update manually
        $category->fill($validatedData);
        $category->save();

        // Return success response with refreshed model
        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category->fresh(),
            'status' => 1
        ]);
    }



    // View a single category
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'message' => 'Category Details',
            'data' => $category,
            'status' => 1
        ], 200);
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully',
            'status' => 1
        ], 200);
    }

    public function single_show(Request $request)
    {
        $storeid = $request->query('store_id');
        //$userid = $request->query('user_id');

        $category = Category::where('store_id', $storeid)
            //->where('user_id', $userid)
            ->get();

        if ($category->isNotEmpty()) {
            return response()->json([
                'message' => 'Category Detail',
                'data' => $category,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'Category Detail Not Found',
            'data' => [],
            'status' => 0
        ], 404);
    }
}