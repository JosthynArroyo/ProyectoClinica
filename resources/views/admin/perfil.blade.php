<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Administrador</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <style>
        :root{
            --primary:#6b74ff; --primary-700:#515cf5;
            --bg:radial-gradient(1200px 500px at 20% -10%, #f1f3ff 0%, #ffffff 60%);
            --white:#fff; --text:#1f2937; --muted:#6b7280; --ring:#e5e7eb; --danger:#ef4444;
            --shadow:0 28px 40px rgba(31,35,48,.08), 0 8px 18px rgba(31,35,48,.06);
            --radius:18px;
        }
        *{box-sizing:border-box} html,body{height:100%}
        body{margin:0;background:var(--bg);font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,"Helvetica Neue",Arial,"Noto Sans",sans-serif;color:var(--text)}
        .wrap{max-width:980px;margin:38px auto;padding:0 20px}
        .card{background:var(--white);border-radius:var(--radius);box-shadow:var(--shadow);border:1px solid #eef1ff;overflow:hidden}
        .card-header{display:flex;align-items:center;gap:20px;padding:26px;background:linear-gradient(180deg,#fafbff 0%, #ffffff 70%);border-bottom:1px solid #eef1ff}
        .avatar{position:relative;width:110px;height:110px;border-radius:999px;overflow:hidden;flex:0 0 auto;border:3px solid #eef2ff;box-shadow:0 8px 16px rgba(17,24,39,.08)}
        .avatar img{width:100%;height:100%;object-fit:cover;display:block}
        .avatar .overlay{position:absolute;left:0;right:0;bottom:0;height:42px;background:linear-gradient(180deg,transparent,rgba(0,0,0,.65));color:#fff;display:flex;align-items:center;justify-content:center;font-size:.86rem;cursor:pointer;opacity:0;transition:opacity .2s}
        .avatar:hover .overlay{opacity:1}
        .title h1{margin:0;font-size:1.5rem;font-weight:800}
        .title p{margin:.35rem 0 0;color:var(--muted);font-size:.96rem}
        .card-body{padding:26px}
        .grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
        @media (max-width:820px){.grid{grid-template-columns:1fr}}
        label{display:block;font-size:.9rem;font-weight:700;margin:0 0 .5rem;color:#2b2f43}
        input,select{width:100%;padding:12px 14px;border:1px solid var(--ring);border-radius:14px;background:#f9fafb;outline:none;font-size:.96rem;font-weight:600;color:#1f2937;transition:border .15s, box-shadow .15s, background .15s}
        input:focus,select:focus{border-color:var(--primary);box-shadow:0 0 0 6px rgba(107,116,255,.18);background:#fff}
        .help{font-size:.8rem;color:var(--muted);margin-top:.35rem}
        .error{font-size:.85rem;color:var(--danger);margin-top:.35rem;font-weight:600}
        .alert{padding:12px 14px;border-radius:14px;margin-bottom:16px;font-weight:700}
        .alert.success{background:#eafcf4;color:#0f6a4f;border:1px solid #b5f1de}
        .alert.danger{background:#fff0f2;color:#a21736;border:1px solid #ffd6df}
        .actions{display:flex;gap:12px;justify-content:flex-end;margin-top:20px}
        .btn{border:none;border-radius:14px;padding:12px 18px;font-weight:800;cursor:pointer;font-size:.95rem;transition:transform .05s, filter .2s, box-shadow .2s}
        .btn:active{transform:translateY(1px) scale(.995)}
        .btn-primary{color:#fff;background:linear-gradient(135deg, var(--primary), #8ea1ff);box-shadow:0 14px 26px rgba(107,116,255,.28)}
        .btn-primary:hover{filter:brightness(1.03)}
        .btn-secondary{background:#eef2ff;color:#2a2f45;border:1px solid #e1e7ff}
        .btn-secondary:hover{filter:brightness(1.02)}
        .hidden{display:none}
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <div class="card-header">
            <div class="avatar">
                <img id="avatarPreview" src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('img/doctor1.jpg') }}" alt="Avatar">
                <div class="overlay" id="changePhoto">Cambiar foto</div>
            </div>
            <div class="title">
                <h1>Perfil del Administrador</h1>
                <p>Información de tu cuenta administrativa.</p>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert danger">
                    <ul style="margin:0 0 0 18px;padding:0;">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.perfil.update') }}" enctype="multipart/form-data">
                @csrf
                <input id="avatarInput" class="hidden" type="file" name="avatar" accept="image/png,image/jpeg,image/jpg,image/webp">

                <div class="grid">
                    <div>
                        <label>Nombre</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label>Correo</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label>Teléfono</label>
                        <input type="tel" name="telefono" value="{{ old('telefono', $user->telefono) }}"
                               inputmode="numeric" pattern="\d{10}" minlength="10" maxlength="10"
                               placeholder="0998740927" title="Debe contener exactamente 10 dígitos">
                        <div class="help">Formato: 10 dígitos.</div>
                        @error('telefono')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label>Número de Cédula</label>
                        <input type="text" name="dni" value="{{ old('dni', $user->dni) }}"
                               inputmode="numeric" pattern="\d{10}" minlength="10" maxlength="10"
                               placeholder="1723456789" title="Debe contener exactamente 10 dígitos">
                        <div class="help">Exactamente 10 dígitos.</div>
                        @error('dni')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label>Dirección</label>
                        <input type="text" name="direccion" value="{{ old('direccion', $user->direccion) }}">
                        @error('direccion')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label>Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', optional($user->fecha_nacimiento)->toDateString()) }}">
                        @error('fecha_nacimiento')
                            <small class="invalid-feedback" style="color:#e11d48">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label>Sexo</label>
                        <select name="sexo">
                            <option value="">Seleccionar</option>
                            <option value="Masculino" {{ old('sexo', $user->sexo)=='Masculino'?'selected':'' }}>Masculino</option>
                            <option value="Femenino"  {{ old('sexo', $user->sexo)=='Femenino'?'selected':'' }}>Femenino</option>
                            <option value="Otro"      {{ old('sexo', $user->sexo)=='Otro'?'selected':'' }}>Otro</option>
                        </select>
                        @error('sexo')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="actions">
                    <a class="btn btn-secondary" href="{{ route('admin.dashboard') }}">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const changePhoto = document.getElementById('changePhoto');
    const input = document.getElementById('avatarInput');
    const preview = document.getElementById('avatarPreview');
    changePhoto.addEventListener('click', () => input.click());
    input.addEventListener('change', (e) => {
        const f = e.target.files?.[0];
        if (!f) return;
        preview.src = URL.createObjectURL(f);
    });
</script>
</body>
</html>
