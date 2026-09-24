<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReporteTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private Categoria $categoria;

    private Producto $producto;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'rol' => 'admin',
            'nombre' => 'Karen',
            'apellido' => 'Plazas',
            'email' => 'karen@almaceneuropa.com',
            'movil' => '3001234567',
            'password' => bcrypt('password123'),
        ]);

        $this->categoria = Categoria::create([
            'nombre' => 'Perfumes',
            'descripcion' => 'Fragancias',
        ]);

        $this->producto = Producto::create([
            'nombre' => 'Chanel Coco Mademoiselle',
            'descripcion' => 'Fragancia floral',
            'precio_compra' => 75.00,
            'precio_venta' => 100.00,
            'categoria' => $this->categoria->categoria,
            'stock' => 50,
            'stock_minimo' => 10,
            'codigo_barras' => '35017181',
        ]);
    }

    public function test_invitado_es_redirigido_al_login(): void
    {
        $response = $this->get(route('reportes.index'));
        $response->assertRedirect(route('login'));

        $responsePrint = $this->get(route('reportes.imprimir'));
        $responsePrint->assertRedirect(route('login'));
    }

    public function test_usuario_autenticado_puede_ver_modulo_reportes(): void
    {
        // Crear una venta con detalle
        $venta = Venta::create([
            'usuario' => $this->user->usuario,
            'fecha' => Carbon::today(),
            'total' => 200.00,
            'metodo_pago' => 'efectivo',
        ]);

        DetalleVenta::create([
            'venta' => $venta->ventas,
            'producto' => $this->producto->productos,
            'cantidad' => 2,
            'precio' => 100.00,
        ]);

        $response = $this->actingAs($this->user)->get(route('reportes.index'));

        $response->assertStatus(200);
        $response->assertSee('Reportes e Informes');
        $response->assertSee('RESUMEN DE VENTAS');
        $response->assertSee('Ingresos totales');
        $response->assertSee('$200');
        $response->assertSee('Ingresos por mes');
        $response->assertSee('Ventas diarias');
        $response->assertSee('Productos más vendidos');
        $response->assertSee('Rendimiento por vendedor');
        $response->assertSee('ESTADO DEL INVENTARIO');
        $response->assertSee('EXPORTAR REPORTE');
        $response->assertSee('Generador de Reportes Especiales');
    }

    public function test_generar_reporte_imprimible_inventario(): void
    {
        $response = $this->actingAs($this->user)->get(route('reportes.imprimir', ['tipo' => 'inventario']));

        $response->assertStatus(200);
        $response->assertSee('ALMACÉN EUROPA');
        $response->assertSee('Reporte de Inventario');
        $response->assertSee('LISTADO COMPLETO DE INVENTARIO');
        $response->assertSee('Chanel Coco Mademoiselle');
        $response->assertSee('TOTALES');
    }

    public function test_generar_reportes_con_otros_tipos(): void
    {
        // Venta de prueba
        $venta = Venta::create([
            'usuario' => $this->user->usuario,
            'fecha' => Carbon::today(),
            'total' => 100.00,
            'metodo_pago' => 'tarjeta',
        ]);

        DetalleVenta::create([
            'venta' => $venta->ventas,
            'producto' => $this->producto->productos,
            'cantidad' => 1,
            'precio' => 100.00,
        ]);

        // Ventas del Mes
        $resVentas = $this->actingAs($this->user)->get(route('reportes.imprimir', ['tipo' => 'ventas_mes']));
        $resVentas->assertStatus(200);
        $resVentas->assertSee('Reporte de Ventas del Mes');

        // Top Productos
        $resTop = $this->actingAs($this->user)->get(route('reportes.imprimir', ['tipo' => 'top_productos']));
        $resTop->assertStatus(200);
        $resTop->assertSee('Reporte de Productos Más Vendidos');

        // Vendedores
        $resVend = $this->actingAs($this->user)->get(route('reportes.imprimir', ['tipo' => 'vendedores']));
        $resVend->assertStatus(200);
        $resVend->assertSee('Reporte de Rendimiento por Vendedor');

        // Stock Bajo
        $resStock = $this->actingAs($this->user)->get(route('reportes.imprimir', ['tipo' => 'stock_bajo']));
        $resStock->assertStatus(200);
        $resStock->assertSee('Reporte de Stock Crítico / Bajo');

        // Resumen
        $resResumen = $this->actingAs($this->user)->get(route('reportes.imprimir', ['tipo' => 'resumen']));
        $resResumen->assertStatus(200);
        $resResumen->assertSee('Resumen Ejecutivo del Negocio');
    }

    public function test_formato_pdf_imprimir_incluye_script_print(): void
    {
        $response = $this->actingAs($this->user)->get(route('reportes.imprimir', [
            'tipo' => 'inventario',
            'formato' => 'pdf_imprimir',
        ]));

        $response->assertStatus(200);
        $response->assertSee('window.print()', false);
    }
}
