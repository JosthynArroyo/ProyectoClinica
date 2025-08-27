<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\User;
use App\Models\Especialidad;
use Illuminate\Support\Facades\Auth;
use App\Jobs\EnviarConfirmacionCitaJob;
use App\Events\CitaAgendada;

class CitaController extends Controller
{
    // -------------------------------
    // PACIENTE
    // -------------------------------

    // Listar citas del paciente
    public function index()
    {
        $citas = Cita::where('paciente_id', Auth::id())
            ->with(['doctor', 'especialidad'])
            ->get();

        return view('paciente.citas', compact('citas'));
    }

    // Formulario crear cita
    public function create()
    {
        $doctores = User::whereHas('roles', function($q){
            $q->where('name', 'doctor');
        })->get();

        $especialidades = Especialidad::all();

        return view('paciente.crear-cita', compact('doctores', 'especialidades'));
    }

    // Guardar nueva cita (con Job y Event)
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'nullable|exists:users,id',
            'especialidad_id' => 'required|exists:especialidades,id',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        $cita = Cita::create([
            'paciente_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'especialidad_id' => $request->especialidad_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => Cita::ESTADO_PENDIENTE,
        ]);

        // Dispara evento para notificar al doctor (Actividad 2)
        event(new CitaAgendada($cita));

        // Enviar confirmación en segundo plano (Actividad 1)
        EnviarConfirmacionCitaJob::dispatch($cita);

        return redirect()->route('paciente.citas')
            ->with('success', 'Cita creada con éxito. Confirmación enviada y doctor notificado.');
    }

    // Cancelar cita
    public function cancelar($id)
    {
        $cita = Cita::findOrFail($id);

        if ($cita->paciente_id != Auth::id()) {
            return back()->with('error', 'No puedes cancelar esta cita.');
        }

        if (in_array($cita->estado, [Cita::ESTADO_CANCELADA, Cita::ESTADO_REALIZADA])) {
            return back()->with('error', 'Esta cita ya no puede ser cancelada.');
        }

        $cita->estado = Cita::ESTADO_CANCELADA;
        $cita->save();

        return back()->with('success', 'Cita cancelada.');
    }

    // Editar / reagendar cita
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);

        if ($cita->paciente_id != Auth::id()) {
            return back()->with('error', 'No puedes editar esta cita.');
        }

        if (in_array($cita->estado, [Cita::ESTADO_CANCELADA, Cita::ESTADO_REALIZADA])) {
            return back()->with('error', 'Esta cita no puede ser modificada.');
        }

        return view('paciente.editar-cita', compact('cita'));
    }

    // Actualizar cita (reagendar)
    public function actualizar(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        if ($cita->paciente_id != Auth::id()) {
            return back()->with('error', 'No puedes modificar esta cita.');
        }

        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->estado = Cita::ESTADO_PENDIENTE;
        $cita->save();

        return redirect()->route('paciente.citas')
            ->with('success', 'Cita reagendada.');
    }

    // -------------------------------
    // DOCTOR
    // -------------------------------

    public function indexDoctor()
    {
        $citas = Cita::where('doctor_id', Auth::id())
            ->with(['paciente', 'especialidad'])
            ->get();

        return view('doctor.citas', compact('citas'));
    }

    public function aceptar($id)
    {
        $cita = Cita::findOrFail($id);

        if ($cita->doctor_id != Auth::id()) {
            return back()->with('error', 'No puedes aceptar esta cita.');
        }

        if ($cita->estado !== Cita::ESTADO_PENDIENTE) {
            return back()->with('error', 'Solo puedes aceptar citas pendientes.');
        }

        $cita->estado = Cita::ESTADO_CONFIRMADA;
        $cita->save();

        return back()->with('success', 'Cita confirmada.');
    }

    public function rechazar($id)
    {
        $cita = Cita::findOrFail($id);

        if ($cita->doctor_id != Auth::id()) {
            return back()->with('error', 'No puedes rechazar esta cita.');
        }

        if ($cita->estado !== Cita::ESTADO_PENDIENTE) {
            return back()->with('error', 'Solo puedes rechazar citas pendientes.');
        }

        $cita->estado = Cita::ESTADO_CANCELADA;
        $cita->save();

        return back()->with('success', 'Cita rechazada.');
    }

    public function realizar($id)
    {
        $cita = Cita::findOrFail($id);

        if ($cita->doctor_id != Auth::id()) {
            return back()->with('error', 'No puedes marcar esta cita.');
        }

        if ($cita->estado !== Cita::ESTADO_CONFIRMADA) {
            return back()->with('error', 'Solo puedes marcar como realizada citas confirmadas.');
        }

        $cita->estado = Cita::ESTADO_REALIZADA;
        $cita->save();

        return back()->with('success', 'Cita marcada como realizada.');
    }
}
