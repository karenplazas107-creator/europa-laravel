<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\TiendaClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

/* ══════════════════════════════════════════
   RUTAS PÚBLICAS
══════════════════════════════════════════ */

// Página principal
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Promociones
Route::get('/promociones', function () {
    return redirect()->route('tienda');
})->name('promociones');

// Carrito
Route::get('/carrito', function () {
    return redirect()->route('tienda');
})->name('carrito');

/* ══════════════════════════════════════════
   RUTAS DE AUTENTICACIÓN
══════════════════════════════════════════ */

// Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post')->middleware('guest');

// Registro
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register')->middleware('guest');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.post')->middleware('guest');

// Cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')->middleware('auth');

/* ══════════════════════════════════════════
   RUTAS PROTEGIDAS (requieren login)
══════════════════════════════════════════ */

Route::middleware('auth')->group(function () {

    // ── Espacio del Cliente ──
    Route::get('/tienda', [TiendaClienteController::class, 'index'])->name('tienda');
    Route::get('/checkout', [TiendaClienteController::class, 'showCheckout'])->name('checkout');
    Route::post('/checkout', [TiendaClienteController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/tienda/checkout', [TiendaClienteController::class, 'processCheckout'])->name('tienda.checkout');
    Route::get('/pedido-confirmado/{id}', [TiendaClienteController::class, 'pedidoConfirmado'])->name('checkout.confirmado');

    // ── Panel Administrativo (solo Admin / Vendedor / Staff) ──
    Route::middleware('staff')->group(function () {

        // Dashboard principal
        Route::get('/dashboard', function () {
            return view('dashboard.index');
        })->name('dashboard');

        // ── Gestión ──
        Route::middleware('admin')->group(function () {
            Route::resource('usuarios', UsuarioController::class)
                ->parameters(['usuarios' => 'id']);
        });

        Route::resource('clientes', ClienteController::class)
            ->only(['index', 'edit', 'update', 'destroy']);
        Route::resource('proveedores', ProveedorController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

        // ── Inventario ──
        Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
        Route::resource('productos', ProductoController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::patch('/productos/{producto}/stock', [ProductoController::class, 'ajustarStock'])
            ->name('productos.stock');
        Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
        Route::post('/inventario/{producto}/movimiento', [InventarioController::class, 'movimiento'])->name('inventario.movimiento');

        // ── Comercial ──
        Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
        Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
        Route::get('/ventas/{venta}', [VentaController::class, 'show'])->name('ventas.show');
        Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
        Route::get('/reportes/imprimir', [ReporteController::class, 'imprimir'])->name('reportes.imprimir');
    });

});
