<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Doctor - Clínica Los Ángeles</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <meta name="doctor-dashboard-data" content="{{ route('doctor.dashboard.data') }}">
    <meta name="user-id" content="{{ Auth::id() }}">
    @vite(['resources/css/dashboards/doctor.css', 'resources/js/dashboard-doctor.js'])
</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo"><h2>Doctor <span class="danger">Los Ángeles</span></h2></div>
                <div class="close"><span class="material-symbols-outlined">close</span></div>
            </div>
            <div class="sidebar">
                <a href="{{ route('doctor.dashboard') }}"><span class="material-symbols-outlined">dashboard</span><h3>Inicio</h3></a>
                <a href="{{ route('doctor.citas') }}"><span class="material-symbols-outlined">calendar_month</span><h3>Mis Citas</h3></a>
                <a href="{{ route('doctor.perfil.edit') }}"><span class="material-symbols-outlined">account_circle</span><h3>Perfil</h3></a>
                <form id="logout-form" action="{{ route('salir') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="material-symbols-outlined">logout</span>
                    <h3>Cerrar Sesión</h3>
                </a>
            </div>
        </aside>

        <main>
            <h1>Panel del Doctor</h1>
            <div class="date"><input type="date"></div>

            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            <div class="insights">
                <div class="sales">
                    <span class="material-symbols-sharp">calendar_month</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Mis Citas Hoy</h3>
                            <h1 id="k-hoy">{{ $citasHoy }}</h1>
                        </div>
                        <div class="progress"><svg><circle r="30" cx="40" cy="40"></circle></svg><div class="number"></div></div>
                    </div>
                    <small>Hoy</small>
                </div>

                <div class="expenses">
                    <span class="material-symbols-sharp">check_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Atendidas</h3>
                            <h1 id="k-realizadas">{{ $citasRealizadas }}</h1>
                        </div>
                        <div class="progress"><svg><circle r="30" cx="40" cy="40"></circle></svg><div class="number"></div></div>
                    </div>
                    <small>Hoy</small>
                </div>

                <div class="income">
                    <span class="material-symbols-sharp">pending_actions</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Pendientes</h3>
                            <h1 id="k-pendientes">{{ $citasPendientes }}</h1>
                        </div>
                        <div class="progress"><svg><circle r="30" cx="40" cy="40"></circle></svg><div class="number"></div></div>
                    </div>
                    <small>Hoy</small>
                </div>
            </div>

            <div class="recent_order">
                <h1>Citas Recientes</h1>
                <table>
                    <thead>
                        <tr><th>Paciente</th><th>Estado</th><th>Fecha</th><th>Hora</th></tr>
                    </thead>
                    <tbody id="tbody-citas">
                        @forelse($citas as $c)
                            <tr>
                                <td>{{ $c->paciente->name ?? 'Paciente' }}</td>
                                <td class="{{ $c->estado === 'pendiente' ? 'warning' : ($c->estado === 'realizada' ? 'success' : ($c->estado === 'confirmada' ? 'info' : 'danger')) }}">{{ ucfirst($c->estado) }}</td>
                                <td>{{ $c->fecha }}</td>
                                <td>{{ $c->hora }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4">Sin citas para hoy.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>

        <div class="right">
            <div class="top">
                <button id="menu_bar"><span class="material-symbols-sharp">menu</span></button>
                <div class="theme-toggler"><span class="material-symbols-sharp active">light_mode</span><span class="material-symbols-sharp">dark_mode</span></div>
                <div class="profile">
                    <div class="info"><p><b>{{ Auth::user()->name }}</b></p><p>Panel Médico</p></div>
                    <div class="profile-photo"><img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : asset('img/doctor1.jpg') }}" alt="Foto del doctor"></div>
                </div>
            </div>

            <div class="recent_updates">
                <h2>Actividad Reciente</h2>
                <div class="updates" id="updates"></div>
            </div>

            <div class="sales_analytics">
                <h2>Resumen de Citas</h2>
                <div class="item online">
                    <div class="icon"><span class="material-symbols-sharp">calendar_month</span></div>
                    <div class="right_text">
                        <div class="info"><h3>Confirmadas</h3><small class="text-muted"></small></div>
                        <h3 id="k-conf-2h">{{ $citasConfirmadas2h }}</h3>
                    </div>
                </div>
                <div class="item online">
                    <div class="icon"><span class="material-symbols-sharp">task_alt</span></div>
                    <div class="right_text">
                        <div class="info"><h3>Atendidas</h3><small class="text-muted"></small></div>
                        <h3 id="k-real-2h">{{ $citasRealizadas2h }}</h3>
                    </div>
                </div>
                <div class="item online">
                    <div class="icon"><span class="material-symbols-sharp">cancel</span></div>
                    <div class="right_text">
                        <div class="info"><h3>Canceladas</h3><small class="text-muted"></small></div>
                        <h3 id="k-canc-2h">{{ $citasCanceladas2h }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
