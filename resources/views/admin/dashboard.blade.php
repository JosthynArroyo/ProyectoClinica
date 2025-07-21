<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    @vite(['resources/css/dashboards/admin.css', 'resources/js/dashboard-admin.js'])
</head>
<body>

<div class="dashboard">
    <aside id="sidebar" class="sidebar expanded">
        <div class="sidebar-header">
            <span class="logo" id="logoText">Clínica Los Angeles</span>
            <button id="toggleSidebar" class="toggle-btn">☰</button>
        </div>
        <nav class="sidebar-nav">
            <a href="#" class="nav-link">👥 <span class="link-text">Usuarios</span></a>
            <a href="#" class="nav-link">🩺 <span class="link-text">Doctores</span></a>
            <a href="#" class="nav-link">📅 <span class="link-text">Citas</span></a>
            <a href="#" class="nav-link">📊 <span class="link-text">Estadísticas</span></a>
            <a href="#" class="nav-link">⚙️ <span class="link-text">Configuración</span></a>
            <a href="{{ route('salir') }}" class="nav-link">🚪 <span class="link-text">Salir</span></a>
        </nav>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <h1>Bienvenido, {{ Auth::user()->name }}</h1>
        </header>
        <section class="content">
            <div class="card">
                <h2>Resumen del Sistema</h2>
                <p>Aquí podrás gestionar los usuarios, doctores y citas médicas.</p>
            </div>

            <div class="card">
                <h3>Estadísticas</h3>
                <ul>
                    <li>👥 Usuarios registrados: {{ $totalUsuarios }}</li>
                    <li>🩺 Doctores activos: {{ $totalDoctores }}</li>
                    <li>📅 Citas programadas: {{ $totalCitas }}</li>
                </ul>
            </div>
        </section>
    </main>
</div>

</body>
</html>
