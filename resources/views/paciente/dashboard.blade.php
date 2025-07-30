<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Paciente</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    @vite(['resources/css/dashboards/paciente.css', 'resources/js/dashboard-paciente.js'])
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
                    <span class="material-symbols-outlined">calendar_add_on</span>
                    <h3>Reservar Cita</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">event_note</span>
                    <h3>Mis Citas</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">medical_services</span>
                    <h3>Médicos</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">folder_copy</span>
                    <h3>Historial Médico</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <h3>Mi Perfil</h3>
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
            <h1>Panel del Paciente</h1>
            <div class="date">
                <input type="date">
            </div>

            <div class="insights">
                <div class="sales">
                    <span class="material-symbols-sharp">event_available</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Cita Próxima</h3>
                            <h1>1</h1>
                        </div>
                        <div class="progress">
                            <svg><circle r="30" cy="40" cx="40"></circle></svg>
                            <div class="number">100%</div>
                        </div>
                    </div>
                    <small>Confirmada</small>
                </div>

                <div class="expenses">
                    <span class="material-symbols-sharp">pending_actions</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Citas Pendientes</h3>
                            <h1>2</h1>
                        </div>
                        <div class="progress">
                            <svg><circle r="30" cy="40" cx="40"></circle></svg>
                            <div class="number">66%</div>
                        </div>
                    </div>
                    <small>Esta semana</small>
                </div>

                <div class="income">
                    <span class="material-symbols-sharp">check_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Citas Realizadas</h3>
                            <h1>5</h1>
                        </div>
                        <div class="progress">
                            <svg><circle r="30" cy="40" cx="40"></circle></svg>
                            <div class="number">100%</div>
                        </div>
                    </div>
                    <small>Últimas 2 semanas</small>
                </div>
            </div>

            <div class="recent_order">
                <h1>Historial de Citas</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Dra. Ruiz</td>
                            <td>10/07/2025</td>
                            <td class="success">Completada</td>
                            <td class="primary">Ver</td>
                        </tr>
                        <tr>
                            <td>Dr. Pérez</td>
                            <td>18/07/2025</td>
                            <td class="warning">Pendiente</td>
                            <td class="primary">Ver</td>
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
                        <p><b>Ana Gómez</b></p>
                        <p>Paciente</p>
                    </div>
                    <div class="profile-photo">
                        <img src="{{ asset('img/doctora1.jpg') }}" alt="Foto Paciente">
                    </div>
                </div>
            </div>

            <div class="recents_updates">
                <h2>Últimas acciones</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="{{ asset('img/doctora1.jpg') }}" alt="">
                        </div>
                        <div class="message">
                            <p><b>Dra. Medina</b> confirmó tu cita</p>
                        </div>
                    </div>
                    <div class="updates">
                        <div class="profile-photo">
                            <img src="{{ asset('img/doctora1.jpg') }}" alt="">
                        </div>
                        <div class="message">
                            <p><b>Ana Gómez</b> subió documentos</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sales_analytics">
                <h2>Resumen</h2>
                <div class="item onlion">
                    <div class="icon">
                        <span class="material-symbols-sharp">calendar_month</span>
                    </div>
                    <div class="right_text">
                        <div class="info">
                            <h3>Próxima cita</h3>
                            <small class="text-muted">08:00 AM</small>
                        </div>
                        <h5 class="danger">Mañana</h5>
                        <h3>1</h3>
                    </div>
                </div>
            </div>
        </div>
        <!--right section end-->
    </div>
</body>
</html>
