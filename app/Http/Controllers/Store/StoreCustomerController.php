<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CountrySettings;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class StoreCustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::latest()->get();
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
                  <div class="edit-delete-action">
                  <a class="me-2 p-2  view-btn" data-id="' . $row->id . '" ><i data-feather="eye" class="text-secondary" style="width: 18px; height: 18px;"></i></i></a> 
                  <a class="me-2 p-2  edit-btn" data-id="' . $row->id . '"  ><i data-feather="edit" class="text-info" style="width: 18px; height: 18px;"></i></a> 

                  <form id="delete-form-' . $row->id . '" action="' . route('store.customer.destroy', $row->id) . '" method="POST" style="display:inline;">
                  ' . csrf_field() . method_field('DELETE') . '
                  <a class="confirm-text p-2  delete-btn" data-id="' . $row->id . '"  ><i data-feather="trash-2"  class="text-danger" style="width: 18px; height: 18px;"></i></a> 
                  </form>
                  
                </div>
                </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        $countries = CountrySettings::all();
        return view('store.customer', compact('countries'));
    }

    /**
     * Store a new customer.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(

            $request->all(),
            [
                'customer_name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'country_id' => 'required|string|max:255',
                'mobile' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                //  'address' => 'required|string|max:255',
                'postcode' => 'required|string|max:255',
                'attachment_1' => 'sometimes|file|image|nullable',
            ]
        );
        /*    if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } */
        $file = $request->file('attachment_1');
        $directory = 'storage/public/customer/';
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $imageName);

        $data = $request->all();
        $data['attachment_1'] = $directory . $imageName;


        $customer = Customer::create($data);

        return redirect()->route('store.customer.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Get customer info for edit modal via AJAX.
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    /**
     * Update customer details.
     */

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'string|max:255',
            'country_id' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'attachment_2' => 'sometimes|file|image|nullable',
        ]);

        // Handle image upload if present
        if ($request->hasFile('attachment_2')) {
            $file = $request->file('attachment_2');
            $directory = 'storage/customer/';
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($directory), $imageName);
            $validatedData['attachment_2'] = $directory . $imageName;
        }

        $customer->fill($validatedData)->save();

        return redirect()->route('store.customer.index')->with('success', 'Customer updated successfully.');
    }


    /**
     * Delete customer.
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect()->back()->with('success', 'Customer deleted successfully.');
    }
}
