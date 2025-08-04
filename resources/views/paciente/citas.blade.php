@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Citas Médicas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($citas->isEmpty())
        <p>No tienes citas registradas.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Doctor</th>
                    <th>Especialidad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas as $cita)
                    <tr>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td>{{ $cita->doctor->name ?? 'Sin asignar' }}</td>
                        <td>{{ $cita->especialidad->nombre ?? 'Sin especialidad' }}</td>
                        <td>{{ $cita->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
