<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//RUTAS ROLES
//grupo rutas administrador
Route::middleware(['auth', 'role:administrador'])->prefix('admin')->group(function (){
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
    //mas rutas del administrador
});


//grupo rutas paciente
Route::middleware(['auth', 'role:paciente'])->prefix('paciente')->group(function (){
    Route::get('/dashboard', [App\Http\Controllers\Paciente\AdminController::class, 'dashboard'])->name('paciente.dashboard');
    //mas rutas del administrador
});


//grupo rutas paciente
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->group(function (){
    Route::get('/dashboard', [App\Http\Controllers\Doctor\AdminController::class, 'dashboard'])->name('doctor.dashboard');
    //mas rutas del administrador
});
