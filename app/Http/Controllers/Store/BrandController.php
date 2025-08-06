<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::latest()->get();

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
                <form id="delete-form-' . $row->id . '" action="' . route('store.brand.destroy', $row->id) . '" method="POST" style="display:inline;">
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
        $brand = Brand::all();
        return view('store.brand', compact('brand'));
    }


    public function store(Request $request)
    {

        $validator = Validator::make(

            $request->all(),
            [
                'brand_name' => 'required|string|max:255|unique:brands,brand_name',
                'status' => 'required|numeric',
                'brand_image' => 'sometimes|file|image|nullable',

            ]
        );

        //    $data = $request->only(['brand_name', 'status']);
        //  $data['store_id'] = auth()->user_level();
        //  $data['store_id'] = auth()->user()->user_level;


        $file = $request->file('brand_image');
        $directory = 'storage/public/brand/';
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $imageName);

        $data = $request->all();
        $data['brand_image'] = $directory . $imageName;

        $brand = Brand::create($data);
        return redirect()->route('store.brand.index')->with('success', 'Brand created successfully.');
    }

    public function show($id)
    {
        $unit = Brand::findOrFail($id);
        return response()->json($unit);
    }
    public function update(Request $request, $id)
    {
        //$tax = tax::findOrFail($id);
        $unit = Brand::findOrFail($id);

        $validatedData = $request->validate([
            'unit_name' => 'required',
            'unit_value' => 'required|string',
            'description' => 'string',



        ]);
        $unit->update($validatedData);


        return redirect()->route('store.brand.index')->with('success', 'Brand updated successfully.');
    }


    public function destroy($id)
    {
        Brand::findOrFail($id)->delete();
        return redirect()->route('store.brand.index')->with('success', 'Brand deleted successfully.');
    }
}
