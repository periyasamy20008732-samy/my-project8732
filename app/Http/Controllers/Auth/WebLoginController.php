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

class WebLoginController extends Controller
{



    public function showLoginForm()
    {
        return view('account.auth.login');
    }

    // public function showRegisterForm()
    // {
    //     return view('store.auth.register');
    // }



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
                'email' => 'Access denied. Only admin-level users can login.',
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