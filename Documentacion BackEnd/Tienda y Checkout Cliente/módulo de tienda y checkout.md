# Módulo de Tienda Virtual y Checkout del Cliente (Laravel)

El módulo de **Tienda Virtual y Checkout** proporciona una experiencia de comercio electrónico moderna, rápida e intuitiva para los clientes de **Almacén Europa**, incluyendo catálogo con filtros en vivo, carrito deslizante (*slide-over drawer*), pasarela de pago inspirada en Shopify con métodos colombianos y motor de cupones de descuento.

---

## 1. Componentes Técnicos Involucrados

| Componente | Archivo en el Proyecto | Responsabilidad |
|---|---|---|
| **Controlador** | `app/Http/Controllers/TiendaClienteController.php` | Renderizado de la tienda, visualización del checkout, procesamiento transaccional de pedidos y comprobante de confirmación |
| **Modelos** | `app/Models/Producto.php`<br>`app/Models/Categoria.php`<br>`app/Models/Venta.php`<br>`app/Models/DetalleVenta.php`<br>`app/Models/User.php` | Modelos de persistencia de inventario, usuarios y ventas |
| **Rutas Web** | `routes/web.php` | `/tienda`, `/checkout` (GET/POST), `/pedido-confirmado/{id}` |
| **Almacenamiento Local** | `localStorage ('europa_cart_items')` | Persistencia del carrito en el navegador del cliente sin saturar la sesión |
| **Vistas Blade** | `resources/views/cliente/tienda.blade.php`<br>`resources/views/cliente/checkout.blade.php`<br>`resources/views/cliente/confirmado.blade.php` | Interfaces e-commerce con diseño premium, tipografías Google Fonts (Inter / Outfit) y microinteracciones |

---

## 2. Endpoints y Enrutamiento (`routes/web.php`)

```php
Route::middleware('auth')->group(function () {
    // Experiencia exclusiva del cliente
    Route::get('/tienda', [TiendaClienteController::class, 'index'])->name('tienda');
    Route::get('/checkout', [TiendaClienteController::class, 'showCheckout'])->name('checkout');
    Route::post('/checkout', [TiendaClienteController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/pedido-confirmado/{id}', [TiendaClienteController::class, 'pedidoConfirmado'])->name('checkout.confirmado');
});
```

---

## 3. Funcionalidades de la Tienda Virtual (`/tienda`)

### A. Catálogo Interactivo y Filtrado Instantáneo
- **Buscador en Vivo:** Permite buscar productos por nombre o descripción con filtrado en tiempo real sin recargar la página.
- **Píldoras de Categorías:** Chips interactivos para filtrar rápidamente por colecciones (Fragancias, Cuidado Facial, etc.).
- **Badges de Stock y Precios:** Muestra disponibilidad real, impidiendo agregar productos agotados.

### B. Carrito Deslizante (*Slide-Over Drawer*)
- Despliegue suave desde el costado derecho con backdrop difuminado.
- Controles interactivos de cantidad (`+` / `-`) y eliminación de artículos.
- Cálculo de subtotal en tiempo real.
- Persistencia automática en el navegador mediante `localStorage.setItem('europa_cart_items', ...)` para que el cliente no pierda sus productos al navegar o refrescar.

---

## 4. Pasarela de Pago y Checkout Estilo Shopify (`/checkout`)

La pantalla de checkout implementa una arquitectura de dos columnas inspirada en las mejores prácticas de Shopify:

### Columna Izquierda: Formulario de Despacho y Pagos
1. **Contacto:** Correo electrónico o número celular del cliente autenticado.
2. **Entrega en Colombia:** Nombre, apellidos, documento de identidad (Cédula de Ciudadanía), dirección domiciliaria con complemento opcional, ciudad y selector de departamentos de Colombia.
3. **Métodos de Pago Colombianos en Acordeón:**
   - **PSE / Addi:** Débito bancario en línea y crédito sin tarjeta.
   - **Wompi (Bancolombia):** Tarjetas de crédito y débito Visa, Mastercard y American Express.
   - **Pago Contra Entrega:** Pago en efectivo directamente al repartidor domiciliario.
   - **Transferencia Bancaria / Nequi / Daviplata:** Instrucciones inmediatas para transferir a cuentas corporativas.

### Columna Derecha: Resumen de Compra y Cupones
- **Lista de Productos:** Miniaturas, títulos, categorías, cantidades y subtotales.
- **Motor de Cupones de Descuento:**
  - Validación en vivo sin alertas invasivas del navegador (cero `alert()`).
  - Avisos sutiles en línea (verde para éxito, ámbar para advertencias).
  - Códigos promocionales como **`EUROPA10`** descuentan automáticamente un **10%** del subtotal, actualizando el botón *"Pagar ahora"*.
- **Desglose Transparente:** Subtotal, descuento aplicado, costo de envío (Gratis) y Total Final en pesos colombianos (COP).

---

## 5. Procesamiento Transaccional y Confirmación (`processCheckout`)

Al pulsar *"Pagar ahora"*, el formulario envía la orden vía AJAX POST a `TiendaClienteController@processCheckout`:

```php
$venta = DB::transaction(function () use ($request) {
    // 1. Bloqueo y verificación de stock para cada artículo
    foreach ($request->input('items') as $item) {
        $prod = Producto::where('productos', $item['producto_id'])->lockForUpdate()->firstOrFail();
        if ($prod->stock < $item['cantidad']) {
            throw new \RuntimeException("Stock insuficiente para '{$prod->nombre}'.");
        }
        $totalVenta += ($prod->precio_venta * $item['cantidad']);
    }

    // 2. Validación de cupón de descuento
    $cupon = strtoupper(trim((string) $request->input('cupon', '')));
    if ($cupon === 'EUROPA10') {
        $descuento = round($totalVenta * 0.10, 2);
        $totalVenta = max(0.0, $totalVenta - $descuento);
    }

    // 3. Creación de la venta con datos de envío
    $venta = Venta::create([
        'usuario' => Auth::user()->usuario,
        'fecha' => now()->toDateString(),
        'total' => $totalVenta,
        'metodo_pago' => $nombreMetodo,
        'direccion_envio' => $direccionCompleta,
        'ciudad' => $request->input('ciudad'),
        'departamento' => $request->input('departamento'),
        'documento' => $request->input('documento'),
        'telefono' => $request->input('telefono'),
        'estado' => ($metodoRaw === 'contraentrega') ? 'pendiente_entrega' : 'pagado',
    ]);

    // 4. Detalle y deducción atómica de inventario
    foreach ($detalles as $d) {
        DetalleVenta::create([...]);
        $d['producto']->decrement('stock', $d['cantidad']);
    }

    return $venta;
});
```

Tras la confirmación exitosa, JavaScript limpia el carrito en `localStorage` y redirige al cliente a `/pedido-confirmado/{id}`, donde visualiza su número de orden (`#0000XX`), datos de despacho, desglose de compra y un botón directo para imprimir su factura.
