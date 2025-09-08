<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <style>
        :root{
            --clr-primary:#7380ec;--clr-danger:#ff7782;--clr-success:#41f1b6;--clr-white:#fff;
            --clr-info-dark:#7d8da1;--clr-info-light:#ccd5e5;--clr-dark:#363949;--bg:#f6f6f9;
            --radius:24px;--shadow:0 2rem 3rem rgba(132,139,200,.18);
            --grid-cols: 260px 2.2fr 220px 1.3fr 260px;
            --v-sep:#d7ddea;         /* divisores verticales */
            --row-sep:#dee4f1;       /* separador entre filas */
            --head-sep:#d3d9e6;      /* bordes del header */
            --card-border:#cfd7e6;
        }
        *{box-sizing:border-box}
        body{margin:0;font-family:ui-sans-serif,system-ui,Segoe UI,Roboto,Ubuntu,Arial;background:var(--bg);color:var(--clr-dark)}
        a{color:inherit;text-decoration:none}
        .wrap{max-width:1200px;margin:32px auto;padding:0 16px}

        .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
        .btn{display:inline-flex;align-items:center;gap:.45rem;border:1px solid transparent;border-radius:12px;
             padding:.65rem 1rem;font-weight:700;cursor:pointer;transition:.15s ease;white-space:nowrap}
        .btn:focus{outline:3px solid rgba(115,128,236,.25);outline-offset:2px}
        .btn-back{background:var(--clr-white);border-color:#e0e6f2;color:#424b5f}
        .btn-back:hover{background:#eef2ff}
        .btn-create{background:var(--clr-primary);color:#fff}
        .btn-create:hover{filter:brightness(.95)}
        .badge{background:#eef2ff;color:#4f46e5;border:1px solid #dbe2ff;border-radius:999px;padding:.25rem .7rem;font-weight:700}

        .alert{padding:.85rem 1rem;border-radius:12px;margin:12px 0;border:1px solid}
        .alert-success{background:#ecfdf5;border-color:#a7f3d0;color:#065f46}
        .alert-error{background:#fff1f2;border-color:#fecdd3;color:#9f1239}

        .card{background:var(--clr-white);border-radius:var(--radius);box-shadow:var(--shadow);padding:18px;border:1.5px solid var(--card-border)}
        .muted{color:var(--clr-info-dark);font-size:.95rem}

        /* ===== Tabla con header y filas en CSS Grid ===== */
        table{width:100%;border-collapse:separate;border-spacing:0}
        thead tr.headergrid{display:grid;grid-template-columns:var(--grid-cols);gap:0}
        thead th{
            background:#fafbff;border-bottom:1.5px solid var(--head-sep);
            text-align:left;padding:14px 12px;font-weight:800;color:#374151;
            border-right:1.5px solid var(--v-sep);
        }
        thead th:last-child{border-right:none}
        thead th.tar{text-align:center}

        tbody td{padding:0;border-bottom:1.5px solid var(--row-sep)}
        tbody tr:hover{background:#f9fbff}

        .rowgrid{
            display:grid;grid-template-columns:var(--grid-cols);gap:0;
            align-items:stretch;                 /* que todas las celdas tengan la misma altura */
        }
        /* Borde vertical a altura completa (sin padding) */
        .rowgrid > div{
            border-right:1.5px solid var(--v-sep);
            display:flex;                        /* para que .cell se estire */
        }
        .rowgrid > div:last-child{border-right:none}

        /* El padding se aplica dentro, así los bordes recorren todo */
        .cell{display:flex;flex-direction:column;gap:6px;padding:12px;width:100%}
        .help{font-size:.82rem;color:#7a859f}

        .input,.select{
            width:100%;height:44px;background:#fbfcfe;border:1.6px solid var(--clr-info-light);
            border-radius:12px;padding:0 .85rem;color:#111827;transition:border .15s, box-shadow .15s;appearance:none
        }
        .input:focus,.select:focus{border-color:#7380ec;box-shadow:0 0 0 4px rgba(115,128,236,.18);outline:none}

        .chips{display:flex;flex-wrap:wrap;gap:.4rem;align-items:center}
        .chip{background:#eef2ff;border:1.5px solid #d5dcff;color:#3949ab;border-radius:999px;padding:.2rem .6rem;font-size:.82rem;font-weight:600}

        .actions{display:flex;gap:.55rem;justify-content:center;align-items:center;white-space:nowrap}
        .btn-save{background:var(--clr-success);color:#053d2d;border:1.5px solid #bdeee0}
        .btn-save:hover{filter:brightness(.95)}
        .btn-del{background:#fff;border:1.5px solid #ffc8d0;color:#b4232c}
        .btn-del:hover{background:#fff1f3}

        @media (max-width:1120px){
            :root{ --grid-cols: 1fr }
            thead tr.headergrid{display:none}
            .rowgrid{grid-template-columns:1fr}
            .rowgrid > div{border-right:none;border-top:1.5px solid var(--v-sep)}
            .rowgrid > div:first-child{border-top:none}
            .actions{justify-content:flex-start}
        }
    </style>
</head>
<body>
<div class="wrap">

    <div class="topbar">
        <div style="display:flex;gap:.7rem;align-items:center">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-back">
                <span class="material-symbols-outlined">arrow_back</span> Volver al panel
            </a>
            <span class="badge">Total: {{ $users->total() }}</span>
        </div>
        <a class="btn btn-create" href="{{ route('admin.doctores.crear') }}">
            <span class="material-symbols-outlined">medical_services</span> Crear doctor
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $e)
                <div>{{ $e }}</div>
            @endforeach
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="muted" style="margin-bottom:12px">Edita los datos y pulsa <b>Guardar</b>.</div>

        <div style="overflow:auto">
            <table>
                <thead>
                <tr class="headergrid">
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Especialidades</th>
                    <th class="tar">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $u)
                    @php
                        $roleIdActual = optional($u->roles->first())->id;
                        $esAdmin = $u->roles->contains(fn($rr)=>$rr->name==='administrador');
                        $espNombres = ($u->especialidades ?? collect())->pluck('nombre')->all();
                    @endphp

                    <form id="update-{{ $u->id }}" action="{{ route('admin.usuarios.update', $u) }}" method="POST">@csrf @method('PUT')</form>
                    @if(!$esAdmin)
                        <form id="delete-{{ $u->id }}" action="{{ route('admin.usuarios.destroy', $u) }}" method="POST">@csrf @method('DELETE')</form>
                    @endif

                    <tr>
                        <td colspan="5">
                            <div class="rowgrid">
                                <div>
                                    <div class="cell">
                                        <input class="input" form="update-{{ $u->id }}" type="text" name="name"
                                               value="{{ old('name_'.$u->id, $u->name) }}" required>
                                        <div class="help">ID: {{ $u->id }}</div>
                                    </div>
                                </div>

                                <div>
                                    <div class="cell">
                                        <input class="input" form="update-{{ $u->id }}" type="email" name="email"
                                               value="{{ old('email_'.$u->id, $u->email) }}" required>
                                    </div>
                                </div>

                                <div>
                                    <div class="cell">
                                        <select class="select" form="update-{{ $u->id }}" name="role_id" required>
                                            @foreach($roles as $r)
                                                <option value="{{ $r->id }}" @selected($roleIdActual===$r->id)>{{ ucfirst($r->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <div class="cell">
                                        @if(count($espNombres))
                                            <div class="chips">
                                                @foreach($espNombres as $n)
                                                    <span class="chip">{{ $n }}</span>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="help">—</div>
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <div class="cell" style="padding:12px">
                                        <div class="actions">
                                            <button form="update-{{ $u->id }}" type="submit" class="btn btn-save">
                                                <span class="material-symbols-outlined">save</span> Guardar
                                            </button>
                                            @if(!$esAdmin)
                                                <button form="delete-{{ $u->id }}" type="submit" class="btn btn-del"
                                                        onclick="return confirm('¿Eliminar usuario {{ $u->name }}?');">
                                                    <span class="material-symbols-outlined">delete</span> Eliminar
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top:12px;display:flex;justify-content:flex-end;gap:.5rem;align-items:center">
            @if ($users->hasPages())
                <div class="muted">Página {{ $users->currentPage() }} de {{ $users->lastPage() }}</div>
            @endif
            {!! $users->withQueryString()->links() !!}
        </div>
    </div>
</div>
</body>
</html>
