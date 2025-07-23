<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Packages;
use Illuminate\Support\Facades\Crypt;

class PackageController extends Controller
{

    public function index()
    {
        $package = Packages::all();
        return view('admin.package', compact('package'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_name' => 'required',
            'validity_date' => 'required',
            'price' => 'required'
        ]);

        Packages::create($validated);

        return redirect()->route('admin.package')->with('success', 'Package created successfully.');
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email,' . $id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        $customer->update($validated);

        return redirect()->route('admin.package')->with('success', 'Customer updated successfully.');
    }

   /* public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customer')->with('success', 'Customer deleted successfully.');
    }*/
        
    public function destroy($encryptedId)
{
    $id = Crypt::decrypt($encryptedId);
    $customer = Packages::findOrFail($id);
    $customer->delete();

    return redirect()->route('admin.package')->with('success', 'Customer deleted');
}
}