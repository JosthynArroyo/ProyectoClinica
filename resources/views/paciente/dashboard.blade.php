<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Paciente - Clínica Los Ángeles</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    @vite(['resources/css/dashboards/paciente.css', 'resources/js/dashboard-paciente.js'])
</head>
<body>
<div class="container">
    <!-- ASIDE -->
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

    <!-- MAIN -->
    <main>
        <h1>Mi Panel</h1>
        <div class="date"><input type="date"></div>

        <!-- INSIGHTS -->
        <div class="insights">
            <div class="sales">
                <span class="material-symbols-sharp">calendar_month</span>
                <div class="middle">
                    <div class="left">
                        <h3>Citas Agendadas</h3>
                        <h1>{{ $totalCitas }}</h1>
                    </div>
                    <div class="progress">
                        <svg><circle r="30" cx="40" cy="40"></circle></svg>
                    </div>
                </div>
                <small>Este mes</small>
            </div>

            <div class="expenses">
                <span class="material-symbols-sharp">check_circle</span>
                <div class="middle">
                    <div class="left">
                        <h3>Completadas</h3>
                        <h1>{{ $totalCitasRealizadas }}</h1>
                    </div>
                    <div class="progress">
                        <svg><circle r="30" cx="40" cy="40"></circle></svg>
                    </div>
                </div>
                <small>Historial</small>
            </div>

            <div class="income">
                <span class="material-symbols-sharp">cancel</span>
                <div class="middle">
                    <div class="left">
                        <h3>Canceladas</h3>
                        <h1>{{ $totalCitas - $totalCitasRealizadas - $totalCitasPendientes }}</h1>
                    </div>
                    <div class="progress">
                        <svg><circle r="30" cx="40" cy="40"></circle></svg>
                    </div>
                </div>
                <small>Este mes</small>
            </div>
        </div>

        <!-- Citas Recientes -->
        <div class="recent_order">
            <h1>Mis Próximas Citas</h1>
            <table>
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Especialidad</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($citas as $cita)
                        <tr>
                            <td>{{ $cita->doctor->name ?? 'Sin asignar' }}</td>
                            <td>{{ $cita->especialidad->nombre ?? '—' }}</td>
                            <td>{{ $cita->fecha }}</td>
                            <td>{{ $cita->hora }}</td>
                            <td>
                                <span class="badge {{ $cita->estado === 'pendiente' ? 'warning' : ($cita->estado === 'realizada' ? 'success' : ($cita->estado === 'confirmada' ? 'info' : 'danger')) }}">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('paciente.editar-cita', $cita->id) }}" class="btn btn-primary btn-sm">Ver / Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No tienes próximas citas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ route('paciente.crear-cita') }}" class="primary" style="display:inline-block; margin-top:1.5rem; font-weight:bold; color:#fff; background:var(--clr-primary); padding:0.8rem 1.5rem; border-radius:0.5rem; text-align:center;">
                + Agendar Nueva Cita
            </a>
        </div>
    </main>

    <!-- RIGHT PANEL -->
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
                @foreach($citas->take(3) as $cita)
                    <div class="update">
                        <div class="profile-photo"><img src="{{ asset('img/doctor1.jpg') }}"></div>
                        <div class="message">
                            <p><b>{{ $cita->doctor->name ?? 'Doctor' }}</b> actualizó tu cita: {{ ucfirst($cita->estado) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="sales_analytics">
            <h2>Resumen</h2>
            <div class="item online">
                <div class="icon"><span class="material-symbols-sharp">calendar_month</span></div>
                <div class="right_text">
                    <div class="info"><h3>Agendadas</h3><small class="text-muted">Este mes</small></div>
                    <h3>{{ $totalCitas }}</h3>
                </div>
            </div>
            <div class="item online">
                <div class="icon"><span class="material-symbols-sharp">task_alt</span></div>
                <div class="right_text">
                    <div class="info"><h3>Completadas</h3><small class="text-muted">Este mes</small></div>
                    <h3>{{ $totalCitasRealizadas }}</h3>
                </div>
            </div>
            <div class="item online">
                <div class="icon"><span class="material-symbols-sharp">cancel</span></div>
                <div class="right_text">
                    <div class="info"><h3>Canceladas</h3><small class="text-muted">Este mes</small></div>
                    <h3>{{ $totalCitas - $totalCitasRealizadas - $totalCitasPendientes }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>