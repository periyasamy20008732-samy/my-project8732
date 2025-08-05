<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Customer;
use Yajra\DataTables\Facades\DataTables;


class SalesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //    $data = Sales::with('customer')->latest()->get();
            $data = Sales::with('customer.level')->latest()->get();


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_level_name', function ($row) {
                    return optional($row->customer->level)->name ?? '-';
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<span class="badge badge-linesuccess">Active</span>'
                        : '<span class="badge badge-linedanger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    return '
        
            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="javascript:void(0);" class="dropdown-item view-btn" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#sales-details-new">
                        <i data-feather="eye" class="info-img"></i> Sale Detail
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="dropdown-item edit-btn" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#edit-sales-new">
                        <i data-feather="edit" class="info-img"></i> Edit Sale
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment">
                        <i data-feather="dollar-sign" class="info-img"></i> Show Payments
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#createpayment">
                        <i data-feather="plus-circle" class="info-img"></i> Create Payment
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="dropdown-item download-pdf" data-id="' . $row->id . '">
                        <i data-feather="download" class="info-img"></i> Download PDF
                    </a>
                </li>
                <li>
                    <form id="delete-form-' . $row->id . '" action="' . route('store.sales.destroy', $row->id) . '" method="POST">
                        ' . csrf_field() . method_field('DELETE') . '
                        <a href="javascript:void(0);" class="dropdown-item delete-btn confirm-text mb-0" data-id="' . $row->id . '">
                            <i data-feather="trash-2" class="info-img"></i> Delete Sale
                        </a>
                    </form>
                </li>
            </ul>
      
    ';
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('store.sales');
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'package_name' => 'required',
            'validity_date' => 'required|date',
            'price' => 'required|numeric',
            'status' => 'required|numeric',
        ]);
        Sales::create($validatedData);
        return redirect()->route('store.sales.index')->with('success', 'Sales created successfully.');
    }

    public function show($id)
    {
        $sales = Sales::findOrFail($id);
        return response()->json($sales);
    }
    public function update(Request $request, $id)
    {
        //$package = Packages::findOrFail($id);
        $sales = Sales::findOrFail($id);

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
        $sales->update($validatedData);


        return redirect()->route('store.sales.index')->with('success', 'Sales updated successfully.');
    }


    public function destroy($id)
    {
        Sales::findOrFail($id)->delete();
        return redirect()->route('store.sales.index')->with('success', 'Sales deleted successfully.');
    }
}
