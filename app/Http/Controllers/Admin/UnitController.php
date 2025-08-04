<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Units;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Units::latest()->get();

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
                <form id="delete-form-' . $row->id . '" action="' . route('admin.unit.destroy', $row->id) . '" method="POST" style="display:inline;">
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
        $unit = Units::all();
        return view('admin.unit', compact('unit'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'unit_name' => 'required',
            'unit_value' => 'required|string',
            'description' => 'string',
            //  'status' => 'required|numeric',
        ]);
        Units::create($validatedData);
        return redirect()->route('admin.unit.index')->with('success', 'Unit created successfully.');
    }

    public function show($id)
    {
        $unit = Units::findOrFail($id);
        return response()->json($unit);
    }
    public function update(Request $request, $id)
    {
        //$tax = tax::findOrFail($id);
        $unit = Units::findOrFail($id);

        $validatedData = $request->validate([
            'unit_name' => 'required',
            'unit_value' => 'required|string',
            'description' => 'string',
            // 'status' => 'required|numeric',
            // 'if_webpanel' => 'required|numeric',
            // 'if_android' => 'required|numeric',
            // 'if_ios' => 'required|numeric',
            // 'if_windows' => 'required|numeric',
            // 'if_customerapp' => 'required|numeric',
            // 'if_deliveryapp' => 'required|numeric',
            // 'if_exicutiveapp' => 'required|numeric',


        ]);
        $unit->update($validatedData);


        return redirect()->route('admin.unit.index')->with('success', 'Unit updated successfully.');
    }


    public function destroy($id)
    {
        Units::findOrFail($id)->delete();
        return redirect()->route('admin.unit.index')->with('success', 'Unit deleted successfully.');
    }
}
