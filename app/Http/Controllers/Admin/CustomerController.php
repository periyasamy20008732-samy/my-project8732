<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()

    {
        $customer = Customer::all();
        return view('admin.customer', compact('customer'));
    }
       
    // return view('admin.customer');

    public function store(Request $request)
    {
          $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:20',
        ]);

        Customer::create($validated);
        
        return redirect()->route('admin.customer')->with('success', 'Customer created successfully.');
    }
public function update(Request $request, $id)
{
    // Validate incoming request
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:100',
        'country' => 'nullable|string|max:100',
        'description' => 'nullable|string|max:1000',
        // Add other fields here
    ]);

    // Fetch and update the customer
    $customer = Customer::findOrFail($id);
    $customer->update($validatedData);

    return redirect()->route('admin.customer')->with('success', 'Customer updated successfully.');
}

}