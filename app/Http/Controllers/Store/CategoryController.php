<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<span class="badge badge-linesuccess">Active</span>'
                        : '<span class="badge badge-linedanger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    return '
        <div class="action-table-data">
            <div class="edit-delete-action d-flex">
                <a class="me-2 p-2 view-btn" data-id="' . $row->id . '">
                    <i data-feather="eye" class="text-secondary" style="width: 18px; height: 18px;"></i>
                </a>
                <a class="me-2 p-2 edit-btn" data-id="' . $row->id . '">
                    <i data-feather="edit" class="text-info" style="width: 18px; height: 18px;"></i>
                </a>
                <form id="delete-form-' . $row->id . '" action="' . route('store.category.destroy', $row->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <a class="p-2 delete-btn" data-id="' . $row->id . '">
                        <i data-feather="trash-2" class="text-danger" style="width: 18px; height: 18px;"></i>
                    </a>
                </form>
            </div>
        </div>
    ';
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        $category = Category::all();
        return view('store.category', compact('category'));
    }


    public function store(Request $request)
    {

        $validator = Validator::make(

            $request->all(),
            [
                'category_name' => 'required|string|max:255',
                'slug' => 'required|string',
                'description' => 'string',

            ]
        );

        /*  $file = $request->file('brand_image');
        $directory = 'storage/public/brand/';
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $imageName);

        $data['brand_image'] = $directory . $imageName;*/
        $data = $request->all();
        $data['status'] = $request->input('status', 1);


        $category = Category::create($data);
        return redirect()->route('store.category.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }
    public function update(Request $request, $id)
    {
        //$tax = tax::findOrFail($id);
        $category = Category::findOrFail($id);

        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'required|string',
            'description' => 'string',



        ]);
        $category->update($validatedData);


        return redirect()->route('store.category.index')->with('success', 'Category updated successfully.');
    }


    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('store.category.index')->with('success', 'Category deleted successfully.');
    }
}
