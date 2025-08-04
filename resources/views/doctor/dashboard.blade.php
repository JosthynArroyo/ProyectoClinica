<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Doctor - Clínica Los Ángeles</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    @vite(['resources/css/dashboards/doctor.css', 'resources/js/dashboard-doctor.js'])
</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <h2>Doctor<span class="danger">Los Ángeles</span></h2>
                </div>
                <div class="close">
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="#"><span class="material-symbols-outlined">dashboard</span><h3>Inicio</h3></a>
                <a href="#"><span class="material-symbols-outlined">event</span><h3>Mis Citas</h3></a>
                <a href="#"><span class="material-symbols-outlined">sick</span><h3>Pacientes</h3></a>
                <a href="#"><span class="material-symbols-outlined">chat</span><h3>Mensajes</h3></a>
                <a href="#"><span class="material-symbols-outlined">tune</span><h3>Preferencias</h3></a>
                <a href="{{ route('salir') }}"><span class="material-symbols-outlined">logout</span><h3>Cerrar Sesión</h3></a>
            </div>
        </aside>

        <main>
            <h1>Panel del Doctor</h1>
            <div class="date">
                <input type="date">
            </div>

            <div class="insights">
                <div class="sales">
                    <span class="material-symbols-sharp">calendar_month</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Mis Citas Hoy</h3>
                            <h1>14</h1>
                        </div>
                        <div class="progress">
                            <svg><circle r="30" cx="40" cy="40"></circle></svg>
                            <div class="number">70%</div>
                        </div>
                    </div>
                    <small>Últimas 24 horas</small>
                </div>

                <div class="expenses">
                    <span class="material-symbols-sharp">check_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Pacientes Atendidos</h3>
                            <h1>9</h1>
                        </div>
                        <div class="progress">
                            <svg><circle r="30" cx="40" cy="40"></circle></svg>
                            <div class="number">60%</div>
                        </div>
                    </div>
                    <small>Últimas 24 horas</small>
                </div>

                <div class="income">
                    <span class="material-symbols-sharp">pending_actions</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Citas Pendientes</h3>
                            <h1>5</h1>
                        </div>
                        <div class="progress">
                            <svg><circle r="30" cx="40" cy="40"></circle></svg>
                            <div class="number">35%</div>
                        </div>
                    </div>
                    <small>Últimas 24 horas</small>
                </div>
            </div>

            <div class="recent_order">
                <h1>Citas Recientes</h1>
                <table>
                    <thead>
                        <tr><th>Paciente</th><th>Motivo</th><th>Estado</th><th>Acción</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Luis Paredes</td><td>Chequeo</td><td class="warning">Pendiente</td><td class="primary">Ver Historia</td></tr>
                        <tr><td>Camila Ríos</td><td>Control</td><td class="warning">Pendiente</td><td class="primary">Ver Historia</td></tr>
                        <tr><td>Andrés Mora</td><td>Dolor</td><td class="warning">Pendiente</td><td class="primary">Ver Historia</td></tr>
                        <tr><td>María Díaz</td><td>Consulta</td><td class="warning">Pendiente</td><td class="primary">Ver Historia</td></tr>
                    </tbody>
                </table>
            </div>
        </main>

        <div class="right">
            <div class="top">
                <button id="menu_bar"><span class="material-symbols-sharp">menu</span></button>
                <div class="theme-toggler">
                    <span class="material-symbols-sharp active">light_mode</span>
                    <span class="material-symbols-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p><b>Doctor</b></p>
                        <p>Panel Médico</p>
                    </div>
                    <div class="profile-photo">
                        <img src="{{ asset('img/doctor1.jpg') }}" alt="Foto del doctor">
                    </div>
                </div>
            </div>

            <div class="recent_updates">
                <h2>Actividad Reciente</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo"><img src="{{ asset('img/paciente1.jpg') }}"></div>
                        <div class="message"><p><b>Paciente López</b> llegó a su consulta</p></div>
                    </div>
                    <div class="update">
                        <div class="profile-photo"><img src="{{ asset('img/paciente2.jpg') }}"></div>
                        <div class="message"><p><b>Paciente Méndez</b> canceló su cita</p></div>
                    </div>
                    <div class="update">
                        <div class="profile-photo"><img src="{{ asset('img/paciente3.jpg') }}"></div>
                        <div class="message"><p><b>Paciente Torres</b> solicitó reprogramación</p></div>
                    </div>
                </div>
            </div>

            <div class="sales_analytics">
                <h2>Resumen de Citas</h2>
                <div class="item online"><div class="icon"><span class="material-symbols-sharp">calendar_month</span></div><div class="right_text"><div class="info"><h3>Confirmadas</h3><small class="text-muted">Últimas 2h</small></div><h5 class="danger">+8%</h5><h3>10</h3></div></div>
                <div class="item online"><div class="icon"><span class="material-symbols-sharp">task_alt</span></div><div class="right_text"><div class="info"><h3>Atendidas</h3><small class="text-muted">Últimas 2h</small></div><h5 class="danger">+5%</h5><h3>9</h3></div></div>
                <div class="item online"><div class="icon"><span class="material-symbols-sharp">cancel</span></div><div class="right_text"><div class="info"><h3>Canceladas</h3><small class="text-muted">Últimas 2h</small></div><h5 class="danger">-1%</h5><h3>2</h3></div></div>
            </div>

            <div class="item add_products">
                <div><span class="material-symbols-sharp">add</span></div>
            </div>
        </div>
    </div>
</body>
</html>
