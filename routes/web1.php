<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CustomerController;

//Route::resource('posts', CustomerController::class);
Route::resource('customers', CustomerController::class);

// ✅ Admin login page (GET)
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');

// Home page
Route::get('/', function () {
    return view('index');
});

// Admin login page (GET)
Route::get('/admin', function () {
    return view('admin.auth.login');
})->name('admin.login');

Route::post('/admin', [AuthController::class, 'login'])->name('admin.loginpost');


//Route::middleware('auth:Admin')->group(function () {
Route::get('/store/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
Route::get('/admin/core', function () {
    return view('admin.core');
})->name('admin.core');

Route::get('/admin/package', function () {
    return view('admin.package');
})->name('admin.package');

Route::get('/admin/tax', function () {
    return view('admin.tax');
})->name('admin.tax');

Route::get('/admin/unit', function () {
    return view('admin.unit');
})->name('admin.unit');


Route::get('/admin/sales-dashboard', function () {
    return view('admin.sales-dashboard');
})->name('admin.sales-dashboard');

Route::get('/admin/customer', function () {
    return view('admin.customer');
})->name('admin.customer');

Route::get('/admin/country', function () {
    return view('admin.country');
})->name('admin.country');
//}); 