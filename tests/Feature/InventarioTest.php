<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventarioTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private Categoria $categoria;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'rol' => 'admin',
            'nombre' => 'Admin',
            'apellido' => 'Test',
            'email' => 'admin@test.com',
            'movil' => '3001112233',
            'password' => bcrypt('secret123'),
        ]);

        $this->categoria = Categoria::create([
            'nombre' => 'Perfumes',
            'descripcion' => 'Fragancias y aromas',
        ]);
    }

    public function test_invitado_no_puede_ver_inventario(): void
    {
        $response = $this->get(route('inventario.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_usuario_autenticado_puede_ver_modulo_inventario(): void
    {
        Producto::create([
            'nombre' => 'Chanel Test',
            'descripcion' => 'Fragancia floral',
            'precio_compra' => 75.00,
            'precio_venta' => 100.00,
            'categoria' => $this->categoria->categoria,
            'stock' => 98,
            'stock_minimo' => 10,
            'codigo_barras' => '35017181',
        ]);

        $response = $this->actingAs($this->user)->get(route('inventario.index'));

        $response->assertStatus(200);
        $response->assertSee('Control de Inventario');
        $response->assertSee('Unidades totales');
        $response->assertSee('Valor en stock');
        $response->assertSee('Stock crítico');
        $response->assertSee('Agotados');
        $response->assertSee('STOCK ACTUAL');
        $response->assertSee('STOCK MÍNIMO');
        $response->assertSee('Chanel Test');
        $response->assertSee('98');
    }

    public function test_filtrado_por_termino_de_busqueda(): void
    {
        Producto::create([
            'nombre' => 'Producto Especial Inventario Test',
            'descripcion' => 'Descripción de prueba para inventario',
            'precio_compra' => 5000,
            'precio_venta' => 8000,
            'categoria' => $this->categoria->categoria,
            'stock' => 25,
            'stock_minimo' => 5,
            'codigo_barras' => '999888777666',
        ]);

        $response = $this->actingAs($this->user)->get(route('inventario.index', ['search' => 'Especial Inventario']));
        $response->assertStatus(200);
        $response->assertSee('Producto Especial Inventario Test');
    }

    public function test_registro_de_movimiento_entrada_y_salida(): void
    {
        $prod = Producto::create([
            'nombre' => 'Item Movimiento Test',
            'descripcion' => 'Test movimiento',
            'precio_compra' => 100,
            'precio_venta' => 150,
            'categoria' => $this->categoria->categoria,
            'stock' => 10,
            'stock_minimo' => 5,
            'codigo_barras' => '1122339900',
        ]);

        // 1. Entrada de 5 unidades -> stock debe ser 15
        $responseEntrada = $this->actingAs($this->user)->postJson(route('inventario.movimiento', $prod->productos), [
            'tipo' => 'entrada',
            'cantidad' => 5,
        ]);
        $responseEntrada->assertStatus(200)
            ->assertJson(['success' => true, 'stock' => 15]);

        $prod->refresh();
        $this->assertEquals(15, $prod->stock);

        // 2. Salida de 8 unidades -> stock debe ser 7
        $responseSalida = $this->actingAs($this->user)->postJson(route('inventario.movimiento', $prod->productos), [
            'tipo' => 'salida',
            'cantidad' => 8,
        ]);
        $responseSalida->assertStatus(200)
            ->assertJson(['success' => true, 'stock' => 7]);

        $prod->refresh();
        $this->assertEquals(7, $prod->stock);
    }
}
