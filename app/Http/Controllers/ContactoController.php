<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;

class ContactoController extends Controller
{
    public function create()
    {
        return view('contactos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email',
            'telefono' => 'nullable|string|max:20',
            'fecha'    => 'required|date',
            'hora'     => 'required',
        ]);

        Contacto::create($request->all());

        return redirect()->back()->with('success', 'Tu cita fue registrada correctamente. Te contactaremos pronto.');
    }
}
