<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    /**
     * Listado de clientes con búsqueda en tiempo real.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $clientes = User::where('rol', 'cliente')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nombre',   'like', "%{$search}%")
                      ->orWhere('apellido', 'like', "%{$search}%")
                      ->orWhere('email',    'like', "%{$search}%")
                      ->orWhere('movil',    'like', "%{$search}%");
                });
            })
            ->orderBy('nombre')
            ->get();

        $total = User::where('rol', 'cliente')->count();

        return view('clientes.index', compact('clientes', 'search', 'total'));
    }

    /**
     * Formulario de edición de un cliente.
     */
    public function edit(string $id)
    {
        $cliente = User::where('rol', 'cliente')->findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Guardar cambios del cliente.
     */
    public function update(Request $request, string $id)
    {
        $cliente = User::where('rol', 'cliente')->findOrFail($id);

        $request->validate([
            'nombre'   => ['required', 'string', 'max:80'],
            'apellido' => ['required', 'string', 'max:80'],
            'email'    => ['nullable', 'email', 'max:120', Rule::unique('users', 'email')->ignore($cliente->usuario, 'usuario')],
            'movil'    => ['required', 'string', 'max:20',  Rule::unique('users', 'movil')->ignore($cliente->usuario, 'usuario')],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'nombre.required'    => 'El nombre es obligatorio.',
            'apellido.required'  => 'El apellido es obligatorio.',
            'email.email'        => 'Ingrese un correo válido.',
            'email.unique'       => 'Este correo ya está en uso.',
            'movil.required'     => 'El móvil es obligatorio.',
            'movil.unique'       => 'Este número de móvil ya está en uso.',
            'password.min'       => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $data = [
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'email'    => $request->email ?: null,
            'movil'    => $request->movil,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $cliente->update($data);

        return redirect()
            ->route('clientes.index')
            ->with('success', "Cliente {$cliente->nombre} {$cliente->apellido} actualizado correctamente.");
    }

    /**
     * Eliminar un cliente.
     */
    public function destroy(string $id)
    {
        $cliente = User::where('rol', 'cliente')->findOrFail($id);
        $nombre  = "{$cliente->nombre} {$cliente->apellido}";
        $cliente->delete();

        return redirect()
            ->route('clientes.index')
            ->with('success', "Cliente {$nombre} eliminado correctamente.");
    }
}
