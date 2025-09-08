@extends('layouts.app')

@section('content')
<style>
    :root{
        --bg:#f6f6f9;--card:#ffffff;--text:#0f172a;--muted:#677483;--primary:#7380ec;
        --title:#4f46e5;--border:#d2dae6;--border-strong:#c3ccda;--shadow:0 10px 24px rgba(16,24,40,.06);--radius:16px
    }
    .wrap{max-width:880px;margin:28px auto;padding:0 16px}
    .header{display:grid;grid-template-columns:1fr auto 1fr;align-items:center;gap:1rem;margin-bottom:16px}
    .back{justify-self:start;display:inline-flex;align-items:center;gap:.45rem;padding:.65rem .9rem;border:1px solid var(--border);border-radius:12px;background:#fff;text-decoration:none;color:var(--text);box-shadow:var(--shadow)}
    .back:hover{background:#eef2ff}
    .title{justify-self:center;font-size:1.7rem;font-weight:800;letter-spacing:.2px;color:var(--title)}
    .alert{border:1px solid;border-radius:12px;padding:.85rem 1rem;margin-bottom:12px}
    .alert--ok{background:#f0fdf4;border-color:#c7f0d2;color:#14532d}
    .alert--err{background:#fef2f2;border-color:#fecaca;color:#7f1d1d}
    .card{background:var(--card);border:1px solid #e7ebf3;border-radius:var(--radius);padding:20px;box-shadow:var(--shadow)}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    .full{grid-column:1/-1}
    label{display:block;margin:2px 0 6px;color:var(--muted);font-size:.92rem}
    input,select{width:100%;padding:.7rem .8rem;border:1.5px solid var(--border-strong);border-radius:12px;background:#fff;color:var(--text);transition:box-shadow .2s,border-color .2s}
    input:focus,select:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 4px rgba(115,128,236,.18)}
    .input-wrap{position:relative}
    .input-wrap input{padding-right:2.6rem}
    .toggle-visibility{position:absolute;right:.45rem;top:50%;transform:translateY(-50%);display:inline-flex;align-items:center;justify-content:center;width:2.1rem;height:2.1rem;border-radius:10px;background:transparent;border:0;color:#5b657f;cursor:pointer}
    .toggle-visibility:hover{background:#f3f4f6}
    .actions{margin-top:16px;display:flex;gap:.6rem;justify-content:flex-end}
    .btn{border:0;padding:.75rem 1.1rem;border-radius:12px;font-weight:700;cursor:pointer}
    .btn-primary{background:var(--primary);color:#fff}
    .btn-primary:hover{filter:brightness(0.95)}
    .btn-secondary{background:#fff;border:1.5px solid var(--border-strong);color:#0f172a}
    @media (max-width:640px){.grid{grid-template-columns:1fr}.title{font-size:1.45rem}}
</style>

{{-- Agregamos el link para los íconos de Material Symbols --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@300;400;500" />

<div class="wrap">
    <div class="header">
        <a class="back" href="{{ route('admin.dashboard') }}" aria-label="Volver al panel">
            <span class="material-symbols-outlined">arrow_back</span>
            <span>Volver</span>
        </a>
        <div class="title">Registrar nuevo paciente</div>
        <div></div>
    </div>

    @if(session('success'))
        <div class="alert alert--ok">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert--err">
            <ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form class="card" method="POST" action="{{ route('admin.pacientes.store') }}" novalidate>
        @csrf
        <div class="grid">
            <div>
                <label>Nombre</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div>
                <label>Correo</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label>Cédula (10 dígitos)</label>
                <input type="text" name="dni" value="{{ old('dni') }}" minlength="10" maxlength="10" pattern="\d{10}" inputmode="numeric" placeholder="1750XXXXXX" required>
            </div>
            <div>
                <label>Teléfono (10 dígitos)</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" minlength="10" maxlength="10" pattern="\d{10}" inputmode="numeric" placeholder="0991234567">
            </div>
            <div class="full">
                <label>Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion') }}">
            </div>
            <div>
                <label>Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
            </div>
            <div>
                <label>Sexo</label>
                <select name="sexo">
                    <option value="">Seleccionar</option>
                    <option value="Masculino" @selected(old('sexo')==='Masculino')>Masculino</option>
                    <option value="Femenino" @selected(old('sexo')==='Femenino')>Femenino</option>
                    <option value="Otro" @selected(old('sexo')==='Otro')>Otro</option>
                </select>
            </div>
            <div>
                <label>Contraseña</label>
                <div class="input-wrap">
                    <input type="password" id="password" name="password" required>
                    <button type="button" class="toggle-visibility" data-target="password" aria-label="Mostrar u ocultar contraseña">
                        <span class="material-symbols-outlined">visibility</span>
                    </button>
                </div>
            </div>
            <div>
                <label>Confirmar contraseña</label>
                <div class="input-wrap">
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                    <button type="button" class="toggle-visibility" data-target="password_confirmation" aria-label="Mostrar u ocultar confirmación">
                        <span class="material-symbols-outlined">visibility</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Registrar Paciente</button>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('.toggle-visibility').forEach(function(btn){
        const input = document.getElementById(btn.dataset.target);
        const icon = btn.querySelector('.material-symbols-outlined');
        btn.addEventListener('click', function(){
            const showing = input.type === 'text';
            input.type = showing ? 'password' : 'text';
            icon.textContent = showing ? 'visibility' : 'visibility_off';
        });
    });
</script>
@endsection
