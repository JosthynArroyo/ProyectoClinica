<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Agendar Cita</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@vite(['resources/css/crear-cita.css', 'resources/js/crear-cita.js'])
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

      <form method="POST" action="{{ route('paciente.crear-cita.store') }}"
      data-endpoint-template="{{ route('especialidades.doctores', ['especialidad' => 'ESP_ID']) }}"
      data-old-esp="{{ old('especialidad_id') }}"
      data-old-doc="{{ old('doctor_id') }}">

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
</body>
</html>
