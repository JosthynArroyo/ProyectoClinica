@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Clínica Médica</title>
    @vite('resources/css/register.css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <div class="container">
        <!-- Panel izquierdo informativo -->
        <div class="toggle-container">
            <h1>¡Te damos la bienvenida!</h1>
            <p>Inicia sesión para acceder a tu historial y agendar tus citas</p>
            <a href="{{ route('login') }}">
                <button>Iniciar Sesión</button>
            </a>
        </div>

        <!-- Formulario de Registro -->
        <div class="form-container sign-up">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Crear Cuenta</h1>
                <input type="text" name="name" placeholder="Nombre completo" value="{{ old('name') }}" required>
                <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>
</body>
</html>
@endsection
