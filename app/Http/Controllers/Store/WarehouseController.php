<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Store;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Warehouse::latest()->get();

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
                <form id="delete-form-' . $row->id . '" action="' . route('store.warehouse.destroy', $row->id) . '" method="POST" style="display:inline;">
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
        $store = Store::all();
        return view('store.warehouse', compact('store'));
    }


    public function store(Request $request)
    {

        $validator = Validator::make(

            $request->all(),
            [
                'warehouse_type' => 'required|string|max:255',
                'warehouse_name' => 'required|string|unique:warehouse,warehouse_name',
                'address' => 'string',
                'store_id' => 'string',

            ]
        );
        $data = $request->all();
        $data['status'] = $request->input('status', 1);
        $data['user_id'] = auth()->user()->user_level;

        $warehouse = Warehouse::create($data);
        return redirect()->route('store.warehouse.index')->with('success', 'Warehouse created successfully.');
    }

    public function show($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return response()->json($warehouse);
    }
    public function update(Request $request, $id)
    {
        //$tax = tax::findOrFail($id);
        $warehouse = Warehouse::findOrFail($id);

        $validatedData = $request->validate([
            'warehouse_type' => 'required|string|max:255',
            'warehouse_name' => 'required|string',
            'address' => 'string',
        ]);
        $warehouse->update($validatedData);


        return redirect()->route('store.warehouse.index')->with('success', 'Warehouse updated successfully.');
    }


    public function destroy($id)
    {
        Warehouse::findOrFail($id)->delete();
        return redirect()->route('store.warehouse.index')->with('success', 'Warehouse deleted successfully.');
    }
}
