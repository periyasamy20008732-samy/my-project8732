<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\TaxController;
use Illuminate\Foundation\PackageManifest;
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
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

      Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
     

      
      //  Route::post('/customer', [CustomerController::class, 'store'])->name('customers.store');
        //Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customers.update');
    

       // Order matters! Put /edit route above /{id}
  //  Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{id}/edit', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

   // Route::get('/dashboard', [PackageController::class, 'dashboard'])->name('dashboard');


    Route::get('/packages', [PackageController::class, 'index'])->name('package');
    Route::post('/packages', [PackageController::class, 'store'])->name('package.store');
    Route::put('/packages/{id}', [PackageController::class, 'update'])->name('package.update');
    Route::delete('/packages/{id}', [PackageController::class, 'destroy'])->name('package.destroy');

 
    //Route::get('/tax', [PackageController::class, 'index'])->name('tax');

   Route::get('/tax', function () {
    return view('admin.tax');
})->name('tax');
 
Route::resource('projects', TaxController::class);


    
    Route::get('/unit', [PackageController::class, 'index'])->name('unit');
    
    Route::get('/country', [PackageController::class, 'index'])->name('country');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings/{id}', [SettingsController::class, 'update'])->name('settings.update');



       
         
        // Add more routes here
    });



    /*


    Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });*/