# Módulo de Informes y Reportes Analíticos (Laravel)

El módulo de **Informes y Reportes** proporciona inteligencia de negocios y analítica comercial para la toma de decisiones estratégicas en **Almacén Europa**, combinando indicadores ejecutivos, gráficos interactivos con Chart.js, rankings de productos y exportación/impresión profesional directa.

---

## 1. Componentes Técnicos Involucrados

| Componente | Archivo en el Proyecto | Responsabilidad |
|---|---|---|
| **Controlador** | `app/Http/Controllers/ReporteController.php` | Agregación estadística, cálculos temporales con Carbon y preparación de datasets |
| **Modelos** | `app/Models/Venta.php`<br>`app/Models/DetalleVenta.php`<br>`app/Models/Producto.php`<br>`app/Models/User.php` | Modelos consultados con funciones agregadas de Eloquent (`SUM`, `COUNT`, `MAX`, `AVG`) |
| **Rutas Web** | `routes/web.php` | `Route::get('/reportes', ...)` y `Route::get('/reportes/imprimir', ...)` |
| **Librería de Gráficos** | Chart.js | Renderizado interactivo de gráficos de líneas, barras y rosquillas |
| **Vistas Blade** | `resources/views/reportes/index.blade.php`<br>`resources/views/reportes/imprimir.blade.php` | Dashboard analítico e interfaz de impresión limpia en la misma ventana |

---

## 2. Endpoints y Enrutamiento (`routes/web.php`)

```php
Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/imprimir', [ReporteController::class, 'imprimir'])->name('reportes.imprimir');
});
```

---

## 3. Indicadores Clave de Negocio (KPIs)

El controlador calcula dinámicamente en cada carga:
1. **Ingresos Totales Históricos:** `Venta::sum('total')`.
2. **Ingresos del Día:** `Venta::whereDate('fecha', Carbon::today())->sum('total')`.
3. **Ingresos del Mes en Curso:** `Venta::whereBetween('fecha', [$inicioMes, $finMes])->sum('total')`.
4. **Ticket Promedio:** Valor medio de facturación por cada transacción (`ingresosTotales / totalVentasCount`).
5. **Venta Más Alta:** Registro de la transacción con mayor valor monetario.

---

## 4. Visualización de Datos y Gráficos (Chart.js)

### A. Evolución Temporal de Ingresos
Gráfico de líneas continuas que ilustra el comportamiento de los ingresos a lo largo de los últimos 12 meses, identificando patrones de estacionalidad.

### B. Ventas Diarias de los Últimos 30 Días
Gráfico de barras verticales que detalla los ingresos diarios, permitiendo identificar días pico de mayor afluencia comercial.

### C. Distribución por Métodos de Pago
Gráfico tipo rosquilla (*Doughnut*) que segmenta la facturación por medio de pago utilizado (Efectivo, Wompi, PSE, Contra Entrega, Transferencia).

---

## 5. Rankings y Auditoría Operativa

- **Top 5 Productos Más Vendidos:** Tabla y barras porcentuales de progreso que destacan las referencias con mayor volumen de unidades colocadas y sus ingresos acumulados.
- **Rendimiento por Colaborador:** Auditoría de productividad comercial según el número de ventas registradas por cada vendedor o cajero.
- **Auditoría Financiera del Inventario:** Conteo de productos, valor total del stock a costo (`SUM(stock * precio_compra)`) y alertas de stock bajo y agotado.

---

## 6. Impresión Integrada en la Misma Ventana

A diferencia de sistemas antiguos que abrían pestañas emergentes propensas a ser bloqueadas por el navegador, **Almacén Europa** implementa:
1. **Ruta Dedicada de Impresión (`/reportes/imprimir`):** Carga el reporte ejecutivo formal con encabezado institucional, tablas limpias y métricas consolidadas.
2. **Hojas de Estilo `@media print`:** Ocultan botones de navegación, menús laterales y pies de página irrelevantes durante la impresión física o exportación a PDF.
3. **Disparador `window.print()`:** Invoca directamente el diálogo de impresión del sistema operativo manteniendo al usuario dentro de la misma experiencia.
