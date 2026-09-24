<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    /**
     * Listado de usuarios con filtros por búsqueda y rol, más métricas del sistema.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search', ''));
        $rolFiltro = trim((string) $request->input('rol', ''));

        $query = User::query();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('movil', 'like', "%{$search}%");
            });
        }

        if ($rolFiltro !== '') {
            if (in_array($rolFiltro, ['admin', 'administrador'])) {
                $query->whereIn('rol', ['admin', 'administrador']);
            } elseif (in_array($rolFiltro, ['auxiliar_bodega', 'bodega', 'auxiliar de bodega'])) {
                $query->whereIn('rol', ['auxiliar_bodega', 'bodega', 'auxiliar de bodega']);
            } else {
                $query->where('rol', $rolFiltro);
            }
        }

        $usuarios = $query->orderBy('usuario', 'desc')->paginate(10)->withQueryString();

        // Conteos estadísticos
        $totalUsuarios = User::count();
        $totalAdmins = User::whereIn('rol', ['admin', 'administrador'])->count();
        $totalVendedores = User::where('rol', 'vendedor')->count();
        $totalBodega = User::whereIn('rol', ['auxiliar_bodega', 'bodega', 'auxiliar de bodega'])->count();
        $totalClientes = User::where('rol', 'cliente')->count();

        $roles = User::rolesDisponibles();

        return view('usuarios.index', compact(
            'usuarios',
            'search',
            'rolFiltro',
            'totalUsuarios',
            'totalAdmins',
            'totalVendedores',
            'totalBodega',
            'totalClientes',
            'roles'
        ));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create(): View
    {
        $roles = User::rolesDisponibles();

        return view('usuarios.create', compact('roles'));
    }

    /**
     * Almacena un nuevo usuario en la base de datos con su rol asignado.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:80'],
            'apellido' => ['required', 'string', 'max:80'],
            'email' => ['nullable', 'email', 'max:120', 'unique:users,email'],
            'movil' => ['required', 'string', 'max:20', 'unique:users,movil'],
            'rol' => ['required', 'string', 'in:administrador,vendedor,auxiliar_bodega,cliente'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'movil.required' => 'El número de teléfono/móvil es obligatorio.',
            'movil.unique' => 'Este número de teléfono/móvil ya está registrado.',
            'rol.required' => 'Debe seleccionar un rol para el usuario.',
            'rol.in' => 'El rol seleccionado no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $usuario = User::create([
            'nombre' => trim($request->nombre),
            'apellido' => trim($request->apellido),
            'email' => $request->email ? trim($request->email) : null,
            'movil' => trim($request->movil),
            'rol' => trim($request->rol),
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', "Usuario {$usuario->nombre} {$usuario->apellido} creado exitosamente con el rol de {$usuario->nombre_rol}.");
    }

    /**
     * Muestra el formulario de edición de un usuario.
     */
    public function edit(string $id): View
    {
        $usuario = User::findOrFail($id);
        $roles = User::rolesDisponibles();

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Actualiza la información y rol del usuario.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'nombre' => ['required', 'string', 'max:80'],
            'apellido' => ['required', 'string', 'max:80'],
            'email' => [
                'nullable',
                'email',
                'max:120',
                Rule::unique('users', 'email')->ignore($usuario->usuario, 'usuario'),
            ],
            'movil' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users', 'movil')->ignore($usuario->usuario, 'usuario'),
            ],
            'rol' => ['required', 'string', 'in:administrador,vendedor,auxiliar_bodega,cliente'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está en uso por otro usuario.',
            'movil.required' => 'El número de teléfono/móvil es obligatorio.',
            'movil.unique' => 'Este número de teléfono/móvil ya está en uso por otro usuario.',
            'rol.required' => 'Debe seleccionar un rol para el usuario.',
            'rol.in' => 'El rol seleccionado no es válido.',
            'password.min' => 'La nueva contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        // Evitar que el administrador en sesión se quite a sí mismo el rol de Administrador
        if ((int) $usuario->usuario === (int) Auth::user()->usuario && ! in_array($request->rol, ['admin', 'administrador'])) {
            return back()
                ->withInput()
                ->with('error', 'No puedes quitarte el rol de Administrador a ti mismo para evitar perder el acceso al panel.');
        }

        $data = [
            'nombre' => trim($request->nombre),
            'apellido' => trim($request->apellido),
            'email' => $request->email ? trim($request->email) : null,
            'movil' => trim($request->movil),
            'rol' => trim($request->rol),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()
            ->route('usuarios.index')
            ->with('success', "Usuario {$usuario->nombre} {$usuario->apellido} actualizado correctamente.");
    }

    /**
     * Elimina un usuario del sistema (con protecciones de seguridad).
     */
    public function destroy(string $id): RedirectResponse
    {
        $usuario = User::findOrFail($id);

        // Protección 1: No eliminar la propia cuenta en sesión
        if ((int) $usuario->usuario === (int) Auth::user()->usuario) {
            return redirect()
                ->route('usuarios.index')
                ->with('error', 'No puedes eliminar tu propia cuenta mientras estás en sesión.');
        }

        // Protección 2: No eliminar si es el único administrador del sistema
        if ($usuario->isAdmin()) {
            $otrosAdmins = User::whereIn('rol', ['admin', 'administrador'])
                ->where('usuario', '!=', $usuario->usuario)
                ->count();

            if ($otrosAdmins === 0) {
                return redirect()
                    ->route('usuarios.index')
                    ->with('error', 'No es posible eliminar al único Administrador disponible en el sistema.');
            }
        }

        $nombreCompleto = "{$usuario->nombre} {$usuario->apellido}";
        $usuario->delete();

        return redirect()
            ->route('usuarios.index')
            ->with('success', "El usuario {$nombreCompleto} ha sido eliminado satisfactoriamente.");
    }
}
