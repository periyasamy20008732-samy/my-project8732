<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Store;


use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $storeIdInput = $request->input('store_id');
        $user = auth()->user();

        // Determine effective store IDs
        $effectiveStoreIds = [];

        if (!empty($storeIdInput) && $storeIdInput !== '0') {
            $effectiveStoreIds[] = $storeIdInput;
        } else {
            // Try stores owned by user
            $ownedStoreIds = Store::where('user_id', $user->id)
                ->pluck('id')
                ->map(fn($id) => (string)$id) // categories.store_id is varchar
                ->filter(fn($id) => !empty($id))
                ->toArray();

            if (!empty($ownedStoreIds)) {
                $effectiveStoreIds = $ownedStoreIds;
            } elseif (!empty($user->store_id) && $user->store_id !== '0') {
                $effectiveStoreIds[] = (string)$user->store_id;
            }
        }

        if (empty($effectiveStoreIds)) {
            return response()->json([
                'message' => 'No store context found for user',
                'categories' => [],
                'total' => 0,
                'status' => 0,
            ], 200);
        }

        // Fetch categories belonging to those stores with item counts
        // Assumes Category model has: public function items() { return $this->hasMany(Item::class, 'category_id', 'id'); }
        $categories = Category::whereIn('store_id', $effectiveStoreIds)
            ->withCount('items')
            ->get();

        if ($categories->isEmpty()) {
            return response()->json([
                'message' => 'Category Not Found',
                'categories' => [],
                'total' => 0,
                'status' => 0,
            ], 200);
        }

        // Format each category: include item_count (from items_count) and optionally other fields
        $formatted = $categories->map(function (Category $cat) {
            return [
                'id' => $cat->id,
                'name' => $cat->category_name,
                'item_count' => $cat->items_count ?? 0,
                'data' => [], // if you want to include item details, you can eager load and populate here
            ];
        })->toArray();

        return response()->json([
            'message' => 'Category List',
            'categories' => $formatted,
            'total' => count($formatted),
            'status' => 1,
        ], 200);
    }

    // public function index()
    // {
    //     $categories = Category::all();
    //     $totalCategory = $categories->count();

    //     if ($categories->isEmpty()) {
    //         return response()->json([
    //             'message' => 'Category Detail Not Found',
    //             'data' => [],
    //             'status' => 0
    //         ], 200);
    //     }

    //     return response()->json([
    //         'message' => 'Category List',
    //         'data' => $categories,
    //         'total' => $totalCategory,
    //         'status' => 1
    //     ], 200);
    // }

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
        $totalCategory = $category->count();

        if ($category->isNotEmpty()) {
            return response()->json([
                'message' => 'Category Detail',
                'data' => $category,
                'total' => $totalCategory,
                'status' => 1
            ], 200);
        }

        return response()->json([
            'message' => 'Category Detail Not Found',
            'data' => [],
            'total' => $totalCategory,
            'status' => 0
        ], 404);
    }
}
