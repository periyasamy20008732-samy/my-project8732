<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TaxController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Tax::latest()->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '
                    <button class="btn btn-sm btn-info view-btn" data-id="' . $row->id . '">View</button>
                    <button class="btn btn-sm btn-warning edit-btn" data-id="' . $row->id . '">Edit</button>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('admin.tax');
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'rate' => 'required|numeric|min:0',
        ]);

        Tax::create($request->only('name', 'rate'));

        return response()->json(['success' => 'Tax added successfully.']);
    }

    public function show($id)
    {
        return Tax::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'rate' => 'required|numeric|min:0',
        ]);

        $tax = Tax::findOrFail($id);
        $tax->update($request->only('name', 'rate'));

        return response()->json(['success' => 'Tax updated successfully.']);
    }

    public function destroy($id)
    {
        $tax = Tax::findOrFail($id);
        $tax->delete();

        return response()->json(['success' => 'Tax deleted successfully.']);
    }
}