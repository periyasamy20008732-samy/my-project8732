<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packages;

class PackageController extends Controller
{
    // Show all packages
    public function index()
    {
        $package = Packages::latest()->get();
        return view('admin.package', compact('package'));
    }

    // Store new package
    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'validity_date' => 'required|date',
            'price' => 'required|numeric',
            
        ]);

        Packages::create([
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

    $package = Packages::findOrFail($id);
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
        Packages::destroy($id);
        return redirect()->back()->with('success', 'Package deleted successfully.');
    }
}