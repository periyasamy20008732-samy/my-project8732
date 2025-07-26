<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 use App\Models\Customer; 
 use App\Models\Packages; 


class DashboardController extends Controller
{
   public function index()
    {
        $user = Auth::user();

        if ($user->user_level == 1) {
            return view('admin.dashboard', ['user' => $user]);
        }

        if ($user->user_level == 2) {
            return view('admin.dashboard', ['user' => $user]);
        }

        abort(403, 'Unauthorized role.');
    } 

   /*     public function dashboard()
    {
       
        $customers = Customer::latest()->get();
        $totalCustomers = $customers->count();

        return view('admin.dashboard', compact('customers', 'totalCustomers'));

    } */
  
    public function dashboard()
    {
        // Fetch data for dashboard
        $customers = Customer::latest()->get();
        $totalCustomers = $customers->count();

        $packages = Packages::latest()->get();
        $totalPackage = $packages->count();

        // Return view with all variables
        return view('admin.dashboard', compact(
            'customers',
            'totalCustomers',
            'packages',
            'totalPackage'
        ));
    } 
}