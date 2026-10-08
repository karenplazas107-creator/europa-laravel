# Documentación y Manual General del Sistema — Almacén Europa

Bienvenido a la documentación y guía de funcionamiento de **Almacén Europa**. Este documento fue elaborado para explicar, de forma clara, detallada y paso a paso, cómo funciona cada uno de los módulos que componen esta plataforma integral de comercio y gestión.

El sistema fue diseñado para atender dos frentes principales del negocio:
1. **La Atención Física en el Local Comercial:** A través de una terminal de Punto de Venta (caja registradora moderna), control de bodegas, inventarios en tiempo real, registro de proveedores y reportes contables.
2. **La Tienda Virtual en Línea:** Para que cualquier persona pueda ingresar desde su celular o computador, consultar el catálogo de productos con fotos y precios, armar su carrito de compras y realizar su pedido a domicilio con diversos métodos de pago.

---

## 1. Mapa de Módulos del Sistema

Cada área del sistema cuenta con un documento detallado donde se explica paso a paso cómo se utiliza, qué ve el usuario en pantalla y cómo responde el sistema ante cada acción. A continuación se presentan los módulos disponibles:

| # | Módulo | ¿Qué hace en el sistema? | Documento Detallado |
|---|---|---|---|
| **01** | **Acceso y Registro** | Inicio de sesión inteligente (por correo o por celular), registro de nuevos clientes y cierre seguro de sesión. | [Ver explicación paso a paso](./Acceso%20al%20Sistema/puerta%20de%20entrada%20al%20sistema.md) |
| **02** | **Catálogo y Categorías** | Vitrina visual para que los empleados consulten productos por familias, fotos, precios y alertas de existencias. | [Ver explicación paso a paso](./Gestión%20de%20Catálogo/módulo%20de%20catálogo.md) |
| **03** | **Gestión de Clientes** | Directorio de compradores registrados, buscador en vivo, actualización de teléfonos o correos y restablecimiento de claves. | [Ver explicación paso a paso](./Gestión%20de%20Clientes/módulo%20de%20clientes.md) |
| **04** | **Control de Inventario** | Valorización económica del stock a costo, alertas de existencias bajas o agotadas, y registro de entradas, salidas o ajustes físicos. | [Ver explicación paso a paso](./Gestión%20de%20Inventario/módulo%20de%20inventario.md) |
| **05** | **Gestión de Productos** | Alta de referencias nuevas, lectura o asignación de código de barras, precios de compra y venta, fotos y márgenes de ganancia. | [Ver explicación paso a paso](./Gestión%20de%20Productos/módulo%20de%20productos.md) |
| **06** | **Gestión de Proveedores** | Directorio de distribuidores y socios comerciales mayoristas, con datos de contacto directo para reposición de mercancía. | [Ver explicación paso a paso](./Gestión%20de%20Proveedores/módulo%20de%20proveedores.md) |
| **07** | **Usuarios y Roles** | Panel del administrador para dar de alta empleados, asignarles cargos (vendedor, bodeguero, admin) y proteger las pantallas privadas. | [Ver explicación paso a paso](./Gestión%20de%20Usuarios/módulo%20de%20usuario.md) |
| **08** | **Ventas y Punto de Venta (POS)** | Caja registradora física para cobrar en mostrador con código de barras, cálculo automático de cambio e impresión de recibo. | [Ver explicación paso a paso](./Gestión%20de%20Ventas/módulo%20de%20ventas.md) |
| **09** | **Informes y Reportes** | Gráficos de ingresos mes a mes, ventas del día, top 5 de productos más vendidos, rendimiento del personal e impresión ejecutiva. | [Ver explicación paso a paso](./Informes%20y%20Reportes/módulo%20de%20reportes.md) |
| **10** | **Tienda Virtual y Checkout** | Experiencia e-commerce para clientes: catálogo digital, carrito deslizante, pagos colombianos (PSE, Addi, Wompi, Contra Entrega) y cupones. | [Ver explicación paso a paso](./Tienda%20y%20Checkout%20Cliente/módulo%20de%20tienda%20y%20checkout.md) |

---

## 2. Los Roles de Trabajo y sus Permisos

Para mantener el orden y la seguridad en la empresa, el sistema clasifica a las personas en 4 tipos de usuarios:

1. **Administrador General:**
   - Es el encargado general de la empresa.
   - Tiene acceso irrestricto a todas las pantallas: creación de empleados, estados financieros, inventario, reportes y configuración.

2. **Vendedor / Cajero:**
   - Su función principal es atender y facturar en el mostrador físico.
   - Tiene acceso al Punto de Venta (POS) para cobrar y generar recibos de compra, y al catálogo para asesorar a los compradores.

3. **Auxiliar de Bodega:**
   - Su función es el control físico de la mercancía.
   - Tiene acceso a la gestión de inventario para registrar ingresos de pedidos, dar de alta productos, supervisar proveedores y hacer ajustes de stock.

4. **Cliente:**
   - Es el comprador que accede por la página web.
   - Solo puede navegar por la tienda virtual, usar su carrito y pagar sus pedidos. El sistema le impide entrar a cualquier pantalla de administración interna.

---

## 3. El Flujo de Trabajo Diario en Almacén Europa

Para entender cómo se conectan todos los módulos entre sí, este es el recorrido que sigue la mercancía y la información en un día normal:

### 1. Entrada y Recepción de Mercancía:
- El camión del distribuidor llega al almacén con cajas de productos.
- El personal de bodega abre el módulo de **Proveedores** para verificar los datos de la empresa despachadora.
- En el módulo de **Productos** y de **Inventario**, registra la entrada de las unidades recibidas, asociando el código de barras y el costo al que se compró.
- El sistema suma esas unidades al inventario general y actualiza el valor del dinero invertido en mercancía.

### 2. Fijación de Precios y Catálogo:
- El administrador supervisa que cada producto tenga su precio de venta al público y su fotografía correspondiente.
- Inmediatamente, el producto queda visible tanto en el **Catálogo interno** de los empleados como en la **Tienda Virtual** de los clientes.

### 3. Venta Presencial en el Mostrador:
- Un cliente llega a la tienda física y pide un artículo.
- El vendedor abre el módulo de **Ventas / POS**, pasa el lector de código de barras sobre el producto y el sistema lo añade a la factura en vivo.
- El cliente paga en efectivo o tarjeta. Si paga en efectivo, el sistema le indica al cajero el valor exacto del cambio a devolver.
- Al confirmar el cobro, el sistema descuenta automáticamente las unidades de la bodega e imprime el recibo en la misma pantalla.

### 4. Venta en Línea a través de la Tienda Virtual:
- Un cliente entra desde su celular a la **Tienda Virtual**.
- Selecciona los productos, los añade a su carrito de compras y avanza al **Checkout**.
- Diligencia su dirección de entrega en Colombia, aplica su cupón de descuento si lo tiene y elige si pagar por PSE, tarjeta o pago contra entrega.
- Al presionar pagar, el sistema descuenta esas unidades del inventario para que no se vendan dos veces y genera el pedido con su número de orden para que bodega prepare el envío.

### 5. Cierre del Día y Análisis Gerencial:
- Al terminar la jornada, el administrador abre el módulo de **Informes y Reportes**.
- Comprueba cuánto dinero en efectivo y cuánto en medios digitales ingresó en el día para cuadrar la caja.
- Revisa qué productos fueron los más solicitados y genera un informe limpio en PDF para el archivo administrativo.
