<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // For authentication

class AuthController extends Controller
{

 public function login(Request $request)
{
    $request->validate([  
        'email' => 'required|string',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        if (Auth::user()->role == "superadmin" || Auth::user()->role == "admin") {
            return redirect()->route('home');
        } else {
            return redirect()->route('store.dash');
        }
    } else {
        return back()->withErrors(['login_error' => 'Invalid username or password']);
    }
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}