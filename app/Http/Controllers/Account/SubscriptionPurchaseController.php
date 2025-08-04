<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionPurchase;

class SubscriptionPurchaseController extends Controller
{
    // Show all subscription payments
    public function index()
    {
        $subscriptions = SubscriptionPurchase::all();
        return view('subscriptions.index', compact('subscriptions'));
    }

    // Insert a new subscription payment
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'package_id' => 'required|integer',
            'validity_date' => 'required|date',
            'payment_id' => 'nullable|string',
            'payment_status' => 'required|string',
            'if_webpanel' => 'nullable|boolean',
            'if_android' => 'nullable|boolean',
            'if_windows' => 'nullable|boolean',
            'price' => 'required|numeric',
            'if_customerapp' => 'nullable|boolean',
            'if_deliveryapp' => 'nullable|boolean',
            'if_exicutiveapp' => 'nullable|boolean',
            'if_multistore' => 'nullable|boolean',
            'if_numberof_store' => 'nullable|integer',
        ]);

        SubscriptionPurchase::create($validatedData);

        return redirect()->back()->with('success', 'Subscription created successfully!');
    }

    // Update an existing subscription payment
    public function update(Request $request, $id)
    {
        $subscription = SubscriptionPurchase::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'package_id' => 'required|integer',
            'validity_date' => 'required|date',
            'payment_id' => 'nullable|string',
            'payment_status' => 'required|string',
            'if_webpanel' => 'nullable|boolean',
            'if_android' => 'nullable|boolean',
            'if_windows' => 'nullable|boolean',
            'price' => 'required|numeric',
            'if_customerapp' => 'nullable|boolean',
            'if_deliveryapp' => 'nullable|boolean',
            'if_exicutiveapp' => 'nullable|boolean',
            'if_multistore' => 'nullable|boolean',
            'if_numberof_store' => 'nullable|integer',
        ]);

        $subscription->update($validatedData);

        return redirect()->back()->with('success', 'Subscription updated successfully!');
    }
}