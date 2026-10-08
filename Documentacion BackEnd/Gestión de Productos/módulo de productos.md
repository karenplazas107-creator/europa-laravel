# Módulo de Gestión de Productos

Este módulo es la base de todo el catálogo comercial de **Almacén Europa**. Es el lugar donde se registran los nuevos artículos que la tienda pone a la venta, se establecen los precios de compra y venta para calcular la ganancia, se asigna el código de barras y se suben las fotografías para que se vean atractivas tanto en el catálogo interno como en la tienda virtual.

---

## 1. ¿Para qué sirve este módulo?

Este módulo permite gestionar el ciclo de vida completo de cada producto:
- Dar de alta artículos nuevos con toda su información comercial y técnica.
- Asignar el código de barras para poder cobrar rápidamente con pistola lectora en el mostrador.
- Definir el precio al que se le compra al proveedor y el precio al que se le vende al público.
- Clasificar el producto dentro de su categoría correspondiente (Perfumería, Maquillaje, Cuidado Facial, etc.).
- Subir la foto del artículo para que los clientes y los vendedores la reconozcan con facilidad.
- Fijar el stock inicial y el límite mínimo de alerta.
- Modificar cualquier dato cuando un precio cambie o se quiera actualizar la fotografía.
- Eliminar productos que se hayan dejado de vender definitivamente.

---

## 2. ¿Quiénes utilizan este módulo?

- **Administrador:** Tiene acceso total para crear productos, fijar márgenes de ganancia, cambiar precios y autorizar la baja de referencias.
- **Personal de Bodega:** Puede registrar referencias nuevas que llegan por primera vez a la bodega y asociarles su respectivo código de barras y categoría.
- **Vendedores:** Pueden consultar la información detallada para responder preguntas de los clientes (ingredientes, aroma, presentación, etc.), pero no tienen permisos para cambiar precios o eliminar productos.

---

## 3. Paso a paso: Cómo registrar un Producto Nuevo

Cuando llega una nueva referencia a la tienda, el proceso para darla de alta es el siguiente:

### Paso 1: Ingreso al formulario de registro
El usuario entra a la sección **"Productos"** y hace clic en el botón superior destacado llamado **"Nuevo Producto"** o **"Agregar Producto"**.

### Paso 2: Diligenciamiento de la información básica
Se completa el formulario con los siguientes campos:
1. **Nombre del Producto:** Nombre comercial claro y descriptivo (por ejemplo: *"Perfume Dolce & Gabbana Light Blue 100ml"*).
2. **Descripción:** Información detallada sobre el producto (notas aromáticas, modo de uso, público sugerido, etc.). Esta información ayuda a los vendedores y orienta a los compradores en la tienda virtual.
3. **Código de Barras:** Se puede digitar manualmente o pasar el lector óptico sobre la caja del producto para que el número se escriba solo. Este código debe ser único.
4. **Categoría:** Se despliega la lista y se elige a qué familia pertenece el artículo (por ejemplo, Perfumería Dama).

### Paso 3: Asignación de precios y existencias
1. **Precio de Compra (Costo):** Cuánto le cuesta este producto a Almacén Europa al comprárselo al proveedor.
2. **Precio de Venta:** El precio final que pagará el cliente en el mostrador o en la web. La diferencia entre ambos valores representa la ganancia del negocio.
3. **Stock Inicial:** Cuántas unidades físicas llegaron en la primera entrega.
4. **Stock Mínimo:** El número de unidades que se considera la reserva de seguridad (por ejemplo, 5 unidades). Cuando el inventario baje a este número, el sistema empezará a mostrar la alerta de stock bajo.

### Paso 4: Subir la fotografía del producto
Se presiona el botón para examinar archivos en el computador y se selecciona la foto del producto:
- Se aceptan imágenes en formatos estándar como JPG, PNG o WebP.
- El sistema comprueba que la imagen no sea excesivamente pesada para garantizar que la tienda cargue rápido tanto en celulares como en computadores.

### Paso 5: Validación y guardado
Al hacer clic en el botón **"Guardar Producto"**:
- El sistema verifica que todos los campos requeridos estén llenos.
- Comprueba que el código de barras no se repita con ningún otro producto registrado.
- Valida que los precios no sean números negativos.
- Guarda la fotografía de forma organizada en el servidor.
- Muestra un mensaje verde confirmando que el producto fue creado exitosamente y lo incluye de inmediato en el catálogo general.

---

## 4. Paso a paso: Cómo modificar o editar un Producto

Cuando el proveedor sube sus precios, se desea mejorar la descripción o cambiar la foto:

### Paso 1: Localizar el producto
En la tabla general de productos, se busca el artículo por nombre o código de barras y se da clic en el botón **"Editar"**.

### Paso 2: Modificar los campos necesarios
Se cargan todos los datos actuales del producto en el formulario:
- Se puede corregir el nombre, descripción, precios o categoría.
- **¿Qué pasa con la foto?** Si la foto actual sigue sirviendo, el campo de imagen se deja tal como está. Si se desea cambiar por una fotografía más bonita o actualizada, se selecciona el nuevo archivo; el sistema guardará la nueva imagen y se encargará automáticamente de borrar la imagen vieja del disco para no desperdiciar espacio de almacenamiento.

### Paso 3: Guardar los cambios
Al pulsar **"Actualizar Producto"**, el sistema valida nuevamente los datos y aplica los cambios de forma instantánea.

---

## 5. Paso a paso: Cómo eliminar un Producto

Si una referencia sale del mercado o fue creada por error:
1. En la lista de productos, se ubica la fila correspondiente y se hace clic en el botón **"Eliminar"**.
2. Aparece un mensaje pidiendo confirmación para evitar equivocaciones accidentales.
3. Al aceptar la eliminación, el sistema retira el producto del catálogo y elimina también su fotografía asociada del servidor, dejando todo limpio y ordenado.
