<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\User;
use App\Models\Especialidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Jobs\EnviarConfirmacionCitaJob;
use App\Events\CitaAgendada;
use Carbon\Carbon;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::where('paciente_id', Auth::id())
            ->with(['doctor', 'especialidad'])
            ->get();

        return view('paciente.citas', compact('citas'));
    }

    public function create()
    {
        $doctores = User::whereHas('roles', function ($q) {
            $q->where('name', 'doctor');
        })->get();

        $especialidades = Especialidad::all();

        return view('paciente.crear-cita', compact('doctores', 'especialidades'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'doctor_id' => 'required|exists:users,id',
                'especialidad_id' => 'required|exists:especialidades,id',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i',
            ],
            [
                'doctor_id.required' => 'Seleccione un doctor.',
                'doctor_id.exists' => 'El doctor seleccionado no existe.',
                'especialidad_id.required' => 'Seleccione una especialidad.',
                'especialidad_id.exists' => 'La especialidad seleccionada no existe.',
                'fecha.required' => 'Seleccione una fecha.',
                'fecha.date' => 'La fecha no es válida.',
                'hora.required' => 'Ingrese una hora.',
                'hora.date_format' => 'Formato de hora inválido. Use HH:MM.',
            ]
        );

        $fechaHora = Carbon::createFromFormat('Y-m-d H:i', $request->fecha . ' ' . $request->hora, 'America/Guayaquil');
        $ahora = now('America/Guayaquil');
        if ($fechaHora->lessThanOrEqualTo($ahora)) {
            return back()->withErrors(['error' => 'La fecha y hora debe ser posterior al momento actual.'])->withInput();
        }

        $slot = Carbon::createFromFormat('H:i', $request->hora);
        if ($slot->minute % 30 !== 0) {
            return back()->withErrors(['hora' => 'La hora debe estar en intervalos de 30 minutos (por ejemplo 08:00, 08:30, 09:00).'])->withInput();
        }

        $citasMismoDia = Cita::where('doctor_id', $request->doctor_id)
            ->where('fecha', $request->fecha)
            ->where('activo', true)
            ->get(['id', 'hora']);

        $existe = $citasMismoDia->contains(function ($c) use ($slot) {
            $h = $c->hora;
            if (strlen($h) >= 5) $h = substr($h, 0, 5);
            $otro = Carbon::createFromFormat('H:i', $h);
            return $otro->diffInMinutes($slot) <= 29;
        });

        if ($existe) {
            return back()->withErrors([
                'error' => 'El doctor ya tiene una cita en ese horario o en un rango de 30 minutos.'
            ])->withInput();
        }

        try {
            DB::beginTransaction();

            $cita = Cita::create([
                'paciente_id' => Auth::id(),
                'doctor_id' => $request->doctor_id,
                'especialidad_id' => $request->especialidad_id,
                'fecha' => $request->fecha,
                'hora' => $slot->format('H:i:00'),
                'estado' => Cita::ESTADO_PENDIENTE,
                'activo' => true,
            ]);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'El doctor ya tiene una cita exactamente a esa hora.'
            ])->withInput();
        }

        event(new CitaAgendada($cita));
        EnviarConfirmacionCitaJob::dispatch($cita);

        return redirect()->route('paciente.citas')
            ->with('success', 'Cita creada con éxito. Confirmación enviada y doctor notificado.');
    }

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
        $cita->activo = false;
        $cita->save();

        return back()->with('success', 'Cita cancelada.');
    }

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

    public function actualizar(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        if ($cita->paciente_id != Auth::id()) {
            return back()->with('error', 'No puedes modificar esta cita.');
        }

        $request->validate(
            [
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i',
            ],
            [
                'fecha.required' => 'Seleccione una fecha.',
                'fecha.date' => 'La fecha no es válida.',
                'hora.required' => 'Ingrese una hora.',
                'hora.date_format' => 'Formato de hora inválido. Use HH:MM.',
            ]
        );

        $fechaHora = Carbon::createFromFormat('Y-m-d H:i', $request->fecha . ' ' . $request->hora, 'America/Guayaquil');
        $ahora = now('America/Guayaquil');
        if ($fechaHora->lessThanOrEqualTo($ahora)) {
            return back()->withErrors(['error' => 'La fecha y hora debe ser posterior al momento actual.'])->withInput();
        }

        $slot = Carbon::createFromFormat('H:i', $request->hora);
        if ($slot->minute % 30 !== 0) {
            return back()->withErrors(['hora' => 'La hora debe estar en intervalos de 30 minutos (por ejemplo 08:00, 08:30, 09:00).'])->withInput();
        }

        $citasMismoDia = Cita::where('doctor_id', $cita->doctor_id)
            ->where('fecha', $request->fecha)
            ->where('activo', true)
            ->where('id', '!=', $cita->id)
            ->get(['id', 'hora']);

        $existe = $citasMismoDia->contains(function ($c) use ($slot) {
            $h = $c->hora;
            if (strlen($h) >= 5) $h = substr($h, 0, 5);
            $otro = Carbon::createFromFormat('H:i', $h);
            return $otro->diffInMinutes($slot) <= 29;
        });

        if ($existe) {
            return back()->withErrors([
                'error' => 'El doctor ya tiene una cita en ese horario o en un rango de 30 minutos.'
            ])->withInput();
        }

        try {
            DB::beginTransaction();

            $cita->update([
                'fecha' => $request->fecha,
                'hora' => $slot->format('H:i:00'),
                'estado' => Cita::ESTADO_PENDIENTE,
                'activo' => true,
            ]);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'El doctor ya tiene una cita exactamente a esa hora.'
            ])->withInput();
        }

        return redirect()->route('paciente.citas')
            ->with('success', 'Cita reagendada.');
    }

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
        $cita->activo = true;
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
        $cita->activo = false;
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
        $cita->activo = true;
        $cita->save();

        return back()->with('success', 'Cita marcada como realizada.');
    }

    public function citasConfirmadas()
    {
        $citas = Cita::with('paciente')->get();

        $pacientes = $citas->filter(fn($cita) => $cita->estado === Cita::ESTADO_CONFIRMADA)
            ->map(fn($cita) => $cita->paciente->name);

        return response()->json($pacientes);
    }
}
