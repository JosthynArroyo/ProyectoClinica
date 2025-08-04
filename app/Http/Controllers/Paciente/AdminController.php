<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'cedula' => 'required|string|max:10|unique:pacientes',
            'telefono' => 'required|string|max:15',
            'correo' => 'required|email|unique:pacientes',
            'direccion' => 'required|string|max:255',
        ]);

        Paciente::create($request->all());

        return redirect()->route('pacientes.create')->with('success', 'Paciente registrado correctamente.');
    }
}
