<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\Admin\AdminController as AdminDashboardController;
use App\Http\Controllers\ExportCitasController; // Ajustado al namespace correcto
use App\Http\Controllers\Paciente\AdminController as PacienteDashboardController;
use App\Http\Controllers\Doctor\AdminController as DoctorDashboardController;

// -----------------------------
// RUTAS PÚBLICAS
// -----------------------------
Route::get('/', function () {
    return view('welcome');
});

Auth::routes(); // login, register, etc.

// -----------------------------
// RUTAS ADMINISTRADOR
// -----------------------------
Route::middleware(['auth', 'role:administrador'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/citas/export', [ExportCitasController::class, 'exportarCitas'])->name('admin.citas.export');
});

// -----------------------------
// RUTAS PACIENTE
// -----------------------------
Route::middleware(['auth', 'role:paciente'])->prefix('paciente')->group(function () {
    Route::get('/dashboard', [PacienteDashboardController::class, 'dashboard'])->name('paciente.dashboard');
    Route::get('/citas', [CitaController::class, 'index'])->name('paciente.citas');
    Route::get('/crear-cita', [CitaController::class, 'create'])->name('paciente.crear-cita');
    Route::post('/crear-cita', [CitaController::class, 'store'])->name('paciente.crear-cita.store');
    Route::post('/citas/{id}/cancelar', [CitaController::class, 'cancelar'])->name('paciente.citas.cancelar');
    Route::get('/editar-cita/{id}', [CitaController::class, 'edit'])->name('paciente.editar-cita');
    Route::post('/editar-cita/{id}', [CitaController::class, 'actualizar'])->name('paciente.editar-cita.update');
    Route::view('/historial', 'paciente.historial')->name('paciente.historial');
    Route::view('/mensajes', 'paciente.mensajes')->name('paciente.mensajes');
    Route::view('/preferencias', 'paciente.preferencias')->name('paciente.preferencias');
});

// -----------------------------
// RUTAS DOCTOR
// -----------------------------
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->group(function () {
    Route::get('/dashboard', [DoctorDashboardController::class, 'dashboard'])->name('doctor.dashboard');
    Route::get('/citas', [CitaController::class, 'indexDoctor'])->name('doctor.citas');
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