<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    // Display page and handle DataTables AJAX
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '<span class="badge badge-linesuccess">' . ($row->status ?? 'Active') . '</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="edit-delete-action d-flex">
                        <button type="button" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#edit-customer" data-id="' . $row->id . '" style="border: none; background: transparent; padding: 0; margin-right: 5px;">
                            <img src="' . asset('admin-assets/img/icons/edit.svg') . '" alt="Edit">
                        </button>
                        <form id="delete-form-' . $row->id . '" action="' . route('admin.customer.destroy', $row->id) . '" method="POST" style="display:inline;">
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

        return view('admin.customer');
    }

    // Store a new customer
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_code' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        Customer::create([
            'customer_name' => $request->customer_name,
            'customer_code' => $request->customer_code, // used as email in Blade
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.customer.index')->with('success', 'Customer created successfully.');
    }

    // Update customer (optional for edit modal)
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_code' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update([
            'customer_name' => $request->customer_name,
            'customer_code' => $request->customer_code,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.customer.index')->with('success', 'Customer updated successfully.');
    }

    // Delete customer
    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect()->back()->with('success', 'Customer deleted successfully.');
    }

    // Optional: For AJAX Edit Modal
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }
}