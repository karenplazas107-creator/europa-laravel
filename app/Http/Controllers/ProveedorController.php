<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $proveedores = Proveedor::when($search, function ($q) use ($search) {
            $q->where('nombre', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('telefono', 'like', "%{$search}%")
                ->orWhere('direccion', 'like', "%{$search}%");
        })
            ->orderBy('nombre')
            ->get();

        $total = Proveedor::count();
        $conEmail = Proveedor::whereNotNull('email')->where('email', '!=', '')->count();
        $conTelefono = Proveedor::whereNotNull('telefono')->where('telefono', '!=', '')->count();

        return view('proveedores.index', compact(
            'proveedores', 'search', 'total', 'conEmail', 'conTelefono'
        ));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:120', 'unique:suppliers,email'],
            'direccion' => ['required', 'string', 'max:255'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Ingrese un email válido.',
            'email.unique' => 'Este email ya está registrado.',
            'direccion.required' => 'La dirección es obligatoria.',
        ]);

        Proveedor::create($request->only('nombre', 'telefono', 'email', 'direccion'));

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor creado correctamente.');
    }

    public function edit(string $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, string $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:120',
                Rule::unique('suppliers', 'email')->ignore($proveedor->proveedores, 'proveedores')],
            'direccion' => ['required', 'string', 'max:255'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Ingrese un email válido.',
            'email.unique' => 'Este email ya está en uso.',
            'direccion.required' => 'La dirección es obligatoria.',
        ]);

        $proveedor->update($request->only('nombre', 'telefono', 'email', 'direccion'));

        return redirect()
            ->route('proveedores.index')
            ->with('success', "Proveedor {$proveedor->nombre} actualizado correctamente.");
    }

    public function destroy(string $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $nombre = $proveedor->nombre;
        $proveedor->delete();

        return redirect()
            ->route('proveedores.index')
            ->with('success', "Proveedor {$nombre} eliminado correctamente.");
    }
}
