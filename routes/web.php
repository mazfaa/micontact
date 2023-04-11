<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegistrationController;

Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('/contact', ContactController::class);
    Route::post('/logout', LogoutController::class)->name('logout');
});

Route::middleware('guest')->group(function() {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/register', [RegistrationController::class, 'create'])->name('register');
    Route::post('/register', [RegistrationController::class, 'store']);
});