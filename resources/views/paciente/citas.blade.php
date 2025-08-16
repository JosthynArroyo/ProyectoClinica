@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Citas Médicas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('paciente.crear-cita') }}" class="btn btn-primary mb-3">+ Agendar Nueva Cita</a>

    @if($citas->isEmpty())
        <p>No tienes citas registradas.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Doctor</th>
                    <th>Especialidad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas as $cita)
                    <tr>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td>{{ $cita->doctor->name ?? 'Sin asignar' }}</td>
                        <td>{{ $cita->especialidad->nombre ?? 'Sin especialidad' }}</td>
                        <td>
                            @switch($cita->estado)
                                @case('pendiente')   <span class="badge bg-warning text-dark">Pendiente</span> @break
                                @case('confirmada')  <span class="badge bg-info text-dark">Confirmada</span> @break
                                @case('cancelada')   <span class="badge bg-danger">Cancelada</span> @break
                                @case('realizada')   <span class="badge bg-success">Realizada</span> @break
                                @default             <span class="badge bg-secondary">{{ $cita->estado }}</span>
                            @endswitch
                        </td>
                        <td>
                            @if(!in_array($cita->estado, ['cancelada','realizada']))
                                <form action="{{ route('paciente.citas.cancelar', $cita->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger">Cancelar</button>
                                </form>
                                <a href="{{ route('paciente.editar-cita', $cita->id) }}" class="btn btn-sm btn-outline-warning">Reagendar</a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
