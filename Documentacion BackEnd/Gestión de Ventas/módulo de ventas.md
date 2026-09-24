# Módulo de Gestión de Ventas y Punto de Venta (POS) (Laravel)

El módulo de **Ventas** es el motor transaccional de **Almacén Europa**. Integra una terminal de punto de venta (POS) rápida y moderna para atención física, control atómico de existencias y generación de recibos de venta.

---

## 1. Componentes Técnicos Involucrados

| Componente | Archivo en el Proyecto | Responsabilidad |
|---|---|---|
| **Controlador** | `app/Http/Controllers/VentaController.php` | Orquestación transaccional de la venta, bloqueo pesimista y cálculo de cambio |
| **Modelos** | `app/Models/Venta.php`<br>`app/Models/DetalleVenta.php`<br>`app/Models/Producto.php` | Modelos Eloquent relacionados mediante `hasMany` y `belongsTo` |
| **Rutas Web** | `routes/web.php` | `Route::get('/ventas', ...)`, `Route::post('/ventas', ...)`, `Route::get('/ventas/{id}', ...)` |
| **Tablas BD** | `sales`, `detalle_ventas`, `products` | Tablas relacionales con llaves foráneas y control de integridad |
| **Vista Principal** | `resources/views/ventas/index.blade.php` | Terminal POS interactiva de doble columna (catálogo visual y factura en vivo) |

---

## 2. Endpoints y Enrutamiento (`routes/web.php`)

```php
Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
    Route::get('/ventas/{id}', [VentaController::class, 'show'])->name('ventas.show');
});
```

---

## 3. Funcionalidades de la Terminal POS

### A. Carrito de Facturación en Vivo
La interfaz permite:
- Búsqueda instantánea de productos por nombre o lectura con pistola de código de barras.
- Adición con un solo clic al carrito lateral.
- Ajuste de cantidades con validación automática contra el stock máximo disponible.
- Cálculo de subtotal, descuentos e IVA en tiempo real.

### B. Múltiples Medios de Pago y Calculadora de Cambio
El cajero puede seleccionar el método de liquidación:
- **Efectivo:** Incluye cálculo dinámico de cambio (*vueltas*) al digitar el dinero recibido por el cliente.
- **Tarjeta Débito / Crédito:** Liquidación electrónica vía datáfono.
- **Transferencia Bancaria / Nequi / Daviplata:** Pagos inmediatos por QR o transferencia.

---

## 4. Lógica Transaccional y Control de Concurrencia (`DB::transaction`)

Para evitar problemas de sobreventa (vender productos sin existencias por peticiones simultáneas), el método `store` implementa **bloqueo pesimista** a nivel de base de datos (`lockForUpdate`):

```php
$venta = DB::transaction(function () use ($request) {
    $totalVenta = 0;
    $itemsData = [];

    // 1. Validar existencias con bloqueo pesimista
    foreach ($request->input('items') as $item) {
        $prod = Producto::lockForUpdate()->findOrFail($item['producto_id']);
        $cantidad = (int) $item['cantidad'];

        if ($prod->stock < $cantidad) {
            throw new \RuntimeException("Stock insuficiente para \"{$prod->nombre}\". Disponible: {$prod->stock} uds.");
        }

        $subtotal = $cantidad * $prod->precio_venta;
        $totalVenta += $subtotal;

        $itemsData[] = [
            'producto' => $prod,
            'cantidad' => $cantidad,
            'precio' => $prod->precio_venta,
        ];
    }

    // 2. Registrar cabecera en la tabla sales
    $venta = Venta::create([
        'usuario' => Auth::user()->usuario,
        'fecha' => now()->toDateString(),
        'total' => $totalVenta,
        'metodo_pago' => $request->input('metodo_pago'),
    ]);

    // 3. Crear líneas de detalle y descontar inventario
    foreach ($itemsData as $it) {
        DetalleVenta::create([
            'venta' => $venta->ventas,
            'producto' => $it['producto']->productos,
            'cantidad' => $it['cantidad'],
            'precio' => $it['precio'],
        ]);

        // Reducción atómica de inventario
        $it['producto']->decrement('stock', $it['cantidad']);
    }

    return $venta;
});
```

Si cualquier producto no tiene existencias suficientes, la transacción ejecuta un `ROLLBACK` automático, impidiendo registros huérfanos o ventas fantasmas.

---

## 5. Impresión de Comprobante de Venta

El sistema genera un ticket de venta profesional con número correlativo, desglose de ítems, totales, cajero responsable y fecha. Cuenta con estilos de impresión optimizados (`@media print`) para **imprimirse directamente en la misma ventana del navegador**, eliminando ventanas emergentes o popups bloqueados por el navegador.
