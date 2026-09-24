# Documentación Técnica del Sistema Backend — Almacén Europa (Laravel)

Bienvenido a la documentación oficial del backend y arquitectura de software de **Almacén Europa**, desarrollado sobre **Laravel 11** y **PHP 8.3**.

Este repositorio centraliza tanto la operación física interna (Terminal Punto de Venta, Inventarios, Catálogos, Compras y Analítica) como la experiencia digital de comercio electrónico (Tienda Virtual, Carrito interactivo y Checkout estilo Shopify).

---

## 1. Ficha Técnica del Proyecto

- **Framework Backend:** Laravel 11.x
- **Lenguaje:** PHP 8.3
- **Base de Datos:** MySQL / SQLite con Eloquent ORM
- **Motor de Plantillas:** Laravel Blade Engine
- **Estilos y Frontend:** CSS Modular Premium + Inter & Outfit Google Fonts
- **Librerías Visuales:** Chart.js (Analítica y Reportes)
- **Control de Código y Estilo:** Laravel Pint (`vendor/bin/pint`)
- **Suite de Pruebas Automatizadas:** PHPUnit Feature & Unit Tests (`php artisan test`)

---

## 2. Mapa de Módulos del Sistema

| # | Módulo | Documento de Detalle | Controlador Principal |
|---|---|---|---|
| **01** | **Acceso y Autenticación** | [puerta de entrada al sistema.md](./Acceso%20al%20Sistema/puerta%20de%20entrada%20al%20sistema.md) | `AuthController.php` |
| **02** | **Gestión de Catálogo** | [módulo de catálogo.md](./Gestión%20de%20Catálogo/módulo%20de%20catálogo.md) | `CatalogoController.php` |
| **03** | **Gestión de Clientes** | [módulo de clientes.md](./Gestión%20de%20Clientes/módulo%20de%20clientes.md) | `ClienteController.php` |
| **04** | **Gestión de Inventario** | [módulo de inventario.md](./Gestión%20de%20Inventario/módulo%20de%20inventario.md) | `InventarioController.php` |
| **05** | **Gestión de Productos** | [módulo de productos.md](./Gestión%20de%20Productos/módulo%20de%20productos.md) | `ProductoController.php` |
| **06** | **Gestión de Proveedores** | [módulo de proveedores.md](./Gestión%20de%20Proveedores/módulo%20de%20proveedores.md) | `ProveedorController.php` |
| **07** | **Gestión de Usuarios y Roles** | [módulo de usuario.md](./Gestión%20de%20Usuarios/módulo%20de%20usuario.md) | `UsuarioController.php` |
| **08** | **Gestión de Ventas y POS** | [módulo de ventas.md](./Gestión%20de%20Ventas/módulo%20de%20ventas.md) | `VentaController.php` |
| **09** | **Informes y Reportes** | [módulo de reportes.md](./Informes%20y%20Reportes/módulo%20de%20reportes.md) | `ReporteController.php` |
| **10** | **Tienda Virtual y Checkout** | [módulo de tienda y checkout.md](./Tienda%20y%20Checkout%20Cliente/módulo%20de%20tienda%20y%20checkout.md) | `TiendaClienteController.php` |

---

## 3. Modelo de Control de Acceso Basado en Roles (RBAC)

El sistema implementa middlewares en cascada para segregar permisos y proteger los recursos según el tipo de usuario:

```
[ Visitante ] ───► /login, /register, / (Landing pública)
      │
  (Autenticado)
      ├── Rol 'cliente'  ───────────► /tienda, /checkout, /pedido-confirmado/*
      └── Rol 'staff'
            ├── 'administrador' ────► Acceso total (Usuarios, Reportes, Configuración, etc.)
            ├── 'vendedor'      ────► /ventas (POS), /catalogo, /productos, /reportes
            └── 'auxiliar_bodega' ──► /inventario, /productos, /proveedores, /catalogo
```

---

## 4. Estructura de la Base de Datos (Tablas Clave)

- **`users`:** Cuentas de usuario con roles (`admin`, `vendedor`, `auxiliar_bodega`, `cliente`), correo único, móvil y contraseñas hasheadas en Bcrypt.
- **`categories`:** Categorías comerciales de clasificación de productos.
- **`products`:** Catálogo de artículos con código de barras, precio de compra, precio de venta, categoría, stock actual, stock mínimo e imagen.
- **`suppliers`:** Proveedores de mercancía con datos de contacto (NIT, email, teléfono, dirección).
- **`sales`:** Cabeceras de venta física y pedidos e-commerce con cliente/cajero, total, método de pago, dirección de envío, ciudad, notas y estado.
- **`detalle_ventas`:** Líneas de factura vinculadas a cada venta (`producto`, `cantidad`, `precio`).
- **`inventarios` / `movimientos_stock`:** Trazabilidad de existencias físicas y auditoría de variaciones de stock.

---

## 5. Medidas de Seguridad y Buenas Prácticas

1. **Protección CSRF:** Activada en todos los formularios y llamadas Fetch mediante directiva `@csrf` y meta-tags.
2. **Transacciones Atómicas (`DB::transaction`):** Las ventas y deducciones de stock se ejecutan en transacciones aisladas con bloqueo pesimista (`lockForUpdate`), garantizando que jamás se facture mercancía sin existencias.
3. **Cero Popups Invasivos:** La aplicación utiliza diseño responsivo, hojas de estilo `@media print` para impresión en la misma ventana y alertas sutiles en línea sin los disruptivos `alert()` del navegador.
4. **Validación de Formularios de Laravel:** Validación granular en el servidor de tipos de datos, longitudes, unicidad de correos/móviles y formatos de archivos multimedia.
