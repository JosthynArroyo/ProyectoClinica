<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | Clínica Los Ángeles</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-indigo-700">Clínica Los Ángeles</h1>
            <nav class="space-x-4">
                <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:underline">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Registrarse</a>
            </nav>
        </div>
    </header>

    <main class="bg-cover bg-center h-[calc(100vh-88px)] flex items-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1588776814546-ec6ec3b8cc4e');">
        <div class="bg-white bg-opacity-90 p-10 rounded-xl shadow-xl max-w-xl text-center">
            <h2 class="text-3xl font-bold text-indigo-800 mb-4">Bienvenido a Clínica Los Ángeles</h2>
            <p class="text-gray-700 mb-6">Gestione sus citas médicas fácilmente. Nuestro sistema está diseñado para brindarle una experiencia segura y rápida.</p>
            <a href="{{ route('login') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700 transition">Agendar Cita</a>
        </div>
    </main>

    <footer class="bg-white text-center text-gray-600 py-4 shadow-inner">
        © {{ date('Y') }} Clínica Los Ángeles - Todos los derechos reservados
    </footer>

</body>
</html>
