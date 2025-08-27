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
    /**
     * Muestra la lista de citas del paciente autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $citas = Cita::where('paciente_id', Auth::id())
            ->with(['doctor', 'especialidad'])
            ->get();

        return view('paciente.citas', compact('citas'));
    }

    /**
     * Muestra el formulario para crear una nueva cita.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $doctores = User::whereHas('roles', function ($q) {
            $q->where('name', 'doctor');
        })->get();

        $especialidades = Especialidad::all();

        return view('paciente.crear-cita', compact('doctores', 'especialidades'));
    }

    /**
     * Almacena una nueva cita en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Cancela una cita.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Muestra el formulario para editar una cita.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * Actualiza una cita existente.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

        // Se usa el método update para hacer el código más limpio
        $cita->update([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => Cita::ESTADO_PENDIENTE,
        ]);

        return redirect()->route('paciente.citas')
            ->with('success', 'Cita reagendada.');
    }

    // -------------------------------
    // DOCTOR
    // -------------------------------

    /**
     * Muestra la lista de citas del doctor autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function indexDoctor()
    {
        $citas = Cita::where('doctor_id', Auth::id())
            ->with(['paciente', 'especialidad'])
            ->get();

        return view('doctor.citas', compact('citas'));
    }

    /**
     * Acepta una cita.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Rechaza una cita.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Marca una cita como realizada.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
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