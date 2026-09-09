<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ProductoController;

/* ══════════════════════════════════════════
   RUTAS PÚBLICAS
══════════════════════════════════════════ */

// Página principal
Route::get('/', function () {
    return view('home');
})->name('home');

// Promociones
Route::get('/promociones', function () {
    return view('home');
})->name('promociones');

// Carrito
Route::get('/carrito', function () {
    return view('home');
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

    // Dashboard principal
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // ── Gestión ──
    Route::resource('clientes',    ClienteController::class)
         ->only(['index', 'edit', 'update', 'destroy']);
    Route::resource('proveedores', ProveedorController::class)
         ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // ── Inventario ──
    Route::get('/catalogo',   [CatalogoController::class, 'index'])->name('catalogo.index');
    Route::resource('productos', ProductoController::class)
         ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::patch('/productos/{producto}/stock', [ProductoController::class, 'ajustarStock'])
         ->name('productos.stock');
    Route::get('/inventario', fn() => view('dashboard.index'))->name('inventario.index');

    // ── Comercial ──
    Route::get('/ventas',   fn() => view('dashboard.index'))->name('ventas.index');
    Route::get('/reportes', fn() => view('dashboard.index'))->name('reportes.index');

});
