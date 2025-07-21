<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Clínica Los Ángeles') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    {{-- Botón de logout solo si está autenticado --}}
    @auth
        <form method="POST" action="{{ route('logout') }}" style="text-align: right; margin: 20px;">
            @csrf
            <button type="submit"
                style="background-color: #512da8; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                Cerrar sesión
            </button>
        </form>
    @endauth

    <main>
        @yield('content')
    </main>
</body>
</html>
