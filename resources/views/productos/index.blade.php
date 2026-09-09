@extends('layouts.dashboard')

@section('title', 'Gestión de Productos')
@section('page-title', 'Gestión de Productos')

@section('content')

<div class="pr-page">

    {{-- ── Encabezado ── --}}
    <div class="pr-header">
        <div>
            <h2 class="pr-header__title">Gestión de Productos</h2>
            <p class="pr-header__sub">Administra el catálogo, precios, stock y códigos de barras.</p>
        </div>
        <a href="{{ route('productos.create') }}" class="pr-btn-nuevo">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Nuevo Producto
        </a>
    </div>

    {{-- ── Toast ── --}}
    @if (session('success'))
        <div class="pr-toast pr-toast--ok" id="pr-toast">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ── Estadísticas ── --}}
    <div class="pr-stats">
        <div class="pr-stat">
            <div class="pr-stat__icon pr-stat__icon--blue">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                </svg>
            </div>
            <div>
                <div class="pr-stat__num">{{ $total }}</div>
                <div class="pr-stat__lbl">Total productos</div>
            </div>
        </div>
        <div class="pr-stat">
            <div class="pr-stat__icon pr-stat__icon--green">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
            </div>
            <div>
                <div class="pr-stat__num">{{ $disponibles }}</div>
                <div class="pr-stat__lbl">Disponibles</div>
            </div>
        </div>
        <div class="pr-stat">
            <div class="pr-stat__icon pr-stat__icon--amber">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
            <div>
                <div class="pr-stat__num">{{ $stock_bajo }}</div>
                <div class="pr-stat__lbl">Stock bajo</div>
            </div>
        </div>
        <div class="pr-stat">
            <div class="pr-stat__icon pr-stat__icon--red">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                </svg>
            </div>
            <div>
                <div class="pr-stat__num">{{ $sin_stock }}</div>
                <div class="pr-stat__lbl">Sin stock</div>
            </div>
        </div>
    </div>

    {{-- ── Filtros ── --}}
    <form method="GET" action="{{ route('productos.index') }}" id="pr-filter-form">
        <div class="pr-filters">
            <div class="pr-search">
                <svg class="pr-search__ico" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" name="search" id="pr-search-input"
                       class="pr-search__inp"
                       placeholder="Buscar por nombre, categoría o código de barras..."
                       value="{{ $search }}"
                       autocomplete="off">
                @if($search)
                    <a href="{{ route('productos.index', array_filter(['categoria'=>$categoria,'stock'=>$stock])) }}"
                       class="pr-search__clear" title="Limpiar">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </a>
                @endif
            </div>
            <select name="categoria" class="pr-select" onchange="document.getElementById('pr-filter-form').submit()">
                <option value="">Todas las categorías</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->categoria }}" {{ $categoria == $cat->categoria ? 'selected' : '' }}>
                        {{ $cat->nombre }}
                    </option>
                @endforeach
            </select>
            <select name="stock" class="pr-select" onchange="document.getElementById('pr-filter-form').submit()">
                <option value="">Todo el stock</option>
                <option value="disponible" {{ $stock === 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="bajo"       {{ $stock === 'bajo'       ? 'selected' : '' }}>Stock bajo</option>
                <option value="sin_stock"  {{ $stock === 'sin_stock'  ? 'selected' : '' }}>Sin stock</option>
            </select>
        </div>
    </form>

    {{-- ── Tabla ── --}}
    <div class="pr-table-card">
        <table class="pr-table">
            <thead>
                <tr>
                    <th>PRODUCTO</th>
                    <th>CATEGORÍA</th>
                    <th>CÓD. BARRAS</th>
                    <th>P. COMPRA</th>
                    <th>P. VENTA</th>
                    <th>STOCK</th>
                    <th class="pr-th-actions">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $producto)
                    <tr>
                        {{-- Imagen + nombre --}}
                        <td>
                            <div class="pr-producto-info">
                                <div class="pr-img-wrap">
                                    @if($producto->imagen)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}"
                                             alt="{{ $producto->nombre }}"
                                             class="pr-img">
                                    @else
                                        <div class="pr-img-placeholder">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="3"/>
                                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                                <polyline points="21 15 16 10 5 21"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="pr-prod-nombre">{{ $producto->nombre }}</div>
                                    <div class="pr-prod-desc">{{ Str::limit($producto->descripcion, 45) }}</div>
                                </div>
                            </div>
                        </td>
                        {{-- Categoría --}}
                        <td>
                            @if($producto->categoriaObj)
                                <span class="pr-badge-cat">{{ $producto->categoriaObj->nombre }}</span>
                            @else
                                <span class="pr-dash">—</span>
                            @endif
                        </td>
                        {{-- Código de barras --}}
                        <td class="pr-td-mono">{{ $producto->codigo_barras ?? '—' }}</td>
                        {{-- Precios --}}
                        <td class="pr-td-precio">${{ number_format($producto->precio_compra, 2) }}</td>
                        <td class="pr-td-precio pr-td-precio--venta">${{ number_format($producto->precio_venta, 2) }}</td>
                        {{-- Stock --}}
                        <td>
                            <div class="pr-stock-wrap">
                                @php
                                    $est = $producto->estado_stock;
                                    $cls = match($est) {
                                        'sin_stock' => 'pr-stock--red',
                                        'bajo'      => 'pr-stock--amber',
                                        default     => 'pr-stock--green',
                                    };
                                    $lbl = $producto->etiqueta_stock;
                                @endphp
                                <span class="pr-stock-badge {{ $cls }}">{{ $lbl }}</span>
                                <span class="pr-stock-num">{{ $producto->stock }} uds</span>
                                <div class="pr-stock-bar">
                                    @php
                                        $pct = min(100, ($producto->stock / max(1, $producto->stock + 20)) * 100);
                                    @endphp
                                    <div class="pr-stock-bar__fill {{ $cls }}" style="width:{{ $pct }}%"></div>
                                </div>
                                <span class="pr-stock-min">Mín: 10</span>
                            </div>
                        </td>
                        {{-- Acciones --}}
                        <td class="pr-td-actions">
                            {{-- Ajuste de stock --}}
                            <button type="button"
                                    class="pr-btn-act pr-btn-act--stock"
                                    title="Ajustar stock"
                                    onclick="abrirModalStock({{ $producto->productos }}, '{{ addslashes($producto->nombre) }}', {{ $producto->stock }})">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                                </svg>
                            </button>
                            {{-- Editar --}}
                            <a href="{{ route('productos.edit', $producto->productos) }}"
                               class="pr-btn-act pr-btn-act--edit"
                               title="Editar producto">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                            </a>
                            {{-- Eliminar --}}
                            <form method="POST"
                                  action="{{ route('productos.destroy', $producto->productos) }}"
                                  class="pr-form-del"
                                  onsubmit="return confirm('¿Eliminar el producto \"{{ addslashes($producto->nombre) }}\"?\nEsta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="pr-btn-act pr-btn-act--del" title="Eliminar">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                        <path d="M10 11v6M14 11v6"/>
                                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="pr-empty">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            </svg>
                            <p>No se encontraron productos
                                @if($search) con "<strong>{{ $search }}</strong>" @endif
                            </p>
                            <a href="{{ route('productos.create') }}" class="pr-btn-nuevo pr-btn-nuevo--sm">
                                + Agregar producto
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pr-table-footer">
            {{ $productos->count() }} de {{ $total }} productos
        </div>
    </div>

</div>

{{-- ── Modal ajuste de stock ── --}}
<div id="modal-stock" class="pr-modal-bg" style="display:none" onclick="cerrarModalStock(event)">
    <div class="pr-modal">
        <div class="pr-modal__header">
            <div>
                <h3 class="pr-modal__title">Ajuste de Stock</h3>
                <p class="pr-modal__sub" id="modal-prod-name">—</p>
            </div>
            <button type="button" onclick="cerrarModalStock()" class="pr-modal__close">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div class="pr-modal__body">
            <div class="pr-modal-stock-actual">
                <span class="pr-modal-stock-lbl">Stock actual</span>
                <span class="pr-modal-stock-val" id="modal-stock-actual">0</span>
            </div>

            <div class="pr-modal-tipo-row">
                <label class="pr-modal-tipo {{ '' }}" id="tipo-entrada">
                    <input type="radio" name="tipo" value="entrada" checked>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Entrada
                </label>
                <label class="pr-modal-tipo" id="tipo-salida">
                    <input type="radio" name="tipo" value="salida">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Salida
                </label>
                <label class="pr-modal-tipo" id="tipo-ajuste">
                    <input type="radio" name="tipo" value="ajuste">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
                    </svg>
                    Ajuste directo
                </label>
            </div>

            <div class="pr-form-group">
                <label class="pr-form-label" for="modal-cantidad">Cantidad</label>
                <input type="number" id="modal-cantidad" class="pr-input" min="0" value="1" placeholder="0">
            </div>
        </div>

        <div class="pr-modal__footer">
            <button type="button" onclick="cerrarModalStock()" class="pr-btn pr-btn--ghost">Cancelar</button>
            <button type="button" onclick="guardarStock()" class="pr-btn pr-btn--primary" id="btn-guardar-stock">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                </svg>
                Guardar
            </button>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
/* ── Página Productos ── */
.pr-page { display: flex; flex-direction: column; gap: 22px; }

/* Header */
.pr-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 14px;
}
.pr-header__title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.3rem;
    font-weight: 800;
    color: #0d1b35;
    letter-spacing: -.025em;
    margin-bottom: 3px;
}
.pr-header__sub { font-size: .82rem; color: #64748b; }

/* Botón nuevo */
.pr-btn-nuevo {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    background: linear-gradient(135deg, #1d74e8, #1440b0);
    color: #fff;
    border-radius: 12px;
    font-family: 'Outfit', sans-serif;
    font-size: .88rem;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 4px 16px rgba(29,116,232,.35);
    transition: all .2s;
    white-space: nowrap;
}
.pr-btn-nuevo:hover {
    box-shadow: 0 8px 24px rgba(29,116,232,.45);
    transform: translateY(-1px);
}
.pr-btn-nuevo--sm {
    margin-top: 14px;
    padding: 9px 18px;
    font-size: .82rem;
}

/* Toast */
.pr-toast {
    display: flex; align-items: center; gap: 9px;
    padding: 12px 18px; border-radius: 10px;
    font-size: .875rem; font-weight: 500;
    animation: pr-slide .35s ease;
}
.pr-toast--ok { background: #f0fdf4; border: 1px solid #bbf7d0; color: #16a34a; }
@keyframes pr-slide {
    from { opacity: 0; transform: translateY(-10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Estadísticas */
.pr-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
}
.pr-stat {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: 0 2px 8px rgba(13,27,53,.05);
    transition: box-shadow .2s;
}
.pr-stat:hover { box-shadow: 0 4px 16px rgba(13,27,53,.10); }
.pr-stat__icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.pr-stat__icon--blue  { background: #eff6ff; color: #1d74e8; }
.pr-stat__icon--green { background: #f0fdf4; color: #22c55e; }
.pr-stat__icon--amber { background: #fffbeb; color: #f59e0b; }
.pr-stat__icon--red   { background: #fef2f2; color: #ef4444; }
.pr-stat__num {
    font-family: 'Outfit', sans-serif;
    font-size: 1.65rem;
    font-weight: 800;
    color: #0d1b35;
    line-height: 1;
}
.pr-stat__lbl { font-size: .78rem; color: #64748b; margin-top: 2px; }

/* Filtros */
.pr-filters {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 8px 12px;
    box-shadow: 0 2px 8px rgba(13,27,53,.05);
}
.pr-search {
    display: flex; align-items: center; gap: 9px;
    flex: 1; position: relative;
}
.pr-search__ico { color: #94a3b8; flex-shrink: 0; }
.pr-search__inp {
    flex: 1; border: none; outline: none;
    font-family: 'Inter', sans-serif;
    font-size: .875rem; color: #0d1b35;
    background: transparent;
}
.pr-search__inp::placeholder { color: #94a3b8; }
.pr-search__clear {
    color: #94a3b8; display: flex; align-items: center;
    padding: 4px; border-radius: 50%; transition: all .2s;
}
.pr-search__clear:hover { background: #f1f5f9; color: #475569; }
.pr-select {
    border: 1.5px solid #e2e8f0;
    border-radius: 9px;
    font-family: 'Inter', sans-serif;
    font-size: .82rem;
    color: #475569;
    background: #f8faff;
    padding: 8px 12px;
    outline: none;
    cursor: pointer;
    transition: border-color .2s;
    white-space: nowrap;
}
.pr-select:focus { border-color: #1d74e8; }

/* Tabla */
.pr-table-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    box-shadow: 0 2px 8px rgba(13,27,53,.05);
    overflow: hidden;
}
.pr-table { width: 100%; border-collapse: collapse; }
.pr-table th {
    padding: 13px 18px;
    text-align: left;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: #94a3b8;
    background: #f8faff;
    border-bottom: 1px solid #e2e8f0;
}
.pr-th-actions { text-align: center; }
.pr-table td {
    padding: 14px 18px;
    font-size: .875rem;
    color: #0d1b35;
    border-bottom: 1px solid #f1f5fd;
    vertical-align: middle;
}
.pr-table tr:last-child td { border-bottom: none; }
.pr-table tbody tr { transition: background .15s; }
.pr-table tbody tr:hover td { background: #f8faff; }

/* Producto info */
.pr-producto-info { display: flex; align-items: center; gap: 12px; }
.pr-img-wrap { flex-shrink: 0; }
.pr-img {
    width: 44px; height: 44px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid #e2e8f0;
}
.pr-img-placeholder {
    width: 44px; height: 44px;
    border-radius: 10px;
    background: #f1f5f9;
    display: flex; align-items: center; justify-content: center;
    color: #94a3b8;
    border: 1px solid #e2e8f0;
}
.pr-prod-nombre { font-weight: 600; color: #0d1b35; font-size: .875rem; }
.pr-prod-desc   { font-size: .78rem; color: #64748b; margin-top: 1px; }

/* Badge categoría */
.pr-badge-cat {
    display: inline-block;
    padding: 4px 11px;
    background: #eff6ff;
    color: #1d74e8;
    border-radius: 999px;
    font-size: .72rem;
    font-weight: 700;
}

/* Precios */
.pr-td-mono         { font-family: monospace; font-size: .82rem; color: #475569; }
.pr-td-precio       { font-weight: 600; color: #475569; }
.pr-td-precio--venta { color: #0d1b35; font-weight: 700; }
.pr-dash            { color: #cbd5e1; }

/* Stock */
.pr-stock-wrap { display: flex; flex-direction: column; gap: 3px; min-width: 110px; }
.pr-stock-badge {
    display: inline-block;
    padding: 3px 9px;
    border-radius: 999px;
    font-size: .68rem;
    font-weight: 700;
    width: fit-content;
}
.pr-stock--green { background: #dcfce7; color: #16a34a; }
.pr-stock--amber { background: #fef9c3; color: #a16207; }
.pr-stock--red   { background: #fee2e2; color: #dc2626; }
.pr-stock-num  { font-size: .78rem; color: #475569; font-weight: 600; }
.pr-stock-bar  { height: 3px; background: #e2e8f0; border-radius: 99px; overflow: hidden; }
.pr-stock-bar__fill { height: 100%; border-radius: 99px; transition: width .4s; }
.pr-stock-bar__fill.pr-stock--green { background: #22c55e; }
.pr-stock-bar__fill.pr-stock--amber { background: #f59e0b; }
.pr-stock-bar__fill.pr-stock--red   { background: #ef4444; }
.pr-stock-min  { font-size: .67rem; color: #94a3b8; }

/* Acciones */
.pr-td-actions  { display: flex; align-items: center; justify-content: center; gap: 5px; }
.pr-form-del    { display: inline-flex; }
.pr-btn-act {
    width: 30px; height: 30px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; border: none;
    transition: background .2s, transform .15s;
    text-decoration: none;
    flex-shrink: 0;
}
.pr-btn-act--stock { background: #eff6ff; color: #1d74e8; }
.pr-btn-act--stock:hover { background: #dbeafe; transform: scale(1.08); }
.pr-btn-act--edit  { background: #fef9c3; color: #ca8a04; }
.pr-btn-act--edit:hover  { background: #fef08a; transform: scale(1.08); }
.pr-btn-act--del   { background: #fee2e2; color: #dc2626; }
.pr-btn-act--del:hover   { background: #fecaca; transform: scale(1.08); }

/* Vacío */
.pr-empty {
    text-align: center;
    padding: 56px 20px !important;
    color: #94a3b8;
}
.pr-empty svg { margin: 0 auto 12px; opacity: .35; }
.pr-empty p { font-size: .9rem; }

/* Footer tabla */
.pr-table-footer {
    padding: 11px 18px;
    font-size: .78rem;
    color: #94a3b8;
    border-top: 1px solid #f1f5fd;
    background: #fafbff;
}

/* ── Modal ── */
.pr-modal-bg {
    position: fixed; inset: 0;
    background: rgba(13,27,53,.45);
    backdrop-filter: blur(3px);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: pr-fadein .2s ease;
}
@keyframes pr-fadein { from { opacity: 0; } to { opacity: 1; } }
.pr-modal {
    background: #fff;
    border-radius: 18px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 20px 60px rgba(13,27,53,.22);
    animation: pr-popup .25s ease;
}
@keyframes pr-popup {
    from { opacity: 0; transform: scale(.94) translateY(10px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}
.pr-modal__header {
    display: flex; align-items: flex-start; justify-content: space-between;
    gap: 12px;
    padding: 22px 24px 0;
}
.pr-modal__title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.1rem; font-weight: 800;
    color: #0d1b35;
}
.pr-modal__sub { font-size: .82rem; color: #1d74e8; font-weight: 600; margin-top: 2px; }
.pr-modal__close {
    background: #f1f5f9; border: none; cursor: pointer;
    width: 30px; height: 30px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: #64748b; transition: all .2s; flex-shrink: 0;
}
.pr-modal__close:hover { background: #e2e8f0; }
.pr-modal__body { padding: 20px 24px; display: flex; flex-direction: column; gap: 18px; }
.pr-modal__footer {
    padding: 0 24px 22px;
    display: flex; justify-content: flex-end; gap: 10px;
}

/* Stock actual chip */
.pr-modal-stock-actual {
    background: #f8faff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px 18px;
    display: flex; align-items: center; justify-content: space-between;
}
.pr-modal-stock-lbl { font-size: .82rem; color: #64748b; font-weight: 500; }
.pr-modal-stock-val {
    font-family: 'Outfit', sans-serif;
    font-size: 1.5rem; font-weight: 800; color: #0d1b35;
}

/* Tipo radio */
.pr-modal-tipo-row {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;
}
.pr-modal-tipo {
    display: flex; flex-direction: column; align-items: center; gap: 5px;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px; padding: 10px 8px;
    font-size: .78rem; font-weight: 600; color: #475569;
    cursor: pointer; transition: all .2s;
}
.pr-modal-tipo:hover { border-color: #1d74e8; color: #1d74e8; background: #eff6ff; }
.pr-modal-tipo input[type="radio"] { display: none; }
.pr-modal-tipo.selected { border-color: #1d74e8; color: #1d74e8; background: #eff6ff; }

/* Botones modal */
.pr-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 22px;
    border-radius: 10px;
    font-family: 'Outfit', sans-serif;
    font-size: .88rem; font-weight: 700;
    cursor: pointer; transition: all .2s;
    text-decoration: none; border: none;
}
.pr-btn--ghost { background: #f1f5f9; color: #475569; }
.pr-btn--ghost:hover { background: #e2e8f0; }
.pr-btn--primary {
    background: linear-gradient(135deg, #1d74e8, #1440b0);
    color: #fff;
    box-shadow: 0 4px 14px rgba(29,116,232,.35);
}
.pr-btn--primary:hover {
    box-shadow: 0 8px 22px rgba(29,116,232,.45);
    transform: translateY(-1px);
}

/* Form elements */
.pr-form-group { display: flex; flex-direction: column; gap: 7px; }
.pr-form-label { font-size: .84rem; font-weight: 600; color: #1e293b; }
.pr-input {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-family: 'Inter', sans-serif;
    font-size: .875rem; color: #0d1b35;
    outline: none; transition: border-color .2s, box-shadow .2s;
}
.pr-input:focus { border-color: #1d74e8; box-shadow: 0 0 0 3px rgba(29,116,232,.1); }

@media (max-width: 900px) {
    .pr-stats { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .pr-stats { grid-template-columns: 1fr 1fr; }
    .pr-filters { flex-direction: column; align-items: stretch; }
    .pr-select { width: 100%; }
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    // Debounce search
    var inp   = document.getElementById('pr-search-input');
    var form  = document.getElementById('pr-filter-form');
    var timer;
    if (inp) {
        inp.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(function () { form.submit(); }, 500);
        });
    }

    // Auto-ocultar toast
    var toast = document.getElementById('pr-toast');
    if (toast) {
        setTimeout(function () {
            toast.style.transition = 'opacity .5s';
            toast.style.opacity    = '0';
            setTimeout(function () { toast.remove(); }, 500);
        }, 3500);
    }
})();

// ── Modal de stock ──
var _prodId   = null;
var _prodNom  = '';
var _stockAct = 0;

function abrirModalStock(id, nombre, stock) {
    _prodId   = id;
    _prodNom  = nombre;
    _stockAct = stock;

    document.getElementById('modal-prod-name').textContent  = nombre;
    document.getElementById('modal-stock-actual').textContent = stock;
    document.getElementById('modal-cantidad').value          = 1;

    // Reset radio
    document.querySelector('input[name="tipo"][value="entrada"]').checked = true;
    actualizarTipoUI();

    document.getElementById('modal-stock').style.display = 'flex';
    document.getElementById('modal-cantidad').focus();
}

function cerrarModalStock(e) {
    if (e && e.target !== document.getElementById('modal-stock')) return;
    document.getElementById('modal-stock').style.display = 'none';
}

// Sync UI de tipo
document.querySelectorAll('input[name="tipo"]').forEach(function (r) {
    r.addEventListener('change', actualizarTipoUI);
});

function actualizarTipoUI() {
    var selVal = document.querySelector('input[name="tipo"]:checked').value;
    document.querySelectorAll('.pr-modal-tipo').forEach(function (lbl) {
        var val = lbl.querySelector('input').value;
        lbl.classList.toggle('selected', val === selVal);
    });
}

// Llamar al cargar
document.addEventListener('DOMContentLoaded', actualizarTipoUI);

function guardarStock() {
    var tipo     = document.querySelector('input[name="tipo"]:checked').value;
    var cantidad = parseInt(document.getElementById('modal-cantidad').value, 10);
    var btn      = document.getElementById('btn-guardar-stock');

    if (isNaN(cantidad) || cantidad < 0) {
        alert('Ingrese una cantidad válida.');
        return;
    }

    btn.disabled   = true;
    btn.textContent = 'Guardando…';

    var csrfMeta = document.querySelector('meta[name="csrf-token"]');
    var token    = csrfMeta ? csrfMeta.content : '';

    fetch('/productos/' + _prodId + '/stock', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ cantidad: cantidad, tipo: tipo }),
    })
    .then(function (r) { return r.json(); })
    .then(function (data) {
        if (data.success) {
            document.getElementById('modal-stock').style.display = 'none';
            window.location.reload();
        } else {
            alert('Error al ajustar el stock.');
        }
    })
    .catch(function () { alert('Error de conexión.'); })
    .finally(function () {
        btn.disabled    = false;
        btn.textContent = 'Guardar';
    });
}

// Cerrar modal con ESC
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        document.getElementById('modal-stock').style.display = 'none';
    }
});
</script>
@endpush
