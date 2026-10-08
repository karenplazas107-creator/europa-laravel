<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClienteTiendaTest extends TestCase
{
    use RefreshDatabase;

    private User $cliente;

    private User $admin;

    private Categoria $categoria;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cliente = User::create([
            'rol' => 'cliente',
            'nombre' => 'Carla',
            'apellido' => 'Gomez',
            'email' => 'carla@test.com',
            'movil' => '3009998877',
            'password' => bcrypt('password123'),
        ]);

        $this->admin = User::create([
            'rol' => 'admin',
            'nombre' => 'Administrador',
            'apellido' => 'General',
            'email' => 'admin@test.com',
            'movil' => '3001112233',
            'password' => bcrypt('password123'),
        ]);

        $this->categoria = Categoria::create([
            'nombre' => 'Perfumes',
            'descripcion' => 'Fragancias y aromas',
        ]);

        Producto::create([
            'nombre' => 'Chanel Coco Mademoiselle',
            'descripcion' => 'Fragancia floral de lujo',
            'precio_compra' => 75.00,
            'precio_venta' => 100.00,
            'categoria' => $this->categoria->categoria,
            'stock' => 98,
            'stock_minimo' => 10,
            'codigo_barras' => '35017181',
        ]);
    }

    public function test_registro_de_cliente_redirige_a_tienda(): void
    {
        $response = $this->post(route('register.post'), [
            'nombre' => 'Laura',
            'apellido' => 'Perez',
            'email' => 'laura@test.com',
            'movil' => '3115554433',
            'password' => 'secreto123',
            'password_confirmation' => 'secreto123',
        ]);

        $response->assertRedirect(route('tienda'));
        $this->assertAuthenticated();

        $user = User::where('movil', '3115554433')->first();
        $this->assertNotNull($user);
        $this->assertEquals('cliente', $user->rol);
    }

    public function test_login_de_cliente_redirige_a_tienda(): void
    {
        $response = $this->post(route('login.post'), [
            'movil' => '3009998877',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('tienda'));
        $this->assertAuthenticatedAs($this->cliente);
    }

    public function test_login_con_correo_electronico_funciona_correctamente(): void
    {
        $response = $this->post(route('login.post'), [
            'movil' => 'carla@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('tienda'));
        $this->assertAuthenticatedAs($this->cliente);
    }

    public function test_login_de_admin_redirige_a_dashboard(): void
    {
        $response = $this->post(route('login.post'), [
            'movil' => 'admin@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($this->admin);
    }

    public function test_cliente_no_puede_acceder_al_dashboard_administrativo(): void
    {
        $response = $this->actingAs($this->cliente)->get(route('dashboard'));

        $response->assertRedirect(route('tienda'));
        $response->assertSessionHas('error');
    }

    public function test_cliente_no_puede_acceder_a_gestion_de_clientes(): void
    {
        $response = $this->actingAs($this->cliente)->get(route('clientes.index'));

        $response->assertRedirect(route('tienda'));
        $response->assertSessionHas('error');
    }

    public function test_cliente_puede_ver_vista_de_tienda_con_productos_y_saludo(): void
    {
        $response = $this->actingAs($this->cliente)->get(route('tienda'));

        $response->assertOk();
        $response->assertSee('carla');
        $response->assertSee('¿Qué vas a llevar hoy?');
        $response->assertSee('Nuestros Productos');
        $response->assertSee('Chanel Coco Mademoiselle');
        $response->assertSee('Mi Carrito');
    }

    public function test_cliente_puede_realizar_checkout_desde_tienda(): void
    {
        $producto = Producto::first();

        $response = $this->actingAs($this->cliente)->postJson(route('tienda.checkout'), [
            'items' => [
                [
                    'producto_id' => $producto->productos,
                    'cantidad' => 2,
                ],
            ],
            'metodo_pago' => 'efectivo',
        ]);

        $response->assertOk();
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('sales', [
            'usuario' => $this->cliente->usuario,
            'total' => 200.00,
        ]);

        $this->assertEquals(96, $producto->fresh()->stock);
    }

    public function test_cliente_puede_ver_pantalla_de_checkout(): void
    {
        $response = $this->actingAs($this->cliente)->get(route('checkout'));

        $response->assertOk();
        $response->assertSee('Contacto');
        $response->assertSee('Entrega');
        $response->assertSee('Pago');
        $response->assertSee('Paga a Crédito o Débito con PSE');
        $response->assertSee('Wompi');
        $response->assertSee('Pago contra entrega');
    }

    public function test_cliente_puede_procesar_checkout_completo_con_datos_de_envio_y_pago(): void
    {
        $producto = Producto::first();

        $response = $this->actingAs($this->cliente)->postJson(route('checkout.process'), [
            'items' => [
                [
                    'producto_id' => $producto->productos,
                    'cantidad' => 1,
                ],
            ],
            'email_contacto' => 'carla@test.com',
            'nombre' => 'Carla',
            'apellido' => 'Gomez',
            'documento' => '1075234567',
            'direccion' => 'Carrera 5 # 12-34',
            'ciudad' => 'Neiva',
            'departamento' => 'Huila',
            'telefono' => '3009998877',
            'metodo_pago' => 'contraentrega',
        ]);

        $response->assertOk();
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('sales', [
            'usuario' => $this->cliente->usuario,
            'direccion_envio' => 'Carrera 5 # 12-34',
            'ciudad' => 'Neiva',
            'departamento' => 'Huila',
            'documento' => '1075234567',
            'metodo_pago' => 'Pago contra entrega',
            'estado' => 'pendiente_entrega',
        ]);
    }

    public function test_cliente_puede_aplicar_cupon_de_descuento_en_checkout(): void
    {
        $producto = Producto::first();
        $subtotal = (float) $producto->precio_venta;
        $totalEsperado = $subtotal * 0.90; // 10% de descuento

        $response = $this->actingAs($this->cliente)->postJson(route('checkout.process'), [
            'items' => [
                [
                    'producto_id' => $producto->productos,
                    'cantidad' => 1,
                ],
            ],
            'email_contacto' => 'carla@test.com',
            'nombre' => 'Carla',
            'apellido' => 'Gomez',
            'documento' => '1075234567',
            'direccion' => 'Carrera 5 # 12-34',
            'ciudad' => 'Neiva',
            'departamento' => 'Huila',
            'telefono' => '3009998877',
            'metodo_pago' => 'pse',
            'cupon' => 'EUROPA10',
        ]);

        $response->assertOk();
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('sales', [
            'usuario' => $this->cliente->usuario,
            'total' => $totalEsperado,
            'metodo_pago' => 'PSE / Débito Bancario',
            'estado' => 'pagado',
        ]);
    }

    public function test_visitante_no_autenticado_puede_ver_tienda_sin_redirigir_a_login(): void
    {
        $response = $this->get(route('tienda'));

        $response->assertOk();
        $response->assertSee('bienvenido(a)');
        $response->assertSee('Ingresar');
    }

    public function test_visitante_no_autenticado_al_intentar_checkout_es_redirigido_a_login(): void
    {
        $response = $this->get(route('checkout'));

        $response->assertRedirect(route('login'));
    }

    public function test_login_con_parametro_checkout_redirige_directamente_a_checkout(): void
    {
        $response = $this->post(route('login.post'), [
            'movil' => '3009998877',
            'password' => 'password123',
            'checkout' => '1',
        ]);

        $response->assertRedirect(route('checkout'));
    }

    public function test_registro_con_parametro_checkout_redirige_directamente_a_checkout(): void
    {
        $response = $this->post(route('register.post'), [
            'nombre' => 'Mariana',
            'apellido' => 'Lopez',
            'email' => 'mariana@test.com',
            'movil' => '3128887766',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'checkout' => '1',
        ]);

        $response->assertRedirect(route('checkout'));
    }

    public function test_cliente_autenticado_puede_acceder_a_mis_compras(): void
    {
        $producto = Producto::first();
        $venta = Venta::create([
            'usuario' => $this->cliente->usuario,
            'fecha' => now()->toDateString(),
            'total' => 200.00,
            'metodo_pago' => 'PSE / Débito Bancario',
            'estado' => 'pagado',
            'direccion_envio' => 'Calle 10 # 4-20',
            'ciudad' => 'Neiva',
            'departamento' => 'Huila',
        ]);

        DetalleVenta::create([
            'venta' => $venta->ventas,
            'producto' => $producto->productos,
            'cantidad' => 2,
            'precio' => 100.00,
        ]);

        $response = $this->actingAs($this->cliente)->get(route('cliente.compras'));

        $response->assertOk();
        $response->assertSee('Mis Compras');
        $response->assertSee('Facturas');
        $response->assertSee($venta->numero_venta);
        $response->assertSee($venta->numero_factura);
        $response->assertSee('Chanel Coco Mademoiselle');
        $response->assertSee('PSE / Débito Bancario');
    }

    public function test_visitante_no_autenticado_no_puede_acceder_a_mis_compras(): void
    {
        $response = $this->get(route('cliente.compras'));

        $response->assertRedirect(route('login'));
    }

    public function test_cliente_puede_ver_su_factura_oficial_imprimible(): void
    {
        $producto = Producto::first();
        $venta = Venta::create([
            'usuario' => $this->cliente->usuario,
            'fecha' => now()->toDateString(),
            'total' => 100.00,
            'metodo_pago' => 'Wompi (Tarjetas)',
            'estado' => 'pagado',
            'direccion_envio' => 'Carrera 7 # 15-30',
            'ciudad' => 'Neiva',
            'departamento' => 'Huila',
        ]);

        DetalleVenta::create([
            'venta' => $venta->ventas,
            'producto' => $producto->productos,
            'cantidad' => 1,
            'precio' => 100.00,
        ]);

        $response = $this->actingAs($this->cliente)->get(route('cliente.compras.factura', $venta->ventas));

        $response->assertOk();
        $response->assertSee('ALMACÉN EUROPA');
        $response->assertSee('NIT: 901234567-8');
        $response->assertSee('FACTURA DE VENTA');
        $response->assertSee('Chanel Coco Mademoiselle');
        $response->assertSee('Wompi (Tarjetas)');
    }

    public function test_cliente_no_puede_ver_factura_de_otro_cliente(): void
    {
        $otroCliente = User::create([
            'rol' => 'cliente',
            'nombre' => 'Felipe',
            'apellido' => 'Duran',
            'email' => 'felipe@test.com',
            'movil' => '3157776655',
            'password' => bcrypt('password123'),
        ]);

        $ventaOtro = Venta::create([
            'usuario' => $otroCliente->usuario,
            'fecha' => now()->toDateString(),
            'total' => 150.00,
            'metodo_pago' => 'Efectivo',
            'estado' => 'pagado',
        ]);

        // Carla intenta acceder a la factura de Felipe
        $response = $this->actingAs($this->cliente)->get(route('cliente.compras.factura', $ventaOtro->ventas));

        $response->assertNotFound();
    }

    public function test_cliente_puede_obtener_detalle_json_de_su_compra(): void
    {
        $producto = Producto::first();
        $venta = Venta::create([
            'usuario' => $this->cliente->usuario,
            'fecha' => now()->toDateString(),
            'total' => 100.00,
            'metodo_pago' => 'PSE / Débito Bancario',
            'estado' => 'pagado',
        ]);

        DetalleVenta::create([
            'venta' => $venta->ventas,
            'producto' => $producto->productos,
            'cantidad' => 1,
            'precio' => 100.00,
        ]);

        $response = $this->actingAs($this->cliente)->getJson(route('cliente.compras.detalle', $venta->ventas));

        $response->assertOk();
        $response->assertJson([
            'success' => true,
            'id' => $venta->ventas,
            'numero_factura' => $venta->numero_factura,
            'metodo_pago' => 'PSE / Débito Bancario',
        ]);
    }
}
