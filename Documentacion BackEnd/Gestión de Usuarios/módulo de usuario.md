# Módulo de Gestión de Usuarios y Roles (Laravel)

El módulo de **Gestión de Usuarios** es el centro de control de personal y seguridad de **Almacén Europa**. Permite al Administrador dar de alta colaboradores, asignar roles operativos y mantener el principio de privilegio mínimo en el sistema.

---

## 1. Componentes Técnicos Involucrados

| Componente | Archivo en el Proyecto | Responsabilidad |
|---|---|---|
| **Controlador** | `app/Http/Controllers/UsuarioController.php` | Lógica de alta, actualización de perfiles, asignación de roles y bajas de personal |
| **Modelo** | `app/Models/User.php` | Modelo Eloquent de la tabla `users` con métodos auxiliares de rol (`isAdmin`, `isStaff`, `isCliente`, `rolesDisponibles`) |
| **Middlewares** | `app/Http/Middleware/AdminMiddleware.php`<br>`app/Http/Middleware/StaffMiddleware.php` | Restricción de acceso exclusivo para administradores |
| **Rutas Web** | `routes/web.php` | Endpoints RESTful protegidos: `/usuarios`, `/usuarios/create`, `/usuarios/{id}/edit`, etc. |
| **Vistas Blade** | `resources/views/usuarios/index.blade.php`<br>`resources/views/usuarios/create.blade.php`<br>`resources/views/usuarios/edit.blade.php` | Tableros administrativos con tarjetas métricas, filtros y modales |

---

## 2. Roles del Sistema (RBAC)

El sistema define 4 roles con responsabilidades claramente delimitadas:

| Rol Técnico | Nombre Visible | Responsabilidades y Acceso |
|---|---|---|
| `administrador` / `admin` | **Administrador General** | Acceso irrestricto a todos los módulos: creación de personal, finanzas, inventarios y configuración |
| `vendedor` | **Vendedor / Cajero** | Terminal POS de ventas, consulta de stock y catálogo de productos |
| `auxiliar_bodega` / `bodeguero` | **Auxiliar de Bodega** | Movimientos de inventario, ajustes de stock, catálogo de productos y gestión de proveedores |
| `cliente` | **Cliente / Comprador** | Portal e-commerce público, catálogo virtual, carrito interactivo y pasarela de checkout |

---

## 3. Endpoints y Enrutamiento (`routes/web.php`)

```php
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});
```

---

## 4. Funcionalidades del Módulo

### A. Panel de Control y Métricas de Personal
La vista principal de usuarios despliega tarjetas de conteo dinámicas calculadas en el servidor:
- **Total de Usuarios:** Cuentas totales en la base de datos.
- **Administradores:** Personal directivo con acceso total.
- **Vendedores:** Personal de atención y facturación.
- **Personal de Bodega:** Operadores de inventario.
- **Clientes Registrados:** Compradores digitales.

### B. Creación de Usuarios por el Administrador (`store`)
Permite registrar colaboradores sin pasar por el formulario de clientes:
1. Valida nombre, apellido, correo único (opcional para vendedores físicos sin correo corporativo), número de teléfono móvil obligatorio y único.
2. Exige selección explícita del rol (`in:administrador,vendedor,auxiliar_bodega,cliente`).
3. Encripta la contraseña con `Hash::make()` (Bcrypt).
4. Persiste el registro y notifica con un mensaje Flash de éxito.

### C. Edición de Perfiles y Cambio de Roles (`update`)
Permite modificar los datos de cualquier colaborador o promoverlo/cambiarlo de rol. La contraseña es opcional; si no se suministra, el sistema conserva el hash anterior sin alteraciones.

### D. Protección contra Autoeliminación Accidental (`destroy`)
Para evitar que el administrador activo se elimine a sí mismo y bloquee el acceso al sistema, el controlador implementa una salvaguarda de seguridad:
```php
if ((string) $usuario->usuario === (string) Auth::user()->usuario) {
    return redirect()
        ->route('usuarios.index')
        ->with('error', 'No puedes eliminar tu propio usuario con sesión activa.');
}
```

---

## 5. Medidas de Seguridad

1. **Blindaje por Middleware (`AdminMiddleware`):** Incluso si un vendedor o cliente conoce la URL `/usuarios`, el middleware verifica `$user->isAdmin()`, rechazando la solicitud con error 403 o redirección forzada.
2. **Hasheo Unidireccional:** Las contraseñas nunca viajan en texto plano ni se guardan sin cifrado.
