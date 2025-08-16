@extends('layouts.app')

@section('content')
<div class="container" style="max-width:640px;">
    <h2>Reagendar Cita</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <strong>Doctor:</strong> {{ $cita->doctor->name ?? 'Sin asignar' }}<br>
        <strong>Especialidad:</strong> {{ $cita->especialidad->nombre ?? '—' }}<br>
        <strong>Estado actual:</strong> 
        @switch($cita->estado)
            @case('pendiente') <span class="badge bg-warning text-dark">Pendiente</span> @break
            @case('confirmada') <span class="badge bg-info text-dark">Confirmada</span> @break
            @case('cancelada') <span class="badge bg-danger">Cancelada</span> @break
            @case('realizada') <span class="badge bg-success">Realizada</span> @break
            @default <span class="badge bg-secondary">{{ $cita->estado }}</span>
        @endswitch
    </div>

    <form method="POST" action="{{ route('paciente.editar-cita.update', $cita->id) }}">
        @csrf

        <div class="mb-3">
            <label>Nueva fecha</label>
            <input type="date" name="fecha" value="{{ old('fecha', $cita->fecha) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nueva hora</label>
            <input type="time" name="hora" value="{{ old('hora', $cita->hora) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="{{ route('paciente.citas') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
