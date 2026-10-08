# Módulo de Gestión de Inventario

Este módulo es el centro de control físico de la mercancía de **Almacén Europa**. Su función principal es llevar la cuenta exacta de cuántas unidades quedan de cada producto en las estanterías y bodegas, cuánto dinero tiene la empresa invertido en mercancía, y permitir registrar ingresos o salidas de productos en el día a día.

---

## 1. ¿Para qué sirve este módulo?

Este módulo resuelve las necesidades operativas de la bodega:
- Muestra el valor total del dinero invertido en mercancía a precio de costo.
- Permite conocer la cantidad exacta de unidades físicas disponibles para cada producto.
- Enciende alertas visuales automáticas cuando un producto tiene pocas existencias o cuando se agotó por completo.
- Permite registrar la llegada de nueva mercancía que traen los proveedores (entradas).
- Permite registrar salidas por mercancía dañada, vencida o entregada como muestra (salidas).
- Permite hacer ajustes directos de conteo cuando se hace una auditoría física en las estanterías (ajuste de inventario).

---

## 2. ¿Quiénes utilizan este módulo?

- **Personal de Bodega:** Son los encargados de recibir las cajas de los proveedores, contar las unidades físicas, registrarlas en el sistema y apartar los productos deteriorados.
- **Administrador:** Utiliza el módulo para vigilar el valor económico del inventario, revisar qué productos necesitan reordenarse y supervisar los ajustes realizados.
- **Vendedores:** Pueden consultar las cantidades disponibles para informar a los clientes, pero no pueden alterar los números sin autorización.

---

## 3. Indicadores de la parte superior (Resumen en vivo)

Al entrar al módulo de inventario, lo primero que se observa en la parte superior son varias tarjetas con números esenciales para el negocio:
1. **Total de Referencias:** La cantidad de productos distintos registrados en el sistema.
2. **Total de Unidades Físicas:** La suma de todas las unidades que hay guardadas en el almacén.
3. **Valor del Inventario:** La cantidad total de dinero que representan todos esos productos a precio de compra. Este dato es fundamental para la administración contable.
4. **Productos con Stock Bajo:** Cuántas referencias están por debajo o cerca de su límite de seguridad (marcado en color naranja de advertencia).
5. **Productos Agotados:** Cuántas referencias llegaron a 0 unidades y requieren pedido urgente a los proveedores (marcado en color rojo).

---

## 4. Paso a paso: Cómo se utiliza el Módulo de Inventario

A continuación se explica paso a paso cómo se trabaja con el inventario físico:

### Paso 1: Localizar el producto a revisar o ajustar
En la tabla de inventario, el encargado tiene a su disposición un buscador y filtros:
- Puede escribir el nombre del producto o pasar el lector de código de barras.
- Puede filtrar la lista para ver solo los productos que están con stock bajo o solo los agotados.
- En cada fila se ve: el código del producto, su nombre, la categoría, el costo unitario, el precio de venta al público, el stock actual y el stock mínimo recomendado.

### Paso 2: Abrir la ventana de movimiento de stock
Al lado de cada producto hay un botón de acción llamado **"Ajustar Stock"** o **"Mover Existencias"**. Al presionarlo, se abre una ventana modal en la misma pantalla sin cambiar de página.

### Paso 3: Seleccionar el tipo de operación
En esta ventana, el encargado selecciona una de las tres operaciones disponibles según lo que haya ocurrido en la bodega:

1. **Entrada de mercancía:**
   - **Cuándo se usa:** Cuando llegó un pedido surtido por un proveedor o una devolución en buen estado.
   - **Qué hace el sistema:** Suma la cantidad que se ingrese a las unidades que ya existían.
   - *Ejemplo:* Si habían 5 perfumes y llegaron 15, el sistema calcula automáticamente que ahora hay 20 unidades.

2. **Salida de mercancía:**
   - **Cuándo se usa:** Cuando un frasco se rompió por accidente, se venció, salió con defecto de fábrica o se utilizó como probador/muestra en la tienda.
   - **Qué hace el sistema:** Resta esa cantidad de las existencias. El sistema no permite restar más unidades de las que realmente hay en existencia para evitar números negativos.

3. **Ajuste directo de conteo:**
   - **Cuándo se usa:** Cuando se hace inventario físico general (contar a mano estante por estante) y el número real no coincide exactamente con el sistema.
   - **Qué hace el sistema:** Reemplaza el número anterior por el nuevo número exacto que se le indique.
   - *Ejemplo:* Si el sistema decía que habían 8 unidades pero en la estantería se cuentan físicamente 9, se escribe 9 y el sistema fija esa cantidad.

### Paso 4: Escribir la cantidad y el motivo
Para que todo quede claro y justificado:
- Se escribe el número de unidades en la casilla correspondiente.
- Se escribe una breve nota explicativa en el campo "Motivo" (por ejemplo: *"Llegó factura 1024 de Proveedor Nacional"* o *"Frasco quebrado durante el desempaque"*).
- Opcionalmente, se puede ajustar el stock mínimo de seguridad si se quiere cambiar el punto de alerta para ese producto.

### Paso 5: Guardar y confirmación instantánea
Al hacer clic en **"Guardar Movimiento"**:
- El sistema procesa la operación al instante.
- El nuevo número de existencias se actualiza de inmediato tanto en la bodega como en la caja registradora de ventas y en la tienda virtual de los clientes.
- Aparece un mensaje verde de éxito confirmando que el inventario fue actualizado.

---

## 5. Colores y alertas de salud del inventario

Para que el personal identifique rápidamente la situación de cada artículo en la estantería:
- **Verde (Stock Saludable):** El producto tiene suficientes existencias por encima de su límite mínimo.
- **Naranja / Amarillo (Stock Crítico):** Las unidades están iguales o por debajo del stock mínimo fijado. Avisa que es momento de llamar al distribuidor.
- **Rojo (Agotado):** El producto tiene cero unidades. El sistema impide que se venda en la tienda en línea para evitar vender artículos inexistentes.
