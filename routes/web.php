<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\MksController;
use App\Http\Controllers\SukuBungaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('/credits', CreditController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/approval', ApprovalController::class);
    Route::resource('/sukubunga', SukuBungaController::class);
    Route::resource('/mks', MksController::class);

    Route::get('/print/{id}', [CreditController::class, 'print_credit_approved'])->name('credits.print');
    Route::get('/get_nasabah/{id}', [CreditController::class, 'get_nasabah'])->name('get_nasabah');
    Route::patch('/approvalmka/{id}', [ApprovalController::class, 'approvalmka'])->name('approval.approvemka');
    Route::post('/get_document', [CreditController::class, 'get_document'])->name('credits.get_document');
});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
