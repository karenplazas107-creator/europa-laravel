# Módulo de Gestión de Productos (Laravel)

El módulo de **Gestión de Productos** es el corazón operativo del catálogo de **Almacén Europa**. Permite la administración integral del ciclo de vida de los artículos comerciales, control de márgenes de ganancia, gestión de imágenes multimedia y asociación con categorías.

---

## 1. Componentes Técnicos Involucrados

| Componente | Archivo en el Proyecto | Responsabilidad |
|---|---|---|
| **Controlador** | `app/Http/Controllers/ProductoController.php` | Operaciones CRUD, procesamiento de imágenes y control de stock |
| **Modelos** | `app/Models/Producto.php`<br>`app/Models/Categoria.php` | Modelos Eloquent con relaciones `belongsTo` y scopes de consulta |
| **Rutas Web** | `routes/web.php` | Recursos RESTful agrupados: `/productos`, `/productos/create`, `/productos/{id}/edit`, etc. |
| **Almacenamiento** | `storage/app/public/productos/` | Disco de almacenamiento público para fotografías y fichas de producto |
| **Vistas Blade** | `resources/views/productos/index.blade.php`<br>`resources/views/productos/create.blade.php`<br>`resources/views/productos/edit.blade.php` | Formularios de captura de datos y paneles de inventario |

---

## 2. Endpoints y Enrutamiento (`routes/web.php`)

```php
Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::post('/productos/{id}/stock', [ProductoController::class, 'ajustarStock'])->name('productos.stock');
});
```

---

## 3. Funcionalidades del Módulo

### A. Estructura y Validación de Datos (`store` / `update`)
Al registrar o actualizar un producto, Laravel valida las reglas de negocio estrictamente:
- **Datos Comerciales:** Nombre obligatorio (`max:120`), descripción detallada (`max:500`) y código de barras único (`unique:products,codigo_barras`).
- **Control de Precios:** `precio_compra` y `precio_venta` validados como valores numéricos no negativos. La diferencia define el margen bruto del negocio.
- **Categorización:** Validación de existencia con clave foránea en la tabla categorías (`exists:categories,categoria`).
- **Existencias:** `stock` inicial entero y `stock_minimo` de seguridad.

### B. Gestión y Almacenamiento Seguro de Imágenes
El controlador maneja el almacenamiento de imágenes en el disco público de Laravel:
```php
if ($request->hasFile('imagen')) {
    // Si es edición y ya tenía imagen, se borra el archivo previo para ahorrar espacio en disco
    if (!empty($producto->imagen) && Storage::disk('public')->exists($producto->imagen)) {
        Storage::disk('public')->delete($producto->imagen);
    }
    $data['imagen'] = $request->file('imagen')->store('productos', 'public');
}
```
Se admiten formatos `jpg`, `jpeg`, `png`, `webp` con un tamaño máximo de 2MB.

### C. Eliminación Segura (`destroy`)
Al eliminar un producto, el controlador ejecuta una limpieza completa:
1. Elimina el archivo multimedia físico asociado en `storage/app/public/productos/`.
2. Elimina el registro del producto en la tabla `products`.
3. Notifica al usuario con un mensaje Flash en la sesión.

---

## 4. Roles y Seguridad

- **Administrador y Bodeguero:** Tienen permisos completos de creación, edición, asignación de precios y eliminación de referencias.
- **Vendedor:** Puede consultar fichas técnicas y precios para cotizar a clientes sin permisos de modificación estructural.
