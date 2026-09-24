<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VentaController extends Controller
{
    /**
     * Muestra el listado del historial de ventas con métricas y filtros.
     */
    public function index(Request $request): View
    {
        // ── Métricas globales ──
        $totalVentas = Venta::count();
        $ingresosTotales = (float) (Venta::sum('total') ?? 0);

        $hoy = Carbon::today()->toDateString();
        $ventasHoyQuery = Venta::where(function ($q) use ($hoy) {
            $q->whereDate('fecha', $hoy)
                ->orWhereDate('created_at', $hoy);
        });

        $ingresosHoy = (float) ($ventasHoyQuery->sum('total') ?? 0);
        $ventasHoyCount = $ventasHoyQuery->count();
        $ventaMasAlta = (float) (Venta::max('total') ?? 0);

        // ── Filtros ──
        $search = trim((string) $request->input('search', ''));
        $fecha = $request->input('fecha');

        $query = Venta::with(['usuarioObj', 'detalles.productoObj']);

        // Búsqueda por número de venta o responsable
        if ($search !== '') {
            $numSearch = (int) ltrim(str_replace('#', '', $search), '0');
            $query->where(function ($q) use ($search, $numSearch) {
                if ($numSearch > 0) {
                    $q->orWhere('ventas', $numSearch);
                }
                $q->orWhereHas('usuarioObj', function ($uq) use ($search) {
                    $uq->where('nombre', 'LIKE', "%{$search}%")
                        ->orWhere('apellido', 'LIKE', "%{$search}%");
                });
            });
        }

        // Filtro por fecha específica
        if (! empty($fecha)) {
            $query->where(function ($q) use ($fecha) {
                $q->whereDate('fecha', $fecha)
                    ->orWhereDate('created_at', $fecha);
            });
        }

        $ventas = $query->orderBy('ventas', 'desc')->paginate(15)->withQueryString();
        $productos = Producto::where('stock', '>', 0)->orderBy('nombre')->get();
        $metodosPago = ['Efectivo', 'Tarjeta de Crédito', 'Tarjeta de Débito', 'Transferencia Bancaria'];

        return view('ventas.index', compact(
            'ventas',
            'totalVentas',
            'ingresosTotales',
            'ingresosHoy',
            'ventasHoyCount',
            'ventaMasAlta',
            'search',
            'fecha',
            'productos',
            'metodosPago'
        ));
    }

    /**
     * Registra una nueva venta con sus productos y descuenta del stock.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'metodo_pago' => ['required', 'string', 'max:60'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.producto_id' => ['required', 'exists:products,productos'],
            'items.*.cantidad' => ['required', 'integer', 'min:1'],
        ], [
            'metodo_pago.required' => 'Seleccione un método de pago.',
            'items.required' => 'Debe agregar al menos un producto a la venta.',
            'items.min' => 'Debe agregar al menos un producto.',
            'items.*.producto_id.required' => 'Producto inválido.',
            'items.*.cantidad.min' => 'La cantidad mínima por producto es 1.',
        ]);

        try {
            $venta = DB::transaction(function () use ($request) {
                $totalVenta = 0;
                $itemsData = [];

                // 1. Validar existencias y calcular totales
                foreach ($request->input('items') as $item) {
                    $prod = Producto::lockForUpdate()->findOrFail($item['producto_id']);
                    $cantidad = (int) $item['cantidad'];

                    if ($prod->stock < $cantidad) {
                        throw new \RuntimeException("Stock insuficiente para \"{$prod->nombre}\". Disponible: {$prod->stock} uds.");
                    }

                    $subtotal = $cantidad * $prod->precio_venta;
                    $totalVenta += $subtotal;

                    $itemsData[] = [
                        'producto' => $prod,
                        'cantidad' => $cantidad,
                        'precio' => $prod->precio_venta,
                    ];
                }

                // 2. Crear cabecera de venta
                $venta = Venta::create([
                    'usuario' => Auth::user()?->usuario ?? 1,
                    'fecha' => now()->toDateString(),
                    'total' => $totalVenta,
                    'metodo_pago' => $request->input('metodo_pago'),
                ]);

                // 3. Crear detalles y descontar stock
                foreach ($itemsData as $it) {
                    DetalleVenta::create([
                        'venta' => $venta->ventas,
                        'producto' => $it['producto']->productos,
                        'cantidad' => $it['cantidad'],
                        'precio' => $it['precio'],
                    ]);

                    // Reducir stock del producto
                    $it['producto']->decrement('stock', $it['cantidad']);
                }

                return $venta;
            });

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'mensaje' => "Venta {$venta->numero_venta} registrada con éxito por {$venta->total_formateado}.",
                    'numero_venta' => $venta->numero_venta,
                    'total' => $venta->total_formateado,
                ]);
            }

            return redirect()
                ->route('ventas.index')
                ->with('success', "Venta {$venta->numero_venta} registrada con éxito.");

        } catch (\RuntimeException $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }

            return back()->withErrors(['items' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Retorna los detalles completos de una venta para el modal de visualización o impresión.
     */
    public function show(string $id): JsonResponse
    {
        $venta = Venta::with(['usuarioObj', 'detalles.productoObj'])->findOrFail($id);

        $detalles = $venta->detalles->map(function ($det) {
            return [
                'producto_nombre' => $det->productoObj?->nombre ?? 'Producto no disponible',
                'codigo_barras' => $det->productoObj?->codigo_barras ?? '—',
                'cantidad' => $det->cantidad,
                'precio' => $det->precio_formateado,
                'subtotal' => $det->subtotal_formateado,
            ];
        });

        return response()->json([
            'success' => true,
            'id' => $venta->ventas,
            'numero_venta' => $venta->numero_venta,
            'fecha' => $venta->fecha_formateada,
            'hora' => $venta->hora_formateada,
            'total' => $venta->total_formateado,
            'total_raw' => $venta->total,
            'metodo_pago' => $venta->metodo_pago,
            'responsable' => $venta->nombre_responsable,
            'responsable_init' => $venta->inicial_responsable,
            'detalles' => $detalles,
        ]);
    }
}
