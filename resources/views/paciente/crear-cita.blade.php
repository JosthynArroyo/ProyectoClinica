<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Agendar Cita</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root{
  --primary:#6b74ff;
  --primary-2:#8ea1ff;
  --danger:#ff6b81;
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
  display:flex; align-items:center; gap:12px;
  max-width:92%; margin:0 auto;
}
.card-header .title{
  color:#1f2330; font-size:1.6rem; font-weight:800; margin:0 0 4px 0;
}
.card-header .subtitle{
  color:#667085; margin:0; font-weight:600; line-height:1.3;
}

/* Content */
.card-body{ padding:26px; }

/* Form */
.form-grid{
  display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-top:8px;
}
.form-grid .col-span-2{ grid-column:1 / -1; }

label{ display:block; font-size:.88rem; font-weight:800; color:#3a3f52; margin:10px 0 8px 6px }

.input{
  position:relative; display:flex; align-items:center;
  background:#ffffff; border:1px solid #e7e9f5; border-radius:14px; padding:10px 12px 10px 40px;
  transition:border .2s, box-shadow .2s;
}
.input:focus-within{ border-color:var(--primary); box-shadow:0 0 0 6px var(--ring) }
.input .icon{ position:absolute; left:12px; top:50%; transform:translateY(-50%); opacity:.75 }
.input .arrow{ position:absolute; right:12px; top:50%; transform:translateY(-50%); opacity:.7; pointer-events:none }

.input input,
.input select{
  width:100%; border:none; outline:none; background:transparent;
  font:600 .98rem/1.4 "Poppins",system-ui; color:var(--ink);
  appearance:none; -webkit-appearance:none; -moz-appearance:none;
}

.input select:disabled{ color:#9aa0b5; }

.help{ margin-top:6px; font-size:.78rem; color:var(--muted) }
.error{ display:block; margin-top:6px; color:var(--danger); font-size:.83rem; font-weight:700 }

/* Alert */
.alert{
  background:#ffe8ec; color:#a21736; border:1px solid #ffd6df;
  border-radius:12px; padding:12px 14px; font-weight:700; margin-bottom:14px
}

/* Actions */
.actions{ display:flex; gap:12px; margin-top:22px; flex-wrap:wrap }
.btn{
  appearance:none; border:none; cursor:pointer; font-weight:800; letter-spacing:.2px;
  padding:12px 18px; border-radius:14px; transition: transform .05s ease, filter .2s ease;
  text-decoration:none; display:inline-flex; align-items:center;
}
.btn:active{ transform:translateY(1px) scale(.995) }
.btn-primary{
  color:#fff; background:linear-gradient(135deg, var(--primary), var(--primary-2));
  box-shadow:0 12px 24px rgba(107,116,255,.30);
}
.btn-primary:hover{ filter:brightness(1.03) }
.btn-ghost{
  background:#f2f5ff; color:#2a2f45; border:1px solid #e5e9ff;
}

/* Responsive */
@media (max-width:780px){
  .header-panel{ max-width:100% }
  .form-grid{ grid-template-columns:1fr }
}
</style>
</head>
<body>
<div class="page">
  <div class="card">

    <!-- HEADER -->
    <div class="card-header">
      <div class="header-panel">
        <!-- ícono de agenda -->
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
          <rect x="3" y="4" width="18" height="18" rx="3"></rect>
          <path d="M16 2v4M8 2v4M3 10h18"></path>
        </svg>
        <div>
          <h1 class="title">Agendar Nueva Cita</h1>
          <p class="subtitle">Elige especialidad, doctor, fecha y hora disponibles.</p>
        </div>
      </div>
    </div>

    <!-- BODY -->
    <div class="card-body">
      @if ($errors->has('error'))
        <div class="alert">{{ $errors->first('error') }}</div>
      @endif

      <form method="POST" action="{{ route('paciente.crear-cita.store') }}">
        @csrf

        <div class="form-grid">

          <div class="col-span-2">
            <label for="especialidad_id">Especialidad</label>
            <div class="input">
              <span class="icon" aria-hidden="true">
                <!-- cruz médica -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"></path></svg>
              </span>
              <select id="especialidad_id" name="especialidad_id" required>
                <option value="">Seleccione una especialidad</option>
                @foreach($especialidades as $esp)
                  <option value="{{ $esp->id }}" {{ old('especialidad_id') == $esp->id ? 'selected' : '' }}>
                    {{ $esp->nombre }}
                  </option>
                @endforeach
              </select>
              <span class="arrow" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
              </span>
            </div>
            @error('especialidad_id')<span class="error">{{ $message }}</span>@enderror
          </div>

          <div class="col-span-2">
            <label for="doctor_id">Doctor</label>
            <div class="input">
              <span class="icon" aria-hidden="true">
                <!-- usuario -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                  <circle cx="12" cy="7" r="4"/>
                </svg>
              </span>
              <select id="doctor_id" name="doctor_id" required disabled>
                <option value="">{{ old('especialidad_id') ? 'Cargando…' : 'Seleccione una especialidad primero' }}</option>
              </select>
              <span class="arrow" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
              </span>
            </div>
            @error('doctor_id')<span class="error">{{ $message }}</span>@enderror
          </div>

          <div>
            <label for="fecha">Fecha</label>
            <div class="input">
              <span class="icon" aria-hidden="true">
                <!-- calendario -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="4" width="18" height="18" rx="3"></rect>
                  <path d="M16 2v4M8 2v4M3 10h18"></path>
                </svg>
              </span>
              <input id="fecha" type="date" name="fecha"
                     value="{{ old('fecha') }}"
                     min="{{ \Carbon\Carbon::now('America/Guayaquil')->toDateString() }}" required>
            </div>
            @error('fecha')<span class="error">{{ $message }}</span>@enderror
            <div class="help">Solo se permiten fechas a partir de hoy.</div>
          </div>

          <div>
            <label for="hora">Hora</label>
            <div class="input">
              <span class="icon" aria-hidden="true">
                <!-- reloj -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="9"></circle>
                  <path d="M12 7v5l3 3"></path>
                </svg>
              </span>
              <input id="hora" type="time" name="hora" value="{{ old('hora') }}" required>
            </div>
            @error('hora')<span class="error">{{ $message }}</span>@enderror
            <div class="help">Formato de 24 horas.</div>
          </div>

        </div>

        <div class="actions">
          <button type="submit" class="btn btn-primary">Registrar Cita</button>
          <a href="{{ route('paciente.citas') }}" class="btn btn-ghost">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
(function(){
  const espSel = document.getElementById('especialidad_id');
  const docSel = document.getElementById('doctor_id');
  const fecha = document.getElementById('fecha');
  const hora  = document.getElementById('hora');

  const endpointTemplate = @json(route('especialidades.doctores', ['especialidad' => 'ESP_ID']));
  const oldEsp = @json(old('especialidad_id'));
  const oldDoc = @json(old('doctor_id'));

  async function loadDoctors(especialidadId, preselectId){
    docSel.innerHTML = '<option value="">Cargando…</option>';
    docSel.disabled = true;

    if(!especialidadId){
      docSel.innerHTML = '<option value="">Seleccione una especialidad primero</option>';
      return;
    }

    const url = endpointTemplate.replace('ESP_ID', encodeURIComponent(especialidadId));

    try{
      const res = await fetch(url, { headers:{ 'Accept':'application/json' } });
      if(!res.ok) throw new Error('HTTP '+res.status);

      const data = await res.json();
      if(!Array.isArray(data) || data.length === 0){
        docSel.innerHTML = '<option value="">No hay doctores activos en esta especialidad</option>';
      }else{
        let opts = '<option value="">Seleccionar</option>';
        for(const d of data){
          const sel = String(preselectId||'') === String(d.id) ? ' selected' : '';
          opts += `<option value="${d.id}"${sel}>${d.name}</option>`;
        }
        docSel.innerHTML = opts;
      }
      docSel.disabled = false;
    }catch(e){
      console.error(e);
      docSel.innerHTML = '<option value="">Error cargando doctores</option>';
    }
  }

  function pad(n){ return String(n).padStart(2,'0'); }
  function updateMinTime(){
    try{
      if(!fecha.value){ hora.removeAttribute('min'); return; }
      const now = new Date();
      const chosen = new Date(fecha.value + 'T00:00:00');

      if(chosen.toDateString() === now.toDateString()){
        const t = new Date(now.getTime() + 30*60000);
        const minVal = `${pad(t.getHours())}:${pad(t.getMinutes())}`;
        hora.min = minVal;
        if(hora.value && hora.value < minVal) hora.value = minVal;
      }else{
        hora.removeAttribute('min');
      }
    }catch(e){}
  }

  fecha && fecha.addEventListener('change', updateMinTime);
  updateMinTime();

  espSel.addEventListener('change', function(){ loadDoctors(this.value, null); });

  if(oldEsp){ loadDoctors(oldEsp, oldDoc); }
})();
</script>
</body>
</html>
