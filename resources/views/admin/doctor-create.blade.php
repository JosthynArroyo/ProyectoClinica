<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear doctor | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@300;400;500">
    <style>
        :root{
            --bg: var(--clr-color-background, #f6f6f9);
            --card: var(--clr-white, #ffffff);
            --text: var(--clr-dark, #0f172a);
            --muted: var(--clr-dark-variant, #677483);
            --primary: var(--clr-primary, #7380ec);
            --title: #4f46e5;
            --danger: var(--clr-danger, #ff7782);
            --success: var(--clr-success, #41f1b6);
            --border: #d2dae6;          
            --border-strong: #c3ccda;    
            --shadow: 0 10px 24px rgba(16,24,40,.06);
            --radius: 16px;
        }
        *{box-sizing:border-box}
        body{margin:0;background:var(--bg);color:var(--text);font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,"Noto Sans",sans-serif}
        .wrap{max-width:880px;margin:28px auto;padding:0 16px}


        .header{
            display:grid;
            grid-template-columns:1fr auto 1fr;
            align-items:center;
            gap:1rem;
            margin-bottom:16px
        }
        .back{
            justify-self:start;
            display:inline-flex;align-items:center;gap:.45rem;
            padding:.65rem .9rem;border:1px solid var(--border);
            border-radius:12px;background:#fff;text-decoration:none;color:var(--text);
            box-shadow:var(--shadow)
        }
        .back:hover{background:#eef2ff}
        .title{
            justify-self:center;
            font-size:1.7rem;font-weight:800;letter-spacing:.2px;
            color:var(--title);
        }

        .alert{border:1px solid;border-radius:12px;padding:.85rem 1rem;margin-bottom:12px}
        .alert--ok{background:#f0fdf4;border-color:#c7f0d2;color:#14532d}
        .alert--err{background:#fef2f2;border-color:#fecaca;color:#7f1d1d}

        .card{
            background:var(--card);
            border:1px solid #e7ebf3;
            border-radius:var(--radius);
            padding:20px;
            box-shadow:var(--shadow)
        }
        .grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
        .full{grid-column:1/-1}
        label{display:block;margin:2px 0 6px;color:var(--muted);font-size:.92rem}


        input,select{
            width:100%;
            padding:.7rem .8rem;
            border:1.5px solid var(--border-strong);
            border-radius:12px;
            background:#fff;color:var(--text);
            transition: box-shadow .2s,border-color .2s
        }
        input:focus,select:focus{
            outline:none;border-color:var(--primary);
            box-shadow:0 0 0 4px rgba(115,128,236,.18)
        }

        .input-wrap{position:relative}
        .input-wrap input{padding-right:2.6rem}
        .toggle-visibility{
            position:absolute;right:.45rem;top:50%;transform:translateY(-50%);
            display:inline-flex;align-items:center;justify-content:center;
            width:2.1rem;height:2.1rem;border-radius:10px;background:transparent;border:0;
            color:#5b657f;cursor:pointer
        }
        .toggle-visibility:hover{background:#f3f4f6}
        .toggle-visibility:focus{outline:2px solid var(--primary);outline-offset:2px}

        .actions{margin-top:16px;display:flex;gap:.6rem;justify-content:flex-end}
        .btn{border:0;padding:.75rem 1.1rem;border-radius:12px;font-weight:700;cursor:pointer}
        .btn-primary{background:var(--primary);color:#fff}
        .btn-primary:hover{filter:brightness(0.95)}

        .material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24}

        .chips{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:.6rem}
        .chip{display:flex;align-items:center;gap:.5rem;border:1.5px solid var(--border-strong);border-radius:10px;padding:.55rem .7rem;background:#fff}

        @media (max-width:800px){.wrap{max-width:95%}}
        @media (max-width:640px){
            .grid{grid-template-columns:1fr}
            .title{font-size:1.45rem}
        }
        @media (max-width:400px){
            .back span.material-symbols-outlined{font-size:18px}
            .back{padding:.5rem .7rem}
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <a class="back" href="{{ route('admin.dashboard') }}" aria-label="Volver al panel">
            <span class="material-symbols-outlined">arrow_back</span>
            <span>Volver</span>
        </a>
        <div class="title">Registrar nuevo doctor</div>
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

    <form class="card" action="{{ route('admin.doctores.store') }}" method="POST" enctype="multipart/form-data" novalidate>
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
                <label>Contraseña</label>
                <div class="input-wrap">
                    <input type="password" id="password" name="password" required>
                    <button type="button" class="toggle-visibility" data-target="password" title="Mostrar u ocultar contraseña" aria-label="Mostrar u ocultar contraseña">
                        <span class="material-symbols-outlined">visibility</span>
                    </button>
                </div>
            </div>
            <div>
                <label>Confirmar contraseña</label>
                <div class="input-wrap">
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                    <button type="button" class="toggle-visibility" data-target="password_confirmation" title="Mostrar u ocultar confirmación" aria-label="Mostrar u ocultar confirmación">
                        <span class="material-symbols-outlined">visibility</span>
                    </button>
                </div>
            </div>

            <div>
                <label>Teléfono (10 dígitos)</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" minlength="10" maxlength="10" pattern="\d{10}" inputmode="numeric" placeholder="0991234567">
            </div>
            <div>
                <label>Número de Cédula (10 dígitos)</label>
                <input type="text" name="dni" value="{{ old('dni') }}" minlength="10" maxlength="10" pattern="\d{10}" inputmode="numeric" placeholder=" ej. 1750XXXXXX">
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

            <div class="full">
                <label>Foto (opcional)</label>
                <input type="file" name="avatar" accept="image/*">
            </div>

            <div class="full">
                <label>Especialidades del doctor</label>
                <div class="chips">
                    @foreach(($especialidades ?? []) as $esp)
                        <label class="chip">
                            <input type="checkbox" name="especialidades[]" value="{{ $esp->id }}" @checked(collect(old('especialidades',[]))->contains($esp->id))>
                            <span>{{ $esp->nombre }}</span>
                        </label>
                    @endforeach
                </div>
                @error('especialidades')
                    <div style="margin-top:6px;color:#b91c1c">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Guardar doctor</button>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('.toggle-visibility').forEach(function(btn){
        var input = document.getElementById(btn.dataset.target);
        var icon  = btn.querySelector('.material-symbols-outlined');
        btn.addEventListener('click', function(){
            var showing = input.type === 'text';
            input.type = showing ? 'password' : 'text';
            icon.textContent = showing ? 'visibility' : 'visibility_off';
        });
        btn.addEventListener('keydown', function(e){
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
        });
    });
</script>
</body>
</html>
