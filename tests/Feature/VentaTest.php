<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VentaTest extends TestCase
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

    public function test_invitado_no_puede_ver_ventas(): void
    {
        $response = $this->get(route('ventas.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_usuario_autenticado_puede_ver_modulo_ventas_y_kpis(): void
    {
        $venta = Venta::create([
            'usuario' => $this->user->usuario,
            'fecha' => now()->toDateString(),
            'total' => 100.00,
            'metodo_pago' => 'Efectivo',
        ]);

        DetalleVenta::create([
            'venta' => $venta->ventas,
            'producto' => $this->producto->productos,
            'cantidad' => 1,
            'precio' => 100.00,
        ]);

        $response = $this->actingAs($this->user)->get(route('ventas.index'));

        $response->assertStatus(200);
        $response->assertSee('Historial de Ventas');
        $response->assertSee('Total ventas');
        $response->assertSee('Ingresos totales');
        $response->assertSee('Venta más alta');
        $response->assertSee('Nueva Venta');
        $response->assertSee($venta->numero_venta);
        $response->assertSee('Karen Plazas');
    }

    public function test_filtrado_por_termino_de_busqueda(): void
    {
        $venta = Venta::create([
            'usuario' => $this->user->usuario,
            'fecha' => now()->toDateString(),
            'total' => 100.00,
            'metodo_pago' => 'Efectivo',
        ]);

        $response = $this->actingAs($this->user)->get(route('ventas.index', ['search' => 'Karen']));
        $response->assertStatus(200);
        $response->assertSee($venta->numero_venta);
    }

    public function test_creacion_de_venta_y_descuento_de_stock(): void
    {
        $stockInicial = $this->producto->stock;

        $response = $this->actingAs($this->user)->postJson(route('ventas.store'), [
            'metodo_pago' => 'Efectivo',
            'items' => [
                [
                    'producto_id' => $this->producto->productos,
                    'cantidad' => 2,
                ],
            ],
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        // Verificar que se creó la venta
        $this->assertDatabaseHas('sales', [
            'total' => 200.00,
            'metodo_pago' => 'Efectivo',
            'usuario' => $this->user->usuario,
        ]);

        // Verificar descuento de stock
        $this->producto->refresh();
        $this->assertEquals($stockInicial - 2, $this->producto->stock);
    }

    public function test_detalle_de_venta_endpoint(): void
    {
        $venta = Venta::create([
            'usuario' => $this->user->usuario,
            'fecha' => now()->toDateString(),
            'total' => 100.00,
            'metodo_pago' => 'Efectivo',
        ]);

        DetalleVenta::create([
            'venta' => $venta->ventas,
            'producto' => $this->producto->productos,
            'cantidad' => 1,
            'precio' => 100.00,
        ]);

        $response = $this->actingAs($this->user)->getJson(route('ventas.show', $venta->ventas));

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'numero_venta' => $venta->numero_venta,
                'metodo_pago' => 'Efectivo',
                'responsable' => 'Karen Plazas',
            ]);
    }
}
