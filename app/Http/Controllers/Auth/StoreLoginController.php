<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;


class StoreLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('store.auth.login');
    }

    public function showRegisterForm()
    {
        return view('store.auth.register');
    }

    /*  public function login(Request $request)
     {
         $credentials = $request->validate([
             'email' => ['required', 'email'],
             'password' => ['required'],
         ]);

         if (Auth::attempt($credentials, $request->boolean('remember'))) {
             $request->session()->regenerate();

             return redirect()->route('store.dashboard');
         }

         throw ValidationException::withMessages([
             'login' => 'Invalid email or password.',
         ]);
     } */

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check user existence and allowed user_level
        $user = User::where('email', $credentials['email'])
            ->whereIn('user_level', [4, 5, 6])
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Access denied. Only admin-level users can login.',
            ]);
        }

        // Now try login only if user is valid and has allowed level
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('store.dashboard');
        }

        throw ValidationException::withMessages([
            'login' => 'Invalid email or password.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
