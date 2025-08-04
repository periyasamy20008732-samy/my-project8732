<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SubscriptionPurchase;
use App\Models\Packages;
use Illuminate\Support\Facades\Auth;

class AccountDashboardController extends Controller
{
    //
    public function dashboard(Request $request)
    {
        // Fetch data for dashboard
        // $customers = Customer::latest()->get();
        // $totalCustomers = $customers->count();

        //  $user = User::where('country_code', $credentials['country_code'])
        // ->where('mobile', $credentials['mobile'])
        // ->whereIn('user_level', [10, 11])
        // ->first();


        $subscription = SubscriptionPurchase::where('user_id', Auth::id())->get();
        $totalsubscription = $subscription->count();

        // Return view with all variables
        return view('account.dashboard', compact(

            'subscription',
            'totalsubscription',

        ));
    }
}
