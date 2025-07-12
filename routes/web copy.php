<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LoginController ;

//use App\Http\Controllers\Admin\LoginController;



// Home page
Route::get('/', function () {
    return view('index');
});

// Admin login (blade page)
Route::get('/admin', function () {
    return view('admin.auth.login');
})->name('admin.login.form');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('dashboard');
// Admin login POST
//Route::post('/admin', [AuthController::class, 'login'])->name('admin.login');

// User login (blade page)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');

// User login POST
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard (requires login)
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');
Route::get('/customer', function () {
    return view('admin.customer');
})->middleware('auth')->name('admin.customer');

Route::get('/package', function () {
    return view('admin.package');
})->middleware('auth')->name('admin.package');


Route::get('/tax', function () {
    return view('admin.tax');
})->middleware('auth')->name('admin.tax');

Route::get('/unit', function () {
    return view('admin.unit');
})->middleware('auth')->name('admin.unit');

Route::get('/core', function () {
    return view('admin.core');
})->middleware('auth')->name('admin.core');

Route::get('/country', function () {
    return view('admin.country');
})->middleware('auth')->name('admin.country');