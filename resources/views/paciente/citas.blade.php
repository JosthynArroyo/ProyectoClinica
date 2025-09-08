<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mis Citas Médicas</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root{
      --primary:#6b74ff;
      --primary-2:#8ea1ff;
      --danger:#ff6b81;
      --success:#41f1b6;
      --ink:#1f2330;
      --muted:#6b7280;
      --card:#ffffff;
      --ring:rgba(107,116,255,.35);
      --shadow:0 20px 35px rgba(31,35,48,.10), 0 8px 14px rgba(31,35,48,.06);
      --radius-lg:22px;
      --radius-sm:14px;
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family:"Poppins",system-ui,-apple-system,Segoe UI,Roboto,Arial;
      color:var(--ink);
      background:radial-gradient(1200px 500px at 20% -10%, #f1f3ff 0%, #ffffff 55%) fixed;
    }

    .page{ max-width:980px; margin:42px auto; padding:0 20px; }

    /* Header */
    .page-header{
      padding:24px 24px 18px;
      background:linear-gradient(135deg, var(--primary), var(--primary-2));
      border-radius:22px;
      box-shadow:var(--shadow);
    }
    .header-panel{
      background:#ffffff;
      border-radius:16px;
      padding:18px 20px;
      box-shadow:0 10px 20px rgba(16,24,40,.06);
      display:flex; align-items:center; gap:14px; justify-content:space-between;
    }
    .header-left{ display:flex; align-items:center; gap:14px; }
    .title{ margin:0; font-size:1.6rem; font-weight:800; color:#1f2330 }
    .subtitle{ margin:2px 0 0; color:#667085; font-weight:600; font-size:.95rem }

    .btn-back{
      background:linear-gradient(135deg, var(--primary), var(--primary-2));
      color:#fff; text-decoration:none; font-weight:800; letter-spacing:.2px;
      padding:10px 14px; border-radius:12px; display:inline-flex; align-items:center; gap:8px;
      box-shadow:0 10px 18px rgba(107,116,255,.25);
      border:none; cursor:pointer;
    }

    /* Alerts */
    .alerts{ margin:18px 4px 4px }
    .alert{
      border-radius:12px; padding:12px 14px; font-weight:600; margin:10px 0;
    }
    .alert-success{ background:#dff7ea; color:#137a5a; border:1px solid #c7f1de }
    .alert-danger{  background:#ffe8ec; color:#a21736; border:1px solid #ffd6df }

    /* Cards list */
    .list{ margin-top:18px; display:grid; gap:18px }

    .appt{
      background:#fff; border:1px solid #eef1ff; border-radius:var(--radius-lg);
      box-shadow:var(--shadow); padding:18px 20px;
      display:grid; grid-template-columns:1fr auto; gap:14px; align-items:center;
    }
    .appt:hover{ box-shadow:0 16px 28px rgba(31,35,48,.12) }

    .appt-title{ margin:0 0 6px 0; font-weight:800; color:#24283a; font-size:1.05rem }
    .appt-meta{ margin:0; color:#60657a; font-weight:600; font-size:.93rem }
    .appt-meta + .appt-meta{ margin-top:6px }

    .right{ display:flex; flex-direction:column; align-items:flex-end; gap:10px }

    /* Pills (estado) */
    .pill{ display:inline-flex; align-items:center; gap:8px; padding:6px 10px; border-radius:999px;
           font-weight:800; font-size:.8rem; border:1px solid transparent }
    .pill.pending{  background:#fff6d8; color:#8a6d3b; border-color:#ffe9a8 }
    .pill.info{     background:#eef2ff; color:#3a47d5; border-color:#dee6ff }
    .pill.danger{   background:#ffe9ef; color:#a21736; border-color:#ffd6e0 }
    .pill.success{  background:#e9fff6; color:#128462; border-color:#c9ffe9 }

    /* Actions */
    .actions{ display:flex; gap:10px; }
    .btn{
      appearance:none; border:none; cursor:pointer; font-weight:800; letter-spacing:.2px;
      padding:10px 14px; border-radius:12px; transition: transform .05s ease, filter .2s ease;
      text-decoration:none; display:inline-flex; align-items:center;
    }
    .btn:active{ transform:translateY(1px) scale(.995) }
    .btn-cancel{ background:#ff7782; color:#fff; box-shadow:0 10px 18px rgba(255,119,130,.25) }
    .btn-cancel:hover{ filter:brightness(1.05) }
    .btn-primary{
      color:#fff; background:linear-gradient(135deg, var(--primary), var(--primary-2));
      box-shadow:0 12px 24px rgba(107,116,255,.30);
    }
    .btn-primary:hover{ filter:brightness(1.03) }

    /* Empty state */
    .empty{
      background:#fff; border:1px solid #eef1ff; border-radius:18px; padding:24px; text-align:center;
      color:#60657a; font-weight:600;
    }

    /* Responsive */
    @media (max-width:780px){
      .header-panel{ flex-direction:column; align-items:flex-start; gap:10px }
      .right{ align-items:flex-start }
      .appt{ grid-template-columns:1fr; }
      .actions{ width:100%; }
      .actions .btn{ flex:1; justify-content:center }
    }
  </style>
</head>
<body>
  <div class="page">

    <!-- Header con panel blanco -->
    <div class="page-header">
      <div class="header-panel">
        <div class="header-left">
          <a href="{{ route('paciente.dashboard') }}" class="btn-back" aria-label="Regresar">
            <!-- flecha -->
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M15 18l-6-6 6-6"/>
            </svg>
            Regresar
          </a>
          <div>
            <h1 class="title">Mis Citas Médicas</h1>
            <p class="subtitle">Consulta, cancela o reagenda tus próximas citas.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Alerts -->
    <div class="alerts">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
    </div>

    <!-- Lista de citas -->
    <div class="list">
      @if($citas->isEmpty())
        <div class="empty">No tienes citas registradas.</div>
      @else
        @foreach($citas as $cita)
          <div class="appt">
            <div class="left">
              <h3 class="appt-title">
                Fecha:
                {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                &nbsp;|&nbsp;
                Hora:
                {{ strlen($cita->hora ?? '')>=5 ? substr($cita->hora,0,5) : $cita->hora }}
              </h3>
              <p class="appt-meta">Doctor: {{ $cita->doctor->name ?? 'Sin asignar' }}</p>
              <p class="appt-meta">Especialidad: {{ $cita->especialidad->nombre ?? 'Sin especialidad' }}</p>
            </div>

            <div class="right">
              <!-- Estado -->
              @switch($cita->estado)
                @case('pendiente')  <span class="pill pending">PENDIENTE</span> @break
                @case('confirmada') <span class="pill info">CONFIRMADA</span> @break
                @case('cancelada')  <span class="pill danger">CANCELADA</span> @break
                @case('realizada')  <span class="pill success">REALIZADA</span> @break
                @default            <span class="pill info">{{ strtoupper($cita->estado) }}</span>
              @endswitch

              @if(!in_array($cita->estado, ['cancelada','realizada']))
                <div class="actions">
                  <form action="{{ route('paciente.citas.cancelar', $cita->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    <button type="submit" class="btn btn-cancel">Cancelar</button>
                  </form>
                  <a class="btn btn-primary" href="{{ route('paciente.editar-cita', $cita->id) }}">Reagendar</a>
                </div>
              @endif
            </div>
          </div>
        @endforeach
      @endif
    </div>

  </div>
</body>
</html>
