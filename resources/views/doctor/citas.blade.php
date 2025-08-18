<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mis Citas (Doctor)</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
  --clr-primary: #7380ec;
  --clr-danger: #ff7782;
  --clr-success: #41f1b6;
  --clr-white: #fff;
  --clr-info-dark: #7d8da1;
  --clr-info-light: #dce1eb;
  --clr-dark: #363949;
  --clr-warning: #ff4e4c;
  --clr-light: rgba(132, 139, 200, 0.18);
  --card-border-radius: 1rem;
  --border-radius-1: 0.4rem;
  --card-padding: 1.8rem;
  --box-shadow: 0 2rem 3rem var(--clr-light);
}

body {
  font-family: "Poppins", sans-serif;
  background: var(--clr-white);
  margin: 0;
  padding: 2rem;
  color: var(--clr-dark);
}

.container {
  max-width: 900px;
  margin: auto;
  background-color: var(--clr-white);
  padding: var(--card-padding);
  border-radius: var(--card-border-radius);
  box-shadow: var(--box-shadow);
}

h1 {
  font-size: 1.8rem;
  font-weight: 700;
  margin-bottom: 1rem;
}

.alert-success, .alert-danger {
  padding: 0.8rem 1rem;
  border-radius: var(--border-radius-1);
  margin-bottom: 1rem;
}

.alert-success { background-color: #d4edda; color: #155724; }
.alert-danger { background-color: #f8d7da; color: #721c24; }

.table-container {
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1rem;
}

thead {
  background-color: var(--clr-primary);
  color: var(--clr-white);
}

th, td {
  padding: 0.8rem 0.6rem;
  text-align: left;
  border-bottom: 1px solid #e0e0e0;
}

.badge {
  padding: 0.3rem 0.6rem;
  border-radius: var(--border-radius-1);
  font-weight: 600;
  font-size: 0.85rem;
}

.bg-warning { background-color: var(--clr-warning); color: #000; }
.bg-info { background-color: var(--clr-info-light); color: #000; }
.bg-danger { background-color: var(--clr-danger); color: #fff; }
.bg-success { background-color: var(--clr-success); color: #000; }
.bg-secondary { background-color: #ccc; color: #000; }

.btn {
  padding: 0.4rem 0.8rem;
  border-radius: var(--border-radius-1);
  font-size: 0.85rem;
  font-weight: 600;
  cursor: pointer;
  border: none;
  transition: all 0.2s ease;
  text-decoration: none;
  display: inline-block;
}

.btn-outline-success {
  background-color: transparent;
  border: 1px solid var(--clr-success);
  color: var(--clr-success);
}

.btn-outline-success:hover {
  background-color: var(--clr-success);
  color: #fff;
}

.btn-outline-danger {
  background-color: transparent;
  border: 1px solid var(--clr-danger);
  color: var(--clr-danger);
}

.btn-outline-danger:hover {
  background-color: var(--clr-danger);
  color: #fff;
}

.btn-success {
  background-color: var(--clr-success);
  color: #000;
}

.btn-success:hover {
  opacity: 0.85;
}

.btn-primary {
  background-color: var(--clr-primary);
  color: #fff;
}

.btn-primary:hover {
  opacity: 0.85;
}

.text-muted { color: #6c757d; }

.d-flex { display: flex; align-items: center; }
.gap-2 { gap: 0.5rem; }

.mb-3 { margin-bottom: 1rem; }
</style>
</head>
<body>
<div class="container">
    <h1>Mis Citas (Doctor)</h1>

    <!-- Botón regresar al dashboard -->
    <a href="{{ route('doctor.dashboard') }}" class="btn btn-primary mb-3">← Volver al Dashboard</a>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-danger">{{ session('error') }}</div>
    @endif

    @if($citas->isEmpty())
        <p>No tienes citas asignadas.</p>
    @else
        <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Especialidad</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas as $cita)
                    <tr>
                        <td>{{ $cita->paciente->name ?? '—' }}</td>
                        <td>{{ $cita->especialidad->nombre ?? '—' }}</td>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td>
                            @switch($cita->estado)
                                @case('pendiente')   <span class="badge bg-warning">Pendiente</span> @break
                                @case('confirmada')  <span class="badge bg-info">Confirmada</span> @break
                                @case('cancelada')   <span class="badge bg-danger">Cancelada</span> @break
                                @case('realizada')   <span class="badge bg-success">Realizada</span> @break
                                @default             <span class="badge bg-secondary">{{ $cita->estado }}</span>
                            @endswitch
                        </td>
                        <td class="d-flex gap-2">
                            @if($cita->estado == 'pendiente')
                                <form action="{{ route('doctor.citas.aceptar', $cita->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-success">Aceptar</button>
                                </form>
                                <form action="{{ route('doctor.citas.rechazar', $cita->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-danger">Rechazar</button>
                                </form>
                            @elseif($cita->estado == 'confirmada')
                                <form action="{{ route('doctor.citas.realizar', $cita->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success">Marcar realizada</button>
                                </form>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    @endif
</div>
</body>
</html>
