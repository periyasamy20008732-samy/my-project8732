<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tax;
use Yajra\DataTables\Facades\DataTables;

class TaxController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tax::latest()->get();

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
                <form id="delete-form-' . $row->id . '" action="' . route('admin.tax.destroy', $row->id) . '" method="POST" style="display:inline;">
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
        $tax = Tax::all();
        return view('admin.tax', compact('tax'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tax_name' => 'required',
            'validity_date' => 'required|date',
            'tax' => 'required|numeric',
            //  'status' => 'required|numeric',
        ]);
        Tax::create($validatedData);
        return redirect()->route('admin.tax.index')->with('success', 'Tax created successfully.');
    }

    public function show($id)
    {
        $tax = Tax::findOrFail($id);
        return response()->json($tax);
    }
    public function update(Request $request, $id)
    {
        //$tax = tax::findOrFail($id);
        $tax = Tax::findOrFail($id);

        $validatedData = $request->validate([
            'tax_name' => 'required',
            'validity_date' => 'required|date',
            'tax' => 'required|numeric',
            // 'status' => 'required|numeric',
            // 'if_webpanel' => 'required|numeric',
            // 'if_android' => 'required|numeric',
            // 'if_ios' => 'required|numeric',
            // 'if_windows' => 'required|numeric',
            // 'if_customerapp' => 'required|numeric',
            // 'if_deliveryapp' => 'required|numeric',
            // 'if_exicutiveapp' => 'required|numeric',


        ]);
        $tax->update($validatedData);


        return redirect()->route('admin.tax.index')->with('success', 'Tax updated successfully.');
    }


    public function destroy($id)
    {
        Tax::findOrFail($id)->delete();
        return redirect()->route('admin.tax.index')->with('success', 'Tax deleted successfully.');
    }
}
