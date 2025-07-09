@extends('layouts.app')

@section('title', 'Contáctanos - Clínica Los Ángeles')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Contáctanos</h1>
    <p class="text-center text-gray-600 mb-10">Si tienes preguntas, sugerencias o necesitas agendar una cita, completa el formulario y nos pondremos en contacto contigo.</p>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6 bg-white shadow rounded-lg p-6">
        @csrf
        <div>
            <label for="name" class="block text-gray-700 font-medium mb-2">Nombre completo</label>
            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label for="email" class="block text-gray-700 font-medium mb-2">Correo electrónico</label>
            <input type="email" name="email" id="email" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label for="phone" class="block text-gray-700 font-medium mb-2">Número de contacto</label>
            <input type="tel" name="phone" id="phone" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="message" class="block text-gray-700 font-medium mb-2">Mensaje</label>
            <textarea name="message" id="message" rows="5" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Enviar mensaje
            </button>
        </div>
    </form>
</div>
@endsection
