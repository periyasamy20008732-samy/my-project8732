<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }


    public function loginCheck(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        // MD5 password match (legacy)
        if (md5($credentials['password']) !== $user->password) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        // Only allow admin access
        if ($user->user_level !== 'admin') {
            return back()->withErrors(['email' => 'Unauthorized access.']);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }



    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}