<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LoginController ;




Route::get('/', function () {
    return view('index');
});

Route::get('/admin', function () {
    return view('admin.auth.login');
})->name('login');

//Route::post('/admin', [AuthController::class, 'login'])->name('admin.login');


Route::get('/login', [LoginController ::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController ::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController ::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('dashboard');