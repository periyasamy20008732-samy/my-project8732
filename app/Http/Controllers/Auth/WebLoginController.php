<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Services\SmsService;
use Illuminate\Validation\ValidationException;
use Cache;

class WebLoginController extends Controller
{



    public function showLoginForm()
    {
        return view('account.auth.login');
    }
    public function showLoginpasswordForm()
    {
        return view('account.auth.loginpassword');
    }

    public function showsignupForm()
    {
        return view('account.auth.signup');
    }

    public function dashboard()
    {
        return view('account.dashboard');
    }




    // public function showRegisterForm()
    // {
    //     return view('store.auth.register');
    // }


    public function getotp(Request $request, SmsService $smsService)
    {
        // $credentials = $request->validate([
        //     'country_code' => ['required'],
        //     'mobile' => ['required', 'numeric'],
        // ]);

        $request->validate(['mobile' => 'required', 'country_code' => 'required']);

        $otp = rand(1000, 9999);
        $expiresAt = now()->addMinutes(5);

        // Store OTP temporarily (in cache, not DB)
        $cached = cache()->put('otp_' . $request->mobile, [
            'otp' => $otp,
            'mobile' => $request->mobile,
            'expires_at' => $expiresAt
        ], $expiresAt);

        $message = str_replace('{code}', $otp, DB::table('site_config')->value('sms_msg') ?? 'Your OTP code is {code}');
        $smsResponse = $smsService->send($request->mobile, $message);
        // dd($smsResponse);

        $cacheKey = 'otp_' . $request->mobile; // however you're identifying the mobile
        $cached = Cache::get($cacheKey);

        return view('account.auth.verify', [
            'mobile' => $cached['mobile'] ?? ''
        ]);
    }
    public function verifyotp(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'otp' => 'required'
        ]);

        $cached = cache()->get('otp_' . $request->mobile);

        if (!$cached || $cached['otp'] != $request->otp || now()->greaterThan($cached['expires_at'])) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired OTP.'
            ], 401);
        }



        // Clear OTP after use
        cache()->forget('otp_' . $request->mobile);

        // OTP is valid — now check if mobile exists in DB
        $user = User::where('mobile', $request->mobile)
            ->whereIn('user_level', [10, 11])
            ->first();

        if ($user) {
            Auth::login($user); // log in the user
            $request->session()->regenerate(); // regenerate session to prevent fixation


            return redirect()->route('account.dashboard');
        } else {
            return redirect()->route('accountlogin.form')->withErrors([
                'mobile' => 'Mobile number not registered.'
            ]);
        }
    }
    public function accountlogin(Request $request)
    {
        $credentials = $request->validate([
            'country_code' => ['required'],
            'mobile' => ['required', 'numeric'],
            'password' => ['required'],
        ]);

        // Check user existence and allowed user_level
        $user = User::where('country_code', $credentials['country_code'])
            ->where('mobile', $credentials['mobile'])
            ->whereIn('user_level', [10, 11])
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'mobile' => 'Access denied.',
            ]);
        }

        // Now try login only if user is valid and has allowed level
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('account.dashboard');
        }

        throw ValidationException::withMessages([
            'login' => 'Invalid mobile or password.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //return redirect()->route('login.form');
        return view('index');
    }
}
