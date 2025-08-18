<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agendar Cita</title>
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
  --card-border-radius: 2rem;
  --border-radius-1: 0.4rem;
  --card-padding: 1.8rem;
  --box-shadow: 0 2rem 3rem var(--clr-light);
}

body {
  font-family: "Poppins", serif;
  background: var(--clr-white);
  margin: 0;
  padding: 2rem;
}

.container {
  max-width: 640px;
  margin: auto;
  background-color: var(--clr-white);
  padding: var(--card-padding);
  border-radius: var(--card-border-radius);
  box-shadow: var(--box-shadow);
}

h2 {
  font-size: 1.6rem;
  font-weight: 700;
  color: var(--clr-dark);
  margin-bottom: 1.2rem;
}

form div {
  margin-bottom: 1rem;
}

label {
  display: block;
  font-weight: 600;
  margin-bottom: 0.3rem;
  color: var(--clr-dark-variant);
}

input, select {
  width: 100%;
  padding: 0.6rem 0.8rem;
  border-radius: var(--border-radius-1);
  border: 1px solid var(--clr-info-light);
  font-size: 0.95rem;
  color: var(--clr-dark);
}

button {
  padding: 0.7rem 1.5rem;
  border-radius: var(--border-radius-1);
  border: none;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s ease;
}

button.btn-primary {
  background-color: var(--clr-primary);
  color: var(--clr-white);
}

button.btn-primary:hover {
  background-color: var(--clr-primary-variant);
}

a.btn-secondary {
  display: inline-block;
  padding: 0.7rem 1.5rem;
  border-radius: var(--border-radius-1);
  background-color: var(--clr-info-light);
  color: var(--clr-dark);
  text-decoration: none;
  margin-left: 0.5rem;
}

a.btn-secondary:hover {
  background-color: var(--clr-info-dark);
  color: var(--clr-white);
}
</style>
</head>
<body>
<div class="container">
    <h2>Agendar Nueva Cita</h2>

    <form method="POST" action="{{ route('paciente.crear-cita.store') }}">
        @csrf

        <div>
            <label>Doctor</label>
            <select name="doctor_id" required>
                <option value="">Seleccione un doctor</option>
                @foreach($doctores as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Especialidad</label>
            <select name="especialidad_id" required>
                <option value="">Seleccione una especialidad</option>
                @foreach($especialidades as $esp)
                    <option value="{{ $esp->id }}">{{ $esp->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Fecha</label>
            <input type="date" name="fecha" required>
        </div>

        <div>
            <label>Hora</label>
            <input type="time" name="hora" required>
        </div>

        <button type="submit" class="btn-primary">Registrar Cita</button>
        <a href="{{ route('paciente.citas') }}" class="btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
