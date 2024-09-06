<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/password_update', [DashboardController::class, 'UpdatePassword'])->name('UpdatePassword');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

