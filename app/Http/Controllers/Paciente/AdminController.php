<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id(); // ID del paciente logueado

        // Obtener todas las citas del paciente ordenadas por fecha
        $citas = Cita::where('paciente_id', $userId)
                      ->orderBy('fecha', 'asc')
                      ->get();

        // Contadores para estadísticas
        $totalCitas = $citas->count();
        $totalCitasPendientes = $citas->where('estado', 'pendiente')->count();
        $totalCitasRealizadas = $citas->where('estado', 'realizada')->count();
        $totalCitasCanceladas = $citas->where('estado', 'cancelada')->count();

        // Contadores de últimas 2 horas (ejemplo, puedes adaptarlo)
        $citasAgendadas2h = $citas->where('created_at', '>=', now()->subHours(2))->count();
        $citasCompletadas2h = $citas->where('estado', 'realizada')
                                     ->where('updated_at', '>=', now()->subHours(2))
                                     ->count();
        $citasCanceladas2h = $citas->where('estado', 'cancelada')
                                    ->where('updated_at', '>=', now()->subHours(2))
                                    ->count();

        return view('paciente.dashboard', compact(
            'citas',
            'totalCitas',
            'totalCitasPendientes',
            'totalCitasRealizadas',
            'totalCitasCanceladas',
            'citasAgendadas2h',
            'citasCompletadas2h',
            'citasCanceladas2h'
        ));
    }
}
