<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CitaController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// RUTAS ROLES

// grupo rutas administrador
Route::middleware(['auth', 'role:administrador'])->prefix('admin')->group(function (){
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
    // mas rutas del administrador
});

// grupo rutas paciente
Route::middleware(['auth', 'role:paciente'])->prefix('paciente')->group(function (){
    Route::get('/dashboard', [App\Http\Controllers\Paciente\AdminController::class, 'dashboard'])->name('paciente.dashboard');
    // rutas del paciente
    Route::get('/citas', [CitaController::class, 'index'])->name('paciente.citas');
    Route::get('/citas/crear', [CitaController::class, 'create'])->name('paciente.citas.crear');
    Route::post('/citas', [CitaController::class, 'store'])->name('paciente.citas.store');

    // nuevas vistas solicitadas
    Route::view('/historial', 'paciente.historial')->name('paciente.historial');
    Route::view('/mensajes', 'paciente.mensajes')->name('paciente.mensajes');
    Route::view('/preferencias', 'paciente.preferencias')->name('paciente.preferencias');
    Route::get('/citas/crear', [CitaController::class, 'create'])->name('paciente.citas.crear');
    Route::post('/citas', [CitaController::class, 'store'])->name('paciente.citas.store');

});

// grupo rutas doctor
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->group(function (){
    Route::get('/dashboard', [App\Http\Controllers\Doctor\AdminController::class, 'dashboard'])->name('doctor.dashboard');
    // mas rutas del doctor
});

// Cerrar Sesión Dashboard Admin
Route::get('/salir', function () {
    Auth::logout(); 
    return redirect('/'); 
})->name('salir');
