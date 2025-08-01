<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\RazorpayPaymentController;
use App\Models\Packages;
use App\Models\User;
use Illuminate\Http\Request;



class PaymentController extends Controller
{
    //

    public function paynow($mobile, $package_id)
    {
        $user = User::where('mobile', $mobile)->first();

        $package = Packages::where('id', $package_id)->first();

        if (!$user || !$package) {
            return redirect()->back()->with('error', 'User or Package not found');
        }


        return view('paynow', compact('user', 'package'));

    }



}