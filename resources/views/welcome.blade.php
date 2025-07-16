<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Clínica Los Ángeles</title>
    @vite('resources/css/welcome.css')
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@600;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <div class="container">
        <h1>Clínica Los Ángeles</h1>
        <nav>
            <a href="{{ route('login') }}" class="btn-primary">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="btn-primary">Registrarse</a>
        </nav>
    </div>
</header>

<main>
    <div class="hero-content" role="main" aria-label="Bienvenida a Clínica Los Ángeles">
        <h2>Bienvenido a la Clínica Los Ángeles</h2>
        <p>Agenda tus citas médicas fácilmente desde casa. Un sistema rápido, seguro y personalizado para ti.</p>
        <a href="{{ route('login') }}" class="btn-primary" role="button" aria-label="Comenzar sesión">Comenzar</a>
    </div>
</main>

<footer>
    © {{ date('Y') }} Clínica Los Ángeles. Todos los derechos reservados.
</footer>

</body>
</html>
