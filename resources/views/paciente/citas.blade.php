<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas Médicas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
          --clr-primary: #7380ec;
          --clr-primary-variant: #111e88;
          --clr-success: #41f1b6;
          --clr-danger: #ff7782;
          --clr-white: #fff;
          --clr-dark: #363949;
          --clr-dark-variant: #677483;
          --clr-light: rgba(132, 139, 200, 0.18);
          --card-border-radius: 1.5rem;
          --card-padding: 1.5rem;
          --box-shadow: 0 2rem 3rem var(--clr-light);
        }

        body {
          font-family: "Poppins", sans-serif;
          background-color: #f6f6f9;
          color: var(--clr-dark-variant);
        }

        .container {
          max-width: 900px;
          margin: 2rem auto;
          padding: 0 1rem;
        }

        h1 {
          font-size: 2rem;
          font-weight: 800;
          color: var(--clr-dark);
          margin-bottom: 1rem;
        }

        .back-btn {
          display: inline-flex;
          align-items: center;
          gap: 0.5rem;
          background-color: var(--clr-primary);
          color: var(--clr-white);
          padding: 0.6rem 1.2rem;
          border-radius: 0.8rem;
          font-weight: 500;
          text-decoration: none;
          margin-bottom: 1.5rem;
          transition: all 0.3s ease;
        }

        .back-btn:hover {
          background-color: var(--clr-primary-variant);
        }

        .alert {
          padding: 0.8rem 1rem;
          border-radius: 0.6rem;
          margin-bottom: 1rem;
          font-weight: 500;
        }

        .alert-success { background-color: #d4f7e2; color: var(--clr-success); }
        .alert-danger { background-color: #ffe0e3; color: var(--clr-danger); }

        .cita-card {
          background-color: var(--clr-white);
          padding: var(--card-padding);
          border-radius: var(--card-border-radius);
          box-shadow: var(--box-shadow);
          display: grid;
          grid-template-columns: 1fr auto;
          align-items: center;
          gap: 1rem;
          margin-bottom: 1rem;
          transition: all 0.3s ease;
        }

        .cita-card:hover {
          box-shadow: none;
        }

        .cita-info h3 {
          font-weight: 600;
          color: var(--clr-dark);
          margin-bottom: 0.25rem;
        }

        .cita-info p {
          font-size: 0.875rem;
          color: var(--clr-dark-variant);
          margin-bottom: 0.2rem;
        }

        .badge {
          padding: 0.25rem 0.75rem;
          border-radius: 0.5rem;
          font-size: 0.75rem;
          font-weight: 600;
          text-transform: uppercase;
          display: inline-block;
          margin-bottom: 0.5rem; /* 🔹 Esto da separación del botón */
        }

        .badge-pendiente { background-color: #ffecb3; color: #8a6d3b; }
        .badge-confirmada { background-color: #cce5ff; color: #004085; }
        .badge-cancelada { background-color: #f8d7da; color: #721c24; }
        .badge-realizada { background-color: #d4edda; color: #155724; }

        .actions button, .actions a {
          font-size: 0.8rem;
          padding: 0.4rem 0.8rem;
          border-radius: 0.6rem;
          font-weight: 500;
          transition: all 0.3s ease;
        }

        .actions button {
          background-color: var(--clr-danger);
          color: var(--clr-white);
        }

        .actions button:hover {
          background-color: #d63950;
        }

        .actions a {
          background-color: var(--clr-primary);
          color: var(--clr-white);
          text-decoration: none;
          margin-left: 0.5rem;
        }

        .actions a:hover {
          background-color: var(--clr-primary-variant);
        }

        @media (max-width: 640px) {
          .cita-card { grid-template-columns: 1fr; }
          .actions { margin-top: 0.5rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('paciente.dashboard') }}" class="back-btn">&larr; Regresar</a>

        <h1>Mis Citas Médicas</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($citas->isEmpty())
            <p>No tienes citas registradas.</p>
        @else
            @foreach($citas as $cita)
            <div class="cita-card">
                <div class="cita-info">
                    <h3>Fecha: {{ $cita->fecha }} | Hora: {{ $cita->hora }}</h3>
                    <p>Doctor: {{ $cita->doctor->name ?? 'Sin asignar' }}</p>
                    <p>Especialidad: {{ $cita->especialidad->nombre ?? 'Sin especialidad' }}</p>
                </div>
                <div class="flex flex-col items-end justify-center">
                    <span class="badge badge-{{ $cita->estado }}">{{ ucfirst($cita->estado) }}</span>
                    @if(!in_array($cita->estado, ['cancelada','realizada']))
                    <div class="actions">
                        <form action="{{ route('paciente.citas.cancelar', $cita->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            <button type="submit">Cancelar</button>
                        </form>
                        <a href="{{ route('paciente.editar-cita', $cita->id) }}">Reagendar</a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        @endif
    </div>
</body>
</html>
