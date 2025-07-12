<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\CustomerController;





// Home page
Route::get('/', function () {
    return view('index');
});

Route::get('/admin/dashboard', [Dashboard::class, 'dashboard'])->name('admin.dashboard');

// Admin login page (custom blade)
Route::get('/admin', function () {
    return view('admin.auth.login');
})->name('admin.login.form');

// User login routes (controller-based)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes - requires authentication
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');

    Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customer');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    
    Route::view('/package', 'admin.package')->name('admin.package');
    Route::view('/tax', 'admin.tax')->name('admin.tax');
    Route::view('/unit', 'admin.unit')->name('admin.unit');
    Route::view('/core', 'admin.core')->name('admin.core');
    Route::view('/country', 'admin.country')->name('admin.country');
});