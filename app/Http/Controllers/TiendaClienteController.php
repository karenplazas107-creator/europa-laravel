<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TiendaClienteController extends Controller
{
    /**
     * Departamentos de Colombia para el formulario de entrega.
     */
    private const DEPARTAMENTOS_COLOMBIA = [
        'Amazonas', 'Antioquia', 'Arauca', 'Atlántico', 'Bogotá D.C.', 'Bolívar', 'Boyacá',
        'Caldas', 'Caquetá', 'Casanare', 'Cauca', 'Cesar', 'Chocó', 'Córdoba', 'Cundinamarca',
        'Guainía', 'Guaviare', 'Huila', 'La Guajira', 'Magdalena', 'Meta', 'Nariño',
        'Norte de Santander', 'Putumayo', 'Quindío', 'Risaralda', 'San Andrés y Providencia',
        'Santander', 'Sucre', 'Tolima', 'Valle del Cauca', 'Vaupés', 'Vichada',
    ];

    /**
     * Muestra la vista principal de la tienda para el cliente.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search', ''));
        $categoriaId = $request->input('categoria', '');

        $categorias = Categoria::orderBy('nombre')->get();
        $totalCategorias = $categorias->count();
        $totalProductos = Producto::count();

        $query = Producto::with('categoriaObj')->orderBy('nombre');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                    ->orWhere('descripcion', 'LIKE', "%{$search}%");
            });
        }

        if (! empty($categoriaId)) {
            $query->where('categoria', $categoriaId);
        }

        $productos = $query->get();
        $user = Auth::user();
        $departamentos = [
            'Amazonas', 'Antioquia', 'Arauca', 'Atlántico', 'Bogotá D.C.', 'Bolívar',
            'Boyacá', 'Caldas', 'Caquetá', 'Casanare', 'Cauca', 'Cesar', 'Chocó',
            'Córdoba', 'Cundinamarca', 'Guainía', 'Guaviare', 'Huila', 'La Guajira',
            'Magdalena', 'Meta', 'Nariño', 'Norte de Santander', 'Putumayo', 'Quindío',
            'Risaralda', 'San Andrés y Providencia', 'Santander', 'Sucre', 'Tolima',
            'Valle del Cauca', 'Vaupés', 'Vichada',
        ];

        return view('cliente.tienda', compact(
            'productos',
            'categorias',
            'totalProductos',
            'totalCategorias',
            'search',
            'categoriaId',
            'departamentos',
            'user'
        ));
    }

    /**
     * Muestra la pantalla de Checkout profesional estilo Shopify.
     */
    public function showCheckout(): View
    {
        $user = Auth::user();
        $departamentos = self::DEPARTAMENTOS_COLOMBIA;

        return view('cliente.checkout', compact('user', 'departamentos'));
    }

    /**
     * Procesa la compra del cliente con datos de envío y método de pago seleccionado.
     */
    public function processCheckout(Request $request): JsonResponse
    {
        $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.producto_id' => ['required', 'integer', 'exists:products,productos'],
            'items.*.cantidad' => ['required', 'integer', 'min:1'],
            'email_contacto' => ['nullable', 'string', 'max:120'],
            'nombre' => ['nullable', 'string', 'max:80'],
            'apellido' => ['nullable', 'string', 'max:80'],
            'documento' => ['nullable', 'string', 'max:30'],
            'direccion' => ['nullable', 'string', 'max:200'],
            'ciudad' => ['nullable', 'string', 'max:100'],
            'departamento' => ['nullable', 'string', 'max:100'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'metodo_pago' => ['required', 'string'],
            'cupon' => ['nullable', 'string', 'max:30'],
        ], [
            'items.required' => 'El carrito está vacío.',
            'items.min' => 'Debe agregar al menos un producto.',
            'metodo_pago.required' => 'Seleccione un método de pago.',
        ]);

        try {
            $venta = DB::transaction(function () use ($request) {
                $items = $request->input('items');
                $totalVenta = 0.0;
                $detalles = [];

                foreach ($items as $item) {
                    $prod = Producto::where('productos', $item['producto_id'])->lockForUpdate()->firstOrFail();
                    $cant = (int) $item['cantidad'];

                    if ($prod->stock < $cant) {
                        throw new \RuntimeException("Stock insuficiente para '{$prod->nombre}'. Disponibles: {$prod->stock}");
                    }

                    $subtotal = (float) $prod->precio_venta * $cant;
                    $totalVenta += $subtotal;

                    $detalles[] = [
                        'producto' => $prod,
                        'cantidad' => $cant,
                        'precio' => $prod->precio_venta,
                    ];
                }

                // Cupones de descuento válidos (10% OFF)
                $cupon = strtoupper(trim((string) $request->input('cupon', '')));
                $descuento = 0.0;
                $cuponesValidos = ['EUROPA10', 'DESCUENTO10', 'BIENVENIDO', 'CLIENTE10'];
                if (in_array($cupon, $cuponesValidos, true)) {
                    $descuento = round($totalVenta * 0.10, 2);
                    $totalVenta = max(0.0, $totalVenta - $descuento);
                }

                // Mapeo amigable de método de pago
                $metodoRaw = strtolower(trim((string) $request->input('metodo_pago')));
                $nombreMetodo = match ($metodoRaw) {
                    'pse' => 'PSE / Débito Bancario',
                    'wompi' => 'Wompi (Tarjetas)',
                    'contraentrega' => 'Pago contra entrega',
                    'transferencia' => 'Transferencia Bancaria / Nequi',
                    default => ucfirst($metodoRaw),
                };

                $estado = ($metodoRaw === 'contraentrega') ? 'pendiente_entrega' : 'pagado';

                $direccionCompleta = trim(
                    (string) $request->input('direccion', '').
                    ($request->filled('complemento') ? ' ('.trim((string) $request->input('complemento')).')' : '')
                );

                $notas = $request->input('notas');
                if ($descuento > 0) {
                    $notas = trim("Cupón aplicado: {$cupon} (-10%, -$".number_format($descuento, 0, ',', '.').'). '.($notas ?? ''));
                }

                $venta = Venta::create([
                    'usuario' => Auth::user()->usuario,
                    'fecha' => now()->toDateString(),
                    'total' => $totalVenta,
                    'metodo_pago' => $nombreMetodo,
                    'direccion_envio' => $direccionCompleta ?: null,
                    'ciudad' => $request->input('ciudad') ?: null,
                    'departamento' => $request->input('departamento') ?: null,
                    'documento' => $request->input('documento') ?: null,
                    'telefono' => $request->input('telefono') ?: Auth::user()->movil,
                    'notas' => $notas ?: null,
                    'estado' => $estado,
                ]);

                foreach ($detalles as $d) {
                    DetalleVenta::create([
                        'venta' => $venta->ventas,
                        'producto' => $d['producto']->productos,
                        'cantidad' => $d['cantidad'],
                        'precio' => $d['precio'],
                    ]);

                    $d['producto']->decrement('stock', $d['cantidad']);
                }

                return $venta;
            });

            return response()->json([
                'success' => true,
                'message' => '¡Tu pedido ha sido procesado con éxito!',
                'numero_venta' => $venta->numero_venta ?? ('#'.$venta->ventas),
                'total' => '$'.number_format($venta->total, 0, ',', '.'),
                'redirect_url' => route('checkout.confirmado', $venta->ventas),
            ]);

        } catch (\RuntimeException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al procesar el pedido: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Alias compatible con rutas previas.
     */
    public function checkout(Request $request): JsonResponse
    {
        return $this->processCheckout($request);
    }

    /**
     * Muestra la pantalla de confirmación de pedido / recibo de compra.
     */
    public function pedidoConfirmado(string $id): View
    {
        $venta = Venta::with(['detalles.productoObj', 'usuarioObj'])
            ->where('usuario', Auth::user()->usuario)
            ->findOrFail($id);

        return view('cliente.confirmado', compact('venta'));
    }
}
