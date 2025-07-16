<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\CustomRegisterController;

Route::get('/', function () {
    return view('welcome');
});

// Registro
Route::get('/register', [CustomRegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [CustomRegisterController::class, 'register'])->name('custom.register');

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [CustomLoginController::class, 'login'])->name('custom.login');


Route::middleware('check.custom.auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/logout', function () {
        session()->forget('user');
        return redirect()->route('login');
    })->name('logout');
});
