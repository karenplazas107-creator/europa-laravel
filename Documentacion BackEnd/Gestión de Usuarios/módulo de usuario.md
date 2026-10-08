# Módulo de Gestión de Usuarios y Roles

Este módulo es el centro de seguridad y control del personal de **Almacén Europa**. Es la herramienta que le permite al Administrador General crear cuentas para los empleados, definir el cargo o rol que desempeñará cada uno en la empresa y garantizar que cada trabajador tenga acceso únicamente a las herramientas que necesita para sus tareas diarias.

---

## 1. ¿Para qué sirve este módulo?

Este módulo cumple un papel fundamental en el orden y la seguridad del negocio:
- Permite crear las cuentas de acceso para nuevos empleados del almacén.
- Permite asignar o cambiar el rol de cada persona (administrador, vendedor, auxiliar de bodega o cliente).
- Garantiza que los vendedores solo vean la caja registradora y el catálogo, y no los reportes financieros ni las cuentas de otros empleados.
- Permite actualizar contraseñas o datos de contacto de cualquier colaborador.
- Incluye un candado de seguridad especial que impide que el administrador se borre a sí mismo por accidente.

---

## 2. Los 4 Roles del Sistema explicados en lenguaje sencillo

Para que la tienda funcione de forma organizada, cada cuenta de usuario tiene asignado uno de los siguientes 4 roles:

1. **Administrador General:**
   - Es el dueño o gerente del almacén.
   - Tiene acceso completo y sin restricciones a todos los módulos: finanzas, ventas, inventario, reportes analíticos, configuración y creación de personal.

2. **Vendedor / Cajero:**
   - Es el empleado encargado de atender al público en el mostrador físico.
   - Su pantalla principal es el Punto de Venta (POS) para cobrar y emitir recibos.
   - Puede consultar el catálogo para verificar precios y características de los productos.
   - No tiene acceso a reportes contables ni a la administración de usuarios.

3. **Auxiliar de Bodega:**
   - Es el encargado de recibir mercancía y cuidar el inventario.
   - Tiene acceso directo a los módulos de Inventario, Productos, Catálogo y Proveedores.
   - Puede registrar entradas de cajas de proveedores, mermas de productos y ajustes de conteo físico.

4. **Cliente:**
   - Es el comprador registrado desde la página web.
   - Su acceso está limitado exclusivamente a la tienda virtual, a su carrito de compras y al pago de sus pedidos.

---

## 3. ¿Quién tiene acceso a este módulo?

**Únicamente el Administrador General.**  
Si un vendedor, un bodeguero o un cliente intenta ingresar a esta pantalla escribiendo la dirección a mano, el sistema lo detecta de inmediato, le bloquea el acceso y lo devuelve a su pantalla autorizada.

---

## 4. Indicadores de la parte superior

Al ingresar al módulo, el administrador puede ver un resumen numérico del equipo de trabajo:
- **Total de Usuarios:** Cantidad de personas registradas en la plataforma.
- **Administradores:** Cuántas cuentas con acceso directivo existen.
- **Vendedores:** Cuántos colaboradores están habilitados para cobrar en caja.
- **Personal de Bodega:** Cuántos operadores gestionan el inventario.
- **Clientes:** Cuántos compradores se han registrado para adquirir productos.

---

## 5. Paso a paso: Cómo dar de alta a un nuevo Colaborador

Cuando entra un nuevo empleado a trabajar en Almacén Europa:

### Paso 1: Ingreso al formulario de creación
El administrador entra a la sección **"Usuarios"** y presiona el botón **"Nuevo Usuario"** o **"Crear Colaborador"**.

### Paso 2: Diligenciamiento de datos del empleado
Se completan los siguientes campos:
1. **Nombre y Apellido:** El nombre completo del trabajador.
2. **Número de Celular:** Teléfono móvil del colaborador (dato obligatorio y único para poder contactarlo y para que pueda iniciar sesión con él).
3. **Correo Electrónico:** Correo del empleado (opcional si es un cajero que solo va a entrar con su número celular).
4. **Rol o Cargo:** Se selecciona del menú desplegable el rol correspondiente: *Administrador*, *Vendedor*, *Auxiliar de Bodega* o *Cliente*.
5. **Contraseña:** Se define una contraseña segura de mínimo 6 caracteres y se repite en la casilla de confirmación para evitar equivocaciones.

### Paso 3: Guardado y activación
Al presionar el botón **"Guardar Usuario"**:
- El sistema comprueba que el teléfono o correo no estén ya registrados.
- Cifra la contraseña con máxima seguridad para que nadie pueda verla.
- Guarda la cuenta y muestra un mensaje verde confirmando la creación.
- A partir de ese mismo instante, el colaborador ya puede iniciar sesión en cualquier computador del almacén utilizando su teléfono y la contraseña asignada.

---

## 6. Paso a paso: Cómo editar un Usuario o cambiarle el Cargo

Si un empleado asciende de puesto, cambia de teléfono o necesita nueva contraseña:
1. En la lista de usuarios, el administrador localiza al colaborador y hace clic en **"Editar"**.
2. Se cargan los datos en el formulario.
3. Se puede modificar el nombre, teléfono, correo o cambiar su rol (por ejemplo, promover a un auxiliar a administrador).
4. **¿Cómo funciona el cambio de contraseña?** Si no se desea cambiar la contraseña del empleado, la casilla se deja completamente vacía y el sistema mantendrá la contraseña que él ya tenía. Si el empleado olvidó su clave, el administrador le escribe una nueva en ese campo y la confirma.
5. Al pulsar **"Actualizar"**, los cambios toman efecto de inmediato.

---

## 7. Paso a paso: Cómo dar de baja a un Usuario (y la protección de seguridad)

Cuando un empleado deja de trabajar en la empresa:
1. El administrador busca al colaborador y presiona el botón **"Eliminar"**.
2. Aparece un cuadro de confirmación para cerciorarse de la decisión.
3. Al aceptar, el usuario queda eliminado y ya no podrá volver a iniciar sesión en el sistema.

### Candado de Seguridad Especial:
Si el administrador intenta por error eliminarse a sí mismo mientras está usando su cuenta, el sistema se lo impide de forma estricta y le muestra un mensaje de alerta en pantalla avisándole: *"No puedes eliminar tu propio usuario con sesión activa"*. Esta protección evita que el almacén se quede sin acceso a la administración general.
