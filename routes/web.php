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
    Route::get('/get_detail_scoring/{id}', [ApprovalController::class, 'detail_score'])->name('approval.skoring');
    Route::get('/print_credit/{id}', [CreditController::class, 'print_credit'])->name('credits.print_credit');
    Route::get('/approval_detail/{id}', [ApprovalController::class, 'approval_detail'])->name('approval.detail');
    Route::get('/get_instalment', [CreditController::class, 'get_instalment'])->name('credits.get_instalment');

    Route::patch('/approvalmka/{id}', [ApprovalController::class, 'approvalmka'])->name('approval.approvemka');
    Route::patch('/approval_head_division/{id}', [ApprovalController::class, 'approval_head_division'])->name('approve.head_division');
    Route::patch('/reject_credit/{id}', [ApprovalController::class, 'reject_credit'])->name('approval.reject_credit');

    Route::post('/get_document', [CreditController::class, 'get_document'])->name('credits.get_document');
});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
