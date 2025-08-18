<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CitaController;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Autenticación
Auth::routes();

// Ruta por defecto luego de login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// RUTAS POR ROLES
// ----------------------------

// Grupo de rutas para ADMINISTRADOR
Route::middleware(['auth', 'role:administrador'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
    // más rutas del administrador
});

// Grupo de rutas para PACIENTE
Route::middleware(['auth', 'role:paciente'])->prefix('paciente')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Paciente\AdminController::class, 'dashboard'])->name('paciente.dashboard');

    // Rutas del paciente - Citas
    Route::get('/citas', [CitaController::class, 'index'])->name('paciente.citas');
    Route::get('/citas/crear', [CitaController::class, 'create'])->name('paciente.citas.crear');
    Route::post('/citas', [CitaController::class, 'store'])->name('paciente.citas.store');

    // Nuevas vistas solicitadas
    Route::view('/historial', 'paciente.historial')->name('paciente.historial');
    Route::view('/mensajes', 'paciente.mensajes')->name('paciente.mensajes');
    Route::view('/preferencias', 'paciente.preferencias')->name('paciente.preferencias');
});

// Grupo de rutas para DOCTOR
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Doctor\AdminController::class, 'dashboard'])->name('doctor.dashboard');
    // más rutas del doctor
});

// Cerrar sesión
Route::get('/salir', function () {
    Auth::logout(); 
    return redirect('/'); 
})->name('salir');
