@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Clínica Médica</title>
    @vite('resources/css/login.css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <div class="container">
        <!-- Formulario de Inicio de Sesión -->
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Iniciar Sesión</h1>
                <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <input type="password" name="password" placeholder="Contraseña" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                <button type="submit">Ingresar</button>
            </form>
        </div>

        <!-- Panel derecho informativo -->
        <div class="toggle-container">
            <h1>¡Bienvenido!</h1>
            <p>Regístrate para agendar y gestionar tus citas médicas fácilmente</p>
            <a href="{{ route('register') }}">
                <button>Registrarse</button>
            </a>
        </div>
    </div>
</body>
</html>
@endsection
