# Módulo de Catálogo y Categorías (Laravel)

El módulo de **Catálogo** ofrece una vista visual y analítica del inventario comercial de **Almacén Europa**, permitiendo la exploración de productos agrupados por categorías, el monitoreo del estado de las existencias y la alternancia de interfaces de visualización.

---

## 1. Componentes Técnicos Involucrados

| Componente | Archivo en el Proyecto | Descripción |
|---|---|---|
| **Controlador** | `app/Http/Controllers/CatalogoController.php` | Orquesta la consulta de productos con eager loading de categorías y métricas de inventario |
| **Modelos** | `app/Models/Producto.php`<br>`app/Models/Categoria.php` | Modelos Eloquent con relaciones de integridad referencial |
| **Rutas Web** | `routes/web.php` | `Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');` |
| **Vista Principal** | `resources/views/catalogo/index.blade.php` | Interfaz interactiva con tarjetas de producto, filtros dinámicos y modal de detalle |

---

## 2. Lógica del Controlador (`CatalogoController@index`)

El controlador procesa filtros dinámicos mediante el query builder de Eloquent:

```php
public function index(Request $request)
{
    $search = $request->input('search', '');
    $categoriaId = $request->input('categoria', '');
    $vista = $request->input('vista', 'grid'); // Cuadrícula o lista tabular

    // Eager loading para evitar el problema N+1 queries
    $productos = Producto::with('categoriaObj')
        ->when($search, function ($q) use ($search) {
            $q->where('nombre', 'like', "%{$search}%")
                ->orWhere('descripcion', 'like', "%{$search}%")
                ->orWhere('codigo_barras', 'like', "%{$search}%");
        })
        ->when($categoriaId, function ($q) use ($categoriaId) {
            $q->where('categoria', $categoriaId);
        })
        ->orderBy('nombre')
        ->get();

    // Métricas del catálogo en tiempo real
    $totalProductos = Producto::count();
    $totalCategorias = Categoria::count();
    $stockBajo = Producto::where('stock', '>', 0)->where('stock', '<=', 10)->count();
    $sinStock = Producto::where('stock', '<=', 0)->count();
    $categorias = Categoria::orderBy('nombre')->get();

    return view('catalogo.index', compact(
        'productos', 'search', 'categoriaId', 'vista',
        'totalProductos', 'totalCategorias', 'stockBajo', 'sinStock',
        'categorias'
    ));
}
```

---

## 3. Funcionalidades Principales

### A. Buscador Multicriterio
Permite localizar artículos en tiempo real buscando por:
- Nombre comercial del producto.
- Descripción y notas olfativas o características técnicas.
- Código de barras o SKU del producto.

### B. Segmentación por Categorías
Permite aislar rápidamente familias de artículos (ej. Perfumería Dama, Perfumería Caballero, Cuidado Facial, Accesorios). La consulta utiliza la relación Eloquent `categoriaObj` para presentar el nombre de la categoría sin sobrecargar la base de datos.

### C. Tarjetas de Indicadores Rápidos (KPIs de Catálogo)
En la parte superior de la vista se despliegan 4 tarjetas clave:
1. **Total de Productos:** Conteo general de referencias en el sistema.
2. **Total de Categorías:** Clasificaciones activas.
3. **Stock Bajo (≤ 10 uds):** Alerta preventiva para reposición oportuna.
4. **Sin Stock (0 uds):** Indicador crítico de productos agotados.

### D. Conmutador de Vistas (Grid vs. List)
Los usuarios del panel pueden alternar con un clic entre:
- **Vista Cuadrícula (Grid):** Tarjetas visuales con fotografía en alta resolución, precio de venta, categoría y badge de disponibilidad.
- **Vista Lista (Table):** Formato tabular condensado para operaciones rápidas y auditorías.

---

## 4. Roles y Permisos de Acceso

- **Administrador, Vendedor y Bodeguero:** Tienen acceso a la consulta del catálogo a través del middleware `staff`, garantizando que todo el personal operativo conozca las referencias disponibles para la venta y asesoría al cliente.
