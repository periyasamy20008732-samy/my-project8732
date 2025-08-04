<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packages;
use Yajra\DataTables\Facades\DataTables;

class PackageController extends Controller
{

    public function home_index(Request $request)
    {
        $packages = Packages::all();
        return view('pricing', compact('packages'));
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Packages::latest()->get();

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
                <form id="delete-form-' . $row->id . '" action="' . route('admin.customer.destroy', $row->id) . '" method="POST" style="display:inline;">
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
        $packages = Packages::all();
        return view('admin.package', compact('packages'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'package_name' => 'required',
            'validity_date' => 'required|date',
            'price' => 'required|numeric',
            'status' => 'required|numeric',
        ]);
        Packages::create($validatedData);
        return redirect()->route('admin.package.index')->with('success', 'Package created successfully.');
    }

    public function show($id)
    {
        $package = Packages::findOrFail($id);
        return response()->json($package);
    }
    public function update(Request $request, $id)
    {
        //$package = Packages::findOrFail($id);
        $package = Packages::findOrFail($id);

        $validatedData = $request->validate([
            'package_name' => 'required',
            'validity_date' => 'required|date',
            'price' => 'required|numeric',
            'status' => 'required|numeric',
            'if_webpanel' => 'required|numeric',
            'if_android' => 'required|numeric',
            'if_ios' => 'required|numeric',
            'if_windows' => 'required|numeric',
            'if_customerapp' => 'required|numeric',
            'if_deliveryapp' => 'required|numeric',
            'if_exicutiveapp' => 'required|numeric',


        ]);
        $package->update($validatedData);


        return redirect()->route('admin.package.index')->with('success', 'Package updated successfully.');
    }


    public function destroy($id)
    {
        Packages::findOrFail($id)->delete();
        return redirect()->route('admin.package.index')->with('success', 'Package deleted successfully.');
    }
}
