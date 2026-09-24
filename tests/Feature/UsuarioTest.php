<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsuarioTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private User $vendedor;

    private User $cliente;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'rol' => 'administrador',
            'nombre' => 'Super',
            'apellido' => 'Admin',
            'email' => 'admin@almaceneuropa.com',
            'movil' => '3001234567',
            'password' => Hash::make('password123'),
        ]);

        $this->vendedor = User::create([
            'rol' => 'vendedor',
            'nombre' => 'Laura',
            'apellido' => 'Vendedora',
            'email' => 'laura@almaceneuropa.com',
            'movil' => '3109876543',
            'password' => Hash::make('password123'),
        ]);

        $this->cliente = User::create([
            'rol' => 'cliente',
            'nombre' => 'Pedro',
            'apellido' => 'Comprador',
            'email' => 'pedro@gmail.com',
            'movil' => '3205554433',
            'password' => Hash::make('password123'),
        ]);
    }

    public function test_administrador_puede_ver_listado_de_usuarios(): void
    {
        $response = $this->actingAs($this->admin)->get(route('usuarios.index'));

        $response->assertStatus(200);
        $response->assertSee('Gestión de Usuarios y Roles');
        $response->assertSee('Super Admin');
        $response->assertSee('Laura Vendedora');
        $response->assertSee('Pedro Comprador');
    }

    public function test_vendedor_no_puede_acceder_a_gestion_de_usuarios(): void
    {
        $response = $this->actingAs($this->vendedor)->get(route('usuarios.index'));

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('error');
    }

    public function test_cliente_no_puede_acceder_a_gestion_de_usuarios(): void
    {
        $response = $this->actingAs($this->cliente)->get(route('usuarios.index'));

        $response->assertRedirect(route('tienda'));
    }

    public function test_invitado_es_redirigido_al_login(): void
    {
        $response = $this->get(route('usuarios.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_administrador_puede_crear_usuario_vendedor(): void
    {
        $response = $this->actingAs($this->admin)->post(route('usuarios.store'), [
            'nombre' => 'Camilo',
            'apellido' => 'Torres',
            'email' => 'camilo@almaceneuropa.com',
            'movil' => '3157778899',
            'rol' => 'vendedor',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertRedirect(route('usuarios.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'nombre' => 'Camilo',
            'apellido' => 'Torres',
            'email' => 'camilo@almaceneuropa.com',
            'movil' => '3157778899',
            'rol' => 'vendedor',
        ]);
    }

    public function test_administrador_puede_crear_usuario_auxiliar_de_bodega(): void
    {
        $response = $this->actingAs($this->admin)->post(route('usuarios.store'), [
            'nombre' => 'Mateo',
            'apellido' => 'Rios',
            'email' => 'mateo@almaceneuropa.com',
            'movil' => '3184443322',
            'rol' => 'auxiliar_bodega',
            'password' => 'bodega123',
            'password_confirmation' => 'bodega123',
        ]);

        $response->assertRedirect(route('usuarios.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'nombre' => 'Mateo',
            'apellido' => 'Rios',
            'movil' => '3184443322',
            'rol' => 'auxiliar_bodega',
        ]);
    }

    public function test_administrador_puede_editar_usuario_y_cambiar_rol(): void
    {
        $response = $this->actingAs($this->admin)->put(route('usuarios.update', $this->vendedor->usuario), [
            'nombre' => 'Laura Modificada',
            'apellido' => 'Vendedora',
            'email' => 'laura_mod@almaceneuropa.com',
            'movil' => $this->vendedor->movil,
            'rol' => 'auxiliar_bodega',
        ]);

        $response->assertRedirect(route('usuarios.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'usuario' => $this->vendedor->usuario,
            'nombre' => 'Laura Modificada',
            'rol' => 'auxiliar_bodega',
        ]);
    }

    public function test_administrador_no_puede_quitarse_su_propio_rol(): void
    {
        $response = $this->actingAs($this->admin)->put(route('usuarios.update', $this->admin->usuario), [
            'nombre' => 'Super',
            'apellido' => 'Admin',
            'email' => $this->admin->email,
            'movil' => $this->admin->movil,
            'rol' => 'vendedor',
        ]);

        $response->assertSessionHas('error');

        $this->assertDatabaseHas('users', [
            'usuario' => $this->admin->usuario,
            'rol' => 'administrador',
        ]);
    }

    public function test_administrador_no_puede_eliminar_su_propia_cuenta(): void
    {
        $response = $this->actingAs($this->admin)->delete(route('usuarios.destroy', $this->admin->usuario));

        $response->assertRedirect(route('usuarios.index'));
        $response->assertSessionHas('error');

        $this->assertDatabaseHas('users', [
            'usuario' => $this->admin->usuario,
        ]);
    }

    public function test_administrador_puede_eliminar_otro_usuario(): void
    {
        $response = $this->actingAs($this->admin)->delete(route('usuarios.destroy', $this->vendedor->usuario));

        $response->assertRedirect(route('usuarios.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('users', [
            'usuario' => $this->vendedor->usuario,
        ]);
    }

    public function test_validacion_de_creacion_requiere_campos_obligatorios(): void
    {
        $response = $this->actingAs($this->admin)->post(route('usuarios.store'), []);

        $response->assertSessionHasErrors(['nombre', 'apellido', 'movil', 'rol', 'password']);
    }
}
