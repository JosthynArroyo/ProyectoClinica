@vite('resources/css/register.css')

<x-guest-layout>
    <div class="register-wrapper">
        <h2 class="register-title">Registro de Paciente</h2>
        <p class="register-subtitle">Clínica Los Ángeles</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre completo -->
            <div class="form-group">
                <x-input-label for="name" :value="'Nombre Completo'" />
                <x-text-input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="input-error" />
            </div>

            <!-- Cédula -->
            <div class="form-group">
                <x-input-label for="cedula" :value="'Cédula (10 dígitos)'" />
                <x-text-input id="cedula" class="form-input" type="text" name="cedula" :value="old('cedula')" required maxlength="10" pattern="\d{10}" />
                <x-input-error :messages="$errors->get('cedula')" class="input-error" />
            </div>

            <!-- Teléfono -->
            <div class="form-group">
                <x-input-label for="telefono" :value="'Número de Teléfono'" />
                <x-text-input id="telefono" class="form-input" type="text" name="telefono" :value="old('telefono')" required maxlength="10" pattern="\d{10}" />
                <x-input-error :messages="$errors->get('telefono')" class="input-error" />
            </div>

            <!-- Fecha de nacimiento -->
            <div class="form-group">
                <x-input-label for="fecha_nacimiento" :value="'Fecha de Nacimiento'" />
                <x-text-input id="fecha_nacimiento" class="form-input" type="date" name="fecha_nacimiento" :value="old('fecha_nacimiento')" required />
                <x-input-error :messages="$errors->get('fecha_nacimiento')" class="input-error" />
            </div>

            <!-- Dirección -->
            <div class="form-group">
                <x-input-label for="direccion" :value="'Dirección o Lugar de Residencia'" />
                <x-text-input id="direccion" class="form-input" type="text" name="direccion" :value="old('direccion')" required />
                <x-input-error :messages="$errors->get('direccion')" class="input-error" />
            </div>

            <!-- Correo electrónico -->
            <div class="form-group">
                <x-input-label for="email" :value="'Correo Electrónico'" />
                <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="input-error" />
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <x-input-label for="password" :value="'Contraseña'" />
                <x-text-input id="password" class="form-input" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="input-error" />
            </div>

            <!-- Confirmar contraseña -->
            <div class="form-group">
                <x-input-label for="password_confirmation" :value="'Confirmar Contraseña'" />
                <x-text-input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="input-error" />
            </div>

            <div class="form-footer">
                <a href="{{ route('login') }}" class="form-link">¿Ya tienes cuenta?</a>
                <x-primary-button class="btn-submit">Registrarse</x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
