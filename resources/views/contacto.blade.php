@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 shadow-lg rounded-2xl">
    <h1 class="text-2xl font-bold mb-6 text-center">📅 Solicitar Cita Médica</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contacto.store') }}" method="POST">
        @csrf

        <div>
            <label for="nombre" class="block font-semibold">Nombre completo:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                class="w-full border p-2 rounded-lg @error('nombre') border-red-500 @enderror" required>
            @error('nombre') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block font-semibold">Correo electrónico:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="w-full border p-2 rounded-lg @error('email') border-red-500 @enderror" required>
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="telefono" class="block font-semibold">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}"
                class="w-full border p-2 rounded-lg">
        </div>

        <div>
            <label for="fecha" class="block font-semibold">Fecha de la cita:</label>
            <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}"
                class="w-full border p-2 rounded-lg @error('fecha') border-red-500 @enderror" required>
            @error('fecha') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="hora" class="block font-semibold">Hora de la cita:</label>
            <input type="time" name="hora" id="hora" value="{{ old('hora') }}"
                class="w-full border p-2 rounded-lg @error('hora') border-red-500 @enderror" required>
            @error('hora') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="mensaje" class="block font-semibold">Mensaje adicional:</label>
            <textarea name="mensaje" id="mensaje" rows="3"
                class="w-full border p-2 rounded-lg">{{ old('mensaje') }}</textarea>
        </div>

        <button type="submit" 
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Reservar Cita
        </button>
    </form>
</div>
@endsection
