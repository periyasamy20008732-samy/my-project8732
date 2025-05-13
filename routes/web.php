<?php

use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return view('index');
});

Route::get('/admin', function () {
    return view('admin.auth.login');
=======
Route::get('/', function () {
    return view('welcome');
>>>>>>> efb3858ceaa94a5283bbc7d05946b724a55cab23
});
