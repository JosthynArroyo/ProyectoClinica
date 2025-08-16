@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Citas (Doctor)</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($citas->isEmpty())
        <p>No tienes citas asignadas.</p>
    @else
        <table class="table">
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
                                @case('pendiente')   <span class="badge bg-warning text-dark">Pendiente</span> @break
                                @case('confirmada')  <span class="badge bg-info text-dark">Confirmada</span> @break
                                @case('cancelada')   <span class="badge bg-danger">Cancelada</span> @break
                                @case('realizada')   <span class="badge bg-success">Realizada</span> @break
                                @default             <span class="badge bg-secondary">{{ $cita->estado }}</span>
                            @endswitch
                        </td>
                        <td class="d-flex gap-2">
                            @if($cita->estado == 'pendiente')
                                <form action="{{ route('doctor.citas.aceptar', $cita->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-success">Aceptar</button>
                                </form>
                                <form action="{{ route('doctor.citas.rechazar', $cita->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger">Rechazar</button>
                                </form>
                            @elseif($cita->estado == 'confirmada')
                                <form action="{{ route('doctor.citas.realizar', $cita->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Marcar realizada</button>
                                </form>
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
