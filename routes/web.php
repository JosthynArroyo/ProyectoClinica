<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CitaController;

// -----------------------------
// RUTAS PÚBLICAS / FRONT
// -----------------------------
Route::get('/', function () { return view('welcome'); });
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// -----------------------------
// RUTAS ADMINISTRADOR
// -----------------------------
Route::middleware(['auth', 'role:administrador'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/citas/export', [App\Http\Controllers\Admin\CitaExportController::class, 'export'])->name('admin.citas.export');
});

// -----------------------------
// RUTAS PACIENTE
// -----------------------------
Route::middleware(['auth', 'role:paciente'])->prefix('paciente')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Paciente\AdminController::class, 'dashboard'])->name('paciente.dashboard');
    Route::get('/citas', [CitaController::class, 'index'])->name('paciente.citas'); // lista citas paciente
    Route::get('/crear-cita', [CitaController::class, 'create'])->name('paciente.crear-cita'); // formulario crear
    Route::post('/crear-cita', [CitaController::class, 'store'])->name('paciente.crear-cita.store'); // guardar cita
    Route::post('/citas/{id}/cancelar', [CitaController::class, 'cancelar'])->name('paciente.citas.cancelar'); // cancelar
    Route::get('/editar-cita/{id}', [CitaController::class, 'edit'])->name('paciente.editar-cita'); // editar/reagendar
    Route::post('/editar-cita/{id}', [CitaController::class, 'actualizar'])->name('paciente.editar-cita.update'); // actualizar cita
    Route::view('/historial', 'paciente.historial')->name('paciente.historial'); 
    Route::view('/mensajes', 'paciente.mensajes')->name('paciente.mensajes');
    Route::view('/preferencias', 'paciente.preferencias')->name('paciente.preferencias');
});

// -----------------------------
// RUTAS DOCTOR
// -----------------------------
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Doctor\AdminController::class, 'dashboard'])->name('doctor.dashboard');
    Route::get('/citas', [CitaController::class, 'indexDoctor'])->name('doctor.citas'); // lista citas doctor
    Route::post('/citas/{id}/aceptar', [CitaController::class, 'aceptar'])->name('doctor.citas.aceptar');
    Route::post('/citas/{id}/rechazar', [CitaController::class, 'rechazar'])->name('doctor.citas.rechazar');
    Route::post('/citas/{id}/realizar', [CitaController::class, 'realizar'])->name('doctor.citas.realizar');
});

// -----------------------------
// LOGOUT
// -----------------------------
Route::get('/salir', function () {
    Auth::logout();
    return redirect('/');
})->name('salir');
