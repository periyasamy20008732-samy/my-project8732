<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Users\Controllers\DashboardController;

Route::prefix('users-module')->name('usersmodule.')->group(function () {
    Route::get('/list', [DashboardController::class, 'index'])->name('list');
});