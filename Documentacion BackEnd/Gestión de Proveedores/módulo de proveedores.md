# Módulo de Gestión de Proveedores (Laravel)

El módulo de **Gestión de Proveedores** administra la red de abastecimiento y relaciones comerciales con los distribuidores de **Almacén Europa**, asegurando información de contacto verificada y trazabilidad en el suministro de productos.

---

## 1. Componentes Técnicos Involucrados

| Componente | Archivo en el Proyecto | Responsabilidad |
|---|---|---|
| **Controlador** | `app/Http/Controllers/ProveedorController.php` | Operaciones CRUD y validación de unicidad de proveedores |
| **Modelo** | `app/Models/Proveedor.php` | Representa la tabla `suppliers` con clave primaria `proveedores` |
| **Rutas Web** | `routes/web.php` | Endpoints RESTful: `/proveedores`, `/proveedores/create`, `/proveedores/{id}/edit`, etc. |
| **Vistas Blade** | `resources/views/proveedores/index.blade.php`<br>`resources/views/proveedores/create.blade.php`<br>`resources/views/proveedores/edit.blade.php` | Interfaces de directorio, métricas y formularios de captura |

---

## 2. Endpoints y Enrutamiento (`routes/web.php`)

```php
Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
    Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
    Route::get('/proveedores/{id}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
    Route::put('/proveedores/{id}', [ProveedorController::class, 'update'])->name('proveedores.update');
    Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
});
```

---

## 3. Funcionalidades del Módulo

### A. Directorio Centralizado y Búsqueda Rápida
El método `index` permite localizar proveedores por:
- Nombre o razón social de la empresa.
- Correo electrónico corporativo.
- Teléfono o celular de contacto.
- Dirección física.

Además, calcula métricas inmediatas:
- **Total Proveedores:** Conteo general de socios comerciales.
- **Con Email Registrado:** Proveedores disponibles para comunicaciones digitales.
- **Con Teléfono Registrado:** Proveedores con línea directa de pedidos.

### B. Registro y Validación de Proveedores (`store`)
Para evitar duplicidades en el directorio, se exige:
```php
$request->validate([
    'nombre' => ['required', 'string', 'max:120'],
    'telefono' => ['required', 'string', 'max:20'],
    'email' => ['required', 'email', 'max:120', 'unique:suppliers,email'],
    'direccion' => ['required', 'string', 'max:255'],
]);
```

### C. Actualización de Datos (`update`)
Utiliza la regla `Rule::unique` de Laravel ignorando la clave primaria del registro actual (`$proveedor->proveedores`), lo que permite modificar el nombre, teléfono o dirección sin provocar colisiones con su propio correo registrado.

### D. Eliminación Controlada (`destroy`)
Permite remover registros obsoletos previa confirmación en la interfaz, enviando una notificación Flash a la sesión del usuario.

---

## 4. Roles y Seguridad

- **Administrador y Bodeguero:** Tienen acceso autorizado para consultar y actualizar el directorio de compras.
- **Protección Middleware:** Las rutas están protegidas por `auth` y `staff`, impidiendo que usuarios con rol de cliente visualicen información comercial o datos de contacto de los proveedores.
