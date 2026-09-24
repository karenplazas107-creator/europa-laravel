<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InventarioController extends Controller
{
    /**
     * Muestra la vista principal de control de inventario con métricas y filtros.
     */
    public function index(Request $request): View
    {
        // ── Métricas globales de inventario ──
        $totalProductos = Producto::count();
        $unidadesTotales = (int) Producto::sum('stock');
        $valorStock = (float) (Producto::selectRaw('SUM(stock * precio_compra) as total')->value('total') ?? 0);
        $stockCritico = Producto::whereRaw('stock > 0 AND stock <= COALESCE(stock_minimo, 10)')->count();
        $agotados = Producto::where('stock', '<=', 0)->count();

        // ── Filtros ──
        $search = trim((string) $request->input('search', ''));
        $categoria = $request->input('categoria');
        $estado = strtolower((string) $request->input('estado', 'todos'));

        $query = Producto::with('categoriaObj');

        // Búsqueda por texto (nombre, código de barras, descripción)
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                    ->orWhere('codigo_barras', 'LIKE', "%{$search}%")
                    ->orWhere('descripcion', 'LIKE', "%{$search}%");
            });
        }

        // Filtro por categoría
        if (! empty($categoria) && $categoria !== 'todas') {
            $query->where('categoria', $categoria);
        }

        // Filtro por estado de stock
        if ($estado === 'ok' || $estado === 'disponible') {
            $query->whereRaw('stock > COALESCE(stock_minimo, 10)');
        } elseif ($estado === 'bajo' || $estado === 'critico') {
            $query->whereRaw('stock > 0 AND stock <= COALESCE(stock_minimo, 10)');
        } elseif ($estado === 'agotado' || $estado === 'sin_stock') {
            $query->where('stock', '<=', 0);
        }

        $productos = $query->orderBy('nombre')->paginate(20)->withQueryString();
        $categorias = Categoria::orderBy('nombre')->get();

        return view('inventario.index', compact(
            'productos',
            'categorias',
            'totalProductos',
            'unidadesTotales',
            'valorStock',
            'stockCritico',
            'agotados',
            'search',
            'categoria',
            'estado'
        ));
    }

    /**
     * Registra un movimiento de inventario (Entrada, Salida o Ajuste directo).
     */
    public function movimiento(Request $request, string $id): JsonResponse|RedirectResponse
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'tipo' => ['required', 'in:entrada,salida,ajuste'],
            'cantidad' => ['required', 'integer', 'min:0'],
            'stock_minimo' => ['nullable', 'integer', 'min:0'],
            'motivo' => ['nullable', 'string', 'max:255'],
        ], [
            'tipo.required' => 'El tipo de movimiento es obligatorio.',
            'tipo.in' => 'Tipo de movimiento inválido.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.min' => 'La cantidad no puede ser negativa.',
        ]);

        $tipo = $request->input('tipo');
        $cantidad = (int) $request->input('cantidad');

        $nuevoStock = match ($tipo) {
            'entrada' => $producto->stock + $cantidad,
            'salida' => max(0, $producto->stock - $cantidad),
            'ajuste' => $cantidad,
        };

        $datosUpdate = ['stock' => $nuevoStock];

        if ($request->filled('stock_minimo')) {
            $datosUpdate['stock_minimo'] = (int) $request->input('stock_minimo');
        }

        $producto->update($datosUpdate);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'mensaje' => "Inventario de \"{$producto->nombre}\" actualizado a {$producto->stock} uds.",
                'stock' => $producto->stock,
                'stock_minimo' => $producto->stock_minimo,
                'estado' => $producto->estado_stock,
                'etiqueta' => $producto->etiqueta_stock,
                'color' => $producto->color_stock,
            ]);
        }

        return back()->with('success', "Inventario de \"{$producto->nombre}\" actualizado a {$producto->stock} uds.");
    }
}
