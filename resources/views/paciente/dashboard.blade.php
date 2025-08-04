<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Paciente</title>
    
   
    
    <!-- Estilos y Scripts -->
    @vite(['resources/css/dashboards/paciente.css', 'resources/js/dashboard-paciente.js'])

<body>
    <div class="dashboard-container">

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Clínica <span class="highlight">Los Ángeles</span></h2>
            </div>
            <nav class="nav-menu">
                <a href="#"><span class="material-symbols-outlined"></span>Inicio</a>
                <a href="#"><span class="material-symbols-outlined"></span>Reservar Cita</a>
                <a href="#"><span class="material-symbols-outlined"></span>Mis Citas</a>
                <a href="#"><span class="material-symbols-outlined"></span>Historial Médico</a>
                <a href="#"><span class="material-symbols-outlined"></span>Soporte</a>
                <a href="#"><span class="material-symbols-outlined"></span>Configuración</a>
                <a href="·"><span class="material-symbols-outlined"></span>Formulario</a>
                <a href="{{ route('salir') }}"><span class="material-symbols-outlined"></span>Salir</a>
                
            </nav>
        </aside>

        <!-- Main content -->
        <main class="main-content">
            <header class="welcome-header">
                <h1>Hola, Juan Pérez</h1>
                <p>Bienvenido de nuevo a tu panel personal.</p>
            </header>

            <section class="grid-container">

                <!-- Próxima Cita -->
                <article class="card next-appointment">
                    <h2>Próxima Cita</h2>
                    <p><strong>Fecha:</strong> 15 de Agosto 2025</p>
                    <p><strong>Hora:</strong> 10:30 AM</p>
                    <p><strong>Médico:</strong> Dr. Laura Gómez</p>
                    <p><strong>Especialidad:</strong> Cardiología</p>
                    <button class="btn-primary">Ver detalles</button>
                </article>

                <!-- Resumen de citas -->
                <article class="card summary">
                    <h2>Resumen de Citas</h2>
                    <ul>
                        <li>Citas pendientes: <strong>2</strong></li>
                        <li>Última cita: <strong>10 Julio 2025</strong></li>
                        <li>Citas canceladas: <strong>1</strong></li>
                    </ul>
                </article>

                <!-- Tratamientos activos -->
                <article class="card treatments">
                    <h2>Tratamientos Activos</h2>
                    <ul>
                        <li>Medicamento A - 2 veces al día</li>
                        <li>Fisioterapia semanal</li>
                    </ul>
                </article>

                <!-- Historial médico -->
                <article class="card history">
                    <h2>Historial Médico Reciente</h2>
                    <ul>
                        <li>Diagnóstico: Gripe Estacional - Julio 2025</li>
                        <li>Examen de Sangre - Resultado normal</li>
                        <li>Control de presión arterial - Estable</li>
                    </ul>
                    <button class="btn-secondary">Ver historial completo</button>
                </article>

                <!-- Documentos descargables -->
                <article class="card documents">
                    <h2>Documentos</h2>
                    <ul>
                        <li><a href="#" download>Informe Laboratorio Julio 2025.pdf</a></li>
                        <li><a href="#" download>Receta Médica Julio 2025.pdf</a></li>
                    </ul>
                </article>

                <!-- Accesos rápidos -->
                <article class="card quick-access">
                    <h2>Accesos Rápidos</h2>
                    <nav>
                        <a href="#"><span class="material-symbols-outlined">add_circle</span>Reservar Cita</a>
                        <a href="#"><span class="material-symbols-outlined">chat_bubble</span>Contactar Soporte</a>
                        <a href="#"><span class="material-symbols-outlined">phone</span>Contacto de Emergencia</a>
                    </nav>
                </article>

                <!-- Notificaciones -->
                <article class="card notifications">
                    <h2>Notificaciones Recientes</h2>
                    <ul>
                        <li>📅 Recordatorio: Cita el 15 de Agosto a las 10:30 AM</li>
                        <li>💬 Nuevo mensaje de Dr. Laura Gómez</li>
                    </ul>
                </article>

                <!-- Equipo médico -->
                <article class="card medical-team">
                    <h2>Tu Equipo Médico</h2>
                    <ul>
                        <li>Dr. Laura Gómez - Cardiología</li>
                        <li>Enfermera Ana Martínez - Atención primaria</li>
                    </ul>
                </article>

            </section>
        </main>

    </div>
</body>
</html>
