# Módulo de Gestión de Clientes

Este módulo funciona como el directorio central de compradores de **Almacén Europa**. En esta sección se concentran todos los clientes que se han registrado en la tienda virtual o que han sido dados de alta en el sistema para realizar compras.

---

## 1. ¿Para qué sirve este módulo?

Este módulo permite llevar un control ordenado de la base de clientes del negocio:
- Permite consultar la lista completa de personas registradas como compradores.
- Facilita la búsqueda inmediata de un cliente por su nombre, teléfono o correo electrónico.
- Permite actualizar o corregir datos de contacto cuando un cliente cambia de número telefónico o dirección de correo.
- Permite reasignar una nueva contraseña en caso de que un cliente la haya olvidado y solicite ayuda para recuperarla.
- Permite eliminar registros de clientes que ya no formen parte de la comunidad o que hayan sido creados por prueba.

---

## 2. ¿Quiénes utilizan este módulo?

Este módulo está destinado exclusivamente al personal administrativo y comercial:
- **Administrador:** Tiene control total para ver, editar o eliminar registros de clientes.
- **Vendedores:** Pueden consultar los datos de contacto para comunicarse con un comprador sobre su pedido o verificar si ya está registrado en el sistema.

*Nota de seguridad:* Los clientes que navegan por la tienda virtual no tienen acceso a esta pantalla; si intentaran entrar a esta dirección, el sistema los regresa automáticamente a la tienda.

---

## 3. Paso a paso: Cómo funciona la Gestión de Clientes

A continuación se explica paso a paso cómo se trabaja dentro de este módulo:

### Paso 1: Ingreso a la lista de clientes
El usuario autorizado entra a la opción **"Clientes"** en el menú lateral o superior. De inmediato se carga una tabla limpia donde se aprecian las siguientes columnas:
- Nombre y Apellido del cliente.
- Número de teléfono celular.
- Correo electrónico.
- Fecha en la que se registró en la plataforma.
- Botones de acción: **Editar** y **Eliminar**.

### Paso 2: Búsqueda rápida de un comprador
En la parte superior de la tabla hay un cuadro de búsqueda inteligente:
- El encargado puede escribir el nombre de la persona, su apellido, su número de celular o su correo electrónico.
- A medida que se van tecleando las letras o números, la lista se va filtrando al instante sin tener que esperar a que la página vuelva a cargar.
- Esto hace que sea muy rápido encontrar la ficha de un cliente mientras está al teléfono o esperando en la tienda.

### Paso 3: Edición de la información de un cliente
Cuando un comprador solicita actualizar sus datos o reporta que cambió de teléfono:
1. El encargado ubica al cliente en la lista y presiona el botón **"Editar"**.
2. Se abre una pantalla con el formulario que contiene los datos actuales del cliente.
3. Se realizan los cambios necesarios (por ejemplo, corregir un apellido mal escrito o poner el nuevo número móvil).
4. **¿Qué pasa con la contraseña?** El campo de contraseña se deja vacío por defecto. Si el cliente no necesita cambiar su clave, ese campo se deja en blanco y el sistema conserva la contraseña que ya tenía intacta. Si el cliente pidió restablecer su clave, aquí se le escribe la nueva contraseña y su confirmación.
5. Al hacer clic en **"Guardar Cambios"**, el sistema comprueba que el nuevo correo o teléfono no pertenezca a otro cliente ya registrado.
6. Si todo está correcto, guarda los cambios y muestra un mensaje verde confirmando que los datos se actualizaron con éxito.

### Paso 4: Eliminación controlada de un cliente
Si es necesario dar de baja a un usuario comprador:
1. El encargado presiona el botón **"Eliminar"** (identificado con el icono de papelera o en color rojo).
2. El sistema muestra una alerta de confirmación preguntando si está completamente seguro de borrar a ese cliente, para evitar borrados por un clic accidental.
3. Al confirmar, el sistema retira el registro de la base de datos y muestra una notificación en pantalla avisando que el cliente fue eliminado satisfactoriamente.

---

## 4. Normas y validaciones importantes

Para mantener la base de datos limpia y ordenada, el sistema aplica las siguientes reglas automáticas:
- **No permite correos duplicados:** Dos clientes no pueden tener el mismo correo electrónico.
- **No permite teléfonos duplicados:** Cada número de celular debe ser único dentro de los clientes registrados.
- **Segregación estricta de cuentas:** Este módulo solo muestra y permite gestionar cuentas con perfil de cliente; las cuentas de los empleados y administradores se gestionan en un módulo aparte para garantizar máxima seguridad.
