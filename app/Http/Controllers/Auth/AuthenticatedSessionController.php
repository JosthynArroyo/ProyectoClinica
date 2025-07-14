<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

       
        $usuariosQuemados = [
            [
                'email' => 'dylan@local.test',
                'password' => 'dylan1234',
                'name' => 'Dylan Cumbal',
            ],
            [
                'email' => 'josthyn@local.test',
                'password' => 'josthyn123',
                'name' => 'Josthyn Arroyo',
            ],
        ];

        foreach ($usuariosQuemados as $user) {
            if ($request->email === $user['email'] && $request->password === $user['password']) {
                session([
                    'user_name' => $user['name'],
                    'user_email' => $user['email'],
                ]);
                return redirect()->intended('/dashboard');
            }
        }

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
