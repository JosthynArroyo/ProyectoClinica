<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:4',
        ]);

        session([
            'user' => [
                'name'  => $request->name,
                'email' => $request->email,
            ],
        ]);

        return redirect()->route('dashboard');
    }
}
