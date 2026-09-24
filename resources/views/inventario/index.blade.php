@extends('layouts.dashboard')

@section('title', 'Control de Inventario')
@section('page-title', 'Inventario')

@section('content')
<div class="inv-page">

    {{-- ── Encabezado ── --}}
    <div class="inv-header">
        <div>
            <h1 class="inv-header__title">Control de Inventario</h1>
            <p class="inv-header__sub">Monitorea el stock, registra entradas y salidas de productos.</p>
        </div>
    </div>

    {{-- ── Toast de éxito ── --}}
    @if (session('success'))
        <div class="inv-toast" id="inv-toast">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- ── 5 Tarjetas de Estadísticas (KPIs) ── --}}
    <div class="inv-stats">
        {{-- 1. Total Productos --}}
        <div class="inv-stat-card">
            <div class="inv-stat-icon inv-stat-icon--blue">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                    <line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
            </div>
            <div class="inv-stat-content">
                <div class="inv-stat-value" id="kpi-total-productos">{{ $totalProductos }}</div>
                <div class="inv-stat-label">Productos</div>
            </div>
        </div>

        {{-- 2. Unidades Totales --}}
        <div class="inv-stat-card">
            <div class="inv-stat-icon inv-stat-icon--purple">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="8" height="8" rx="2"/>
                    <rect x="14" y="2" width="8" height="8" rx="2"/>
                    <rect x="8" y="14" width="8" height="8" rx="2"/>
                </svg>
            </div>
            <div class="inv-stat-content">
                <div class="inv-stat-value" id="kpi-unidades-totales">{{ number_format($unidadesTotales, 0, ',', '.') }}</div>
                <div class="inv-stat-label">Unidades totales</div>
            </div>
        </div>

        {{-- 3. Valor en Stock --}}
        <div class="inv-stat-card">
            <div class="inv-stat-icon inv-stat-icon--green">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>
            <div class="inv-stat-content">
                <div class="inv-stat-value" id="kpi-valor-stock">${{ number_format($valorStock, 0, ',', '.') }}</div>
                <div class="inv-stat-label">Valor en stock</div>
            </div>
        </div>

        {{-- 4. Stock Crítico --}}
        <div class="inv-stat-card">
            <div class="inv-stat-icon inv-stat-icon--amber">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
            <div class="inv-stat-content">
                <div class="inv-stat-value" id="kpi-stock-critico">{{ $stockCritico }}</div>
                <div class="inv-stat-label">Stock crítico</div>
            </div>
        </div>

        {{-- 5. Agotados --}}
        <div class="inv-stat-card">
            <div class="inv-stat-icon inv-stat-icon--red">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                </svg>
            </div>
            <div class="inv-stat-content">
                <div class="inv-stat-value" id="kpi-agotados">{{ $agotados }}</div>
                <div class="inv-stat-label">Agotados</div>
            </div>
        </div>
    </div>

    {{-- ── Barra de Búsqueda y Filtros ── --}}
    <div class="inv-filter-card">
        <form method="GET" action="{{ route('inventario.index') }}" id="inv-filter-form" class="inv-filters-form">
            {{-- Búsqueda --}}
            <div class="inv-search-wrap">
                <svg class="inv-search-icon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text"
                    name="search"
                    id="inv-search-input"
                    class="inv-search-input"
                    placeholder="Buscar producto..."
                    value="{{ $search }}"
                    autocomplete="off"
                >
                @if($search)
                    <a href="{{ route('inventario.index', array_filter(['categoria' => $categoria, 'estado' => $estado])) }}" class="inv-search-clear" title="Limpiar">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </a>
                @endif
            </div>

            {{-- Selector de Categorías --}}
            <div class="inv-select-wrap">
                <select name="categoria" id="inv-categoria-select" class="inv-select" onchange="this.form.submit()">
                    <option value="">Todas las categorías</option>
                    @foreach ($categorias as $cat)
                        <option value="{{ $cat->categoria }}" {{ (string)$categoria === (string)$cat->categoria ? 'selected' : '' }}>
                            {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>
                <svg class="inv-select-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </div>

            {{-- Segmented Pills (Todos, OK, Bajo, Agotado) --}}
            <input type="hidden" name="estado" id="inv-estado-input" value="{{ $estado }}">
            <div class="inv-segmented-pills">
                <button type="button"
                        class="inv-pill {{ $estado === 'todos' || empty($estado) ? 'active' : '' }}"
                        onclick="cambiarEstado('todos')">
                    Todos
                </button>
                <button type="button"
                        class="inv-pill {{ $estado === 'ok' || $estado === 'disponible' ? 'active' : '' }}"
                        onclick="cambiarEstado('ok')">
                    OK
                </button>
                <button type="button"
                        class="inv-pill {{ $estado === 'bajo' || $estado === 'critico' ? 'active' : '' }}"
                        onclick="cambiarEstado('bajo')">
                    Bajo
                </button>
                <button type="button"
                        class="inv-pill {{ $estado === 'agotado' || $estado === 'sin_stock' ? 'active' : '' }}"
                        onclick="cambiarEstado('agotado')">
                    Agotado
                </button>
            </div>
        </form>
    </div>

    {{-- ── Tabla de Inventario ── --}}
    <div class="inv-table-card">
        <table class="inv-table">
            <thead>
                <tr>
                    <th class="inv-th-prod">PRODUCTO</th>
                    <th class="inv-th-cat">CATEGORÍA</th>
                    <th class="inv-th-estado">ESTADO</th>
                    <th class="inv-th-stock">STOCK ACTUAL</th>
                    <th class="inv-th-min">STOCK MÍNIMO</th>
                    <th class="inv-th-acc">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $producto)
                    @php
                        $estadoKey = $producto->estado_stock;
                        $stockMin = $producto->stock_minimo ?? 10;
                    @endphp
                    <tr id="row-prod-{{ $producto->productos }}">
                        {{-- Producto con imagen, nombre y código --}}
                        <td>
                            <div class="inv-prod-cell">
                                <div class="inv-thumb-wrap">
                                    @if ($producto->imagen)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="inv-thumb">
                                    @else
                                        <div class="inv-thumb-placeholder">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                                <polyline points="21 15 16 10 5 21"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="inv-prod-details">
                                    <span class="inv-prod-name">{{ $producto->nombre }}</span>
                                    <span class="inv-prod-code">{{ $producto->codigo_barras ?: 'SIN CÓDIGO' }}</span>
                                </div>
                            </div>
                        </td>

                        {{-- Categoría pill --}}
                        <td>
                            <span class="inv-cat-pill">
                                {{ $producto->categoriaObj->nombre ?? 'General' }}
                            </span>
                        </td>

                        {{-- Estado Badge --}}
                        <td>
                            <span class="inv-badge inv-badge--{{ $estadoKey }}" id="badge-prod-{{ $producto->productos }}">
                                {{ $producto->etiqueta_stock }}
                            </span>
                        </td>

                        {{-- Stock Actual --}}
                        <td>
                            <div class="inv-stock-val-wrap">
                                <span class="inv-stock-bold" id="stock-val-{{ $producto->productos }}">{{ $producto->stock }}</span>
                                <span class="inv-unit-lbl">uds</span>
                            </div>
                        </td>

                        {{-- Stock Mínimo --}}
                        <td>
                            <span class="inv-min-lbl" id="min-val-{{ $producto->productos }}">{{ $stockMin }} uds</span>
                        </td>

                        {{-- Acciones (Registrar Entrada / Salida / Ajuste) --}}
                        <td class="inv-td-actions">
                            <button
                                type="button"
                                class="inv-btn-mov"
                                title="Registrar entrada o salida"
                                onclick="abrirModalMovimiento({{ $producto->productos }}, '{{ addslashes($producto->nombre) }}', {{ $producto->stock }}, {{ $stockMin }})"
                            >
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="17 1 21 5 17 9"/>
                                    <path d="M3 11V9a4 4 0 0 1 4-4h14"/>
                                    <polyline points="7 23 3 19 7 15"/>
                                    <path d="M21 13v2a4 4 0 0 1-4 4H3"/>
                                </svg>
                                <span>Ajustar</span>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="inv-empty-state">
                            <div class="inv-empty-content">
                                <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                                <h4>No se encontraron productos</h4>
                                <p>Intenta ajustar el término de búsqueda o restablecer los filtros seleccionados.</p>
                                <a href="{{ route('inventario.index') }}" class="inv-btn-reset">Restablecer filtros</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación y footer --}}
        <div class="inv-table-footer">
            <div class="inv-footer-count">
                Mostrando {{ $productos->count() }} de {{ $productos->total() }} productos
            </div>
            @if($productos->hasPages())
                <div class="inv-pagination">
                    {{ $productos->links() }}
                </div>
            @endif
        </div>
    </div>

</div>

{{-- ── Modal de Movimiento de Inventario ── --}}
<div id="modal-movimiento" class="inv-modal-backdrop" style="display: none;" onclick="cerrarModalMovimiento(event)">
    <div class="inv-modal-dialog">
        <div class="inv-modal-header">
            <div>
                <h3 class="inv-modal-title">Movimiento de Inventario</h3>
                <p class="inv-modal-subtitle" id="modal-prod-nombre">—</p>
            </div>
            <button type="button" class="inv-modal-close" onclick="cerrarModalMovimiento()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <form id="form-movimiento" onsubmit="guardarMovimiento(event)">
            <input type="hidden" id="modal-prod-id" value="">

            <div class="inv-modal-body">
                {{-- Resumen de stock actual --}}
                <div class="inv-modal-summary">
                    <div class="inv-summary-box">
                        <span class="inv-summary-label">Stock Actual</span>
                        <span class="inv-summary-value" id="modal-stock-actual">0</span>
                    </div>
                    <div class="inv-summary-box">
                        <span class="inv-summary-label">Stock Mínimo</span>
                        <span class="inv-summary-value" id="modal-stock-minimo-lbl">0</span>
                    </div>
                </div>

                {{-- Selector de Tipo de Movimiento --}}
                <div class="inv-mov-type-group">
                    <label class="inv-mov-type-label">Tipo de Movimiento</label>
                    <div class="inv-mov-types">
                        <label class="inv-type-pill active" id="type-entrada-lbl">
                            <input type="radio" name="modal_tipo" value="entrada" checked onchange="actualizarTipoMovimiento()">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            <span>Entrada (+)</span>
                        </label>
                        <label class="inv-type-pill" id="type-salida-lbl">
                            <input type="radio" name="modal_tipo" value="salida" onchange="actualizarTipoMovimiento()">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            <span>Salida (−)</span>
                        </label>
                        <label class="inv-type-pill" id="type-ajuste-lbl">
                            <input type="radio" name="modal_tipo" value="ajuste" onchange="actualizarTipoMovimiento()">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"/>
                                <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
                            </svg>
                            <span>Ajuste directo (=)</span>
                        </label>
                    </div>
                </div>

                {{-- Cantidad --}}
                <div class="inv-form-group">
                    <label class="inv-form-label" for="modal-cantidad">
                        <span id="lbl-cantidad-texto">Cantidad a ingresar</span>
                        <span class="inv-req">*</span>
                    </label>
                    <div class="inv-input-wrap">
                        <input type="number" id="modal-cantidad" class="inv-modal-input" min="0" value="1" required>
                    </div>
                </div>

                {{-- Stock Mínimo opcional --}}
                <div class="inv-form-group">
                    <label class="inv-form-label" for="modal-stock-minimo">
                        Alerta de Stock Mínimo (uds)
                    </label>
                    <input type="number" id="modal-stock-minimo" class="inv-modal-input" min="0" placeholder="10">
                </div>

                {{-- Motivo / Observación --}}
                <div class="inv-form-group">
                    <label class="inv-form-label" for="modal-motivo">
                        Motivo u Observación (Opcional)
                    </label>
                    <input type="text" id="modal-motivo" class="inv-modal-input" placeholder="Ej. Compra proveedor, Venta física, Reconteo...">
                </div>
            </div>

            <div class="inv-modal-footer">
                <button type="button" class="inv-btn-ghost" onclick="cerrarModalMovimiento()">Cancelar</button>
                <button type="submit" class="inv-btn-primary" id="btn-submit-mov">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                    </svg>
                    <span>Confirmar Movimiento</span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<style>
/* ── Página Inventario ── */
.inv-page {
    display: flex;
    flex-direction: column;
    gap: 22px;
}

/* Encabezado */
.inv-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}
.inv-header__title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.55rem;
    font-weight: 800;
    color: #090d16;
    letter-spacing: -.025em;
    margin-bottom: 4px;
}
.inv-header__sub {
    font-size: .88rem;
    color: #64748b;
    font-weight: 400;
}

/* Toast */
.inv-toast {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 18px;
    border-radius: 12px;
    font-size: .875rem;
    font-weight: 500;
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #065f46;
    animation: invSlideDown .3s ease;
}
@keyframes invSlideDown {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── 5 Tarjetas KPIs ── */
.inv-stats {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
}
.inv-stat-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 20px 22px;
    display: flex;
    align-items: center;
    gap: 16px;
    box-shadow: 0 1px 3px rgba(9, 13, 22, 0.04), 0 4px 12px rgba(9, 13, 22, 0.02);
    transition: all .25s ease;
}
.inv-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px -4px rgba(9, 13, 22, 0.08);
}
.inv-stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: transform .2s ease;
}
.inv-stat-card:hover .inv-stat-icon {
    transform: scale(1.06);
}
.inv-stat-icon--blue   { background: #eff6ff; color: #2563eb; }
.inv-stat-icon--purple { background: #f5f3ff; color: #8b5cf6; }
.inv-stat-icon--green  { background: #ecfdf5; color: #10b981; }
.inv-stat-icon--amber  { background: #fffbeb; color: #f59e0b; }
.inv-stat-icon--red    { background: #fff1f2; color: #f43f5e; }

.inv-stat-content {
    display: flex;
    flex-direction: column;
}
.inv-stat-value {
    font-family: 'Outfit', sans-serif;
    font-size: 1.65rem;
    font-weight: 800;
    color: #090d16;
    letter-spacing: -.03em;
    line-height: 1.1;
}
.inv-stat-label {
    font-size: .8rem;
    color: #64748b;
    margin-top: 3px;
    font-weight: 500;
}

/* ── Barra de Búsqueda y Filtros ── */
.inv-filter-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 10px 14px;
    box-shadow: 0 1px 3px rgba(9, 13, 22, 0.04);
}
.inv-filters-form {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
}

/* Input búsqueda */
.inv-search-wrap {
    flex: 1;
    min-width: 260px;
    display: flex;
    align-items: center;
    gap: 10px;
    position: relative;
}
.inv-search-icon {
    color: #94a3b8;
    flex-shrink: 0;
}
.inv-search-input {
    flex: 1;
    border: none;
    outline: none;
    font-family: 'Inter', sans-serif;
    font-size: .9rem;
    color: #090d16;
    background: transparent;
    padding: 6px 0;
}
.inv-search-input::placeholder {
    color: #94a3b8;
}
.inv-search-clear {
    color: #94a3b8;
    display: flex;
    align-items: center;
    padding: 4px;
    border-radius: 50%;
    transition: all .2s;
}
.inv-search-clear:hover {
    background: #f1f5f9;
    color: #475569;
}

/* Dropdown Categoría */
.inv-select-wrap {
    position: relative;
    display: flex;
    align-items: center;
}
.inv-select {
    appearance: none;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    font-family: 'Inter', sans-serif;
    font-size: .85rem;
    color: #475569;
    background: #f8fafc;
    padding: 8px 34px 8px 14px;
    outline: none;
    cursor: pointer;
    transition: all .2s;
    font-weight: 500;
}
.inv-select:focus {
    border-color: #2563eb;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}
.inv-select-arrow {
    position: absolute;
    right: 12px;
    color: #64748b;
    pointer-events: none;
}

/* Segmented Pills (Todos, OK, Bajo, Agotado) */
.inv-segmented-pills {
    display: flex;
    align-items: center;
    gap: 4px;
    background: #f1f5f9;
    padding: 4px;
    border-radius: 12px;
}
.inv-pill {
    background: transparent;
    border: none;
    border-radius: 9px;
    padding: 6px 14px;
    font-family: 'Inter', sans-serif;
    font-size: .82rem;
    font-weight: 600;
    color: #64748b;
    cursor: pointer;
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
}
.inv-pill:hover:not(.active) {
    color: #090d16;
}
.inv-pill.active {
    background: #090d16;
    color: #fff;
    box-shadow: 0 2px 8px rgba(9, 13, 22, 0.25);
}

/* ── Tabla de Inventario ── */
.inv-table-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(9, 13, 22, 0.04), 0 4px 12px rgba(9, 13, 22, 0.02);
    overflow: hidden;
}
.inv-table {
    width: 100%;
    border-collapse: collapse;
}
.inv-table th {
    padding: 14px 20px;
    text-align: left;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: #64748b;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}
.inv-th-acc { text-align: center; width: 110px; }
.inv-table td {
    padding: 15px 20px;
    font-size: .88rem;
    color: #090d16;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}
.inv-table tr:last-child td { border-bottom: none; }
.inv-table tbody tr {
    transition: background .15s ease;
}
.inv-table tbody tr:hover td {
    background: #f8fafc;
}

/* Celdas específicas */
.inv-prod-cell {
    display: flex;
    align-items: center;
    gap: 14px;
}
.inv-thumb-wrap {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    overflow: hidden;
    flex-shrink: 0;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
}
.inv-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.inv-thumb-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
}
.inv-prod-details {
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.inv-prod-name {
    font-weight: 700;
    color: #090d16;
    font-size: .88rem;
}
.inv-prod-code {
    font-size: .76rem;
    color: #94a3b8;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
}

/* Categoría pill */
.inv-cat-pill {
    display: inline-block;
    padding: 4px 12px;
    background: #f1f5f9;
    color: #475569;
    border-radius: 999px;
    font-size: .75rem;
    font-weight: 600;
    text-transform: capitalize;
}

/* Estado badges */
.inv-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: .74rem;
    font-weight: 700;
    white-space: nowrap;
}
.inv-badge--disponible {
    background: #dcfce7;
    color: #16a34a;
    border: 1px solid #bbf7d0;
}
.inv-badge--bajo {
    background: #fef3c7;
    color: #d97706;
    border: 1px solid #fde68a;
}
.inv-badge--agotado, .inv-badge--sin_stock {
    background: #fee2e2;
    color: #dc2626;
    border: 1px solid #fecdd3;
}

/* Stock Actual & Mínimo */
.inv-stock-val-wrap {
    display: flex;
    align-items: baseline;
    gap: 4px;
}
.inv-stock-bold {
    font-family: 'Outfit', sans-serif;
    font-size: 1.15rem;
    font-weight: 800;
    color: #090d16;
}
.inv-unit-lbl {
    font-size: .78rem;
    color: #94a3b8;
    font-weight: 500;
}
.inv-min-lbl {
    font-size: .84rem;
    color: #64748b;
    font-weight: 500;
}

/* Botón Ajustar */
.inv-td-actions { text-align: center; }
.inv-btn-mov {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    background: #eff6ff;
    color: #2563eb;
    border: 1px solid #bfdbfe;
    border-radius: 10px;
    font-family: 'Outfit', sans-serif;
    font-size: .8rem;
    font-weight: 700;
    cursor: pointer;
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
}
.inv-btn-mov:hover {
    background: #2563eb;
    color: #fff;
    border-color: #2563eb;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.28);
}

/* Estado vacío */
.inv-empty-state {
    text-align: center;
    padding: 60px 20px !important;
}
.inv-empty-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    color: #94a3b8;
}
.inv-empty-content svg { opacity: .4; margin-bottom: 4px; }
.inv-empty-content h4 { font-size: 1.05rem; font-weight: 700; color: #090d16; }
.inv-empty-content p { font-size: .85rem; max-width: 380px; }
.inv-btn-reset {
    margin-top: 10px;
    display: inline-block;
    padding: 8px 16px;
    background: #f1f5f9;
    color: #090d16;
    border-radius: 9px;
    font-size: .82rem;
    font-weight: 600;
    text-decoration: none;
    transition: background .2s;
}
.inv-btn-reset:hover { background: #e2e8f0; }

/* Footer de la tabla */
.inv-table-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    padding: 12px 20px;
    font-size: .8rem;
    color: #64748b;
    border-top: 1px solid #f1f5f9;
    background: #f8fafc;
}

/* ── Modal de Movimiento ── */
.inv-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(9, 13, 22, 0.55);
    backdrop-filter: blur(6px);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: invFadeIn .2s ease;
}
@keyframes invFadeIn { from { opacity: 0; } to { opacity: 1; } }

.inv-modal-dialog {
    background: #fff;
    border-radius: 20px;
    width: 100%;
    max-width: 440px;
    box-shadow: 0 25px 60px -10px rgba(9, 13, 22, 0.3);
    animation: invPopup .25s cubic-bezier(0.16, 1, 0.3, 1);
    overflow: hidden;
}
@keyframes invPopup {
    from { opacity: 0; transform: scale(.94) translateY(12px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}

.inv-modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 22px 24px 0;
    gap: 12px;
}
.inv-modal-title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.2rem;
    font-weight: 800;
    color: #090d16;
}
.inv-modal-subtitle {
    font-size: .84rem;
    color: #2563eb;
    font-weight: 600;
    margin-top: 2px;
}
.inv-modal-close {
    background: #f1f5f9;
    border: none;
    cursor: pointer;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    transition: all .2s;
    flex-shrink: 0;
}
.inv-modal-close:hover {
    background: #e2e8f0;
    color: #090d16;
}

.inv-modal-body {
    padding: 20px 24px;
    display: flex;
    flex-direction: column;
    gap: 18px;
}

/* Resumen stock en modal */
.inv-modal-summary {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}
.inv-summary-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 14px;
    display: flex;
    flex-direction: column;
}
.inv-summary-label {
    font-size: .75rem;
    color: #64748b;
    font-weight: 500;
}
.inv-summary-value {
    font-family: 'Outfit', sans-serif;
    font-size: 1.4rem;
    font-weight: 800;
    color: #090d16;
    margin-top: 2px;
}

/* Selector tipos de movimiento */
.inv-mov-type-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.inv-mov-type-label {
    font-size: .8rem;
    font-weight: 600;
    color: #1e293b;
}
.inv-mov-types {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
}
.inv-type-pill {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    padding: 10px 6px;
    font-size: .75rem;
    font-weight: 600;
    color: #475569;
    cursor: pointer;
    transition: all .2s;
    text-align: center;
}
.inv-type-pill input[type="radio"] { display: none; }
.inv-type-pill:hover {
    border-color: #2563eb;
    color: #2563eb;
    background: #eff6ff;
}
.inv-type-pill.active {
    border-color: #2563eb;
    color: #2563eb;
    background: #eff6ff;
}

/* Inputs en modal */
.inv-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.inv-form-label {
    font-size: .82rem;
    font-weight: 600;
    color: #1e293b;
}
.inv-req { color: #f43f5e; }
.inv-modal-input {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    font-family: 'Inter', sans-serif;
    font-size: .88rem;
    color: #090d16;
    outline: none;
    transition: all .2s;
}
.inv-modal-input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

.inv-modal-footer {
    padding: 0 24px 22px;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}
.inv-btn-ghost {
    padding: 10px 18px;
    background: #f1f5f9;
    color: #475569;
    border: none;
    border-radius: 12px;
    font-family: 'Outfit', sans-serif;
    font-size: .88rem;
    font-weight: 700;
    cursor: pointer;
    transition: all .2s;
}
.inv-btn-ghost:hover {
    background: #e2e8f0;
    color: #090d16;
}
.inv-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 22px;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-family: 'Outfit', sans-serif;
    font-size: .88rem;
    font-weight: 700;
    cursor: pointer;
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 14px rgba(37, 99, 235, .28);
}
.inv-btn-primary:hover {
    box-shadow: 0 8px 22px rgba(37, 99, 235, .38);
    transform: translateY(-1px);
}

/* Responsividad */
@media (max-width: 1100px) {
    .inv-stats { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
    .inv-stats { grid-template-columns: repeat(2, 1fr); }
    .inv-filters-form { flex-direction: column; align-items: stretch; }
    .inv-search-wrap, .inv-select, .inv-segmented-pills { width: 100%; }
    .inv-segmented-pills { justify-content: space-between; }
    .inv-pill { flex: 1; text-align: center; }
}
@media (max-width: 540px) {
    .inv-stats { grid-template-columns: 1fr; }
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    // Búsqueda con debounce
    var searchInput = document.getElementById('inv-search-input');
    var filterForm  = document.getElementById('inv-filter-form');
    var timer;

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(function () {
                filterForm.submit();
            }, 400);
        });
    }

    // Auto-ocultar toast
    var toast = document.getElementById('inv-toast');
    if (toast) {
        setTimeout(function () {
            toast.style.transition = 'opacity .4s ease';
            toast.style.opacity    = '0';
            setTimeout(function () { toast.remove(); }, 400);
        }, 3500);
    }
})();

// Cambio de pestaña de estado
function cambiarEstado(estado) {
    document.getElementById('inv-estado-input').value = estado;
    document.getElementById('inv-filter-form').submit();
}

// ── Modal de Movimiento de Inventario ──
var _movProdId = null;
var _movStockActual = 0;
var _movStockMinimo = 0;

function abrirModalMovimiento(id, nombre, stock, min) {
    _movProdId      = id;
    _movStockActual = stock;
    _movStockMinimo = min;

    document.getElementById('modal-prod-id').value             = id;
    document.getElementById('modal-prod-nombre').textContent   = nombre;
    document.getElementById('modal-stock-actual').textContent  = stock + ' uds';
    document.getElementById('modal-stock-minimo-lbl').textContent = min + ' uds';
    document.getElementById('modal-cantidad').value            = 1;
    document.getElementById('modal-stock-minimo').value        = min;
    document.getElementById('modal-motivo').value              = '';

    // Resetear radio a entrada
    document.querySelector('input[name="modal_tipo"][value="entrada"]').checked = true;
    actualizarTipoMovimiento();

    document.getElementById('modal-movimiento').style.display = 'flex';
    document.getElementById('modal-cantidad').focus();
}

function cerrarModalMovimiento(e) {
    if (e && e.target !== document.getElementById('modal-movimiento')) return;
    document.getElementById('modal-movimiento').style.display = 'none';
}

function actualizarTipoMovimiento() {
    var radioVal = document.querySelector('input[name="modal_tipo"]:checked').value;
    var lbl = document.getElementById('lbl-cantidad-texto');

    document.querySelectorAll('.inv-type-pill').forEach(function (pill) {
        var val = pill.querySelector('input').value;
        pill.classList.toggle('active', val === radioVal);
    });

    if (radioVal === 'entrada') {
        lbl.textContent = 'Cantidad a ingresar';
    } else if (radioVal === 'salida') {
        lbl.textContent = 'Cantidad a retirar';
    } else {
        lbl.textContent = 'Nuevo stock total';
    }
}

function guardarMovimiento(e) {
    e.preventDefault();

    var id       = document.getElementById('modal-prod-id').value;
    var tipo     = document.querySelector('input[name="modal_tipo"]:checked').value;
    var cantidad = parseInt(document.getElementById('modal-cantidad').value, 10);
    var stockMin = document.getElementById('modal-stock-minimo').value;
    var motivo   = document.getElementById('modal-motivo').value;
    var btn      = document.getElementById('btn-submit-mov');

    if (isNaN(cantidad) || cantidad < 0) {
        alert('Por favor ingresa una cantidad válida.');
        return;
    }

    btn.disabled  = true;
    btn.innerHTML = 'Guardando…';

    var csrf = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '';

    fetch('/inventario/' + id + '/movimiento', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            tipo: tipo,
            cantidad: cantidad,
            stock_minimo: stockMin !== '' ? parseInt(stockMin, 10) : null,
            motivo: motivo
        })
    })
    .then(function (res) { return res.json(); })
    .then(function (data) {
        if (data.success) {
            // Actualizar celda en la tabla sin recargar
            var stockCell = document.getElementById('stock-val-' + id);
            var minCell   = document.getElementById('min-val-' + id);
            var badgeCell = document.getElementById('badge-prod-' + id);

            if (stockCell) stockCell.textContent = data.stock;
            if (minCell && data.stock_minimo !== null) minCell.textContent = data.stock_minimo + ' uds';

            if (badgeCell) {
                badgeCell.className   = 'inv-badge inv-badge--' + data.estado;
                badgeCell.textContent = data.etiqueta;
            }

            document.getElementById('modal-movimiento').style.display = 'none';

            // Recargar para sincronizar KPIs globales
            window.location.reload();
        } else {
            alert(data.message || 'Error al guardar el movimiento.');
        }
    })
    .catch(function () {
        alert('Error de conexión al servidor.');
    })
    .finally(function () {
        btn.disabled  = false;
        btn.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
            </svg>
            <span>Confirmar Movimiento</span>
        `;
    });
}

// Cerrar con Escape
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        var modal = document.getElementById('modal-movimiento');
        if (modal) modal.style.display = 'none';
    }
});
</script>
@endpush
