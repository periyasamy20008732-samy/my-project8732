<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    // View all packages
    public function index()
    {
        $category = Category::all();


        if ($category->isEmpty()) {

            return response()->json([
                'message' => 'Category Detail Not Found',
                'data' => [],
                'status' => 0
            ], 200);

        } else {

            return response()->json([
                'message' => 'Category List',
                'data' => $category,
                'status' => 1
            ], 200);

        }
    }

    public function store_show(Request $request)
    {
        $storeid = $request->input('store_id'); // Get store_code from Postman

        if ($storeid) {
            $category = Category::where('store_id', $storeid)->get();

            if (!$category) {
                return response()->json([
                    'message' => 'Category  Not Found',
                    'data' => [],
                    'status' => 0
                ], 200);
            }

            return response()->json([
                'message' => 'Category  Details',
                'data' => $category,
                'status' => 1
            ], 200);
        }

        // If no store_code is passed, return all stores
        $category = Category::all();

        if ($category->isEmpty()) {
            return response()->json([
                'message' => 'No Category List Found',
                'data' => [],
                'status' => 0
            ], 200);
        }

        return response()->json([
            'message' => 'Category List',
            'data' => $category,
            'status' => 1
        ], 200);
    }

    // Store a new Category
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string',
            'category_code' => 'required|string',
            'image' => 'required'
        ]);

        //$data= new Category();
        $file = $request->image;
        $directory = 'storage/public/category/';
        $imageName = time() . '.' . $file->getClientOriginalname();
        $file->move(public_path($directory), $imageName);
        //  $data -> image = $directory.$imageName;
        $data = $request->all();
        $data['image'] = $directory . $imageName;

        $category = Category::create($data);

        return response()->json([
            'message' => 'Category created successfully',
            'image' => $category

        ], 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|file|image|max:2048', // 2MB max
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $directory = 'storage/category/';
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($directory), $imageName);
            $validatedData['image'] = $directory . $imageName;
        }

        $category->update($validatedData);

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }
    /*
        // Update an existing Category
        public function update(Request $request, $id)
        {
            $category = Category::findOrFail($id);

             $request->validate([
                'category_name' => 'required|string',
                'category_code' => 'required|string',
                'image' => 'required'
            ]);

             $file = $request->image;
            $directory = 'storage/public/category/';
            $imageName = time (). '.'.$file -> getClientOriginalname();
            $file -> move(public_path($directory),$imageName);
          //  $data -> image = $directory.$imageName;
            $data = $request->all();
            $data['image'] = $directory.$imageName;

            $category->update($data);

            return response()->json([
                'message' => 'Category updated successfully',
                'data' => $category
            ]);
        }
    */
    // View a single Category
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Category deleted']);
    }
}