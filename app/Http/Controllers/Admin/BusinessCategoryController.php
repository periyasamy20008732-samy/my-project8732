<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategories;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class BusinessCategoryController extends Controller
{
    //
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BusinessCategories::latest()->get();

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
               
                <a class="me-2 p-2 edit-btn" data-id="' . $row->id . '">
                    <i data-feather="edit" class="text-info" style="width: 18px; height: 18px;"></i>
                </a>
                <form id="delete-form-' . $row->id . '" action="' . route('admin.business-category.destroy', $row->id) . '" method="POST" style="display:inline;">
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
        $business_type = BusinessCategories::all();
        return view('admin.business-category', compact('business_type'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|numeric',
        ]);

        BusinessCategories::create($request->only('name', 'status'));

        // return response()->json($type, 201);
        return redirect()->route('admin.business-category.index')->with('success', 'Business Type created successfully.');
    }

    public function show($id)
    {
        $type = BusinessCategories::findOrFail($id);
        return response()->json($type);
    }

    public function update(Request $request, $id)
    {
        $type = BusinessCategories::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required|numeric',

        ]);
        //return response()->json($type);
        $type->update($validatedData);
        return redirect()->route('admin.business-category.index')->with('success', 'Business type updated successfully.');

    }

    public function destroy($id)
    {
        BusinessCategories::findOrFail($id)->delete();
        // return response()->json(['message' => 'Deleted successfully']);
        return redirect()->route('admin.business-category.index')->with('success', 'Business type deleted successfully.');

    }
}