<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function dashboard()
    {
        $admin = Auth::user();
        return view('admin.dashboard', compact('admin'));
    }
}