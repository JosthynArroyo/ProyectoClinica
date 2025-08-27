<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Muestra el panel de control del administrador.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Totales de citas
        $totalCitas = Cita::count();
        $totalCitasPendientes = Cita::where('estado', Cita::ESTADO_PENDIENTE)->count();
        $totalCitasRealizadas = Cita::where('estado', Cita::ESTADO_REALIZADA)->count();

        // Obtener las 5 citas más recientes
        $citas = Cita::with(['paciente', 'doctor'])
            ->orderByDesc('fecha')
            ->orderByDesc('hora')
            ->take(5)
            ->get()
            ->map(fn($c) => [
                'paciente' => $c->paciente->nombre ?? 'N/A',
                'doctor' => $c->doctor->nombre ?? 'Sin asignar',
                'fecha' => $c->fecha . ' ' . $c->hora,
                'estado' => $c->estado,
            ]);

        // Fechas para consultas de las últimas 2 horas
        $dosHorasAntes = Carbon::now()->subHours(2);

        // Citas agendadas en las últimas 2 horas
        $citasAgendadas2h = Cita::where('created_at', '>=', $dosHorasAntes)->count();
        
        // Citas completadas en las últimas 2 horas
        $citasCompletadas2h = Cita::where('estado', Cita::ESTADO_REALIZADA)
                                  ->where('fecha', '>=', $dosHorasAntes->toDateString())
                                  ->where('hora', '>=', $dosHorasAntes->toTimeString())
                                  ->count();

        // Citas canceladas en las últimas 2 horas
        $citasCanceladas2h = Cita::where('estado', Cita::ESTADO_CANCELADA)
                                 ->where('fecha', '>=', $dosHorasAntes->toDateString())
                                 ->where('hora', '>=', $dosHorasAntes->toTimeString())
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