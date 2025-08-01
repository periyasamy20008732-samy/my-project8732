<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\RazorpayPaymentController;
use App\Models\Packages;
use Illuminate\Http\Request;
use App\Models\User;


class PaymentController extends Controller
{
    //

    public function paynow($mobile, $package_id)
    {
        $user = User::where('mobile', $mobile)
            ->first();

        $package = Packages::where('id', $package_id)->first();


        return view('paynow', compact('user', 'package'));
    }


    public function paynowdata(Request $request)
    {

        $credentials = $request->validate([
            'mobile' => ['required', 'numeric'],
            'package_id' => ['required', 'numeric'],
        ]);

        dd($credentials);
        //return view('paynow');
    }
}