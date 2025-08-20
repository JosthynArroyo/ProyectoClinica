<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function mostrarFormulario()
    {
        return view('contacto');
    }

    public function enviarFormulario(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'asunto' => 'nullable|string|max:255',
            'mensaje' => 'required|string',
        ]);

        Contacto::create($request->all());
        return redirect()->back()->with('success', 'Tu mensaje ha sido enviado correctamente. ¡Gracias por contactarnos!');
    }
}
