<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packages;
use Yajra\DataTables\Facades\DataTables;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Packages::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '<span class="badge badge-linesuccess">' . $row->status . '</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="edit-delete-action d-flex">
                        <form id="delete-form-' . $row->id . '" action="' . route('admin.package.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="button" class="delete-btn" data-id="' . $row->id . '" style="border: none; background: transparent; padding: 0;">
                                <img src="' . asset('admin-assets/img/icons/delete.svg') . '" alt="Delete">
                            </button>
                        </form>
                    </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.package');
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required',
            'validity_date' => 'required|date',
            'price' => 'required|numeric',
        ]);

        Packages::create([
            'package_name' => $request->package_name,
            'validity_date' => $request->validity_date,
            'price' => $request->price,
            'status' => $request->status == 'Active' ? 'Active' : 'Inactive',
        ]);

        return redirect()->route('admin.package.index')->with('success', 'Package created successfully.');
    }

    public function destroy($id)
    {
        Packages::findOrFail($id)->delete();
        return redirect()->route('admin.package.index')->with('success', 'Package deleted successfully.');
    }
}