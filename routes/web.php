<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\StoreLoginController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\TaxController;
use Illuminate\Foundation\PackageManifest;
use Illuminate\Support\Facades\Route;

// ---------- Home Website ----------
Route::get('/', function () {
    return view('index');
});
Route::get('/pricing', function () {
    return view('pricing');
});
Route::get('/about-us', function () {
    return view('about');
});
Route::get('/partner-program', function () {
    return view('partnerprogram');
});

Route::get('/contact-us', function () {
    return view('contact');
});

// Route::get('pricing', function () {
//     return view('admin.package');
// });
Route::get('/pricing', [PackageController::class, 'home_index'])->name('packages');

// ---------- Home Website End ----------


//Admin Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {

    Route::resource('package', PackageController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{id}/edit', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    Route::get('/tax', [TaxController::class, 'index'])->name('tax');

    Route::get('/unit', [PackageController::class, 'index'])->name('unit');

    Route::get('/country', [PackageController::class, 'index'])->name('country');


    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings/{id}', [SettingsController::class, 'update'])->name('settings.update');

    //  Route::post('/customer', [CustomerController::class, 'store'])->name('customers.store');
    //Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customers.update');
    // Order matters! Put /edit route above /{id}
    //  Route::get('/customers', [CustomerController::class, 'index'])->name('customers');


    // Route::get('/dashboard', [PackageController::class, 'dashboard'])->name('dashboard');

    /*
        Route::get('/packages', [PackageController::class, 'index'])->name('package');
        Route::post('/packages', [PackageController::class, 'store'])->name('package.store');
        Route::put('/packages/{id}', [PackageController::class, 'update'])->name('package.update');
        Route::delete('/packages/{id}', [PackageController::class, 'destroy'])->name('package.destroy');*/


    //Route::get('/tax', [PackageController::class, 'index'])->name('tax');
    // Add more routes here

});


//Store Login Routes 
Route::get('/store', [StoreLoginController::class, 'showLoginForm'])->name('storelogin.form');
Route::post('/store/login', [StoreLoginController::class, 'login'])->name('storelogin');
Route::get('/store/register', [StoreLoginController::class, 'showRegisterForm'])->name('storeregister.form');

Route::prefix('store')->middleware(['auth'])->name('store.')->group(function () {

    Route::resource('package', PackageController::class);

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // In routes/web.php
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');



});



/*
Route::prefix('admin')
->middleware('auth')
->name('admin.')
->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});*/