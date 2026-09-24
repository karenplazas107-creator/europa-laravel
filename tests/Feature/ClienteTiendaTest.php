<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
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
}
