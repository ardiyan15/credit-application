<?php

use App\Http\Controllers\CreditController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('/credits', CreditController::class);
Route::resource('/users', UserController::class);

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
