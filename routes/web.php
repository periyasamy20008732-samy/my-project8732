<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// ---------- Home page ----------
Route::get('/', function () {
    return view('index');
});


Route::get('/customerview', function () {
    return view('admin.customer.customerview');
});


// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard (protected)
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
      Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
      //  Route::post('/customer', [CustomerController::class, 'store'])->name('customers.store');
        //Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customers.update');
    

       // Order matters! Put /edit route above /{id}
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{id}/edit', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');



     Route::get('/tax', [PackageController::class, 'index'])->name('tax');
        Route::get('/unit', [PackageController::class, 'index'])->name('unit');
        Route::get('/country', [PackageController::class, 'index'])->name('country');
       
        Route::get('/package', [PackageController::class, 'index'])->name('package'); 
        // Add more routes here
    });



    /*


    Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });*/