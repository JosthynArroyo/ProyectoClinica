<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow-md mt-8">
        <h2 class="text-2xl font-bold text-center text-indigo-700 mb-6">Registro de Paciente - Clínica Los Ángeles</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre completo -->
            <div>
                <x-input-label for="name" :value="'Nombre Completo'" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Correo electrónico -->
            <div class="mt-4">
                <x-input-label for="email" :value="'Correo Electrónico'" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <x-input-label for="password" :value="'Contraseña'" />
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirmar contraseña -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="'Confirmar Contraseña'" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-indigo-600 hover:text-indigo-900 font-semibold" href="{{ route('login') }}">
                    ¿Ya tienes cuenta?
                </a>

                <x-primary-button class="ms-4">
                    Registrarse
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
