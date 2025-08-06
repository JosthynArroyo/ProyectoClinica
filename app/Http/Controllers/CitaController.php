<?php
namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::where('paciente_id', Auth::id())->get();
        return view('paciente.citas', compact('citas'));
    }

    public function create()
    {
        $especialidades = Especialidad::all();
        $doctores = User::whereHas('roles', fn($q) => $q->where('name', 'doctor'))->get();
        return view('paciente.crear-cita', compact('especialidades', 'doctores'));
    }

    public function store(Request $request)
    {
        Cita::create([
            'paciente_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'especialidad_id' => $request->especialidad_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('paciente.citas')->with('success', 'Cita registrada correctamente.');
    }
}
