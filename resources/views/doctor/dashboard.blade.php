<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Doctor</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    @vite(['resources/css/dashboards/doctor.css', 'resources/js/dashboard-doctor.js'])
</head>
<body>
    <div class="container">
        <!--aside section start-->
        <aside>
            <div class="top">
                <div class="logo">
                    <h2>Clínica<span class="danger">Los Angeles</span></h2>
                </div>
                <div class="close">
                    <span class="material-symbols-outlined"> close </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="#">
                    <span class="material-symbols-outlined">dashboard</span>
                    <h3>Inicio</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">event_available</span>
                    <h3>Mis Citas</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">group</span>
                    <h3>Pacientes</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">schedule</span>
                    <h3>Disponibilidad</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">history</span>
                    <h3>Historial</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <h3>Configuración</h3>
                </a>
                <a href="{{ route('salir') }}">
                    <span class="material-symbols-outlined">logout</span>
                    <h3>Cerrar Sesión</h3>
                </a>
            </div>
        </aside>
        <!--aside section end-->

        <!--main section start-->
        <main>
            <h1>Panel del Doctor</h1>
            <div class="date">
                <input type="date">
            </div>

            <div class="insights">
                <div class="sales">
                    <span class="material-symbols-sharp">event_available</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Citas Programadas</h3>
                            <h1>12</h1>
                        </div>
                        <div class="progress">
                            <svg><circle r="30" cy="40" cx="40"></circle></svg>
                            <div class="number">75%</div>
                        </div>
                    </div>
                    <small>Hoy</small>
                </div>

                <div class="expenses">
                    <span class="material-symbols-sharp">pending_actions</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Citas Pendientes</h3>
                            <h1>4</h1>
                        </div>
                        <div class="progress">
                            <svg><circle r="30" cy="40" cx="40"></circle></svg>
                            <div class="number">33%</div>
                        </div>
                    </div>
                    <small>Hoy</small>
                </div>

                <div class="income">
                    <span class="material-symbols-sharp">check_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Citas Realizadas</h3>
                            <h1>8</h1>
                        </div>
                        <div class="progress">
                            <svg><circle r="30" cy="40" cx="40"></circle></svg>
                            <div class="number">100%</div>
                        </div>
                    </div>
                    <small>Hoy</small>
                </div>
            </div>

            <div class="recent_order">
                <h1>Consultas de Hoy</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Juan Pérez</td>
                            <td>10:00 AM</td>
                            <td class="warning">Pendiente</td>
                            <td class="primary">Ver Ficha</td>
                        </tr>
                        <tr>
                            <td>Lucía Torres</td>
                            <td>11:00 AM</td>
                            <td class="success">Completado</td>
                            <td class="primary">Ver Ficha</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>

        <!--right section start-->
        <div class="right">
            <div class="top">
                <button id="menu_bar">
                    <span class="material-symbols-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-sharp">light_mode</span>
                    <span class="material-symbols-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p><b>Dr. Ramírez</b></p>
                        <p>Cardiología</p>
                    </div>
                    <div class="profile-photo">
                        <img src="{{ asset('img/doctor1.jpg') }}" alt="Foto Doctor">
                    </div>
                </div>
            </div>

            <div class="recents_updates">
                <h2>Notificaciones</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="{{ asset('img/doctor2.jpg') }}" alt="">
                        </div>
                        <div class="message">
                            <p><b>Paciente Ruiz</b> subió exámenes</p>
                        </div>
                    </div>
                    <div class="updates">
                        <div class="profile-photo">
                            <img src="{{ asset('img/doctora1.jpg') }}" alt="">
                        </div>
                        <div class="message">
                            <p><b>Admin</b> actualizó tu horario</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sales_analytics">
                <h2>Resumen Diario</h2>
                <div class="item onlion">
                    <div class="icon">
                        <span class="material-symbols-sharp">event_note</span>
                    </div>
                    <div class="right_text">
                        <div class="info">
                            <h3>Citas Hoy</h3>
                            <small class="text-muted">Actualizado</small>
                        </div>
                        <h5 class="danger">+2</h5>
                        <h3>12</h3>
                    </div>
                </div>
            </div>
        </div>
        <!--right section end-->
    </div>
</body>
</html>
