<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\SukuBungaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('/credits', CreditController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/approval', ApprovalController::class);
    Route::resource('/sukubunga', SukuBungaController::class);

    Route::patch('/approvalmka/{id}', [ApprovalController::class, 'approvalmka'])->name('approval.approvemka');
    Route::get('/print/{id}', [CreditController::class, 'print_credit_approved'])->name('credits.print');
});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
