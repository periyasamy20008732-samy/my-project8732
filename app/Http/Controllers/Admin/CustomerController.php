<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    // Show all packages

 /*  public function index()
{
    $customers = Customer::latest()->get(); // plural
    $totalCustomers = $customers->count();
    return view('admin.customer', compact('customers', 'totalCustomers'));
}*/

 public function index()
    {
        // This method can still be used for listing customers elsewhere
        $customers = Customer::latest()->get();
        return view('admin.customer', compact('customers'));
    }
    


    // Store new package
    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'validity_date' => 'required|date',
            'price' => 'required|numeric',
        ]);

        Customer::create([
            'package_name' => $request->package_name,
            'validity_date' => $request->validity_date,
            'price' => $request->price,
            'status' => 'Active', // default status
        ]);

        return redirect()->back()->with('success', 'Package created successfully.');
    }

    // Update package (Optional if you want to build Edit logic)
public function update(Request $request, $id)
{
    $request->validate([
        'package_name' => 'required|string|max:255',
        'validity_date' => 'required|date',
        'price' => 'required|numeric',
    ]);

    $package = Customer::findOrFail($id);
    $package->update([
        'package_name' => $request->package_name,
        'validity_date' => $request->validity_date,
        'price' => $request->price,
    ]);

    return redirect()->back()->with('success', 'Package updated successfully.');
}
    // (Optional) Delete package
    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect()->back()->with('success', 'Package deleted successfully.');
    }
}