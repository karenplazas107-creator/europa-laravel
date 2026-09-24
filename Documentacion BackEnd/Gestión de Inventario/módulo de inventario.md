# Módulo de Gestión de Inventario (Laravel)

El módulo de **Gestión de Inventario** de **Almacén Europa** es el centro de control físico y financiero de las existencias. Proporciona trazabilidad completa del stock, auditoría de capital invertido y operaciones de ajuste en tiempo real.

---

## 1. Componentes Técnicos Involucrados

| Componente | Archivo en el Proyecto | Responsabilidad |
|---|---|---|
| **Controlador** | `app/Http/Controllers/InventarioController.php` | Métricas financieras, filtrado por estado de salud y movimientos de existencias |
| **Modelos** | `app/Models/Producto.php`<br>`app/Models/Categoria.php` | Modelos de persistencia para stock, costos y clasificación |
| **Rutas Web** | `routes/web.php` | `Route::get('/inventario', ...)` y `Route::post('/inventario/{id}/movimiento', ...)` |
| **Vista Principal** | `resources/views/inventario/index.blade.php` | Panel con KPIs financieros, filtros multicriterio y modales de ajuste rápido |

---

## 2. Indicadores Financieros y Operativos (KPIs)

Al ingresar a la vista, el controlador calcula dinámicamente:
1. **Total de Referencias:** Cantidad de productos registrados en el sistema.
2. **Unidades Totales en Existencia:** Sumatoria absoluta de unidades físicas (`Producto::sum('stock')`).
3. **Valorización del Inventario:** Capital inmovilizado a precio de costo, calculado mediante:
   ```php
   $valorStock = Producto::selectRaw('SUM(stock * precio_compra) as total')->value('total');
   ```
4. **Stock Crítico / Bajo:** Conteo de productos con existencias por debajo del umbral de seguridad (`stock <= stock_minimo`).
5. **Agotados:** Artículos con stock en 0 unidades.

---

## 3. Operaciones de Movimiento de Stock (`InventarioController@movimiento`)

El sistema permite corregir y registrar variaciones físicas a través del endpoint `POST /inventario/{id}/movimiento`, aceptando tres tipos de operaciones:

| Tipo | Operación en el Servidor | Caso de Uso |
|---|---|---|
| **Entrada (`entrada`)** | `$producto->stock + $cantidad` | Recepción de pedidos de proveedores, devoluciones o hallazgos |
| **Salida (`salida`)** | `max(0, $producto->stock - $cantidad)` | Mermas, artículos dañados, muestras comerciales o mermas |
| **Ajuste Directo (`ajuste`)** | `$producto->stock = $cantidad` | Cuadre posterior a toma física de inventario |

### Validación y Respuesta Dual (JSON / Web)
El controlador valida que la cantidad no sea negativa y soporta tanto llamadas asíncronas vía Fetch/AJAX como peticiones tradicionales de formulario web:
```php
$request->validate([
    'tipo' => ['required', 'in:entrada,salida,ajuste'],
    'cantidad' => ['required', 'integer', 'min:0'],
    'stock_minimo' => ['nullable', 'integer', 'min:0'],
    'motivo' => ['nullable', 'string', 'max:255'],
]);
```

---

## 4. Clasificación Visual de Estados de Stock

En la interfaz de inventario se aplican insignias y estilos visuales basados en el stock:
- **Verde (Óptimo / Disponible):** `stock > stock_minimo`
- **Ámbar / Naranja (Bajo / Crítico):** `0 < stock <= stock_minimo` (Alerta para compras)
- **Rojo (Agotado):** `stock == 0` (No disponible para ventas)

---

## 5. Roles y Permisos

- **Administrador y Bodeguero:** Tienen permisos plenos para ejecutar movimientos de entrada, salida y ajustes directos.
- **Vendedor:** Puede consultar existencias y valorización para responder consultas de clientes, con restricciones operativas para alterar el inventario sin autorización.
