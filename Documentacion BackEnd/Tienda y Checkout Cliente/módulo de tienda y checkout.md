# Módulo de Tienda Virtual y Pago en Línea (Checkout)

Este módulo es la cara digital de **Almacén Europa** hacia el público. Funciona como una tienda virtual completa y moderna donde los clientes pueden navegar desde su celular o computador, descubrir productos, agregarlos a su carrito de compras y realizar su pedido a domicilio con total comodidad y seguridad.

---

## 1. ¿Para qué sirve este módulo?

Este módulo brinda una experiencia de compra en línea sencilla, rápida y atractiva:
- Permite a los clientes explorar el catálogo de productos con fotos de alta calidad y precios claros.
- Ofrece filtros rápidos por categorías y un buscador instantáneo que encuentra productos mientras se escribe.
- Cuenta con un carrito de compras interactivo que se despliega desde el lateral sin interrumpir la navegación.
- Recuerda los productos del carrito para que el cliente no los pierda si recarga la página o apaga el celular.
- Incluye una pantalla de pago limpia y moderna inspirada en tiendas de clase mundial (estilo Shopify).
- Recibe múltiples medios de pago colombianos (PSE, tarjetas de crédito/débito, transferencias y Pago Contra Entrega).
- Permite aplicar cupones de descuento automáticos (como el cupón `EUROPA10`).
- Genera un comprobante de orden confirmado con número de pedido (`#0000XX`) y opción de imprimir la factura.

---

## 2. ¿Quiénes utilizan este módulo?

- **Clientes / Compradores:** Son los usuarios principales de esta sección. Es el entorno diseñado exclusivamente para que elijan sus artículos y hagan sus pedidos.
- **Equipo de Despachos y Vendedores:** Reciben las órdenes confirmadas en el sistema para empaquetar los productos y enviarlos a la dirección indicada por el cliente.

---

## 3. Paso a paso: Cómo compra un Cliente en la Tienda Virtual

Todo el proceso de compra fue diseñado para ser muy amigable y consta de los siguientes pasos:

### Paso 1: Exploración del catálogo de la tienda
El cliente ingresa a la dirección de la tienda y se encuentra con un diseño visual moderno y organizado:
1. **Buscador en tiempo real:** Arriba puede escribir lo que desea encontrar (por ejemplo: *"Crema hidratante"* o *"Perfume"*) y los resultados aparecen al instante.
2. **Botones de categorías:** Si prefiere curiosear por secciones, puede presionar los botones superiores (Perfumería, Cuidado Facial, Maquillaje, etc.) para ver únicamente los productos de ese grupo.
3. **Disponibilidad clara:** Cada producto muestra su foto, su nombre, su precio y una etiqueta de disponibilidad. Si un producto no tiene existencias, aparece claramente como **"Agotado"** y el botón de compra se desactiva, evitando disgustos o cobros de cosas que no hay en bodega.

### Paso 2: Agregar artículos al Carrito de Compras
Cuando el cliente ve un producto que le gusta:
1. Presiona el botón **"Agregar al Carrito"**.
2. De inmediato se desliza suavemente un panel lateral desde la derecha (el Carrito Deslizante), mostrándole lo que lleva acumulado.
3. En este carrito el cliente puede:
   - Aumentar o disminuir las unidades con los botones `+` y `-`.
   - Eliminar un producto con el botón de papelera si cambió de opinión.
   - Ver el subtotal de su compra sumándose en tiempo real.
4. Puede cerrar el carrito y seguir navegando para agregar más artículos; el sistema guarda automáticamente sus productos para que no se borren aunque cierre el navegador.

### Paso 3: Pasar a la pantalla de Pago (Checkout)
Cuando el cliente está listo para comprar, abre su carrito y hace clic en el botón principal **"Continuar con el Pedido"** o **"Ir al Checkout"**.

Se abre una pantalla muy limpia y organizada en dos columnas:

#### Columna de la Izquierda: Datos de Entrega y Pago
El cliente diligencia sus datos para coordinar el despacho:
1. **Datos de Contacto:** Su nombre, apellido, correo electrónico y número de celular para llamarlo cuando vaya el repartidor.
2. **Documento de Identidad:** Cédula de ciudadanía o extranjería (necesaria para la facturación).
3. **Dirección de Entrega en Colombia:** Dirección completa de su casa u oficina, complemento (apartamento, torre o conjunto), su ciudad y el departamento correspondiente.
4. **Elección del Método de Pago:** El cliente selecciona la forma en que desea pagar entre las siguientes opciones:
   - **PSE:** Para pagar con débito desde su cuenta bancaria.
   - **Wompi / Tarjetas:** Para pagar con tarjeta de crédito o débito Visa, Mastercard o American Express.
   - **Transferencia Directa (Nequi / Daviplata):** Para transferir desde su celular a las cuentas oficiales de la tienda.
   - **Pago Contra Entrega:** Para pagar en efectivo directamente al mensajero cuando toque a su puerta con el paquete.

#### Columna de la Derecha: Resumen de la Orden y Cupones
En el lado derecho de la pantalla, el cliente ve en todo momento el resumen de lo que va a recibir:
- Las fotos en miniatura de cada artículo con su nombre y la cantidad de unidades.
- El costo del envío (con mensaje de envío gratis o tarifa fijada).
- **Casilla de Cupón de Descuento:**  
  Si el cliente tiene un código de promoción (por ejemplo, escribe el código **`EUROPA10`**), lo escribe y presiona **"Aplicar"**:
  - El sistema comprueba el código al instante sin ventanas emergentes molestas.
  - Le muestra un aviso verde de felicitación.
  - Le descuenta automáticamente el 10% del total de su compra y actualiza el valor a pagar de inmediato.
- **Total Final:** El precio final definitivo en pesos colombianos.

### Paso 4: Finalización del Pedido
El cliente presiona el botón destacado **"Pagar Ahora"** o **"Confirmar Pedido"**:
1. El sistema realiza una última verificación en la bodega para confirmar que las unidades sigan disponibles.
2. Descuenta automáticamente los productos del inventario general.
3. Si el método fue *Contra Entrega*, el pedido queda registrado en estado *"Pendiente de Entrega"*. Si fue por medios digitales, queda como *"Pagado"*.
4. Guarda toda la información de entrega, ciudad y teléfono para el repartidor.
5. Limpia el carrito de compras en el celular del cliente para que quede listo para futuras compras.

### Paso 5: Pantalla de Pedido Confirmado
El sistema redirige automáticamente al cliente a una pantalla de felicitación y confirmación:
- Se muestra en grande un mensaje verde de éxito: *"¡Gracias por tu compra!"*.
- Se le entrega su número oficial de orden (por ejemplo: Pedido `#000034`).
- Se presenta el resumen completo de lo comprado, el método de pago seleccionado y la dirección a donde se enviará el paquete.
- Cuenta con un botón para **"Imprimir Resumen / Factura"** si desea guardar un comprobante impreso o en PDF.
- Incluye un botón para **"Seguir Comprando"** que lo devuelve a la tienda cuando lo desee.
