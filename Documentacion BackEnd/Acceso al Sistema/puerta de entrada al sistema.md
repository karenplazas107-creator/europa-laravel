# Módulo de Acceso al Sistema y Registro de Usuarios

Este módulo es la puerta de entrada a todo el sistema de **Almacén Europa**. Su objetivo principal es permitir que las personas inicien sesión de forma fácil y segura, que los nuevos clientes puedan crear su cuenta sin complicaciones, y que el sistema sepa a qué sección debe enviar a cada persona según el cargo o rol que tenga.

---

## 1. ¿Para qué sirve este módulo?

En palabras sencillas, este módulo se encarga de:
- Identificar quién está entrando al sistema (si es un cliente que quiere comprar o un empleado del almacén).
- Permitir el inicio de sesión tanto con correo electrónico como con número de celular.
- Facilitar el registro rápido de nuevos clientes desde la tienda.
- Redirigir automáticamente a cada usuario a la pantalla que le corresponde según sus permisos.
- Cerrar la sesión de forma limpia para proteger la cuenta cuando el usuario termina de usar el sistema.

---

## 2. ¿Quiénes utilizan este módulo?

Este módulo lo utilizan todos los usuarios que interactúan con la plataforma:
- **Clientes:** Personas que desean ver el catálogo digital, agregar productos al carrito y hacer pedidos a domicilio.
- **Vendedores y Cajeros:** Empleados que atienden en el mostrador físico y necesitan entrar a la caja registradora (Punto de Venta).
- **Personal de Bodega:** Encargados de recibir mercancía y revisar las existencias.
- **Administrador:** Dueño o encargado general que supervisa todos los movimientos, reportes y configuración de la tienda.

---

## 3. Paso a paso: Cómo funciona el Inicio de Sesión (Login)

Cuando una persona desea ingresar al sistema, el proceso ocurre en los siguientes pasos:

### Paso 1: Ingreso a la pantalla de acceso
El usuario da clic en la opción "Iniciar Sesión" desde el menú o la página principal. Se le muestra una pantalla limpia con un formulario que le solicita dos datos:
1. Su usuario de acceso (puede ser su correo electrónico o su número de teléfono celular).
2. Su contraseña personal.
3. Una casilla opcional que dice "Recordarme" si desea mantener su sesión abierta en ese dispositivo.

### Paso 2: Detección inteligente del dato ingresado
Al hacer clic en el botón **"Ingresar"**, el sistema revisa automáticamente lo que la persona escribió en el primer campo:
- Si detecta que tiene formato de correo (con un signo `@`), busca al usuario por su correo electrónico.
- Si no tiene `@`, asume que es un número de teléfono celular y lo busca por su número móvil.
Esto hace que la experiencia sea muy cómoda, porque los clientes que prefieren recordar solo su número celular pueden entrar sin problemas.

### Paso 3: Validación de seguridad
El sistema comprueba internamente que:
- La cuenta exista en la base de datos.
- La contraseña escrita coincida exactamente con la registrada. Las contraseñas están completamente cifradas, lo que significa que nadie (ni siquiera el administrador) puede verlas en texto plano.

**¿Qué pasa si los datos son incorrectos?**  
El sistema no deja pasar a la persona y le muestra un mensaje en pantalla indicando que los datos de acceso no coinciden, permitiéndole intentarlo nuevamente sin revelar detalles que pongan en riesgo la cuenta.

### Paso 4: Redirección automática según el rol
Si los datos son correctos, el sistema abre la sesión y envía de inmediato al usuario a su área de trabajo correspondiente:
- **Si es Cliente:** Lo manda directamente a la **Tienda Virtual**, listo para comprar. Si por alguna razón intenta entrar a páginas exclusivas de los empleados, el sistema no se lo permite y lo mantiene en la tienda.
- **Si es Administrador:** Lo dirige al panel de administración general.
- **Si es Vendedor:** Lo manda directamente al módulo de ventas o punto de venta para atender clientes.
- **Si es Bodeguero:** Lo lleva al módulo de inventario y recepción de productos.

---

## 4. Paso a paso: Cómo funciona el Registro de Clientes Nuevos

Cualquier persona que visite la plataforma puede crearse una cuenta de cliente siguiendo estos sencillos pasos:

### Paso 1: Abrir el formulario de registro
El visitante hace clic en **"Crear Cuenta"** o **"Registrarse"**. Aparece un formulario donde se le piden sus datos básicos:
- Nombre y Apellido.
- Correo electrónico.
- Número de teléfono celular.
- Contraseña deseada y la confirmación de la misma (para evitar que se equivoque al escribirla).

### Paso 2: Verificación de los datos
Cuando el usuario presiona el botón **"Registrarme"**, el sistema realiza las siguientes validaciones:
1. Revisa que no haya dejado ningún campo obligatorio en blanco.
2. Comprueba que el correo electrónico no esté ya registrado por otra persona.
3. Comprueba que el número de teléfono celular no pertenezca a otra cuenta existente.
4. Confirma que la contraseña tenga como mínimo 6 caracteres y que ambas contraseñas coincidan exactamente.

### Paso 3: Creación de la cuenta y bienvenida
Si todas las validaciones son exitosas:
- El sistema crea la cuenta y le asigna de manera fija y automática el rol de **Cliente**. Esto garantiza que ningún usuario externo pueda auto-asignarse permisos de empleado o administrador.
- La contraseña se guarda con protección criptográfica de alta seguridad.
- El sistema inicia la sesión del nuevo cliente de forma automática para que no tenga que volver a escribir sus datos.
- Redirige al cliente inmediatamente a la tienda virtual con un mensaje de bienvenida para que empiece a armar su pedido.

---

## 5. Paso a paso: Cómo funciona el Cierre de Sesión (Logout)

Cuando el usuario desea terminar su jornada o cerrar su cuenta en un computador compartido:

### Paso 1: Pulsar en "Cerrar Sesión"
En la esquina superior de la pantalla, el usuario hace clic en el botón o enlace de **"Cerrar Sesión"**.

### Paso 2: Limpieza completa de la sesión
En ese momento, el sistema realiza tres acciones inmediatas:
1. Finaliza la sesión activa del usuario.
2. Borra los identificadores de sesión temporales del navegador para evitar que alguien más pueda volver atrás en el navegador y usar su cuenta.
3. Renueva las llaves de seguridad internas.

### Paso 3: Retorno a la página principal
El sistema redirige automáticamente a la persona a la página de inicio o a la pantalla de login, dejándolo listo por si alguien más desea entrar.

---

## 6. Reglas de seguridad explicadas de forma sencilla

Para cuidar la información de los clientes y del negocio, este módulo cuenta con las siguientes normas:
1. **Protección contra formularios falsos:** Cada formulario del sistema tiene un candado digital invisible que confirma que los datos fueron enviados directamente desde nuestra página y no por un enlace engañoso de terceros.
2. **Contraseñas blindadas:** Ninguna contraseña se almacena como texto normal; se transforman en códigos encriptados irreversibles.
3. **Control de acceso estricto:** Si una persona intenta escribir a mano la dirección de una página a la que no tiene permiso (por ejemplo, un cliente intentando entrar a la lista de usuarios o a los reportes de ventas), el sistema detecta que no tiene el cargo correspondiente y lo bloquea, redirigiéndolo a su área permitida.
