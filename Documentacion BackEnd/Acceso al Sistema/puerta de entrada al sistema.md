# Puerta de Entrada y Autenticación del Sistema (Laravel)

El módulo de acceso y autenticación gestiona la seguridad perimetral de **Almacén Europa**, el control de sesiones y el enrutamiento inteligente según el perfil o rol del usuario en la plataforma.

---

## 1. Arquitectura y Componentes Involucrados

| Componente | Ruta en el Proyecto | Responsabilidad |
|---|---|---|
| **Controlador** | `app/Http/Controllers/AuthController.php` | Control de login, registro, logout y redirección por roles |
| **Modelo** | `app/Models/User.php` | Representación Eloquent de la tabla `users` |
| **Rutas Web** | `routes/web.php` | Definición de endpoints (`/`, `/login`, `/register`, `/logout`) |
| **Middlewares** | `app/Http/Middleware/StaffMiddleware.php`<br>`app/Http/Middleware/AdminMiddleware.php`<br>`app/Http/Middleware/ClienteMiddleware.php` | Protección de rutas según el rol autenticado |
| **Vistas Blade** | `resources/views/home.blade.php`<br>`resources/views/auth/login.blade.php`<br>`resources/views/auth/register.blade.php` | Interfaces públicas y formularios con estilos modernos |

---

## 2. Endpoints y Enrutamiento (`routes/web.php`)

```php
// Rutas Públicas de Bienvenida
Route::get('/', [HomeController::class, 'index'])->name('home');

// Autenticación (Middleware 'guest' - solo usuarios no autenticados)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.post')->middleware('guest');

// Cierre de Sesión (Middleware 'auth' - requiere sesión activa)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
```

---

## 3. Funcionalidades del Módulo

### A. Autenticación Dual (Correo Electrónico o Móvil)
El método `login(Request $request)` de `AuthController` permite a los usuarios identificarse utilizando **tanto su correo electrónico como su número de teléfono celular**:

```php
$loginInput = $request->input('movil'); // Campo universal de ingreso
$campo = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'movil';

if (Auth::attempt([$campo => $loginInput, 'password' => $request->input('password')], $request->filled('remember'))) {
    $request->session()->regenerate();
    return $this->redirectByRole(Auth::user());
}
```

### B. Redirección Inteligente según el Rol (`redirectByRole`)
El sistema segrega automáticamente las vistas para garantizar que cada tipo de usuario acceda al entorno que le corresponde:

- **Rol `cliente`:** Es redirigido automáticamente a la experiencia e-commerce en `/tienda`. Si intenta entrar a la landing page pública o al panel administrativo, los middlewares lo mantienen en su tienda personalizada.
- **Roles Staff (`admin`, `vendedor`, `bodeguero`):** Son redirigidos al panel administrativo `/dashboard` (o al módulo de ventas/inventario correspondiente).

### C. Registro Autónomo de Clientes
Desde `resources/views/auth/register.blade.php`, cualquier visitante puede registrarse como comprador. El sistema:
1. Valida nombre, apellido, correo único, móvil único y contraseña mínima de 6 caracteres con confirmación.
2. Asigna automáticamente el rol `'cliente'` de forma segura en el servidor, evitando que un atacante intente auto-asignarse un rol administrativo.
3. Hashea la contraseña mediante el algoritmo seguro **Bcrypt** (`Hash::make()`).
4. Autentica de inmediato al nuevo usuario mediante `Auth::login($user)` y lo redirige a `/tienda`.

### D. Cierre de Sesión Seguro (`logout`)
El método `logout` invalida completamente la sesión activa, regenera el token CSRF para prevenir ataques de *Session Fixation* y redirige al usuario a la página de inicio:
```php
Auth::logout();
$request->session()->invalidate();
$request->session()->regenerateToken();
return redirect()->route('home');
```

---

## 4. Medidas de Seguridad Implementadas

1. **Protección CSRF:** Todos los formularios Blade incluyen la directiva `@csrf`, la cual genera un token criptográfico validado por el middleware de Laravel en cada petición POST.
2. **Cifrado de Credenciales:** Todas las contraseñas se almacenan mediante Bcrypt con coste computacional configurable.
3. **Regeneración de Sesión:** Tras un login exitoso, `$request->session()->regenerate()` destruye el ID de sesión anterior para evitar ataques de fijación de sesión.
4. **Middlewares de Acceso:** Las rutas administrativas están blindadas con el middleware `staff`, impidiendo el acceso a clientes no autorizados.
