<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\StoreLoginController;
use App\Http\Controllers\Auth\WebLoginController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Payment\RazorpayPaymentController;
use App\Http\Controllers\Account\PaymentController;


use Illuminate\Foundation\PackageManifest;
use Illuminate\Support\Facades\Route;

// ---------- Home Website Start----------//

Route::get('/', function () {
    return view('index');
});
Route::get('/pricing', function () {
    return view('pricing');
});
Route::get('/pricing', [PackageController::class, 'home_index'])->name('packages');

Route::get('/about-us', function () {
    return view('about');
});
Route::get('/partner-program', function () {
    return view('partnerprogram');
});

Route::get('/contact-us', function () {
    return view('contact');
});

//Route::get('/paynow', [RazorpayPaymentController::class, 'index']);

//Route::get('/paynow/{mobile}/{package_id}', [PaymentController::class, 'paynow']);
Route::get('/paynow/{mobile}/{package_id}', [PaymentController::class, 'paynow'])->name('paynow');

Route::post('/paynow/order', [RazorpayPaymentController::class, 'createOrder'])->name('razorpay.order');
Route::post('/paynow/success', [RazorpayPaymentController::class, 'paymentSuccess'])->name('razorpay.success');

// ---------- Home Website End ----------

// ---------- Account start ----------

Route::get('/account', [WebLoginController::class, 'showLoginForm'])->name('accountlogin.form');
Route::get('/account/login-password', [WebLoginController::class, 'showLoginpasswordForm'])->name('accountloginpassword.form');
Route::get('/account/signup', [WebLoginController::class, 'showsignupForm'])->name('accountsignup.form');
Route::post('/account/login', [WebLoginController::class, 'login'])->name('accountlogin');

Route::post('/account/getotp', [WebLoginController::class, 'getotp'])->name('getotp');
Route::post('/account/verify', [WebLoginController::class, 'verifyotp'])->name('verifyotp');


Route::prefix('account')->middleware(['auth'])->name('account.')->group(function () {

    Route::get('/dashboard', [WebLoginController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [WebLoginController::class, 'logout'])->name('logout');

});

// ---------- Account End ----------

// ---------- Admin side ----------


//Admin Login routes
Route::get('/admin', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    Route::resource('package', PackageController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('tax', TaxController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('country', UnitController::class);
    // Route::get('/', [PackageController::class, 'index'])->name('country');

    /*
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{id}/edit', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');*/



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

// ---------- Admin side END ----------//

// ---------- Store side Start ----------//

//Store Login Routes 

Route::get('/store', [StoreLoginController::class, 'showLoginForm'])->name('storelogin.form');
Route::post('/store/login', [StoreLoginController::class, 'login'])->name('storelogin');
Route::get('/store/register', [StoreLoginController::class, 'showRegisterForm'])->name('storeregister.form');

Route::prefix('store')->middleware(['auth'])->name('store.')->group(function () {

    Route::resource('package', PackageController::class);

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // In routes/web.php
    Route::get('/dashboard', [DashboardController::class, 'store_index'])->name('dashboard');

    //::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');



});


// ---------- Store Side End ----------//


/*
Route::prefix('admin')
->middleware('auth')
->name('admin.')
->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});*/