# Módulo de Gestión de Ventas y Punto de Venta (POS)

Este módulo es el motor comercial de **Almacén Europa**. Funciona como la terminal de caja registradora moderna (Punto de Venta) para atender a los clientes que visitan la tienda física, cobrar sus compras rápidamente, calcular el cambio exacto, descontar de inmediato la mercancía del inventario e imprimir el comprobante de venta.

---

## 1. ¿Para qué sirve este módulo?

Este módulo agiliza todo el proceso de atención y cobro en el mostrador:
- Permite facturar las ventas del día de forma rápida e intuitiva.
- Cuenta con un carrito de cobro interactivo que calcula subtotales, totales y cambio en vivo.
- Soporta tanto la búsqueda de productos por nombre como la lectura automática con pistola de código de barras.
- Descuenta automáticamente las unidades de la bodega al confirmar la venta para que nunca haya discrepancias en el inventario.
- Permite registrar el pago con distintos métodos (Efectivo, Tarjeta, Transferencia a Nequi, Daviplata, Bancolombia).
- Genera un recibo de compra listo para imprimir directamente en la misma pantalla sin ventanas molestas.

---

## 2. ¿Quiénes utilizan este módulo?

- **Vendedores y Cajeros:** Es su herramienta principal de trabajo diario para registrar las compras de los clientes.
- **Administrador:** Puede realizar ventas y también consultar el historial completo de transacciones para auditar la facturación.

---

## 3. La pantalla de Punto de Venta (Estructura de dos columnas)

Para que el cajero trabaje con comodidad sin perder de vista al cliente, la pantalla está dividida en dos secciones muy claras:
- **Columna Izquierda (Catálogo y Búsqueda):** Muestra los productos con sus fotos y precios, junto a un buscador rápido y botones de categorías para encontrar cualquier artículo en un segundo.
- **Columna Derecha (La Factura en Vivo):** Es el ticket o cuenta que se le va sumando al cliente, donde se ven los productos agregados, la cantidad de unidades, el total acumulado y los botones de cobro.

---

## 4. Paso a paso: Cómo se realiza una Venta Presencial

El cobro en el mostrador sigue un proceso muy sencillo y fluido:

### Paso 1: Ingreso a la pantalla de ventas
El vendedor hace clic en la opción **"Ventas / POS"** en el menú. Se carga de inmediato la terminal de cobro lista para empezar a facturar.

### Paso 2: Agregar productos a la cuenta
El cajero puede sumar productos al ticket de dos maneras:
1. **Con lector de código de barras:** Simplemente pasa la pistola sobre la etiqueta del producto. El sistema reconoce el código, emite un sonido suave y agrega el artículo automáticamente a la factura.
2. **Haciendo clic en la pantalla:** Busca el producto en la columna izquierda por su nombre o foto y le da clic. Cada clic suma una unidad a la cuenta.

**Control de existencias en vivo:**  
El cajero puede aumentar o disminuir las cantidades con los botones `+` y `-` en la cuenta. Si intenta agregar más unidades de las que realmente hay en la bodega, el sistema le avisa con un mensaje y no le permite superar el stock real, evitando vender productos que no existen físicamente.

### Paso 3: Selección del método de pago
Una vez que el cliente terminó de elegir sus productos, el cajero selecciona cómo va a pagar:
- **Pago en Efectivo:**
  - El sistema muestra una casilla para escribir cuánto dinero en billetes entrega el cliente (por ejemplo, si la compra es de $70.000 y entregan un billete de $100.000).
  - El sistema calcula de forma instantánea el cambio o "vueltas" exactas que hay que devolverle al comprador ($30.000), evitando cualquier error de cálculo mental.
- **Pago con Tarjeta de Débito o Crédito:**
  - Se procesa el pago a través del datáfono físico de la tienda y se marca la opción en pantalla.
- **Transferencia Digital (Nequi, Daviplata o Bancolombia):**
  - El cliente realiza la transferencia mediante código QR o número telefónico del almacén. El cajero verifica en su celular que el dinero haya ingresado y selecciona este medio.

### Paso 4: Finalización y confirmación de la venta
Cuando el pago está listo, el vendedor presiona el botón destacado **"Cobrar / Finalizar Venta"**:
1. El sistema realiza una comprobación interna para verificar que todas las unidades sigan disponibles.
2. Descuenta de inmediato las unidades del stock en la bodega general para que nadie más las pueda vender.
3. Guarda la venta con el número de factura correspondiente, la fecha, la hora exacta, el cajero que atendió y el desglose de productos.
4. Muestra un mensaje verde confirmando que la transacción fue exitosa.

### Paso 5: Generación e impresión del comprobante de venta
Inmediatamente después de completarse la venta:
- Se genera en pantalla el recibo o ticket de compra formal, que incluye:
  - Nombre y datos de contacto de Almacén Europa.
  - Número correlativo de recibo (ejemplo: Factura #00125).
  - Fecha y hora.
  - Nombre del cajero o vendedor.
  - Lista detallada de productos con cantidad, precio unitario y subtotal.
  - Método de pago utilizado y el total liquidado.
- El sistema cuenta con un botón directo de **"Imprimir Recibo"**. Al pulsarlo, se abre el diálogo de impresión directamente en la misma ventana del navegador, sin molestas pestañas emergentes ni ventanas que se bloqueen, quedando listo para entregar al cliente.

---

## 5. Paso a paso: Cómo consultar el historial de Ventas

Si se necesita revisar una venta realizada anteriormente o reimprimir un recibo:
1. Se accede a la lista general de ventas en el menú.
2. Se muestra una tabla con todas las transacciones ordenadas de la más reciente a la más antigua.
3. Se puede ver el número de recibo, la fecha, el cajero responsable, el medio de pago y el monto total cobrado.
4. Al hacer clic sobre cualquier venta, se abre el detalle completo con la opción de volver a imprimir el comprobante si el cliente lo solicita.
