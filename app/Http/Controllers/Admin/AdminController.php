<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Totales
        $totalCitas = Cita::count();
        $totalCitasPendientes = Cita::where('estado', Cita::ESTADO_PENDIENTE)->count();
        $totalCitasRealizadas = Cita::where('estado', Cita::ESTADO_REALIZADA)->count();

        // Últimas 5 citas
        $citas = Cita::with(['paciente', 'doctor'])
                    ->orderByDesc('fecha')
                    ->orderByDesc('hora')
                    ->take(5)
                    ->get();

        // Estadísticas últimas 2 horas
        $dosHorasAntes = Carbon::now()->subHours(2);

        $citasAgendadas2h = Cita::where('created_at', '>=', $dosHorasAntes)->count();
        $citasCompletadas2h = Cita::where('estado', Cita::ESTADO_REALIZADA)
                                  ->where('updated_at', '>=', $dosHorasAntes)
                                  ->count();
        $citasCanceladas2h = Cita::where('estado', Cita::ESTADO_CANCELADA)
                                 ->where('updated_at', '>=', $dosHorasAntes)
                                 ->count();

        return view('admin.dashboard', [
            'totalCitas' => $totalCitas,
            'totalCitasPendientes' => $totalCitasPendientes,
            'totalCitasRealizadas' => $totalCitasRealizadas,
            'citas' => $citas,
            'citasAgendadas2h' => $citasAgendadas2h,
            'citasCompletadas2h' => $citasCompletadas2h,
            'citasCanceladas2h' => $citasCanceladas2h,
        ]);
    }
}
