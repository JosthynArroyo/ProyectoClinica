<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Este controlador gestiona la autenticación de usuarios y redirige
    | según su rol una vez hayan iniciado sesión correctamente.
    |
    */

    use AuthenticatesUsers;

    /**
     * Redirección por defecto si no se sobreescribe.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Crear una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Redirige al usuario autenticado según su rol.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('administrador')) {
            return redirect()->intended('admin/dashboard');
        } elseif ($user->hasRole('paciente')) {
            return redirect()->intended('paciente/dashboard');
        } elseif ($user->hasRole('doctor')) {
            return redirect()->intended('doctor/dashboard');
        }

        // Redirección por defecto
        return redirect('/');
    }

    /**
     * 
     *
     * @return string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user->hasRole('administrador')) {
            return 'admin/dashboard';
        } elseif ($user->hasRole('paciente')) {
            return 'paciente/dashboard';
        } elseif ($user->hasRole('doctor')) {
            return 'doctor/dashboard';
        }

        return '/';
    }
}
