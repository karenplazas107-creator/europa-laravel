# Módulo de Gestión de Clientes (Laravel)

El módulo de **Gestión de Clientes** permite al personal administrativo y comercial supervisar el directorio de compradores registrados en **Almacén Europa**, actualizar sus datos de contacto y auditar sus registros.

---

## 1. Componentes Técnicos Involucrados

| Componente | Archivo en el Proyecto | Responsabilidad |
|---|---|---|
| **Controlador** | `app/Http/Controllers/ClienteController.php` | Control de listado, edición, actualización y eliminación de clientes |
| **Modelo** | `app/Models/User.php` | Representa la entidad con filtro de negocio `where('rol', 'cliente')` |
| **Rutas Web** | `routes/web.php` | Rutas agrupadas bajo middleware `auth` y `staff`: `/clientes`, `/clientes/{id}/edit`, etc. |
| **Vistas Blade** | `resources/views/clientes/index.blade.php`<br>`resources/views/clientes/edit.blade.php` | Interfaces administrativas con tablas dinámicas, modales y formularios de edición |

---

## 2. Endpoints y Enrutamiento (`routes/web.php`)

```php
Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
});
```

---

## 3. Funcionalidades del Módulo

### A. Directorio y Búsqueda en Tiempo Real
El método `index(Request $request)` filtra exclusivamente a los usuarios con rol `'cliente'`:
```php
$clientes = User::where('rol', 'cliente')
    ->when($search, function ($query, $search) {
        $query->where(function ($q) use ($search) {
            $q->where('nombre', 'like', "%{$search}%")
                ->orWhere('apellido', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('movil', 'like', "%{$search}%");
        });
    })
    ->orderBy('nombre')
    ->get();
```
La interfaz complementa esto con filtrado instantáneo por JavaScript en el frontend para respuesta en cero milisegundos mientras el usuario escribe.

### B. Edición y Validación Segura de Datos
En `ClienteController@update`, se valida rigurosamente la integridad de los datos:
1. **Unicidad de Correo y Teléfono:** Se utiliza `Rule::unique('users', 'campo')->ignore($cliente->usuario, 'usuario')` para permitir conservar el correo/móvil propio sin disparar errores de duplicidad.
2. **Actualización Opcional de Contraseña:** Si el campo `password` se deja en blanco, la contraseña actual se mantiene intacta. Si se proporciona, se exige confirmación y mínimo 6 caracteres, aplicándose `Hash::make()`.

### C. Eliminación Controlada
El método `destroy` localiza al usuario asegurando que pertenezca al rol `'cliente'` mediante `findOrFail`, eliminándolo de la base de datos y retornando un mensaje de sesión tipo `flash` (`with('success', ...)`).

---

## 4. Roles y Seguridad

- **Acceso Exclusivo Staff:** Solo los usuarios con rol `admin`, `vendedor` o `bodeguero` pueden acceder a este módulo. Si un usuario con rol `cliente` intenta ingresar a `/clientes`, es interceptado por `StaffMiddleware` y redirigido a `/tienda`.
