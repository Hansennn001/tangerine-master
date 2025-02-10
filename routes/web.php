<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

use App\Http\Controllers\MembershipController;
use App\Http\Controllers\AuthController;

Route::get('/membership', [MembershipController::class, 'index'])->name('membership');
Route::post('/membership', [MembershipController::class, 'store'])->name('membership.store');


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});