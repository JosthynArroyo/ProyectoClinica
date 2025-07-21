<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Los Ángeles</title>
    @vite('resources/css/welcome.css')
</head>
<body>
    <header class="header">
        <div class="menu container">
            <a href="{{ url('/') }}" class="logo">Clinica Los Angeles</a>
            <input type="checkbox" id="menu">
            <label for="menu">
                <img src="{{ asset('img/menu.png') }}" class="menu-icono" alt="Menú">
            </label>
            <nav class="navbar">
                <ul>
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                    <li><a href="{{ route('register') }}">Registrarse</a></li>
                    <li><a href="#footer">Contacto</a></li>
                </ul>
            </nav>
        </div>

        <div class="header-content container">
            <div class="header-txt">
                <h1>Clinica</h1>
                <span>Los Ángeles</span>
                <p>
                    Sistema de gestión médica para agendar citas fácilmente y recibir atención especializada.
                </p>
                <a href="{{ route('register') }}" class="btn-1">Ver Especialidades</a>
            </div>

            <div class="header-dir">
                <div class="dir">
                    <h3>Dirección</h3>
                    <p>Quito, Av. Colón y 6 de Diciembre</p>
                </div>

                <div class="dir">
                    <h3>Teléfono</h3>
                    <p>0998742410</p>
                </div>

                <div class="dir">
                    <h3>Horario</h3>
                    <p>Lunes a Viernes, 08:00 - 18:00</p>
                </div>
            </div>
        </div>
    </header>

    <section class="welcome">
        <div class="welcome-1"></div>

        <div class="welcome-2">
            <h2>Bienvenidos al Sistema de Gestión de Citas Médicas</h2>

            <p class="b1">
                Accede a consultas con médicos especializados desde cualquier lugar.
            </p>

            <p>
                Nuestro sistema te permite agendar, modificar o cancelar tus citas de forma rápida y segura.
            </p>
            <a href="{{ route('register') }}" class="btn-1">Conoce más</a>
        </div>
    </section>

    <main class="services container">
        <div class="services-txt">
            <h2>Nuestros Servicios</h2>
            <hr>
            <p>
                Contamos con atención médica en múltiples especialidades para cuidar de tu salud y bienestar.
            </p>
        </div>

        <div class="services-group">
            <div class="services-1">
                <img src="{{ asset('img/i1.svg') }}" alt="Consulta general">
                <h3>Consulta General</h3>
                <p>
                    Evaluaciones médicas primarias para todas las edades. Recomendaciones y diagnósticos generales.
                </p>
                <a href="#">Saber más</a>
            </div>

            <div class="services-1">
                <img src="{{ asset('img/i2.svg') }}" alt="Pediatría">
                <h3>Pediatría</h3>
                <p>
                    Atención especializada para bebés, niños y adolescentes por parte de profesionales calificados.
                </p>
                <a href="#">Saber más</a>
            </div>

            <div class="services-1">
                <img src="{{ asset('img/i3.svg') }}" alt="Ginecología">
                <h3>Ginecología</h3>
                <p>
                    Controles ginecológicos, planificación familiar y seguimiento especializado para la salud femenina.
                </p>
                <a href="#">Saber más</a>
            </div>
        </div>
        <a href="{{ route('register') }}" class="btn-1">Ver más servicios</a>
    </main>

    <section class="prices">
        <div class="prices-1">
            <h2>Tarifario de Servicios</h2>
            <p>
                Consulta los precios aproximados de nuestros servicios médicos. Pregunta por paquetes y promociones.
            </p>
            <table>
                <tbody>
                    <tr>
                        <th>Consulta General</th>
                        <td>$25</td>
                    </tr>
                    <tr>
                        <th>Ecografía</th>
                        <td>$30</td>
                    </tr>
                    <tr>
                        <th>Atención a domicilio</th>
                        <td>$40</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('login') }}" class="btn-1">Solicitar cita</a>
        </div>

        <div class="prices-2"></div>
    </section>

    <section class="personal container">
        <div class="personal-txt">
            <h2>Nuestros Doctores</h2>
            <p>
                Contamos con un equipo médico calificado y comprometido con tu salud y la de tu familia.
            </p>
        </div>

        <div class="personal-group">
            <div class="personal-1">
                <img src="{{ asset('img/doctora1.jpg') }}" alt="Doctora Ana">
                <p>
                    Dra. Ana Martínez - Ginecóloga con más de 10 años de experiencia en salud integral femenina.
                </p>
                <a href="#">Ver perfil</a>
            </div>

            <div class="personal-1">
                <img src="{{ asset('img/doctor1.jpg') }}" alt="Doctor Carlos">
                <p>
                    Dr. Carlos Pérez - Pediatra apasionado por el bienestar y desarrollo de los más pequeños.
                </p>
                <a href="#">Ver perfil</a>
            </div>

            <div class="personal-1">
                <img src="{{ asset('img/doctor2.jpg') }}" alt="Doctor Juan">
                <p>
                    Dr. Juan Torres - Médico general con enfoque preventivo y atención cercana al paciente.
                </p>
                <a href="#">Ver perfil</a>
            </div>
        </div>
        <a href="{{ route('register') }}" class="btn-1">Conoce a todo el equipo</a>
    </section>

    <footer id="footer">
        <div class="footer-txt">
            <p>
                Clínica Los Ángeles © {{ date('Y') }} - Todos los derechos reservados.
            </p>
        </div>
    </footer>

</body>
</html>
