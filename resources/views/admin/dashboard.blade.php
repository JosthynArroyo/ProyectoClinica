<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - Clínica Los Ángeles</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <meta name="dashboard-resumen-url" content="{{ route('admin.dashboard.resumen') }}">
    @vite(['resources/css/dashboards/admin.css', 'resources/js/dashboard-admin.js', 'resources/js/dashboard-admin-extras.js'])
</head>
<body>
<div class="container">
    <aside>
        <div class="top">
            <div class="logo">
                <h2>Clínica <span class="danger">Los Ángeles</span></h2>
            </div>
            <div class="close">
                <span class="material-symbols-outlined">close</span>
            </div>
        </div>
        <div class="sidebar">
            <a href="{{ route('admin.dashboard') }}"><span class="material-symbols-outlined">dashboard</span><h3>Inicio</h3></a>

            <a href="{{ route('admin.usuarios.index') }}"><span class="material-symbols-outlined">person</span><h3>Usuarios</h3></a>

            <a href="{{ route('admin.doctores.crear') }}"><span class="material-symbols-outlined">person_add</span><h3>Registrar Doctor</h3></a>

            {{-- NUEVO: Registrar Paciente --}}
            <a href="{{ route('admin.pacientes.crear') }}"><span class="material-symbols-outlined">group_add</span><h3>Registrar Paciente</h3></a>

            <a href="{{ route('admin.perfil.edit') }}"><span class="material-symbols-outlined">account_circle</span><h3>Perfil</h3></a>
            <a href="{{ route('salir') }}"><span class="material-symbols-outlined">logout</span><h3>Cerrar Sesión</h3></a>
        </div>
    </aside>

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
                        <h1>{{ $totalCitas }}</h1>
                    </div>
                    <div class="progress"><svg><circle r="30" cx="40" cy="40"></circle></svg></div>
                </div>
                <small>Acumulado</small>
            </div>

            <div class="expenses">
                <span class="material-symbols-sharp">event_note</span>
                <div class="middle">
                    <div class="left">
                        <h3>Citas Pendientes</h3>
                        <h1>{{ $totalCitasPendientes }}</h1>
                    </div>
                    <div class="progress"><svg><circle r="30" cx="40" cy="40"></circle></svg></div>
                </div>
                <small>Acumulado</small>
            </div>

            <div class="income">
                <span class="material-symbols-sharp">check_circle</span>
                <div class="middle">
                    <div class="left">
                        <h3>Citas Completadas</h3>
                        <h1>{{ $totalCitasRealizadas }}</h1>
                    </div>
                    <div class="progress"><svg><circle r="30" cx="40" cy="40"></circle></svg></div>
                </div>
                <small>Acumulado</small>
            </div>
        </div>

        <div class="recent_order">
            <h1>Citas Recientes</h1>

            <form action="{{ route('admin.citas.export') }}" method="GET" style="margin-bottom: 15px; text-align: right;">
                <button type="submit" class="btn-export">
                    <span class="material-symbols-outlined">download</span> Exportar a Excel
                </button>
            </form>

            @php use Illuminate\Support\Carbon; @endphp

            <table id="tabla-citas">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Doctor</th>
                        <th>Estado</th>
                        <th>Horario</th>
                    </tr>
                </thead>
                <tbody id="citasBody">
                    @forelse($citas as $cita)
                        <tr>
                            <td>{{ $cita->paciente->name ?? 'Sin paciente' }}</td>
                            <td>{{ $cita->doctor->name ?? 'Sin asignar' }}</td>
                            <td class="{{ $cita->estado === 'pendiente' ? 'warning' : ($cita->estado === 'realizada' ? 'success' : ($cita->estado === 'confirmada' ? 'info' : 'danger')) }}">
                                {{ ucfirst($cita->estado) }}
                            </td>
                            <td>{{ Carbon::parse($cita->fecha)->format('Y-m-d') }} {{ Carbon::parse($cita->hora)->format('H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No hay citas recientes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="table-actions" style="display:flex;gap:.6rem;justify-content:flex-end;margin-top:.8rem;">
                <button type="button" id="btnShowLess" class="btn-outline" style="display:none;">Mostrar menos</button>
                <button type="button" id="btnShowMore" class="btn-outline">Mostrar más</button>
            </div>
        </div>
    </main>

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
                    <img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : asset('img/doctor1.jpg') }}" alt="Foto del doctor">
                </div>
            </div>
        </div>

        <div class="recent_updates">
            <h2>Últimas actividades</h2>
            <div class="updates"></div>
        </div>

        <div class="sales_analytics">
            <h2>Resumen de citas</h2>

            <div class="item online">
                <div class="icon"><span class="material-symbols-sharp">calendar_month</span></div>
                <div class="right_text">
                    <div class="info"><h3>Citas agendadas</h3><small class="text-muted">Total</small></div>
                    <h3 id="kpi-agendadas">{{ $totalCitas }}</h3>
                </div>
            </div>

            <div class="item online">
                <div class="icon"><span class="material-symbols-sharp">task_alt</span></div>
                <div class="right_text">
                    <div class="info"><h3>Citas completadas</h3><small class="text-muted">Total</small></div>
                    <h3 id="kpi-completadas">{{ $totalCitasRealizadas }}</h3>
                </div>
            </div>

            <div class="item online">
                <div class="icon"><span class="material-symbols-sharp">cancel</span></div>
                <div class="right_text">
                    <div class="info"><h3>Citas canceladas</h3><small class="text-muted">Total</small></div>
                    <h3 id="kpi-canceladas">{{ $totalCitasCanceladas }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
