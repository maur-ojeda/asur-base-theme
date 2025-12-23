# wp-dev

Actúa como un desarrollador experto en WordPress. Mi proyecto usa Carbon Fields, Bootstrap 5 , fastbootstrap, y scripts shell para tareas de automatización.
Ayúdame con la siguientes tarea:

# Historias de Usuario - Simulador de Cotizaciones Residenciales (WordPress)

## 1. Gestión de Comunas de Servicio (Administrador)

> _Como administrador del sitio, quiero poder gestionar una lista de comunas donde Enercity presta servicio, para que el simulador pueda validar automáticamente si una dirección está dentro del área de cobertura._

**Criterios de Aceptación:**

- Puedo agregar, editar y eliminar comunas desde el panel de WordPress.
- Los campos son: nombre de la comuna (texto) y estado (activo/inactivo).
- Se usa Carbon Fields para crear un CPT “Comuna de Servicio” con campos personalizados.
- La lista se almacena en la base de datos y se consulta desde la API REST.

---

## 2. Validación de Ubicación por Comuna (Usuario Final)

> _Como usuario que quiere simular una cotización, quiero que el sistema valide automáticamente si mi dirección está en una comuna de servicio, para saber si puedo avanzar con la simulación._

**Criterios de Aceptación:**

- Al ingresar una dirección (o seleccionar una comuna), el sistema llama a `/wp-json/enercity/v1/validate-comuna` con el nombre de la comuna.
- Si la comuna no está en la lista, se muestra un mensaje claro: _“Actualmente no prestamos servicios en esta comuna.”_
- Si está en la lista, se permite continuar con el simulador.
- La validación se realiza sin recargar la página (usando AJAX o API REST).

---

## 3. Cálculo de Potencia y Costo según Boleta Mensual (Usuario Final)

> _Como usuario, quiero que el sistema calcule automáticamente la cantidad de paneles solares y el costo estimado basado en el monto de mi boleta mensual, para entender qué sistema necesito._

**Criterios de Aceptación:**

- El sistema aplica una regla de conversión definida en la configuración (ej: $10.000/mes = 2 kW).
- Se usan multiplicadores definidos en Carbon Fields (Tipo de techo, ubicación del medidor).
- El resultado muestra: kW necesarios, cantidad de paneles, costo total estimado.
- Todos los cálculos se realizan en PHP (backend), no en JS, para evitar manipulación.

---

## 4. Guardado Temporal de Simulación por Sesión (Usuario Final)

> _Como usuario que está simulando, quiero que mis datos de simulación se guarden temporalmente en mi sesión, para poder completar el formulario de contacto sin perder mi cotización._

**Criterios de Aceptación:**

- Al finalizar el cálculo, se crea un registro temporal en la base de datos (CPT “Simulación Temporal”) asociado al ID de sesión del usuario.
- Los datos guardados incluyen: ubicación, tipo de techo, ubicación del medidor, monto de boleta, kW calculados, costo estimado.
- Este registro se elimina si la sesión expira (30 min de inactividad, como ya definiste).

---

## 5. Descarga de Simulación en PDF (Usuario Final)

> _Como usuario que recibió la simulación, quiero poder descargarla en PDF después de ingresar mis datos de contacto, para tener un respaldo físico o digital._

**Criterios de Aceptación:**

- Al enviar el formulario de contacto, se genera un PDF con los resultados de la simulación (diseño limpio, logotipo, datos del cliente, cálculos).
- Se usa una librería de Composer (ej: `spipu/html2pdf`) para generar el PDF.
- El PDF se adjunta al correo y también se ofrece como descarga directa tras el envío.

---

## 6. Captura de Datos de Contacto (Usuario Final)

> _Como usuario que quiere recibir su cotización, quiero completar un formulario simple con mis datos de contacto y preferencia de comunicación, para que Enercity pueda contactarme._

**Criterios de Aceptación:**

- El formulario tiene: nombre, correo, teléfono, forma de contacto (select: Teléfono, Email, WhatsApp).
- Se valida formato de correo y teléfono (chileno).
- Se guarda todo en la base de datos como un registro final de “Simulación Completada” (CPT “Simulación Final”), vinculado al registro temporal.
- No se requiere registro de usuario ni contraseña: se usa RUT como usuario (si aplica más adelante), pero en esta etapa solo se captura nombre y contacto.

---

## 7. Envío de Cotización por Correo (Sistema)

> _Como sistema, quiero enviar automáticamente un correo con el PDF adjunto al correo del usuario cuando completa la simulación, para entregarle su cotización sin intervención manual._

**Criterios de Aceptación:**

- Al recibir los datos de contacto, se envía un correo usando `wp_mail()` con el PDF adjunto.
- El cuerpo del correo incluye un mensaje personalizado y un resumen de la simulación.
- El correo se envía incluso si hay errores posteriores (API ERP), para no perder la comunicación con el cliente.

---

## 8. Sincronización con ERP Externo (Sistema)

> _Como sistema, quiero enviar los datos del cliente y la simulación a la API del ERP externo cuando se completa la cotización, para que el equipo comercial pueda gestionar el lead automáticamente._

**Criterios de Aceptación:**

- Se usa una librería de Composer para consumir la API del ERP (ej: `guzzlehttp/guzzle`).
- Se envían: nombre, correo, teléfono, comuna, kW, costo, forma de contacto.
- Si la API responde con error, se registra en un log (o en un CPT “Errores de Integración”) y se notifica al administrador.
- El envío a ERP no bloquea la respuesta al usuario: se hace en segundo plano (async).

---

## 9. Registro de Simulación en Base de Datos (Sistema)

> _Como sistema, quiero registrar todas las simulaciones completadas en la base de datos, para tener un historial de leads y poder reportar métricas._

**Criterios de Aceptación:**

- Cada simulación final se guarda como un CPT “Simulación Final” con todos los campos.
- Se incluye fecha/hora, IP del usuario, ID de sesión original, estado de integración con ERP.
- Se puede listar, filtrar y exportar desde el panel de WordPress usando Carbon Fields para campos personalizados.

---

## 10. Expiración de Sesión (Sistema)

> _Como sistema, quiero que las simulaciones temporales expiren automáticamente después de 30 minutos de inactividad, para mantener la base de datos limpia y segura._

**Criterios de Aceptación:**

- Se usa la lógica de sesión ya definida (30 min de inactividad).
- Se limpian los registros del CPT “Simulación Temporal” que no se hayan convertido en finales en ese tiempo.
- Si el usuario vuelve después de la expiración, se reinicia el simulador.
