<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $categoria = $request->input('categoria', '');
        $stock = $request->input('stock', '');

        $query = Producto::with('categoriaObj')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('nombre', 'like', "%{$search}%")
                        ->orWhere('codigo_barras', 'like', "%{$search}%")
                        ->orWhere('descripcion', 'like', "%{$search}%");
                });
            })
            ->when($categoria, function ($q) use ($categoria) {
                $q->where('categoria', $categoria);
            })
            ->when($stock, function ($q) use ($stock) {
                if ($stock === 'disponible') {
                    $q->whereColumn('stock', '>', 'stock_minimo');
                } elseif ($stock === 'bajo') {
                    $q->where('stock', '>', 0)->whereColumn('stock', '<=', 'stock_minimo');
                } elseif ($stock === 'sin_stock') {
                    $q->where('stock', '<=', 0);
                }
            })
            ->orderBy('productos', 'asc');

        $productos = $query->paginate(15)->withQueryString();

        $total = Producto::count();
        $disponibles = Producto::whereColumn('stock', '>', 'stock_minimo')->count();
        $stock_bajo = Producto::where('stock', '>', 0)->whereColumn('stock', '<=', 'stock_minimo')->count();
        $sin_stock = Producto::where('stock', '<=', 0)->count();
        $categorias = Categoria::orderBy('nombre')->get();

        return view('productos.index', compact(
            'productos',
            'total',
            'disponibles',
            'stock_bajo',
            'sin_stock',
            'categorias',
            'search',
            'categoria',
            'stock'
        ));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'descripcion' => ['required', 'string', 'max:500'],
            'precio_compra' => ['required', 'numeric', 'min:0'],
            'precio_venta' => ['required', 'numeric', 'min:0'],
            'categoria' => ['required', 'exists:categories,categoria'],
            'stock' => ['required', 'integer', 'min:0'],
            'codigo_barras' => ['nullable', 'string', 'max:60', 'unique:products,codigo_barras'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'precio_compra.required' => 'El precio de compra es obligatorio.',
            'precio_venta.required' => 'El precio de venta es obligatorio.',
            'categoria.required' => 'Selecciona una categoría.',
            'categoria.exists' => 'La categoría seleccionada no existe.',
            'stock.required' => 'El stock es obligatorio.',
            'codigo_barras.unique' => 'Este código de barras ya está en uso.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.max' => 'La imagen no puede superar 2MB.',
        ]);

        $data = $request->only([
            'nombre', 'descripcion', 'precio_compra',
            'precio_venta', 'categoria', 'stock', 'codigo_barras',
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create($data);

        return redirect()
            ->route('catalogo.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::orderBy('nombre')->get();

        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'descripcion' => ['required', 'string', 'max:500'],
            'precio_compra' => ['required', 'numeric', 'min:0'],
            'precio_venta' => ['required', 'numeric', 'min:0'],
            'categoria' => ['required', 'exists:categories,categoria'],
            'stock' => ['required', 'integer', 'min:0'],
            'codigo_barras' => ['nullable', 'string', 'max:60',
                Rule::unique('products', 'codigo_barras')
                    ->ignore($producto->productos, 'productos')],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'precio_compra.required' => 'El precio de compra es obligatorio.',
            'precio_venta.required' => 'El precio de venta es obligatorio.',
            'categoria.required' => 'Selecciona una categoría.',
            'categoria.exists' => 'La categoría seleccionada no existe.',
            'stock_minimo' => ['nullable', 'integer', 'min:0'],
            'codigo_barras' => ['nullable', 'string', 'max:60',
                Rule::unique('products', 'codigo_barras')
                    ->ignore($producto->productos, 'productos')],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'precio_compra.required' => 'El precio de compra es obligatorio.',
            'precio_venta.required' => 'El precio de venta es obligatorio.',
            'categoria.required' => 'Selecciona una categoría.',
            'categoria.exists' => 'La categoría seleccionada no existe.',
            'stock.required' => 'El stock es obligatorio.',
            'codigo_barras.unique' => 'Este código de barras ya está en uso.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.max' => 'La imagen no puede superar 2MB.',
        ]);

        $data = $request->only([
            'nombre', 'descripcion', 'precio_compra',
            'precio_venta', 'categoria', 'stock', 'stock_minimo', 'codigo_barras',
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        // Opción de eliminar imagen
        if ($request->boolean('eliminar_imagen') && $producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
            $data['imagen'] = null;
        }

        $producto->update($data);

        return redirect()
            ->route('productos.index')
            ->with('success', "Producto \"{$producto->nombre}\" actualizado correctamente.");
    }

    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $nombre = $producto->nombre;
        $producto->delete();

        return redirect()
            ->route('productos.index')
            ->with('success', "Producto \"{$nombre}\" eliminado correctamente.");
    }

    /**
     * Ajustar stock rápido desde el catálogo o tabla de productos.
     */
    public function ajustarStock(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);

        if ($request->has('tipo') && $request->has('cantidad')) {
            $cantidad = (int) $request->input('cantidad');
            $tipo = $request->input('tipo');

            if ($tipo === 'entrada') {
                $producto->stock += $cantidad;
            } elseif ($tipo === 'salida') {
                $producto->stock = max(0, $producto->stock - $cantidad);
            } elseif ($tipo === 'ajuste') {
                $producto->stock = max(0, $cantidad);
            }
            $producto->save();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'stock' => $producto->stock,
                    'message' => "Stock de \"{$producto->nombre}\" actualizado a {$producto->stock} unidades.",
                ]);
            }

            return back()->with('success', "Stock de \"{$producto->nombre}\" actualizado a {$producto->stock} unidades.");
        }

        $request->validate([
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $producto->update(['stock' => $request->stock]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'stock' => $producto->stock,
                'message' => "Stock de \"{$producto->nombre}\" actualizado a {$producto->stock} unidades.",
            ]);
        }

        return back()->with('success', "Stock de \"{$producto->nombre}\" actualizado.");
    }
}
