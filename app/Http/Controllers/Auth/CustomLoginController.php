<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomLoginController extends Controller
{
    // Usuarios quemados en el código (en lugar de BD)
    private $users = [
        ['email' => 'josthyn123@gmail.com', 'password' => 'Josthyn123', 'name' => 'Usuario Uno'],
        ['email' => 'Dylan123@gmail.com', 'password' => 'Dylan456', 'name' => 'Usuario Dos'],
    ];

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        foreach ($this->users as $user) {
            if ($user['email'] === $request->email && $user['password'] === $request->password) {
                // Guardamos el usuario en sesión
                session(['user' => $user]);
                return redirect('/dashboard');
            }
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
    }
}
