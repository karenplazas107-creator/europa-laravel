<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search', '');
        $categoriaId= $request->input('categoria', '');
        $vista      = $request->input('vista', 'grid'); // grid | lista

        /* ── Productos con filtros ── */
        $productos = Producto::with('categoriaObj')
            ->when($search, function ($q) use ($search) {
                $q->where('nombre',        'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%")
                  ->orWhere('codigo_barras','like', "%{$search}%");
            })
            ->when($categoriaId, function ($q) use ($categoriaId) {
                $q->where('categoria', $categoriaId);
            })
            ->orderBy('nombre')
            ->get();

        /* ── Stats ── */
        $totalProductos  = Producto::count();
        $totalCategorias = Categoria::count();
        $stockBajo       = Producto::where('stock', '>', 0)->where('stock', '<=', 10)->count();
        $sinStock        = Producto::where('stock', '<=', 0)->count();

        /* ── Categorías para filtros ── */
        $categorias = Categoria::orderBy('nombre')->get();

        return view('catalogo.index', compact(
            'productos', 'search', 'categoriaId', 'vista',
            'totalProductos', 'totalCategorias', 'stockBajo', 'sinStock',
            'categorias'
        ));
    }
}
