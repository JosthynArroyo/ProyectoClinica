<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Cita;
use App\Models\User;
use App\Models\Role;
use App\Models\Especialidad;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $citas = Cita::with(['paciente','doctor'])
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        $totalCitas           = Cita::count();
        $totalCitasPendientes = Cita::where('estado', 'pendiente')->count();
        $totalCitasRealizadas = Cita::where('estado', 'realizada')->count();
        $totalCitasCanceladas = Cita::where('estado', 'cancelada')->count();

        return view('admin.dashboard', compact(
            'user',
            'citas',
            'totalCitas',
            'totalCitasPendientes',
            'totalCitasRealizadas',
            'totalCitasCanceladas'
        ));
    }

    public function resumenGlobal(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->route('admin.dashboard');
        }

        return response()->json([
            'agendadas'   => Cita::count(),
            'completadas' => Cita::where('estado', 'realizada')->count(),
            'canceladas'  => Cita::where('estado', 'cancelada')->count(),
        ]);
    }

    public function editarPerfil()
    {
        $user = Auth::user();
        return view('admin.perfil', compact('user'));
    }

    public function actualizarPerfil(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'telefono'          => ['nullable', 'digits:10'],
            'dni'               => ['required', 'digits:10', Rule::unique('users','dni')->ignore($user->id)],
            'direccion'         => ['nullable', 'string', 'max:255'],
            'fecha_nacimiento'  => ['nullable', 'date', 'before:today'],
            'sexo'              => ['nullable', 'in:Masculino,Femenino,Otro'],
            'avatar'            => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];

        $messages = [
            'name.required'           => 'El nombre es obligatorio.',
            'email.required'          => 'El correo es obligatorio.',
            'email.email'             => 'Formato de correo inválido.',
            'email.unique'            => 'Este correo ya está registrado.',
            'telefono.digits'         => 'El teléfono debe tener exactamente 10 dígitos.',
            'dni.required'            => 'El número de cédula es obligatorio.',
            'dni.digits'              => 'El número de cédula debe tener exactamente 10 dígitos.',
            'dni.unique'              => 'Este número de cédula ya está registrado.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'sexo.in'                 => 'Seleccione un sexo válido.',
            'avatar.image'            => 'La foto debe ser una imagen.',
            'avatar.mimes'            => 'Formato permitido: jpg, jpeg, png o webp.',
            'avatar.max'              => 'La imagen no debe superar 2 MB.',
        ];

        $data = $request->validate($rules, $messages);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()->route('admin.perfil.edit')->with('success', 'Perfil actualizado correctamente.');
    }

    public function usuarios(Request $request)
    {
        $users = User::with(['roles','especialidades'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $roles = Role::orderBy('name', 'asc')->get();

        return view('admin.usuarios', compact('users', 'roles'));
    }

    public function usuariosUpdate(Request $request, User $user)
    {
        return $this->usuarioUpdate($request, $user);
    }

    public function usuariosDestroy(User $user)
    {
        return $this->usuarioDestroy($user);
    }

    public function usuarioUpdate(Request $request, User $user)
    {
        $request->validate([
            'name'    => ['required','string','max:255'],
            'email'   => ['required','email','max:255', Rule::unique('users','email')->ignore($user->id)],
            'role_id' => ['required','exists:roles,id'],
            'active'  => ['nullable','in:0,1'],
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->has('active')) {
            $user->active = $request->boolean('active');
        }

        $user->save();

        $role = Role::findOrFail($request->role_id);
        $user->roles()->sync([$role->id]);

        if (Auth::id() === $user->id) {
            Auth::setUser($user->fresh('roles'));
            return redirect()->route('home')->with('success', 'Tu perfil y rol fueron actualizados.');
        }

        return back()->with('success', 'Usuario actualizado.');
    }


    public function usuarioDestroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return back()->withErrors(['No puedes eliminar tu propio usuario.']);
        }

        if ($user->hasRole('administrador')) {
            return back()->withErrors(['No puedes eliminar cuentas con rol administrador.']);
        }

        $user->roles()->detach();
        $user->delete();

        return back()->with('success', 'Usuario eliminado.');
    }

    public function crearDoctor()
    {
        $especialidades = Especialidad::orderBy('nombre')->get();
        return view('admin.doctor-create', compact('especialidades'));
    }

    public function storeDoctor(Request $request)
    {
        return $this->guardarDoctor($request);
    }

    public function guardarDoctor(Request $request)
    {
        $rules = [
            'name'             => ['required','string','max:255'],
            'email'            => ['required','email','max:255','unique:users,email'],
            'password'         => ['required','string','min:8','confirmed','regex:/^(?=.*[A-Za-z])(?=.*\d).+$/'],
            'telefono'         => ['nullable','digits:10'],
            'dni'              => ['required','digits:10','unique:users,dni'],
            'direccion'        => ['nullable','string','max:255'],
            'fecha_nacimiento' => ['required','date','before:today'],
            'sexo'             => ['nullable','in:Masculino,Femenino,Otro'],
            'avatar'           => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'especialidades'   => ['nullable','array'],
            'especialidades.*' => ['integer','exists:especialidades,id'],
        ];

        $messages = [
            'required'              => 'El :attribute es obligatorio.',
            'email'                 => 'Ingresa un correo válido.',
            'unique'                => 'Este :attribute ya está registrado.',
            'password.min'          => 'La contraseña debe tener al menos 8 caracteres.',
            'confirmed'             => 'La confirmación de :attribute no coincide.',
            'password.regex'        => 'La contraseña debe incluir letras y números.',
            'digits'                => 'El :attribute debe tener exactamente :digits dígitos.',
            'in'                    => 'Selecciona un valor válido para :attribute.',
            'date'                  => 'La :attribute no es válida.',
            'before'                => 'La :attribute debe ser anterior a hoy.',
            'image'                 => 'La :attribute debe ser una imagen.',
            'mimes'                 => 'La :attribute debe ser jpg, jpeg, png o webp.',
            'max'                   => 'La :attribute no debe superar :max.',
            'array'                 => 'Selecciona al menos una opción válida en :attribute.',
            'exists'                => 'Alguna de las :attribute seleccionadas no existe.',
            'dni.required'          => 'El número de cédula es obligatorio.',
            'dni.digits'            => 'El número de cédula debe tener exactamente 10 dígitos.',
            'dni.unique'            => 'Este número de cédula ya está registrado.',
        ];

        $attributes = [
            'name'                  => 'nombre',
            'email'                 => 'correo',
            'password'              => 'contraseña',
            'password_confirmation' => 'confirmación de contraseña',
            'telefono'              => 'teléfono',
            'dni'                   => 'número de cédula',
            'direccion'             => 'dirección',
            'fecha_nacimiento'      => 'fecha de nacimiento',
            'sexo'                  => 'sexo',
            'avatar'                => 'foto',
            'especialidades'        => 'especialidades',
        ];

        $validated = $request->validate($rules, $messages, $attributes);

        $user = new User();
        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->active = true;
        $user->telefono = $validated['telefono'] ?? null;
        $user->dni = $validated['dni'] ?? null;
        $user->direccion = $validated['direccion'] ?? null;
        $user->fecha_nacimiento = $validated['fecha_nacimiento'] ?? null;
        $user->sexo = $validated['sexo'] ?? null;

        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $user->save();

        $role = Role::where('name', 'doctor')->firstOrFail();
        $user->roles()->sync([$role->id]);

        if (!empty($validated['especialidades'])) {
            $user->especialidades()->sync($validated['especialidades']);
        }

        return redirect()->route('admin.usuarios.index')->with('success', 'Doctor creado correctamente.');
    }

    public function doctoresPorEspecialidad(Especialidad $especialidad)
    {
        $doctores = $especialidad->doctores()
            ->whereHas('roles', fn($q) => $q->where('name','doctor'))
            ->where('active', true)
            ->orderBy('name')
            ->get(['users.id','users.name']);

        return response()->json($doctores);
    }
}
