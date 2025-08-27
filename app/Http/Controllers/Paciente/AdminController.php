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
        $userId = Auth::id();

        $citas = Cita::where('paciente_id', $userId)
                      ->orderBy('fecha', 'asc')
                      ->get();

        $totalCitas = $citas->count();
        $totalCitasPendientes = $citas->where('estado', 'pendiente')->count();
        $totalCitasRealizadas = $citas->where('estado', 'realizada')->count();
        $totalCitasCanceladas = $citas->where('estado', 'cancelada')->count();

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
