<!-- dashboard.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Panel Paciente - Clínica Los Ángeles</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    @vite(['resources/css/dashboards/paciente.css', 'resources/js/dashboard-paciente.js'])
</head>
<body>
    <div class="container">
        <!-- Barra lateral -->
        <aside>
            <div class="top">
                <div class="logo">
                    <h2>Paciente<span class="danger">Los Ángeles</span></h2>
                </div>
                <div class="close">
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="{{ route('paciente.dashboard') }}"><span class="material-symbols-outlined">dashboard</span><h3>Inicio</h3></a>
                <a href="{{ route('paciente.citas') }}"><span class="material-symbols-outlined">calendar_month</span><h3>Mis Citas</h3></a>
                <a href="{{ route('paciente.historial') }}"><span class="material-symbols-outlined">medical_information</span><h3>Historial Médico</h3></a>
                <a href="{{ route('paciente.mensajes') }}"><span class="material-symbols-outlined">chat</span><h3>Mensajes</h3></a>
                <a href="{{ route('paciente.preferencias') }}"><span class="material-symbols-outlined">tune</span><h3>Preferencias</h3></a>
                <a href="{{ route('salir') }}"><span class="material-symbols-outlined">logout</span><h3>Cerrar Sesión</h3></a>
            </div>
        </aside>

        <!-- Contenido principal -->
        <main>
            <h1>Mi Panel</h1>
            <div class="date"><input type="date"></div>

            <!-- Tarjetas resumen -->
            <div class="insights">
                <div class="sales">
                    <span class="material-symbols-sharp">calendar_month</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Citas Agendadas</h3>
                            <h1>3</h1>
                        </div>
                        <div class="progress">
                            <svg><circle r="30" cx="40" cy="40"></circle></svg>
                            <div class="number">60%</div>
                        </div>
                    </div>
                    <small>Este mes</small>
                </div>
                <div class="expenses">
                    <span class="material-symbols-sharp">check_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Completadas</h3>
                            <h1>5</h1>
                        </div>
                        <div class="progress">
                            <svg><circle r="30" cx="40" cy="40"></circle></svg>
                            <div class="number">100%</div>
                        </div>
                    </div>
                    <small>Historial</small>
                </div>
                <div class="income">
                    <span class="material-symbols-sharp">cancel</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Canceladas</h3>
                            <h1>1</h1>
                        </div>
                        <div class="progress">
                            <svg><circle r="30" cx="40" cy="40"></circle></svg>
                            <div class="number">20%</div>
                        </div>
                    </div>
                    <small>Este mes</small>
                </div>
            </div>

            <!-- Tabla de citas -->
            <div class="recent_order">
                <h1>Mis Próximas Citas</h1>
                <table>
                    <thead>
                        <tr><th>Doctor</th><th>Especialidad</th><th>Estado</th><th>Acción</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Dra. Ruiz</td><td>Cardiología</td><td class="warning">Confirmada</td><td class="primary"><a href="#">Ver</a></td></tr>
                        <tr><td>Dr. Torres</td><td>General</td><td class="warning">Pendiente</td><td class="primary"><a href="#">Ver</a></td></tr>
                        <tr><td>Dr. Pérez</td><td>Dermatología</td><td class="warning">Pendiente</td><td class="primary"><a href="#">Ver</a></td></tr>
                        <tr><td>Dra. Gómez</td><td>Pediatría</td><td class="warning">Reprogramada</td><td class="primary"><a href="#">Ver</a></td></tr>
                    </tbody>
                </table>
                <!-- Botón Agendar Cita -->
                <a href="{{ route('paciente.citas.crear') }}" class="primary" style="display:inline-block; margin-top:1.5rem; font-weight:bold; color:#fff; background:var(--clr-primary); padding:0.8rem 1.5rem; border-radius:0.5rem; text-align:center;">+ Agendar Nueva Cita</a>
            </div>
        </main>

        <!-- Panel derecho -->
        <div class="right">
            <div class="top">
                <button id="menu_bar"><span class="material-symbols-sharp">menu</span></button>
                <div class="theme-toggler">
                    <span class="material-symbols-sharp active">light_mode</span>
                    <span class="material-symbols-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p><b>Paciente</b></p>
                        <p>Panel Personal</p>
                    </div>
                    <div class="profile-photo">
                        <img src="{{ asset('img/paciente1.jpg') }}" alt="Foto del paciente">
                    </div>
                </div>
            </div>

            <div class="recent_updates">
                <h2>Actualizaciones</h2>
                <div class="updates">
                    <div class="update"><div class="profile-photo"><img src="{{ asset('img/doctor1.jpg') }}"></div><div class="message"><p><b>Dr. Ruiz</b> confirmó tu cita</p></div></div>
                    <div class="update"><div class="profile-photo"><img src="{{ asset('img/doctora1.jpg') }}"></div><div class="message"><p><b>Dra. Pérez</b> reprogramó la consulta</p></div></div>
                    <div class="update"><div class="profile-photo"><img src="{{ asset('img/doctor2.jpg') }}"></div><div class="message"><p><b>Dr. Torres</b> envió un mensaje</p></div></div>
                </div>
            </div>

            <div class="sales_analytics">
                <h2>Resumen</h2>
                <div class="item online"><div class="icon"><span class="material-symbols-sharp">calendar_month</span></div><div class="right_text"><div class="info"><h3>Agendadas</h3><small class="text-muted">Este mes</small></div><h5 class="danger">+12%</h5><h3>3</h3></div></div>
                <div class="item online"><div class="icon"><span class="material-symbols-sharp">task_alt</span></div><div class="right_text"><div class="info"><h3>Completadas</h3><small class="text-muted">Este mes</small></div><h5 class="danger">+4%</h5><h3>5</h3></div></div>
                <div class="item online"><div class="icon"><span class="material-symbols-sharp">cancel</span></div><div class="right_text"><div class="info"><h3>Canceladas</h3><small class="text-muted">Este mes</small></div><h5 class="danger">-1%</h5><h3>1</h3></div></div>
            </div>

            <div class="item add_products">
                <div><span class="material-symbols-sharp">add</span></div>
            </div>
        </div>
    </div>
</body>
</html>
