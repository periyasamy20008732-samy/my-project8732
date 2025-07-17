<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}