<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;

class AdminController extends Controller
{
    public function dashboard()
    {
        $doctorId = Auth::id();

        $citas = Cita::with('paciente')
            ->where('doctor_id', $doctorId)
            ->whereDate('fecha', now())
            ->orderBy('hora', 'asc')
            ->get();

        // Estadísticas
        $citasHoy = $citas->count();
        $citasRealizadas = $citas->where('estado', 'realizada')->count();
        $citasPendientes = $citas->where('estado', 'pendiente')->count();

        $citasConfirmadas2h = Cita::where('doctor_id', $doctorId)
            ->where('estado', 'confirmada')
            ->where('updated_at', '>=', now()->subHours(2))
            ->count();

        $citasRealizadas2h = Cita::where('doctor_id', $doctorId)
            ->where('estado', 'realizada')
            ->where('updated_at', '>=', now()->subHours(2))
            ->count();

        $citasCanceladas2h = Cita::where('doctor_id', $doctorId)
            ->where('estado', 'cancelada')
            ->where('updated_at', '>=', now()->subHours(2))
            ->count();

        return view('doctor.dashboard', compact(
            'citas',
            'citasHoy',
            'citasRealizadas',
            'citasPendientes',
            'citasConfirmadas2h',
            'citasRealizadas2h',
            'citasCanceladas2h'
        ));
    }
}
