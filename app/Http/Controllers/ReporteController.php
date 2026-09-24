<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReporteController extends Controller
{
    /**
     * Muestra el panel interactivo de Reportes e Informes.
     */
    public function index(): View
    {
        $ahora = Carbon::now();
        $hoy = Carbon::today();
        $inicioMes = Carbon::now()->startOfMonth();
        $finMes = Carbon::now()->endOfMonth();

        // ════════════════════════════════════════
        // 1. RESUMEN DE VENTAS (KPIs)
        // ════════════════════════════════════════
        $ingresosTotales = (float) Venta::sum('total');
        $totalVentasCount = Venta::count();

        $ingresosHoy = (float) Venta::whereDate('fecha', $hoy)->sum('total');
        $ventasHoyCount = Venta::whereDate('fecha', $hoy)->count();

        $ingresosMes = (float) Venta::whereBetween('fecha', [$inicioMes, $finMes])->sum('total');
        $mesActualNombre = $ahora->translatedFormat('F Y');

        $ticketPromedio = $totalVentasCount > 0 ? ($ingresosTotales / $totalVentasCount) : 0.0;
        $ventaMasAlta = (float) (Venta::max('total') ?? 0.0);

        // ════════════════════════════════════════
        // 2. GRÁFICAS DE VENTAS
        // ════════════════════════════════════════
        // Ingresos por mes (Últimos 12 meses o meses con ventas)
        $isSqlite = DB::connection()->getDriverName() === 'sqlite';
        $dateExpression = $isSqlite ? "strftime('%Y-%m', fecha)" : "DATE_FORMAT(fecha, '%Y-%m')";

        $ventasPorMesRaw = Venta::selectRaw("{$dateExpression} as mes_ym, SUM(total) as total_mes")
            ->groupBy('mes_ym')
            ->orderBy('mes_ym', 'asc')
            ->get();

        // Construir etiquetas amigables para los últimos 12 meses o los meses disponibles
        $mesesLabels = [];
        $mesesValores = [];

        if ($ventasPorMesRaw->isNotEmpty()) {
            foreach ($ventasPorMesRaw as $row) {
                if (! empty($row->mes_ym)) {
                    $fechaMes = Carbon::createFromFormat('Y-m', $row->mes_ym);
                    $mesesLabels[] = $fechaMes ? $fechaMes->translatedFormat('M Y') : $row->mes_ym;
                    $mesesValores[] = (float) $row->total_mes;
                }
            }
        }

        // Si no hay suficientes meses, rellenar con meses recientes para una visualización agradable
        if (count($mesesLabels) < 2) {
            $mesesLabels = [
                $ahora->copy()->subMonths(5)->translatedFormat('M Y'),
                $ahora->copy()->subMonths(4)->translatedFormat('M Y'),
                $ahora->copy()->subMonths(3)->translatedFormat('M Y'),
                $ahora->copy()->subMonths(2)->translatedFormat('M Y'),
                $ahora->copy()->subMonths(1)->translatedFormat('M Y'),
                $ahora->translatedFormat('M Y'),
            ];
            $mesesValores = [0, 0, 0, 0, 0, $ingresosTotales];
        }

        // Ventas diarias (Últimos 30 días)
        $inicio30 = Carbon::today()->subDays(29);
        $diasLabels = [];
        $diasValores = [];

        $ventasDiariasRaw = Venta::whereDate('fecha', '>=', $inicio30)
            ->get()
            ->groupBy(function ($v) {
                return Carbon::parse($v->fecha)->format('d/m');
            });

        for ($i = 29; $i >= 0; $i--) {
            $diaObj = Carbon::today()->subDays($i);
            $diaStr = $diaObj->format('d/m');
            $diasLabels[] = $diaStr;
            $diasValores[] = isset($ventasDiariasRaw[$diaStr]) ? (float) $ventasDiariasRaw[$diaStr]->sum('total') : 0.0;
        }

        // ════════════════════════════════════════
        // 3. RANKINGS
        // ════════════════════════════════════════
        // Productos más vendidos por unidades
        $topProductosQuery = DetalleVenta::select('producto', DB::raw('SUM(cantidad) as total_unidades'), DB::raw('SUM(cantidad * precio) as total_ingresos'))
            ->groupBy('producto')
            ->orderByDesc('total_unidades')
            ->limit(5)
            ->with('productoObj')
            ->get();

        $maxUnidades = $topProductosQuery->max('total_unidades') ?: 1;
        $topProductos = $topProductosQuery->map(function ($item, $index) use ($maxUnidades) {
            $nombre = $item->productoObj?->nombre ?? "Producto #{$item->producto}";
            $porcentaje = min(100, round(($item->total_unidades / $maxUnidades) * 100));

            return [
                'posicion' => $index + 1,
                'nombre' => $nombre,
                'unidades' => (int) $item->total_unidades,
                'ingresos' => (float) $item->total_ingresos,
                'ingresos_formateado' => '$'.number_format($item->total_ingresos, 0, ',', '.'),
                'porcentaje' => $porcentaje,
            ];
        });

        // Rendimiento por vendedor
        $rendimientoVendedoresQuery = Venta::select('usuario', DB::raw('SUM(total) as total_ingresos'), DB::raw('COUNT(*) as total_ventas'))
            ->groupBy('usuario')
            ->orderByDesc('total_ingresos')
            ->limit(5)
            ->with('usuarioObj')
            ->get();

        $maxIngresosVendedor = $rendimientoVendedoresQuery->max('total_ingresos') ?: 1;
        $rendimientoVendedores = $rendimientoVendedoresQuery->map(function ($item) use ($maxIngresosVendedor) {
            $nombre = $item->usuarioObj ? trim("{$item->usuarioObj->nombre} {$item->usuarioObj->apellido}") : 'Desconocido';
            $inicial = $item->usuarioObj?->nombre ? strtoupper(substr($item->usuarioObj->nombre, 0, 1)) : 'U';
            $porcentaje = min(100, round(($item->total_ingresos / $maxIngresosVendedor) * 100));

            return [
                'nombre' => $nombre,
                'inicial' => $inicial,
                'ingresos' => (float) $item->total_ingresos,
                'ingresos_formateado' => '$'.number_format($item->total_ingresos, 0, ',', '.'),
                'total_ventas' => (int) $item->total_ventas,
                'porcentaje' => $porcentaje,
            ];
        });

        // ════════════════════════════════════════
        // 4. ESTADO DEL INVENTARIO (KPIs)
        // ════════════════════════════════════════
        $totalProductos = Producto::count();
        $unidadesStock = (int) Producto::sum('stock');
        $stockBajoCount = Producto::whereColumn('stock', '<=', 'stock_minimo')->count();
        $valorStock = (float) Producto::selectRaw('SUM(stock * precio_compra) as total_valor')->value('total_valor');

        // Timestamp actual para la esquina superior derecha
        $fechaActualizacion = $ahora->format('d/m/Y H:i');

        return view('reportes.index', compact(
            'ingresosTotales',
            'totalVentasCount',
            'ingresosHoy',
            'ventasHoyCount',
            'ingresosMes',
            'mesActualNombre',
            'ticketPromedio',
            'ventaMasAlta',
            'mesesLabels',
            'mesesValores',
            'diasLabels',
            'diasValores',
            'topProductos',
            'rendimientoVendedores',
            'totalProductos',
            'unidadesStock',
            'stockBajoCount',
            'valorStock',
            'fechaActualizacion'
        ));
    }

    /**
     * Genera la vista imprimible y corporativa de reportes especiales para PDF.
     */
    public function imprimir(Request $request): View
    {
        $tipo = $request->query('tipo', 'inventario');
        $formato = $request->query('formato', 'pantalla');
        $ahora = Carbon::now();
        $fechaGeneracion = $ahora->format('d/m/Y H:i');

        $tituloReporte = 'Reporte de Inventario';
        $subtituloReporte = 'LISTADO COMPLETO DE INVENTARIO';
        $items = collect();
        $totales = [
            'unidades' => 0,
            'valor_compra' => 0.0,
            'valor_venta' => 0.0,
            'total_general' => 0.0,
        ];

        switch ($tipo) {
            case 'ventas_mes':
                $tituloReporte = 'Reporte de Ventas del Mes';
                $subtituloReporte = 'VENTAS REGISTRADAS EN '.strtoupper($ahora->translatedFormat('F Y'));
                $items = Venta::with(['usuarioObj', 'detalles.productoObj'])
                    ->whereBetween('fecha', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                    ->orderByDesc('ventas')
                    ->get();
                $totales['total_general'] = (float) $items->sum('total');
                break;

            case 'top_productos':
                $tituloReporte = 'Reporte de Productos Más Vendidos';
                $subtituloReporte = 'RANKING GENERAL POR UNIDADES VENDIDAS';
                $items = DetalleVenta::select('producto', DB::raw('SUM(cantidad) as total_unidades'), DB::raw('SUM(cantidad * precio) as total_ingresos'))
                    ->groupBy('producto')
                    ->orderByDesc('total_unidades')
                    ->with('productoObj.categoriaObj')
                    ->get();
                $totales['unidades'] = (int) $items->sum('total_unidades');
                $totales['total_general'] = (float) $items->sum('total_ingresos');
                break;

            case 'vendedores':
                $tituloReporte = 'Reporte de Rendimiento por Vendedor';
                $subtituloReporte = 'HISTORIAL ACUMULADO DE VENTAS POR USUARIO';
                $items = Venta::select('usuario', DB::raw('SUM(total) as total_ingresos'), DB::raw('COUNT(*) as total_ventas'))
                    ->groupBy('usuario')
                    ->orderByDesc('total_ingresos')
                    ->with('usuarioObj')
                    ->get();
                $totales['unidades'] = (int) $items->sum('total_ventas');
                $totales['total_general'] = (float) $items->sum('total_ingresos');
                break;

            case 'stock_bajo':
                $tituloReporte = 'Reporte de Stock Crítico / Bajo';
                $subtituloReporte = 'PRODUCTOS QUE REQUIEREN REABASTECIMIENTO INMEDIATO';
                $items = Producto::with('categoriaObj')
                    ->whereColumn('stock', '<=', 'stock_minimo')
                    ->orderBy('stock', 'asc')
                    ->get();
                $totales['unidades'] = (int) $items->sum('stock');
                $totales['valor_compra'] = (float) $items->sum(fn ($p) => $p->stock * $p->precio_compra);
                $totales['valor_venta'] = (float) $items->sum(fn ($p) => $p->stock * $p->precio_venta);
                break;

            case 'resumen':
                $tituloReporte = 'Resumen Ejecutivo del Negocio';
                $subtituloReporte = 'CONSOLIDADO GENERAL DE VENTAS E INVENTARIO';
                $items = collect([
                    'total_ventas' => Venta::count(),
                    'ingresos_totales' => (float) Venta::sum('total'),
                    'total_productos' => Producto::count(),
                    'unidades_stock' => (int) Producto::sum('stock'),
                    'valor_inventario' => (float) Producto::selectRaw('SUM(stock * precio_compra) as val')->value('val'),
                    'stock_critico' => Producto::whereColumn('stock', '<=', 'stock_minimo')->count(),
                ]);
                break;

            case 'inventario':
            default:
                $tipo = 'inventario';
                $tituloReporte = 'Reporte de Inventario';
                $subtituloReporte = 'LISTADO COMPLETO DE INVENTARIO ('.Producto::count().' PRODUCTOS)';
                $items = Producto::with('categoriaObj')->orderBy('productos', 'asc')->get();
                $totales['unidades'] = (int) $items->sum('stock');
                $totales['valor_compra'] = (float) $items->sum(fn ($p) => $p->stock * $p->precio_compra);
                $totales['valor_venta'] = (float) $items->sum(fn ($p) => $p->stock * $p->precio_venta);
                break;
        }

        return view('reportes.imprimir', compact(
            'tipo',
            'formato',
            'tituloReporte',
            'subtituloReporte',
            'items',
            'totales',
            'fechaGeneracion'
        ));
    }
}
