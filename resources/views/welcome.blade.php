<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido - Clínica Los Ángeles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white shadow-lg rounded-lg p-10 max-w-lg text-center">
            <h1 class="text-3xl font-bold text-indigo-600 mb-4">Bienvenido al Sistema de Citas</h1>
            <p class="text-gray-600 mb-6">
                Reserva, reprograma y gestiona tus citas médicas de forma rápida y segura.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded hover:bg-gray-300 transition">Registrarse</a>
            </div>
        </div>
    </div>
</body>
</html>
