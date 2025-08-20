<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Redirección después del login
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('administrador')) {
            return redirect()->intended('admin/dashboard');
        } elseif ($user->hasRole('paciente')) {
            return redirect()->intended('paciente/dashboard');
        } elseif ($user->hasRole('doctor')) {
            return redirect()->intended('doctor/dashboard');
        }

        return redirect('/');
    }

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
