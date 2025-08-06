@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Agendar Nueva Cita</h2>
    <form method="POST" action="{{ route('paciente.citas.store') }}">
        @csrf
        <div class="mb-3">
            <label>Doctor</label>
            <select name="doctor_id" class="form-control" required>
                @foreach($doctores as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Especialidad</label>
            <select name="especialidad_id" class="form-control" required>
                @foreach($especialidades as $esp)
                    <option value="{{ $esp->id }}">{{ $esp->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Hora</label>
            <input type="time" name="hora" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Cita</button>
    </form>
</div>
@endsection
