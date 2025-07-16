@vite('resources/css/login.css')

<x-guest-layout>
    <div class="login-wrapper">
        <div class="login-header">
            <h2>Acceso al Sistema</h2>
            <p class="login-subtitle">Clínica Los Ángeles</p>
        </div>

        <x-auth-session-status class="mb-6" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <x-input-label for="email" :value="'Correo Electrónico'" />
                <x-text-input id="email" class="login-input"
                              type="email" name="email"
                              :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
            </div>

            <div class="form-group">
                <x-input-label for="password" :value="'Contraseña'" />
                <x-text-input id="password" class="login-input"
                              type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
            </div>

            <div class="form-options">
                <label class="form-checkbox">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Recordarme</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="form-link">¿Olvidaste tu contraseña?</a>
                @endif
            </div>

            <div class="form-submit">
                <x-primary-button class="btn-submit">Ingresar</x-primary-button>
            </div>
        </form>

        <p class="login-footer">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="form-link">Regístrate aquí</a>
        </p>
    </div>
</x-guest-layout>
