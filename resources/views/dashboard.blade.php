@extends('layouts.app')

@section('title', 'Dashboard - Clínica Los Ángeles')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Panel Principal - Clínica Los Ángeles</h1>

    <!-- Panel de métricas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total de Citas -->
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-blue-500">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Citas Registradas</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $totalCitas }}</p>
            <a href="{{ route('citas.index') }}" class="text-sm text-blue-500 hover:underline mt-2 inline-block">Ver todas</a>
        </div>

        <!-- Próxima Cita -->
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-green-500">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Próxima Cita</h2>
            @if($proximaCita)
                <p class="text-gray-600"><strong>Fecha:</strong> {{ $proximaCita->fecha }}</p>
                <p class="text-gray-600"><strong>Médico:</strong> {{ $proximaCita->medico->nombre }}</p>
            @else
                <p class="text-gray-500">No tienes citas próximas.</p>
            @endif
        </div>

        <!-- Notificaciones -->
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-yellow-500">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Notificaciones</h2>
            @if($notificaciones->count())
                <ul class="list-disc pl-5 text-gray-600 space-y-1">
                    @foreach($notificaciones as $nota)
                        <li>{{ $nota->mensaje }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No hay notificaciones nuevas.</p>
            @endif
        </div>
    </div>

    <!-- Accesos rápidos -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Accesos Rápidos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('citas.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg text-center">
                Agendar Cita
            </a>
            <a href="{{ route('perfil') }}" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg text-center">
                Ver Perfil
            </a>
            <a href="{{ route('historial') }}" class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded-lg text-center">
                Historial Médico
            </a>
            <a href="{{ route('soporte') }}" class="bg-red-500 hover:bg-red-600 text-white p-4 rounded-lg text-center">
                Soporte
            </a>
        </div>
    </div>
</div>
@endsection
