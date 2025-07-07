@extends('layouts.app')

@section('title', 'Dashboard - Clínica')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-2xl font-bold mb-6">Bienvenido al Panel de la Clínica</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Citas agendadas -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-2">Mis Citas</h2>
            <p>Tienes <strong>{{ $totalCitas }}</strong> citas registradas.</p>
            <a href="{{ route('citas.index') }}" class="text-blue-500 hover:underline">Ver citas</a>
        </div>

        <!-- Última cita -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-2">Próxima Cita</h2>
            @if($proximaCita)
                <p><strong>Fecha:</strong> {{ $proximaCita->fecha }}</p>
                <p><strong>Médico:</strong> {{ $proximaCita->medico->nombre }}</p>
            @else
                <p>No tienes una cita próxima.</p>
            @endif
        </div>

        <!-- Notificaciones -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-2">Notificaciones</h2>
            @if($notificaciones->count())
                <ul class="list-disc list-inside">
                    @foreach($notificaciones as $nota)
                        <li>{{ $nota->mensaje }}</li>
                    @endforeach
                </ul>
            @else
                <p>No tienes notificaciones.</p>
            @endif
        </div>
    </div>
</div>
@endsection
