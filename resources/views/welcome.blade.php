<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Los Ángeles</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Header -->
    <header class="bg-white shadow-md fixed top-0 left-0 right-0 z-10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-indigo-700">Clínica Los Ángeles</h1>
            <nav class="space-x-4">
                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded transition">Registrarse</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-hero h-screen flex items-center justify-center pt-24">
        <div class="hero-overlay bg-white bg-opacity-90 p-10 rounded-lg shadow-xl max-w-2xl text-center">
            <h2 class="text-4xl font-bold text-indigo-800 mb-4">Bienvenido a la Clínica Los Ángeles</h2>
            <p class="text-lg text-gray-700 mb-6">Agenda tus citas médicas fácilmente desde casa. Un sistema rápido, seguro y personalizado para ti.</p>
            <a href="{{ route('login') }}" class="btn-primary">Comenzar</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white shadow-inner mt-10">
        <div class="max-w-7xl mx-auto py-4 px-6 text-center text-sm text-gray-600">
            © {{ date('Y') }} Clínica Los Ángeles. Todos los derechos reservados.
        </div>
    </footer>

</body>
</html>
