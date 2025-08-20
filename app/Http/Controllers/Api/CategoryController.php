<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{
    // View all categories
    public function index(Request $request)
    {
        try {

            $user = auth()->user();
            $storeId = $request->query('store_id');

            // Determine effective store IDs
            $storeIds = [];

            if ($storeId) {
                $storeIds = [trim($storeId)];
            } elseif (!empty($user->store_id) && $user->store_id != '0' && $user->store_id != 0) {
                $storeIds = [trim($user->store_id)];
            } else {
                // fallback to stores owned by user
                $storeIds = DB::table('store')
                    ->where('user_id', $user->id)
                    ->pluck('id')
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

            // Fetch categories with item counts
            $categories = DB::table('categories as c')
                ->leftJoin('items as i', 'i.category_id', '=', 'c.id')
                ->select([
                    'c.id',
                    DB::raw('c.category_name as name'),
                    DB::raw('COUNT(i.id) as item_count'),
                ])
                ->whereIn('c.store_id', $storeIds)
                ->groupBy('c.id', 'c.category_name')
                ->get();

            if ($categories->isEmpty()) {
                return response()->json([
                    'message' => 'Category Detail Not Found',
                    'data' => [],
                    'total' => 0,
                    'status' => 0,
                ], 200);
            }

            return response()->json([
                'message' => 'Category List',
                'data' => $categories,
                'total' => $categories->count(),
                'status' => 1,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Internal server error',
                'data' => $e,
                'total' => 0,
                'status' => 500,

            ], 500);
        }
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

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_name' => 'required|string|max:255',
                'category_code' => 'required|string|max:255',
                'image' => 'sometimes|file|image|max:2048',
                'store_id' => 'nullable|integer'
            ]);

            $data = $request->all();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $directory = 'storage/public/category/';
                $imageName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($directory), $imageName);
                $data['image'] = $directory . $imageName;
            }

            $category = Category::create($data);

            return response()->json([
                'message' => 'Category created successfully',
                'data' => $category,
                'status' => 1
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'status' => 0
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Category store error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage(),
                'status' => 0
            ], 500);
        }
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

    public function getItemsBasedOnCateId(Request $request, $categoryId)
    {
        try {
            $user = auth()->user();

            // Step 1: Validate category and get store_id
            $category = DB::table('categories')->where('id', $categoryId)->first();
            if (!$category) {
                return response()->json([
                    'message' => 'Category not found',
                    'data' => [],
                    'total' => 0,
                    'status' => 0,
                ], 404);
            }

            $categoryStoreId = $category->store_id;

            // Step 2: Determine user type & store IDs
            $storeIds = [];

            if (!empty($user->store_id) && ($user->store_id != '0' && $user->store_id != 0)) {
                // Store user (assigned to one store)
                $storeIds = [trim($user->store_id)];
            } else {
                // Possible store admin (owns one or more stores)
                $storeIds = DB::table('store')
                    ->where('user_id', $user->id)
                    ->pluck('id')
                    ->map(fn($id) => (string)$id)
                    ->toArray();
            }

            // Step 3: Logic based on role
            if (!empty($user->store_id) && $user->store_id !== '0') {
                // Store user → must match category store
                if ((string)$categoryStoreId !== (string)$user->store_id) {
                    return response()->json([
                        'message' => 'You do not have permission to view items for this category',
                        'data' => [],
                        'total' => 0,
                        'status' => 0,
                    ], 403);
                }
            } else {
                // Store admin → check if category store belongs to them
                if (!in_array((string)$categoryStoreId, $storeIds)) {
                    return response()->json([
                        'message' => 'You do not have permission to view items for this category',
                        'data' => [],
                        'total' => 0,
                        'status' => 0,
                    ], 403);
                }
            }

            // Step 4: Fetch items (include category + store names)
            $items = DB::table('items')
                ->leftJoin('categories', 'items.category_id', '=', 'categories.id')
                ->leftJoin('store', 'items.store_id', '=', 'store.id')
                ->select(
                    'items.*',
                    'categories.category_name as category_name',
                    'store.store_name as store_name'
                )
                ->whereIn(
                    'items.store_id',
                    !empty($user->store_id) && $user->store_id != '0' && $user->store_id != 0
                        ? [$user->store_id] // Store user → single store
                        : $storeIds         // Store admin → multiple stores
                )
                ->where(function ($query) use ($categoryId) {
                    $query->where('items.category_id', $categoryId)
                        ->orWhereNull('items.category_id');
                })
                ->get();

            return response()->json([
                'message' => 'Items fetched successfully',
                'data' => $items,
                'total' => $items->count(),
                'status' => 200,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('getItemsBasedOnCateId failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => optional(auth()->user())->id,
                'category_id' => $categoryId,
            ]);
            return response()->json([
                'message' => 'Internal server error',
                'data' => $e,
                'total' => $user,
                'status' => 500,
            ], 500);
        }
    }

    public function category_bulkpost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,txt|max:5120'
        ]);
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $save_path = $file->storeAs('category_bulk_import', $filename, 'private');
            }
            $path = $request->file('file')->getRealPath();
            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();
            $header = array_map('strtolower', array_shift($rows));
            $insertData = [];
            $skipped    = [];
            foreach ($rows as $row) {
                $data = array_combine($header, $row);
                $category_name   = trim($data['category_name'] ?? '');
                $category_code   = trim($data['category_code'] ?? '');
                $description     = $data['description'] ?? null;
                if (!$category_name || !$category_code) {
                    $skipped[] = [
                        'category_name' => $category_name,
                        'category_code'       => $category_code,
                        'reason'    => 'Missing category_name or category_code'
                    ];
                    continue;
                }
                if (Category::where('category_name', $category_name)->orWhere('category_code', $category_code)->exists()) {
                    $skipped[] = [
                        'category_name' => $category_name,
                        'category_code'       => $category_code,
                        'reason'    => 'Already exists'
                    ];
                    continue;
                }
                $insertData[] = [

                    'store_id' => auth()->user()->store_id,
                    'category_name'   => $category_name,
                    'category_code' => $category_code,
                    'description' => $description,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }
            if (!empty($insertData)) {
                Category::insert($insertData);
            }
            return response()->json([
                'status'   => true,
                'message'  => 'Bulk import completed',
                'inserted_count' => count($insertData),
                'inserted' => $insertData,
                'skipped_count' => count($skipped),
                'skipped'  => $skipped,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Import failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
