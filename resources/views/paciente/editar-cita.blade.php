<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Reagendar Cita</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root{
  --primary:#6b74ff;
  --primary-2:#8ea1ff;
  --danger:#ff6b81;
  --success:#41f1b6;
  --info:#e7ecff;
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
  margin:0;
  font-family:"Poppins",system-ui,-apple-system,Segoe UI,Roboto,Arial;
  color:var(--ink);
  background:radial-gradient(1200px 500px at 20% -10%, #f1f3ff 0%, #ffffff 55%) fixed;
}

/* Soft blobs */
body::before, body::after{
  content:""; position:fixed; inset:auto auto 10% -10%;
  width:420px; height:420px; border-radius:50%;
  filter:blur(70px); opacity:.38; z-index:-1;
}
body::before{ background:linear-gradient(120deg, #f3f6ff, #e9faff) }
body::after{ left:auto; right:-8%; bottom:15%; background:linear-gradient(120deg, #ffe9ef, #ecf0ff) }

.page{ max-width:980px; margin:48px auto; padding:0 20px; }

.card{
  background:var(--card);
  border-radius:var(--radius-lg);
  box-shadow:var(--shadow);
  overflow:hidden;
  border:1px solid #f2f4ff;
}

/* Header */
.card-header{
  padding:24px 24px 18px;
  background:linear-gradient(135deg, var(--primary), var(--primary-2));
}
.header-panel{
  background:#ffffff;
  border-radius:16px;
  padding:18px 20px;
  box-shadow:0 10px 20px rgba(16,24,40,.06);
  display:flex;
  align-items:center;
  gap:12px;
  max-width:92%;
  margin:0 auto;
}
.card-header .title{
  color:#1f2330;
  font-size:1.35rem;
  font-weight:800;
  margin:0 0 4px 0;
}
.card-header .subtitle{
  color:#667085;
  margin:0;
  font-weight:600;
  line-height:1.3;
}

/* Content */
.card-body{ padding:26px; }

.meta{
  display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:18px;
}
.meta .kpi{
  background:#f9faff; border:1px solid #eef1ff; border-radius:14px; padding:14px 14px;
}
.kpi .label{ font-size:.78rem; color:var(--muted); font-weight:600; letter-spacing:.3px; text-transform:uppercase }
.kpi .value{ margin-top:6px; font-weight:700; font-size:1.02rem }

/* Estado pill */
.pill{ display:inline-flex; align-items:center; gap:8px; padding:6px 10px; border-radius:999px; font-weight:700; font-size:.82rem }
.pill svg{ width:16px; height:16px }
.pill.pending{ background:#fff1f1; color:#d63131; border:1px solid #ffd4d4 }
.pill.info{ background:#eef2ff; color:#3a47d5; border:1px solid #dfe4ff }
.pill.success{ background:#e9fff6; color:#128462; border:1px solid #c9ffe9 }
.pill.danger{ background:#ffe9ef; color:#a21736; border:1px solid #ffd6e0 }

/* Form */
.form-grid{
  display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-top:8px;
}
.input{
  position:relative; display:flex; align-items:center;
  background:#ffffff; border:1px solid #e7e9f5; border-radius:14px; padding:10px 12px 10px 40px;
  transition:border .2s, box-shadow .2s, transform .05s;
}
.input:focus-within{
  border-color:var(--primary);
  box-shadow:0 0 0 6px var(--ring);
}
.input .icon{
  position:absolute; left:12px; top:50%; transform:translateY(-50%); opacity:.7;
}
.input input{
  width:100%; border:none; outline:none; background:transparent; font:600 .98rem/1.4 "Poppins",system-ui;
  color:var(--ink);
}

label{ display:block; font-size:.88rem; font-weight:700; color:#3a3f52; margin:10px 0 8px 6px }
.help{ margin-top:6px; font-size:.78rem; color:var(--muted) }
.error{ display:block; margin-top:6px; color:var(--danger); font-size:.83rem; font-weight:600 }

/* Buttons */
.actions{ display:flex; gap:12px; margin-top:22px; flex-wrap:wrap }
.btn{
  appearance:none; border:none; cursor:pointer; font-weight:800; letter-spacing:.2px;
  padding:12px 18px; border-radius:14px; transition: transform .05s ease, box-shadow .2s ease, filter .2s ease;
}
.btn:active{ transform:translateY(1px) scale(.995) }

.btn-primary{
  color:#fff; background:linear-gradient(135deg, var(--primary), var(--primary-2));
  box-shadow:0 12px 24px rgba(107,116,255,.30);
}
.btn-primary:hover{ filter:brightness(1.03) }

.btn-ghost{
  background:#f2f5ff; color:#2a2f45; border:1px solid #e5e9ff;
  text-decoration:none; display:inline-flex; align-items:center;
}
.btn-ghost:hover{ filter:brightness(1.02) }

/* Alert */
.alert{
  background:var(--danger); color:#fff; padding:12px 14px; border-radius:12px; font-weight:600; margin-bottom:14px
}

/* Responsive */
@media (max-width: 900px){
  .header-panel{ max-width:100%; }
}
@media (max-width: 780px){
  .meta{ grid-template-columns:1fr; }
  .form-grid{ grid-template-columns:1fr; }
  .card-header{ padding:18px; }
  .card-body{ padding:20px; }
}
</style>
</head>
<body>
<div class="page">
  <div class="card">

    <!-- HEADER -->
    <div class="card-header">
      <div class="header-panel">
        <!-- icono opcional -->
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
          <rect x="3" y="4" width="18" height="18" rx="3"></rect>
          <path d="M16 2v4M8 2v4M3 10h18"></path>
        </svg>
        <div>
          <h1 class="title">Reagendar Cita</h1>
          <p class="subtitle">Selecciona una nueva fecha y hora para tu atención.</p>
        </div>
      </div>
    </div>

    <!-- BODY -->
    <div class="card-body">

      @if ($errors->has('error'))
        <div class="alert">{{ $errors->first('error') }}</div>
      @endif

      <!-- META -->
      <div class="meta">
        <div class="kpi">
          <div class="label">Doctor</div>
          <div class="value">{{ $cita->doctor->name ?? 'Sin asignar' }}</div>
        </div>
        <div class="kpi">
          <div class="label">Especialidad</div>
          <div class="value">{{ $cita->especialidad->nombre ?? '—' }}</div>
        </div>
        <div class="kpi">
          <div class="label">Estado actual</div>
          <div class="value">
            @switch($cita->estado)
              @case('pendiente')
                <span class="pill pending">
                  <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="12" cy="12" r="6"/></svg>
                  Pendiente
                </span>
              @break
              @case('confirmada')
                <span class="pill info">
                  <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 12l2 2 4-4"/></svg>
                  Confirmada
                </span>
              @break
              @case('cancelada')
                <span class="pill danger">
                  <svg viewBox="0 0 24 24" fill="currentColor"><path d="M7 7l10 10M17 7L7 17"/></svg>
                  Cancelada
                </span>
              @break
              @case('realizada')
                <span class="pill success">
                  <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 12l2 2 4-4"/></svg>
                  Realizada
                </span>
              @break
              @default
                <span class="pill info">{{ $cita->estado }}</span>
            @endswitch
          </div>
        </div>
      </div>

      <!-- FORM -->
      <form method="POST" action="{{ route('paciente.editar-cita.update', $cita->id) }}">
        @csrf

        <div class="form-grid">

          <div>
            <label for="fecha">Nueva fecha</label>
            <div class="input">
              <span class="icon" aria-hidden="true">
                <!-- calendar -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="4" width="18" height="18" rx="3"></rect>
                  <path d="M16 2v4M8 2v4M3 10h18"></path>
                </svg>
              </span>
              <input id="fecha" type="date" name="fecha"
                     value="{{ old('fecha', $cita->fecha) }}"
                     min="{{ \Carbon\Carbon::now('America/Guayaquil')->toDateString() }}"
                     required />
            </div>
            @error('fecha')<span class="error">{{ $message }}</span>@enderror
            <div class="help">Solo se permiten fechas a partir de hoy.</div>
          </div>

          <div>
            <label for="hora">Nueva hora</label>
            <div class="input">
              <span class="icon" aria-hidden="true">
                <!-- clock -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="9"></circle>
                  <path d="M12 7v5l3 3"></path>
                </svg>
              </span>
              <input id="hora" type="time" name="hora"
                     value="{{ old('hora', (strlen($cita->hora ?? '')>=5 ? substr($cita->hora,0,5) : $cita->hora)) }}"
                     required />
            </div>
            @error('hora')<span class="error">{{ $message }}</span>@enderror
            <div class="help">Formato de 24 horas.</div>
          </div>

        </div>

        <div class="actions">
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
          <a href="{{ route('paciente.citas') }}" class="btn btn-ghost">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- UX: si el usuario elige hoy, fija un mínimo de hora (ahora + 30 min) -->
<script>
(function(){
  const $fecha = document.getElementById('fecha');
  const $hora  = document.getElementById('hora');

  if(!$fecha || !$hora) return;

  function pad(n){ return String(n).padStart(2,'0'); }

  function updateMinTime(){
    try{
      const now = new Date();
      const chosen = $fecha.value ? new Date($fecha.value + 'T00:00:00') : null;

      if(chosen && chosen.toDateString() === now.toDateString()){
        const t = new Date(now.getTime() + 30*60000);
        $hora.min = `${pad(t.getHours())}:${pad(t.getMinutes())}`;
      }else{
        $hora.removeAttribute('min');
      }
    }catch(e){}
  }

  $fecha.addEventListener('change', updateMinTime);
  updateMinTime();
})();
</script>
</body>
</html>
