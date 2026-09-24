@extends('layouts.dashboard')

@section('title', 'Historial de Ventas')
@section('page-title', 'Ventas')

@section('content')
<div class="vt-page">

    {{-- ── Encabezado ── --}}
    <div class="vt-header">
        <div>
            <h1 class="vt-header__title">Historial de Ventas</h1>
            <p class="vt-header__sub">Consulta y administra todos los registros de ventas.</p>
        </div>
        <div>
            <button type="button" class="vt-btn-nueva" onclick="abrirModalNuevaVenta()">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                <span>Nueva Venta</span>
            </button>
        </div>
    </div>

    {{-- ── Toast de éxito / alerta ── --}}
    @if (session('success'))
        <div class="vt-toast vt-toast--ok" id="vt-toast">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- ── 4 Tarjetas de Estadísticas (KPIs) ── --}}
    <div class="vt-stats">
        {{-- 1. Total ventas --}}
        <div class="vt-stat-card">
            <div class="vt-stat-icon vt-stat-icon--blue">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
            </div>
            <div class="vt-stat-content">
                <div class="vt-stat-value" id="kpi-total-ventas">{{ $totalVentas }}</div>
                <div class="vt-stat-label">Total ventas</div>
            </div>
        </div>

        {{-- 2. Ingresos totales --}}
        <div class="vt-stat-card">
            <div class="vt-stat-icon vt-stat-icon--green">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>
            <div class="vt-stat-content">
                <div class="vt-stat-value" id="kpi-ingresos-totales">${{ number_format($ingresosTotales, 0, ',', '.') }}</div>
                <div class="vt-stat-label">Ingresos totales</div>
            </div>
        </div>

        {{-- 3. Ingresos hoy --}}
        <div class="vt-stat-card">
            <div class="vt-stat-icon vt-stat-icon--purple">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
            <div class="vt-stat-content">
                <div class="vt-stat-value" id="kpi-ingresos-hoy">${{ number_format($ingresosHoy, 0, ',', '.') }}</div>
                <div class="vt-stat-label">Ingresos hoy ({{ $ventasHoyCount }} ventas)</div>
            </div>
        </div>

        {{-- 4. Venta más alta --}}
        <div class="vt-stat-card">
            <div class="vt-stat-icon vt-stat-icon--amber">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                    <polyline points="17 6 23 6 23 12"/>
                </svg>
            </div>
            <div class="vt-stat-content">
                <div class="vt-stat-value" id="kpi-venta-mas-alta">${{ number_format($ventaMasAlta, 0, ',', '.') }}</div>
                <div class="vt-stat-label">Venta más alta</div>
            </div>
        </div>
    </div>

    {{-- ── Barra de Búsqueda y Filtro de Fecha ── --}}
    <div class="vt-filter-card">
        <form method="GET" action="{{ route('ventas.index') }}" id="vt-filter-form" class="vt-filters-form">
            {{-- Búsqueda --}}
            <div class="vt-search-wrap">
                <svg class="vt-search-icon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text"
                    name="search"
                    id="vt-search-input"
                    class="vt-search-input"
                    placeholder="Buscar por # venta o responsable..."
                    value="{{ $search }}"
                    autocomplete="off"
                >
            </div>

            {{-- Selector de fecha --}}
            <div class="vt-date-wrap">
                <input
                    type="date"
                    name="fecha"
                    id="vt-date-input"
                    class="vt-date-input"
                    value="{{ $fecha }}"
                    onchange="this.form.submit()"
                >
            </div>

            {{-- Botón Limpiar --}}
            @if($search || $fecha)
                <a href="{{ route('ventas.index') }}" class="vt-btn-limpiar" title="Restablecer filtros">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                    <span>Limpiar</span>
                </a>
            @else
                <button type="button" class="vt-btn-limpiar disabled" disabled>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                    <span>Limpiar</span>
                </button>
            @endif
        </form>
    </div>

    {{-- ── Tabla de Historial de Ventas ── --}}
    <div class="vt-table-card">
        <table class="vt-table">
            <thead>
                <tr>
                    <th class="vt-th-id"># VENTA</th>
                    <th class="vt-th-resp">RESPONSABLE</th>
                    <th class="vt-th-fecha">FECHA</th>
                    <th class="vt-th-total">TOTAL</th>
                    <th class="vt-th-acc">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ventas as $v)
                    <tr id="row-venta-{{ $v->ventas }}">
                        {{-- Número de venta formateado --}}
                        <td>
                            <span class="vt-sale-id">{{ $v->numero_venta }}</span>
                        </td>

                        {{-- Responsable con avatar circular --}}
                        <td>
                            <div class="vt-resp-cell">
                                <div class="vt-avatar">
                                    {{ $v->inicial_responsable }}
                                </div>
                                <span class="vt-resp-name">{{ $v->nombre_responsable }}</span>
                            </div>
                        </td>

                        {{-- Fecha y hora --}}
                        <td>
                            <div class="vt-date-cell">
                                <span class="vt-date-val">{{ $v->fecha_formateada }}</span>
                                <span class="vt-time-val">{{ $v->hora_formateada }}</span>
                            </div>
                        </td>

                        {{-- Total --}}
                        <td>
                            <span class="vt-total-val">{{ $v->total_formateado }}</span>
                        </td>

                        {{-- Acciones (Ver comprobante, Imprimir ticket) --}}
                        <td class="vt-td-actions">
                            <button
                                type="button"
                                class="vt-btn-act vt-btn-act--view"
                                title="Ver detalles de la venta"
                                onclick="verDetalleVenta({{ $v->ventas }})"
                            >
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                            <button
                                type="button"
                                class="vt-btn-act vt-btn-act--print"
                                title="Imprimir ticket"
                                onclick="imprimirVentaDirecta({{ $v->ventas }})"
                            >
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 6 2 18 2 18 9"/>
                                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                                    <rect x="6" y="14" width="12" height="8"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="vt-empty-state">
                            <div class="vt-empty-content">
                                <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                                <h4>No se encontraron ventas registradas</h4>
                                <p>Ajusta el filtro de búsqueda o registra una nueva venta para comenzar a visualizar el historial.</p>
                                @if($search || $fecha)
                                    <a href="{{ route('ventas.index') }}" class="vt-btn-reset">Restablecer filtros</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Footer tabla y paginación --}}
        <div class="vt-table-footer">
            <div class="vt-footer-count">
                Mostrando {{ $ventas->count() }} de {{ $ventas->total() }} registros
            </div>
            @if($ventas->hasPages())
                <div class="vt-pagination">
                    {{ $ventas->links() }}
                </div>
            @endif
        </div>
    </div>

</div>

{{-- ── Modal Nueva Venta ── --}}
<div id="modal-nueva-venta" class="vt-modal-backdrop" style="display: none;" onclick="cerrarModalNuevaVenta(event)">
    <div class="vt-modal-dialog vt-modal-dialog--lg">
        <div class="vt-modal-header">
            <div>
                <h3 class="vt-modal-title">Registrar Nueva Venta</h3>
                <p class="vt-modal-subtitle">Selecciona los productos y confirma el método de pago.</p>
            </div>
            <button type="button" class="vt-modal-close" onclick="cerrarModalNuevaVenta()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <form id="form-nueva-venta" onsubmit="guardarNuevaVenta(event)">
            <div class="vt-modal-body">
                {{-- Selector de productos para agregar --}}
                <div class="vt-add-item-box">
                    <div class="vt-form-group" style="flex: 2;">
                        <label class="vt-form-label" for="select-producto">Producto</label>
                        <select id="select-producto" class="vt-input" onchange="actualizarPrecioProducto()">
                            <option value="">-- Seleccionar producto --</option>
                            @foreach ($productos as $p)
                                <option value="{{ $p->productos }}" data-precio="{{ $p->precio_venta }}" data-stock="{{ $p->stock }}">
                                    {{ $p->nombre }} (Stock: {{ $p->stock }} | ${{ number_format($p->precio_venta, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="vt-form-group" style="flex: 1; max-width: 110px;">
                        <label class="vt-form-label" for="input-item-cant">Cantidad</label>
                        <input type="number" id="input-item-cant" class="vt-input" min="1" value="1">
                    </div>
                    <div class="vt-form-group" style="justify-content: flex-end;">
                        <button type="button" class="vt-btn-add-item" onclick="agregarItemAlCarrito()">
                            + Agregar
                        </button>
                    </div>
                </div>

                {{-- Tabla de items de la venta --}}
                <div class="vt-cart-table-wrap">
                    <table class="vt-cart-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th style="text-align:center;">Cant.</th>
                                <th style="text-align:right;">Precio</th>
                                <th style="text-align:right;">Subtotal</th>
                                <th style="text-align:center; width: 40px;"></th>
                            </tr>
                        </thead>
                        <tbody id="cart-items-body">
                            <tr id="cart-empty-row">
                                <td colspan="5" style="text-align:center; color:#94a3b8; padding: 24px;">
                                    <div style="font-weight:600; color:#475569; margin-bottom:4px;">No has agregado ningún producto a la venta.</div>
                                    <div style="font-size:.82rem; color:#94a3b8;">Selecciona un producto arriba y haz clic en <strong>"+ Agregar"</strong> (o pulsa "Procesar Venta" para agregarlo automáticamente).</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Método de Pago y Total --}}
                <div class="vt-checkout-bar">
                    <div class="vt-form-group" style="flex: 1;">
                        <label class="vt-form-label" for="select-metodo-pago">Método de Pago</label>
                        <select id="select-metodo-pago" class="vt-input" required>
                            @foreach ($metodosPago as $metodo)
                                <option value="{{ $metodo }}">{{ $metodo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="vt-total-box">
                        <span class="vt-total-lbl">Total a Pagar</span>
                        <span class="vt-total-amount" id="lbl-total-venta">$0</span>
                    </div>
                </div>
            </div>

            <div class="vt-modal-footer">
                <button type="button" class="vt-btn-ghost" onclick="cerrarModalNuevaVenta()">Cancelar</button>
                <button type="submit" class="vt-btn-primary" id="btn-submit-venta">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <span>Procesar Venta</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ── Modal Detalle de Venta / Comprobante ── --}}
<div id="modal-detalle-venta" class="vt-modal-backdrop" style="display: none;" onclick="cerrarModalDetalle(event)">
    <div class="vt-modal-dialog">
        <div class="vt-modal-header">
            <div>
                <h3 class="vt-modal-title" id="det-modal-title">Comprobante de Venta</h3>
                <p class="vt-modal-subtitle" id="det-modal-sub">—</p>
            </div>
            <button type="button" class="vt-modal-close" onclick="cerrarModalDetalle()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div class="vt-modal-body" id="ticket-printable-area">
            {{-- Encabezado comprobante --}}
            <div class="vt-ticket-header">
                <div class="vt-ticket-brand">Almacén <strong>Europa</strong></div>
                <div class="vt-ticket-meta" id="det-ticket-num">#000000</div>
                <div class="vt-ticket-line" id="det-ticket-fecha">—</div>
                <div class="vt-ticket-line" id="det-ticket-resp">Responsable: —</div>
                <div class="vt-ticket-line" id="det-ticket-metodo">Método de pago: —</div>
            </div>

            {{-- Desglose items --}}
            <div class="vt-ticket-items">
                <table class="vt-ticket-table">
                    <thead>
                        <tr>
                            <th>Cant.</th>
                            <th>Descripción</th>
                            <th style="text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody id="det-items-body">
                        {{-- Items dinámicos --}}
                    </tbody>
                </table>
            </div>

            {{-- Total final --}}
            <div class="vt-ticket-total-wrap">
                <span class="vt-ticket-total-lbl">TOTAL PAGADO</span>
                <span class="vt-ticket-total-val" id="det-ticket-total">$0</span>
            </div>

            <div class="vt-ticket-footer">
                ¡Gracias por su compra en Almacén Europa!
            </div>
        </div>

        <div class="vt-modal-footer">
            <button type="button" class="vt-btn-ghost" onclick="cerrarModalDetalle()">Cerrar</button>
            <button type="button" class="vt-btn-primary" onclick="imprimirTicketActual()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 6 2 18 2 18 9"/>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                    <rect x="6" y="14" width="12" height="8"/>
                </svg>
                <span>Imprimir Ticket</span>
            </button>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
/* ── Página Ventas ── */
.vt-page {
    display: flex;
    flex-direction: column;
    gap: 22px;
}

/* Encabezado */
.vt-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}
.vt-header__title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.55rem;
    font-weight: 800;
    color: #090d16;
    letter-spacing: -.025em;
    margin-bottom: 4px;
}
.vt-header__sub {
    font-size: .88rem;
    color: #64748b;
    font-weight: 400;
}

/* Botón + Nueva Venta */
.vt-btn-nueva {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: #0f172a;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-family: 'Outfit', sans-serif;
    font-size: .88rem;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(15, 23, 42, 0.28);
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
}
.vt-btn-nueva:hover {
    background: #1e293b;
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(15, 23, 42, 0.36);
}

/* Toast */
.vt-toast {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 18px;
    border-radius: 12px;
    font-size: .875rem;
    font-weight: 500;
    animation: vtSlideDown .3s ease;
}
.vt-toast--ok {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #065f46;
}
@keyframes vtSlideDown {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── 4 Tarjetas KPIs ── */
.vt-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}
.vt-stat-card {
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
.vt-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px -4px rgba(9, 13, 22, 0.08);
}
.vt-stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: transform .2s ease;
}
.vt-stat-card:hover .vt-stat-icon {
    transform: scale(1.06);
}
.vt-stat-icon--blue   { background: #eff6ff; color: #2563eb; }
.vt-stat-icon--green  { background: #ecfdf5; color: #10b981; }
.vt-stat-icon--purple { background: #f5f3ff; color: #8b5cf6; }
.vt-stat-icon--amber  { background: #fffbeb; color: #f59e0b; }

.vt-stat-content {
    display: flex;
    flex-direction: column;
}
.vt-stat-value {
    font-family: 'Outfit', sans-serif;
    font-size: 1.65rem;
    font-weight: 800;
    color: #090d16;
    letter-spacing: -.03em;
    line-height: 1.1;
}
.vt-stat-label {
    font-size: .8rem;
    color: #64748b;
    margin-top: 3px;
    font-weight: 500;
}

/* ── Filtros ── */
.vt-filter-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 10px 14px;
    box-shadow: 0 1px 3px rgba(9, 13, 22, 0.04);
}
.vt-filters-form {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
}

/* Buscador */
.vt-search-wrap {
    flex: 1;
    min-width: 260px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.vt-search-icon {
    color: #94a3b8;
    flex-shrink: 0;
}
.vt-search-input {
    flex: 1;
    border: none;
    outline: none;
    font-family: 'Inter', sans-serif;
    font-size: .88rem;
    color: #090d16;
    background: transparent;
    padding: 6px 0;
}
.vt-search-input::placeholder {
    color: #94a3b8;
}

/* Date input */
.vt-date-wrap {
    display: flex;
    align-items: center;
}
.vt-date-input {
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    font-family: 'Inter', sans-serif;
    font-size: .84rem;
    color: #475569;
    background: #f8fafc;
    padding: 7px 12px;
    outline: none;
    cursor: pointer;
    transition: all .2s;
}
.vt-date-input:focus {
    border-color: #2563eb;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

/* Botón Limpiar */
.vt-btn-limpiar {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 12px;
    border: 1.5px solid #e2e8f0;
    background: #f8fafc;
    color: #475569;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: all .2s;
}
.vt-btn-limpiar:hover:not(.disabled) {
    background: #e2e8f0;
    color: #090d16;
}
.vt-btn-limpiar.disabled {
    opacity: .5;
    cursor: not-allowed;
}

/* ── Tabla de Historial ── */
.vt-table-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(9, 13, 22, 0.04), 0 4px 12px rgba(9, 13, 22, 0.02);
    overflow: hidden;
}
.vt-table {
    width: 100%;
    border-collapse: collapse;
}
.vt-table th {
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
.vt-th-total { text-align: right; }
.vt-th-acc   { text-align: center; width: 110px; }
.vt-table td {
    padding: 15px 20px;
    font-size: .88rem;
    color: #090d16;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}
.vt-table tr:last-child td { border-bottom: none; }
.vt-table tbody tr {
    transition: background .15s ease;
}
.vt-table tbody tr:hover td {
    background: #f8fafc;
}

/* Columnas */
.vt-sale-id {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-weight: 700;
    font-size: .9rem;
    color: #2563eb;
}

.vt-resp-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}
.vt-avatar {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #eff6ff;
    color: #2563eb;
    border: 1px solid #bfdbfe;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem;
    font-weight: 800;
    flex-shrink: 0;
}
.vt-resp-name {
    font-weight: 600;
    color: #090d16;
}

.vt-date-cell {
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.vt-date-val {
    font-weight: 500;
    color: #334155;
}
.vt-time-val {
    font-size: .75rem;
    color: #94a3b8;
}

.vt-total-val {
    display: block;
    text-align: right;
    font-family: 'Outfit', sans-serif;
    font-weight: 800;
    font-size: 1rem;
    color: #090d16;
}

/* Botones de acción */
.vt-td-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.vt-btn-act {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
}
.vt-btn-act--view {
    background: #eff6ff;
    color: #2563eb;
}
.vt-btn-act--view:hover {
    background: #dbeafe;
    transform: translateY(-1px);
}
.vt-btn-act--print {
    background: #ecfdf5;
    color: #10b981;
}
.vt-btn-act--print:hover {
    background: #d1fae5;
    transform: translateY(-1px);
}

/* Vacío */
.vt-empty-state {
    text-align: center;
    padding: 60px 20px !important;
}
.vt-empty-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    color: #94a3b8;
}
.vt-empty-content svg { opacity: .4; margin-bottom: 4px; }
.vt-empty-content h4 { font-size: 1.05rem; font-weight: 700; color: #090d16; }
.vt-empty-content p { font-size: .85rem; max-width: 380px; }
.vt-btn-reset {
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
.vt-btn-reset:hover { background: #e2e8f0; }

/* Footer tabla */
.vt-table-footer {
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

/* ── Modal Styles ── */
.vt-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(9, 13, 22, 0.55);
    backdrop-filter: blur(6px);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: vtFadeIn .2s ease;
}
@keyframes vtFadeIn { from { opacity: 0; } to { opacity: 1; } }

.vt-modal-dialog {
    background: #fff;
    border-radius: 20px;
    width: 100%;
    max-width: 460px;
    box-shadow: 0 25px 60px -10px rgba(9, 13, 22, 0.3);
    animation: vtPopup .25s cubic-bezier(0.16, 1, 0.3, 1);
    overflow: hidden;
}
.vt-modal-dialog--lg { max-width: 600px; }
@keyframes vtPopup {
    from { opacity: 0; transform: scale(.94) translateY(12px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}

.vt-modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 22px 24px 0;
    gap: 12px;
}
.vt-modal-title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    color: #090d16;
}
.vt-modal-subtitle {
    font-size: .84rem;
    color: #64748b;
    margin-top: 2px;
}
.vt-modal-close {
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
.vt-modal-close:hover {
    background: #e2e8f0;
    color: #090d16;
}

.vt-modal-body {
    padding: 20px 24px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.vt-modal-footer {
    padding: 0 24px 22px;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.vt-btn-ghost {
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
.vt-btn-ghost:hover {
    background: #e2e8f0;
    color: #090d16;
}
.vt-btn-primary {
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
    box-shadow: 0 4px 14px rgba(37, 99, 235, .28);
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
}
.vt-btn-primary:hover {
    box-shadow: 0 8px 22px rgba(37, 99, 235, .38);
    transform: translateY(-1px);
}

/* Elementos formulario en modal nueva venta */
.vt-add-item-box {
    display: flex;
    align-items: flex-end;
    gap: 10px;
    background: #f8fafc;
    padding: 14px;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    flex-wrap: wrap;
}
.vt-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.vt-form-label {
    font-size: .8rem;
    font-weight: 600;
    color: #1e293b;
}
.vt-input {
    width: 100%;
    padding: 9px 12px;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-family: 'Inter', sans-serif;
    font-size: .85rem;
    color: #090d16;
    outline: none;
    transition: all .2s;
    background: #fff;
}
.vt-input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}
.vt-btn-add-item {
    padding: 9px 16px;
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-family: 'Outfit', sans-serif;
    font-size: .84rem;
    font-weight: 700;
    cursor: pointer;
    transition: background .2s;
    white-space: nowrap;
}
.vt-btn-add-item:hover {
    background: #1d4ed8;
}

/* Tabla de items del carrito */
.vt-cart-table-wrap {
    max-height: 180px;
    overflow-y: auto;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
}
.vt-cart-table {
    width: 100%;
    border-collapse: collapse;
}
.vt-cart-table th {
    padding: 8px 12px;
    font-size: .7rem;
    font-weight: 700;
    text-transform: uppercase;
    color: #64748b;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}
.vt-cart-table td {
    padding: 10px 12px;
    font-size: .84rem;
    border-bottom: 1px solid #f1f5f9;
}
.vt-btn-del-item {
    background: none;
    border: none;
    color: #f43f5e;
    cursor: pointer;
    font-size: 1.1rem;
    line-height: 1;
}

.vt-checkout-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    border-top: 1px solid #f1f5f9;
    padding-top: 14px;
}
.vt-total-box {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}
.vt-total-lbl {
    font-size: .75rem;
    color: #64748b;
    font-weight: 600;
    text-transform: uppercase;
}
.vt-total-amount {
    font-family: 'Outfit', sans-serif;
    font-size: 1.6rem;
    font-weight: 800;
    color: #090d16;
}

/* Ticket comprobante */
.vt-ticket-header {
    text-align: center;
    border-bottom: 1px dashed #cbd5e1;
    padding-bottom: 14px;
}
.vt-ticket-brand {
    font-family: 'Outfit', sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    color: #090d16;
}
.vt-ticket-meta {
    font-family: ui-monospace, monospace;
    font-size: .95rem;
    font-weight: 700;
    color: #2563eb;
    margin: 4px 0;
}
.vt-ticket-line {
    font-size: .8rem;
    color: #64748b;
}
.vt-ticket-items {
    margin: 14px 0;
}
.vt-ticket-table {
    width: 100%;
    border-collapse: collapse;
}
.vt-ticket-table th {
    font-size: .72rem;
    color: #64748b;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
    padding: 6px 0;
}
.vt-ticket-table td {
    font-size: .84rem;
    color: #090d16;
    padding: 8px 0;
    border-bottom: 1px solid #f8fafc;
}
.vt-ticket-total-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px dashed #cbd5e1;
    padding-top: 12px;
    margin-top: 6px;
}
.vt-ticket-total-lbl {
    font-weight: 700;
    font-size: .85rem;
    color: #090d16;
}
.vt-ticket-total-val {
    font-family: 'Outfit', sans-serif;
    font-weight: 800;
    font-size: 1.35rem;
    color: #090d16;
}
.vt-ticket-footer {
    text-align: center;
    font-size: .78rem;
    color: #94a3b8;
    margin-top: 14px;
    font-style: italic;
}

@media (max-width: 1000px) {
    .vt-stats { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .vt-stats { grid-template-columns: 1fr; }
    .vt-filters-form { flex-direction: column; align-items: stretch; }
    .vt-search-wrap, .vt-date-wrap { width: 100%; }
}

/* Impresión */
@media print {
    body * { visibility: hidden; }
    #ticket-printable-area, #ticket-printable-area * {
        visibility: visible;
    }
    #ticket-printable-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        max-width: 320px;
        margin: 0 auto;
        padding: 10px;
    }
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    // Búsqueda con debounce
    var searchInput = document.getElementById('vt-search-input');
    var filterForm  = document.getElementById('vt-filter-form');
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
    var toast = document.getElementById('vt-toast');
    if (toast) {
        setTimeout(function () {
            toast.style.transition = 'opacity .4s ease';
            toast.style.opacity    = '0';
            setTimeout(function () { toast.remove(); }, 400);
        }, 3500);
    }
})();

// ── Carrito dinámico para Modal Nueva Venta ──
var _cartItems = [];

function abrirModalNuevaVenta() {
    _cartItems = [];
    var sel = document.getElementById('select-producto');
    if (sel) sel.value = '';
    var cant = document.getElementById('input-item-cant');
    if (cant) cant.value = 1;
    renderizarCarrito();
    document.getElementById('modal-nueva-venta').style.display = 'flex';
}

function cerrarModalNuevaVenta(e) {
    if (e && e.target !== document.getElementById('modal-nueva-venta')) return;
    document.getElementById('modal-nueva-venta').style.display = 'none';
}

function actualizarPrecioProducto() {
    var sel = document.getElementById('select-producto');
    if (sel) {
        sel.style.borderColor = '';
        sel.style.boxShadow = '';
    }
    var opt = sel.options[sel.selectedIndex];
    var maxStock = opt ? parseInt(opt.getAttribute('data-stock'), 10) : 1;
    var cantInput = document.getElementById('input-item-cant');
    cantInput.max = maxStock > 0 ? maxStock : 1;
    cantInput.value = 1;
}

function agregarItemAlCarrito() {
    var sel = document.getElementById('select-producto');
    if (!sel || !sel.value) {
        if (sel) {
            sel.focus();
            sel.style.borderColor = '#ef4444';
            sel.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.2)';
        }
        alert('Por favor haz clic en la casilla "Producto" y selecciona cuál deseas vender.');
        return false;
    }

    var opt      = sel.options[sel.selectedIndex];
    var prodId   = parseInt(sel.value, 10);
    var prodName = opt.text.split('(')[0].trim();
    var precio   = parseFloat(opt.getAttribute('data-precio'));
    var maxStock = parseInt(opt.getAttribute('data-stock'), 10);
    var cant     = parseInt(document.getElementById('input-item-cant').value, 10);

    if (isNaN(cant) || cant < 1) {
        alert('La cantidad debe ser al menos 1.');
        return false;
    }

    // Comprobar si ya está en el carrito
    var existingIndex = _cartItems.findIndex(function (it) { return it.producto_id === prodId; });
    var currentCantInCart = existingIndex >= 0 ? _cartItems[existingIndex].cantidad : 0;

    if (currentCantInCart + cant > maxStock) {
        alert('Stock insuficiente. Solo hay ' + maxStock + ' unidades disponibles.');
        return false;
    }

    if (existingIndex >= 0) {
        _cartItems[existingIndex].cantidad += cant;
    } else {
        _cartItems.push({
            producto_id: prodId,
            nombre: prodName,
            precio: precio,
            cantidad: cant
        });
    }

    sel.value = '';
    document.getElementById('input-item-cant').value = 1;
    renderizarCarrito();
    return true;
}

function eliminarItemDelCarrito(index) {
    _cartItems.splice(index, 1);
    renderizarCarrito();
}

function renderizarCarrito() {
    var tbody = document.getElementById('cart-items-body');
    var totalLbl = document.getElementById('lbl-total-venta');
    var total = 0;

    if (_cartItems.length === 0) {
        tbody.innerHTML = `
            <tr id="cart-empty-row">
                <td colspan="5" style="text-align:center; color:#94a3b8; padding: 24px;">
                    <div style="font-weight:600; color:#475569; margin-bottom:4px;">No has agregado ningún producto a la venta.</div>
                    <div style="font-size:.82rem; color:#94a3b8;">Selecciona un producto arriba y haz clic en <strong>"+ Agregar"</strong> (o pulsa "Procesar Venta" para agregarlo automáticamente).</div>
                </td>
            </tr>
        `;
        totalLbl.textContent = '$0';
        return;
    }

    var html = '';
    _cartItems.forEach(function (item, idx) {
        var subtotal = item.cantidad * item.precio;
        total += subtotal;
        html += `
            <tr>
                <td style="font-weight:600; color:#090d16;">${item.nombre}</td>
                <td style="text-align:center;">${item.cantidad}</td>
                <td style="text-align:right;">$${item.precio.toLocaleString('es-CO')}</td>
                <td style="text-align:right; font-weight:700;">$${subtotal.toLocaleString('es-CO')}</td>
                <td style="text-align:center;">
                    <button type="button" class="vt-btn-del-item" onclick="eliminarItemDelCarrito(${idx})" title="Eliminar">&times;</button>
                </td>
            </tr>
        `;
    });

    tbody.innerHTML = html;
    totalLbl.textContent = '$' + total.toLocaleString('es-CO');
}

function guardarNuevaVenta(e) {
    e.preventDefault();

    // Si aún hay un producto seleccionado en el desplegable, agregarlo automáticamente a la venta
    var sel = document.getElementById('select-producto');
    if (sel && sel.value) {
        if (!agregarItemAlCarrito()) {
            return;
        }
    }

    if (_cartItems.length === 0) {
        if (sel) {
            sel.focus();
            sel.style.borderColor = '#ef4444';
            sel.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.2)';
        }
        alert('Debes seleccionar al menos un producto en la casilla "Producto" antes de procesar la venta.');
        return;
    }

    var metodoPago = document.getElementById('select-metodo-pago').value;
    var btn = document.getElementById('btn-submit-venta');

    btn.disabled  = true;
    btn.innerHTML = 'Procesando…';

    var csrf = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '';

    fetch('/ventas', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            metodo_pago: metodoPago,
            items: _cartItems
        })
    })
    .then(function (res) { return res.json(); })
    .then(function (data) {
        if (data.success) {
            document.getElementById('modal-nueva-venta').style.display = 'none';
            window.location.reload();
        } else {
            alert(data.message || 'Error al procesar la venta.');
        }
    })
    .catch(function () {
        alert('Error de conexión al servidor.');
    })
    .finally(function () {
        btn.disabled  = false;
        btn.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            <span>Procesar Venta</span>
        `;
    });
}

// ── Modal Detalle de Venta & Impresión ──
function verDetalleVenta(id) {
    fetch('/ventas/' + id)
        .then(function (res) { return res.json(); })
        .then(function (data) {
            if (data.success) {
                document.getElementById('det-modal-sub').textContent       = 'Comprobante emitido ' + data.fecha + ' a las ' + data.hora;
                document.getElementById('det-ticket-num').textContent     = data.numero_venta;
                document.getElementById('det-ticket-fecha').textContent   = data.fecha + ' - ' + data.hora;
                document.getElementById('det-ticket-resp').textContent    = 'Responsable: ' + data.responsable;
                document.getElementById('det-ticket-metodo').textContent  = 'Método de pago: ' + data.metodo_pago;
                document.getElementById('det-ticket-total').textContent   = data.total;

                var itemsHtml = '';
                data.detalles.forEach(function (d) {
                    itemsHtml += `
                        <tr>
                            <td style="font-weight:700;">${d.cantidad}x</td>
                            <td>
                                <div>${d.producto_nombre}</div>
                                <div style="font-size:.72rem; color:#94a3b8;">${d.precio} c/u</div>
                            </td>
                            <td style="text-align:right; font-weight:700;">${d.subtotal}</td>
                        </tr>
                    `;
                });

                document.getElementById('det-items-body').innerHTML = itemsHtml;
                document.getElementById('modal-detalle-venta').style.display = 'flex';
            }
        })
        .catch(function () {
            alert('No se pudo cargar el detalle de la venta.');
        });
}

function cerrarModalDetalle(e) {
    if (e && e.target !== document.getElementById('modal-detalle-venta')) return;
    document.getElementById('modal-detalle-venta').style.display = 'none';
}

function imprimirTicketActual() {
    window.print();
}

function imprimirVentaDirecta(id) {
    verDetalleVenta(id);
    setTimeout(function () {
        window.print();
    }, 600);
}

// Cerrar con Escape
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        var m1 = document.getElementById('modal-nueva-venta');
        var m2 = document.getElementById('modal-detalle-venta');
        if (m1) m1.style.display = 'none';
        if (m2) m2.style.display = 'none';
    }
});
</script>
@endpush
