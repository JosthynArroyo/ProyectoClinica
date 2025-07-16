<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        // Aquí puedes procesar la info del formulario
        // Por ahora solo redirigimos o retornamos algo
        return redirect()->back()->with('status', 'Mensaje enviado correctamente.');
    }
}
