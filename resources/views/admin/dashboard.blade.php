<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - Clínica Los Ángeles</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    @vite(['resources/css/dashboards/admin.css', 'resources/js/dashboard-admin.js'])
</head>
<body>
    <div class="container">
        <!-- ASIDE -->
        <aside>
            <div class="top">
                <div class="logo">
                    <h2>Clínica<span class="danger">Los Ángeles</span></h2>
                </div>
                <div class="close">
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="#"><span class="material-symbols-outlined">dashboard</span><h3>Inicio</h3></a>
                <a href="#"><span class="material-symbols-outlined">person</span><h3>Usuarios</h3></a>
                <a href="#"><span class="material-symbols-outlined">calendar_month</span><h3>Citas Médicas</h3></a>
                <a href="#"><span class="material-symbols-outlined">medical_services</span><h3>Doctores</h3></a>
                <a href="#"><span class="material-symbols-outlined">sick</span><h3>Pacientes</h3></a>
                <a href="#"><span class="material-symbols-outlined">analytics</span><h3>Estadísticas</h3></a>
                <a href="#"><span class="material-symbols-outlined">tune</span><h3>Preferencias</h3></a>
                <a href="{{ route('salir') }}"><span class="material-symbols-outlined">logout</span><h3>Cerrar Sesión</h3></a>
            </div>
        </aside>

        <!-- MAIN -->
        <main>
            <h1>Panel de Control</h1>
            <div class="date">
                <input type="date">
            </div>

            <div class="insights">
                <div class="sales">
                    <span class="material-symbols-sharp">monitor_heart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Citas Totales</h3>
                            <h1>120</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle r="30" cx="40" cy="40"></circle>
                            </svg>
                            <div class="number">80%</div>
                        </div>
                    </div>
                    <small>Últimas 24 horas</small>
                </div>

                <div class="expenses">
                    <span class="material-symbols-sharp">event_note</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Citas Pendientes</h3>
                            <h1>35</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle r="30" cx="40" cy="40"></circle>
                            </svg>
                            <div class="number">65%</div>
                        </div>
                    </div>
                    <small>Últimas 24 horas</small>
                </div>

                <div class="income">
                    <span class="material-symbols-sharp">check_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Citas Completadas</h3>
                            <h1>85</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle r="30" cx="40" cy="40"></circle>
                            </svg>
                            <div class="number">100%</div>
                        </div>
                    </div>
                    <small>Últimas 24 horas</small>
                </div>
            </div>

            <div class="recent_order">
                <h1>Citas Recientes</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Estado</th>
                            <th>Horario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Juan Pérez</td>
                            <td>Dra. Ramírez</td>
                            <td class="warning">Pendiente</td>
                            <td class="primary">Ver Detalles</td>
                        </tr>
                        <tr>
                            <td>Ana Gómez</td>
                            <td>Dr. Castillo</td>
                            <td class="warning">Pendiente</td>
                            <td class="primary">Ver Detalles</td>
                        </tr>
                        <tr>
                            <td>Roberto Ruiz</td>
                            <td>Dr. Morales</td>
                            <td class="warning">Pendiente</td>
                            <td class="primary">Ver Detalles</td>
                        </tr>
                        <tr>
                            <td>Lucía Torres</td>
                            <td>Dra. Medina</td>
                            <td class="warning">Pendiente</td>
                            <td class="primary">Ver Detalles</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>

        <!-- RIGHT -->
        <div class="right">
            <div class="top">
                <button id="menu_bar">
                    <span class="material-symbols-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-sharp active">light_mode</span>
                    <span class="material-symbols-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p><b>Admin</b></p>
                        <p>Panel Clínico</p>
                    </div>
                    <div class="profile-photo">
                        <img src="{{ asset('img/doctor1.jpg') }}" alt="Foto del administrador">
                    </div>
                </div>
            </div>

            <div class="recent_updates">
                <h2>Últimas actividades</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="{{ asset('img/doctor2.jpg') }}" alt="Foto de doctor">
                        </div>
                        <div class="message">
                            <p><b>Dr. Pérez</b> actualizó su disponibilidad</p>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="{{ asset('img/doctor1.jpg') }}" alt="Foto de doctor">
                        </div>
                        <div class="message">
                            <p><b>Paciente Gómez</b> agendó una nueva cita</p>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="{{ asset('img/doctora1.jpg') }}" alt="Foto de doctora">
                        </div>
                        <div class="message">
                            <p><b>Dra. Ruiz</b> confirmó una consulta médica</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sales_analytics">
                <h2>Resumen de citas</h2>

                <div class="item online">
                    <div class="icon">
                        <span class="material-symbols-sharp">calendar_month</span>
                    </div>
                    <div class="right_text">
                        <div class="info">
                            <h3>Citas agendadas</h3>
                            <small class="text-muted">Últimas 2 horas</small>
                        </div>
                        <h5 class="danger">+10%</h5>
                        <h3>40</h3>
                    </div>
                </div>

                <div class="item online">
                    <div class="icon">
                        <span class="material-symbols-sharp">task_alt</span>
                    </div>
                    <div class="right_text">
                        <div class="info">
                            <h3>Citas completadas</h3>
                            <small class="text-muted">Últimas 2 horas</small>
                        </div>
                        <h5 class="danger">+5%</h5>
                        <h3>38</h3>
                    </div>
                </div>

                <div class="item online">
                    <div class="icon">
                        <span class="material-symbols-sharp">cancel</span>
                    </div>
                    <div class="right_text">
                        <div class="info">
                            <h3>Citas canceladas</h3>
                            <small class="text-muted">Últimas 2 horas</small>
                        </div>
                        <h5 class="danger">-3%</h5>
                        <h3>7</h3>
                    </div>
                </div>

            </div>
            <div class="item add_products">
            <div>
                <span class="material-symbols-sharp">add</span>
            </div>
        </div>

        </div>
        

    </div>
</body>
</html>
