@extends('layouts.dashboard')

@section('title', 'Reportes e Informes — Almacén Europa')
@section('page-title', 'Reportes e Informes')

@section('content')

{{-- ════════════════════════════════════════
     CABECERA DEL MÓDULO
════════════════════════════════════════ --}}
<div class="rep-header">
    <div>
        <h1 class="rep-title">Reportes e Informes</h1>
        <p class="rep-subtitle">Resumen general del negocio en tiempo real.</p>
    </div>
    <div class="rep-badge-live">
        <span class="rep-pulse-dot"></span>
        <span>Datos actualizados al {{ $fechaActualizacion }}</span>
    </div>
</div>

{{-- ════════════════════════════════════════
     SECCIÓN 1: RESUMEN DE VENTAS (4 KPIs)
════════════════════════════════════════ --}}
<div class="rep-section-label">RESUMEN DE VENTAS</div>

<div class="rep-sales-kpis">

    {{-- Ingresos Totales (Borde Azul) --}}
    <div class="rep-kpi-card rep-kpi-card--blue">
        <div class="rep-kpi-info">
            <div class="rep-kpi-label">Ingresos totales</div>
            <div class="rep-kpi-value">${{ number_format($ingresosTotales, 0, ',', '.') }}</div>
            <div class="rep-kpi-sub">{{ $totalVentasCount }} ventas registradas</div>
        </div>
        <div class="rep-kpi-icon rep-kpi-icon--blue">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="1" x2="12" y2="23"/>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>
        </div>
    </div>

    {{-- Ingresos Hoy (Borde Verde) --}}
    <div class="rep-kpi-card rep-kpi-card--green">
        <div class="rep-kpi-info">
            <div class="rep-kpi-label">Ingresos hoy</div>
            <div class="rep-kpi-value">${{ number_format($ingresosHoy, 0, ',', '.') }}</div>
            <div class="rep-kpi-sub">{{ $ventasHoyCount }} ventas hoy</div>
        </div>
        <div class="rep-kpi-icon rep-kpi-icon--green">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
        </div>
    </div>

    {{-- Ingresos Este Mes (Borde Púrpura) --}}
    <div class="rep-kpi-card rep-kpi-card--purple">
        <div class="rep-kpi-info">
            <div class="rep-kpi-label">Ingresos este mes</div>
            <div class="rep-kpi-value">${{ number_format($ingresosMes, 0, ',', '.') }}</div>
            <div class="rep-kpi-sub">{{ $mesActualNombre }}</div>
        </div>
        <div class="rep-kpi-icon rep-kpi-icon--purple">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
            </svg>
        </div>
    </div>

    {{-- Ticket Promedio (Borde Ámbar) --}}
    <div class="rep-kpi-card rep-kpi-card--amber">
        <div class="rep-kpi-info">
            <div class="rep-kpi-label">Ticket promedio</div>
            <div class="rep-kpi-value">${{ number_format($ticketPromedio, 0, ',', '.') }}</div>
            <div class="rep-kpi-sub">Máx: ${{ number_format($ventaMasAlta, 0, ',', '.') }}</div>
        </div>
        <div class="rep-kpi-icon rep-kpi-icon--amber">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
                <polyline points="10 9 9 9 8 9"/>
            </svg>
        </div>
    </div>

</div>

{{-- ════════════════════════════════════════
     SECCIÓN 2: GRÁFICAS (Ingresos por Mes & Ventas Diarias)
════════════════════════════════════════ --}}
<div class="rep-charts-grid">

    {{-- Gráfica de Ingresos por mes --}}
    <div class="rep-chart-card">
        <div class="rep-chart-head">
            <div>
                <div class="rep-chart-title">Ingresos por mes</div>
                <div class="rep-chart-sub">Últimos 12 meses</div>
            </div>
            <div class="rep-chart-badge rep-chart-badge--blue">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                    <polyline points="17 6 23 6 23 12"/>
                </svg>
            </div>
        </div>
        <div class="rep-chart-canvas-wrap">
            <canvas id="chartIngresosMes"></canvas>
        </div>
    </div>

    {{-- Gráfica de Ventas diarias --}}
    <div class="rep-chart-card">
        <div class="rep-chart-head">
            <div>
                <div class="rep-chart-title">Ventas diarias</div>
                <div class="rep-chart-sub">Últimos 30 días</div>
            </div>
            <div class="rep-chart-badge rep-chart-badge--green">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"/>
                    <line x1="12" y1="20" x2="12" y2="4"/>
                    <line x1="6" y1="20" x2="6" y2="14"/>
                </svg>
            </div>
        </div>
        <div class="rep-chart-canvas-wrap">
            <canvas id="chartVentasDiarias"></canvas>
        </div>
    </div>

</div>

{{-- ════════════════════════════════════════
     SECCIÓN 3: RANKINGS (Top Productos & Rendimiento Vendedor)
════════════════════════════════════════ --}}
<div class="rep-rankings-grid">

    {{-- Productos Más Vendidos --}}
    <div class="rep-rank-card">
        <div class="rep-rank-head">
            <div>
                <div class="rep-rank-title">Productos más vendidos</div>
                <div class="rep-rank-sub">Por unidades vendidas</div>
            </div>
            <div class="rep-rank-badge-icon text-amber">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/>
                    <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/>
                    <path d="M4 22h16"/>
                    <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/>
                    <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/>
                    <path d="M18 2H6v7a6 6 0 0 0 12 0V2z"/>
                </svg>
            </div>
        </div>

        <div class="rep-rank-list">
            @forelse($topProductos as $prod)
                <div class="rep-rank-item">
                    <div class="rep-rank-item-top">
                        <div class="rep-rank-item-info">
                            <span class="rep-rank-pos rep-rank-pos--{{ $prod['posicion'] <= 3 ? $prod['posicion'] : 'other' }}">
                                {{ $prod['posicion'] }}
                            </span>
                            <span class="rep-rank-name" title="{{ $prod['nombre'] }}">{{ $prod['nombre'] }}</span>
                        </div>
                        <div class="rep-rank-meta">
                            <span class="rep-rank-units">{{ $prod['unidades'] }} uds</span>
                            <span class="rep-rank-price">{{ $prod['ingresos_formateado'] }}</span>
                        </div>
                    </div>
                    <div class="rep-progress-track">
                        <div class="rep-progress-bar rep-progress-bar--{{ $prod['posicion'] <= 2 ? ($prod['posicion'] == 1 ? 'blue' : 'purple') : 'teal' }}"
                             style="width: {{ $prod['porcentaje'] }}%;"></div>
                    </div>
                </div>
            @empty
                <div class="rep-empty-msg">No hay ventas registradas todavía.</div>
            @endforelse
        </div>
    </div>

    {{-- Rendimiento por Vendedor --}}
    <div class="rep-rank-card">
        <div class="rep-rank-head">
            <div>
                <div class="rep-rank-title">Rendimiento por vendedor</div>
                <div class="rep-rank-sub">Total histórico</div>
            </div>
            <div class="rep-rank-badge-icon text-blue">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
        </div>

        <div class="rep-rank-list">
            @forelse($rendimientoVendedores as $index => $vend)
                <div class="rep-rank-item">
                    <div class="rep-rank-item-top">
                        <div class="rep-rank-item-info">
                            <div class="rep-avatar-seller">
                                {{ $vend['inicial'] }}
                            </div>
                            <span class="rep-rank-name">{{ $vend['nombre'] }}</span>
                        </div>
                        <div class="rep-rank-meta">
                            <span class="rep-rank-units">{{ $vend['ingresos_formateado'] }}</span>
                            <span class="rep-rank-price">{{ $vend['total_ventas'] }} {{ $vend['total_ventas'] == 1 ? 'venta' : 'ventas' }}</span>
                        </div>
                    </div>
                    <div class="rep-progress-track">
                        <div class="rep-progress-bar rep-progress-bar--blue" style="width: {{ $vend['porcentaje'] }}%;"></div>
                    </div>
                </div>
            @empty
                <div class="rep-empty-msg">No hay registros de vendedores aún.</div>
            @endforelse
        </div>
    </div>

</div>

{{-- ════════════════════════════════════════
     SECCIÓN 4: ESTADO DEL INVENTARIO (4 KPIs)
════════════════════════════════════════ --}}
<div class="rep-section-label" style="margin-top: 2rem;">ESTADO DEL INVENTARIO</div>

<div class="rep-inventory-kpis">

    {{-- Productos --}}
    <div class="rep-inv-card">
        <div class="rep-inv-icon rep-inv-icon--blue">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                <line x1="12" y1="22.08" x2="12" y2="12"/>
            </svg>
        </div>
        <div>
            <div class="rep-inv-val">{{ $totalProductos }}</div>
            <div class="rep-inv-lbl">Productos</div>
        </div>
    </div>

    {{-- Unidades en stock --}}
    <div class="rep-inv-card">
        <div class="rep-inv-icon rep-inv-icon--purple">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="2" width="8" height="8" rx="2"/>
                <rect x="14" y="2" width="8" height="8" rx="2"/>
                <rect x="2" y="14" width="8" height="8" rx="2"/>
                <rect x="14" y="14" width="8" height="8" rx="2"/>
            </svg>
        </div>
        <div>
            <div class="rep-inv-val">{{ number_format($unidadesStock, 0, ',', '.') }}</div>
            <div class="rep-inv-lbl">Unidades en stock</div>
        </div>
    </div>

    {{-- Stock bajo --}}
    <div class="rep-inv-card">
        <div class="rep-inv-icon rep-inv-icon--amber">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                <line x1="12" y1="9" x2="12" y2="13"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
        </div>
        <div>
            <div class="rep-inv-val">{{ $stockBajoCount }}</div>
            <div class="rep-inv-lbl">Stock bajo</div>
        </div>
    </div>

    {{-- Valor en stock --}}
    <div class="rep-inv-card">
        <div class="rep-inv-icon rep-inv-icon--green">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="1" x2="12" y2="23"/>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>
        </div>
        <div>
            <div class="rep-inv-val">${{ number_format($valorStock, 0, ',', '.') }}</div>
            <div class="rep-inv-lbl">Valor en stock</div>
        </div>
    </div>

</div>

{{-- ════════════════════════════════════════
     SECCIÓN 5: EXPORTAR REPORTE (Generador & Accesos Rápidos)
════════════════════════════════════════ --}}
<div class="rep-section-label" style="margin-top: 2rem;">EXPORTAR REPORTE</div>

<div class="rep-export-box">

    {{-- Encabezado del Generador --}}
    <div class="rep-export-head">
        <div class="rep-pdf-badge">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
                <polyline points="10 9 9 9 8 9"/>
            </svg>
            <span class="rep-pdf-tag">PDF</span>
        </div>
        <div>
            <h3 class="rep-export-title">Generador de Reportes Especiales</h3>
            <p class="rep-export-sub">Selecciona el tipo de reporte y ábrelo para descargar como PDF</p>
        </div>
    </div>

    {{-- Formulario con Selectores y Botón --}}
    <form id="repExportForm" onsubmit="ejecutarReporteModal(event)" class="rep-export-form">
        <div class="rep-form-group">
            <label class="rep-form-label">Filtrar por:</label>
            <select name="tipo" id="repTipoSelect" class="rep-select">
                <option value="inventario">Todo el Inventario</option>
                <option value="ventas_mes">Ventas del Mes</option>
                <option value="top_productos">Top Productos Más Vendidos</option>
                <option value="vendedores">Rendimiento por Vendedor</option>
                <option value="stock_bajo">Stock Crítico / Bajo</option>
                <option value="resumen">Resumen Ejecutivo</option>
            </select>
        </div>

        <div class="rep-form-group">
            <label class="rep-form-label">Formato:</label>
            <select name="formato" id="repFormatoSelect" class="rep-select">
                <option value="pantalla">Ver en Pantalla (Imprimible)</option>
                <option value="pdf_imprimir">Descargar PDF / Imprimir Directo</option>
            </select>
        </div>

        <button type="submit" class="rep-btn-generate">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <polygon points="5 3 19 12 5 21 5 3"/>
            </svg>
            Ver Reporte
        </button>
    </form>

    {{-- Accesos Rápidos (Grid de 6 Botones) --}}
    <div class="rep-quick-grid">
        <button type="button" onclick="abrirReporteEnModal('{{ route('reportes.imprimir', ['tipo' => 'inventario']) }}', 'Reporte de Inventario Completo')" class="rep-quick-card rep-quick-card--blue">
            <div class="rep-quick-icon rep-quick-icon--blue">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                </svg>
            </div>
            <span class="rep-quick-label">Inventario</span>
        </button>

        <button type="button" onclick="abrirReporteEnModal('{{ route('reportes.imprimir', ['tipo' => 'ventas_mes']) }}', 'Reporte de Ventas del Mes')" class="rep-quick-card rep-quick-card--purple">
            <div class="rep-quick-icon rep-quick-icon--purple">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                    <polyline points="17 6 23 6 23 12"/>
                </svg>
            </div>
            <span class="rep-quick-label">Ventas/Mes</span>
        </button>

        <button type="button" onclick="abrirReporteEnModal('{{ route('reportes.imprimir', ['tipo' => 'top_productos']) }}', 'Reporte de Top Productos Más Vendidos')" class="rep-quick-card rep-quick-card--amber">
            <div class="rep-quick-icon rep-quick-icon--amber">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/>
                    <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/>
                    <path d="M18 2H6v7a6 6 0 0 0 12 0V2z"/>
                </svg>
            </div>
            <span class="rep-quick-label">Top Productos</span>
        </button>

        <button type="button" onclick="abrirReporteEnModal('{{ route('reportes.imprimir', ['tipo' => 'vendedores']) }}', 'Reporte de Rendimiento por Vendedor')" class="rep-quick-card rep-quick-card--green">
            <div class="rep-quick-icon rep-quick-icon--green">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                </svg>
            </div>
            <span class="rep-quick-label">Vendedores</span>
        </button>

        <button type="button" onclick="abrirReporteEnModal('{{ route('reportes.imprimir', ['tipo' => 'stock_bajo']) }}', 'Reporte de Stock Crítico / Bajo')" class="rep-quick-card rep-quick-card--red">
            <div class="rep-quick-icon rep-quick-icon--red">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                </svg>
            </div>
            <span class="rep-quick-label">Stock Bajo</span>
        </button>

        <button type="button" onclick="abrirReporteEnModal('{{ route('reportes.imprimir', ['tipo' => 'resumen']) }}', 'Resumen Ejecutivo del Negocio')" class="rep-quick-card rep-quick-card--violet">
            <div class="rep-quick-icon rep-quick-icon--violet">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 2a10 10 0 0 1 10 10h-10z"/>
                </svg>
            </div>
            <span class="rep-quick-label">Resumen</span>
        </button>
    </div>

</div>

{{-- ════════════════════════════════════════
     MODAL DE VISOR DE REPORTES INTEGRADO
════════════════════════════════════════ --}}
<div id="modal-reporte-visor" class="rep-modal-backdrop" style="display: none;" onclick="cerrarModalReporte(event)">
    <div class="rep-modal-dialog">
        <div class="rep-modal-header">
            <div class="rep-modal-title-wrap">
                <div class="rep-modal-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>
                </div>
                <div>
                    <h3 class="rep-modal-title" id="repModalTitulo">Visualizador de Reportes</h3>
                    <p class="rep-modal-subtitle">Documento generado en tiempo real en la misma ventana del sistema</p>
                </div>
            </div>
            <div class="rep-modal-actions">
                <button type="button" class="rep-btn-modal-print" onclick="imprimirDesdeModal()">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>
                    <span>Imprimir / Guardar PDF</span>
                </button>
                <button type="button" class="rep-modal-close" onclick="cerrarModalReporte()" title="Cerrar ventana">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </div>

        <div class="rep-modal-body">
            <div id="rep-modal-loader" class="rep-modal-loader">
                <div class="rep-spinner"></div>
                <span>Cargando reporte...</span>
            </div>
            <iframe id="rep-modal-iframe" class="rep-modal-iframe" src="about:blank" onload="onReporteIframeLoaded()"></iframe>
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════
     ESTILOS CSS INTEGRADOS DEL MÓDULO
════════════════════════════════════════ --}}
<style>
/* Cabecera */
.rep-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
}
.rep-title {
    font-size: 1.625rem;
    font-weight: 800;
    color: #090d16;
    margin: 0 0 0.25rem 0;
    letter-spacing: -0.02em;
}
.rep-subtitle {
    color: #64748b;
    font-size: 0.885rem;
    margin: 0;
}
.rep-badge-live {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    padding: 0.35rem 0.85rem;
    border-radius: 9999px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    font-size: 0.785rem;
    font-weight: 500;
    color: #64748b;
}
.rep-pulse-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #10b981;
    display: inline-block;
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
}

/* Etiquetas de sección */
.rep-section-label {
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    color: #64748b;
    margin-bottom: 0.85rem;
    text-transform: uppercase;
}

/* 4 KPIs de Ventas */
.rep-sales-kpis {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.rep-kpi-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 1.25rem 1.25rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.rep-kpi-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(0,0,0,0.06);
}
.rep-kpi-card--blue {
    border: 1.8px solid #3b82f6;
}
.rep-kpi-card--green {
    border: 1.8px solid #22c55e;
}
.rep-kpi-card--purple {
    border: 1.8px solid #a855f7;
}
.rep-kpi-card--amber {
    border: 1.8px solid #f59e0b;
}

.rep-kpi-label {
    font-size: 0.82rem;
    color: #64748b;
    font-weight: 500;
    margin-bottom: 0.35rem;
}
.rep-kpi-value {
    font-size: 1.65rem;
    font-weight: 800;
    color: #090d16;
    letter-spacing: -0.02em;
    line-height: 1.15;
    margin-bottom: 0.35rem;
}
.rep-kpi-sub {
    font-size: 0.75rem;
    color: #94a3b8;
}

.rep-kpi-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.rep-kpi-icon--blue {
    background: #eff6ff;
    color: #2563eb;
}
.rep-kpi-icon--green {
    background: #ecfdf5;
    color: #10b981;
}
.rep-kpi-icon--purple {
    background: #f5f3ff;
    color: #8b5cf6;
}
.rep-kpi-icon--amber {
    background: #fffbeb;
    color: #f59e0b;
}

/* Gráficas */
.rep-charts-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
    margin-bottom: 1.5rem;
}
.rep-chart-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 1.35rem 1.35rem 1rem 1.35rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.02);
}
.rep-chart-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.25rem;
}
.rep-chart-title {
    font-size: 1rem;
    font-weight: 700;
    color: #090d16;
}
.rep-chart-sub {
    font-size: 0.785rem;
    color: #94a3b8;
    margin-top: 0.15rem;
}
.rep-chart-badge {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.rep-chart-badge--blue {
    background: #eff6ff;
    color: #2563eb;
}
.rep-chart-badge--green {
    background: #ecfdf5;
    color: #10b981;
}
.rep-chart-canvas-wrap {
    height: 230px;
    position: relative;
}

/* Rankings */
.rep-rankings-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
    margin-bottom: 1.5rem;
}
.rep-rank-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 1.35rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.02);
}
.rep-rank-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.25rem;
}
.rep-rank-title {
    font-size: 1rem;
    font-weight: 700;
    color: #090d16;
}
.rep-rank-sub {
    font-size: 0.785rem;
    color: #94a3b8;
    margin-top: 0.15rem;
}
.text-amber { color: #f59e0b; }
.text-blue { color: #2563eb; }

.rep-rank-list {
    display: flex;
    flex-direction: column;
    gap: 1.15rem;
}
.rep-rank-item {
    display: flex;
    flex-direction: column;
    gap: 0.45rem;
}
.rep-rank-item-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.rep-rank-item-info {
    display: flex;
    align-items: center;
    gap: 0.65rem;
}
.rep-rank-pos {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 700;
    color: #ffffff;
}
.rep-rank-pos--1 {
    background: #2563eb;
}
.rep-rank-pos--2 {
    background: #8b5cf6;
}
.rep-rank-pos--3 {
    background: #06b6d4;
}
.rep-rank-pos--other {
    background: #94a3b8;
}
.rep-avatar-seller {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #eff6ff;
    color: #1e40af;
    font-size: 0.8rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #bfdbfe;
}
.rep-rank-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: #1e293b;
}
.rep-rank-meta {
    text-align: right;
}
.rep-rank-units {
    font-size: 0.875rem;
    font-weight: 700;
    color: #090d16;
    display: block;
}
.rep-rank-price {
    font-size: 0.75rem;
    color: #64748b;
}

.rep-progress-track {
    width: 100%;
    height: 6px;
    background: #f1f5f9;
    border-radius: 9999px;
    overflow: hidden;
}
.rep-progress-bar {
    height: 100%;
    border-radius: 9999px;
    transition: width 0.6s ease;
}
.rep-progress-bar--blue {
    background: #2563eb;
}
.rep-progress-bar--purple {
    background: #8b5cf6;
}
.rep-progress-bar--teal {
    background: #06b6d4;
}

.rep-empty-msg {
    color: #94a3b8;
    font-size: 0.85rem;
    text-align: center;
    padding: 1.5rem 0;
}

/* Estado del Inventario (4 KPIs blancos) */
.rep-inventory-kpis {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.rep-inv-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 1.15rem 1.25rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.02);
}
.rep-inv-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.rep-inv-icon--blue {
    background: #eff6ff;
    color: #2563eb;
}
.rep-inv-icon--purple {
    background: #f5f3ff;
    color: #8b5cf6;
}
.rep-inv-icon--amber {
    background: #fffbeb;
    color: #f59e0b;
}
.rep-inv-icon--green {
    background: #ecfdf5;
    color: #10b981;
}
.rep-inv-val {
    font-size: 1.35rem;
    font-weight: 800;
    color: #090d16;
    letter-spacing: -0.02em;
    line-height: 1.15;
}
.rep-inv-lbl {
    font-size: 0.78rem;
    color: #64748b;
    margin-top: 0.2rem;
}

/* Exportar Reporte Box */
.rep-export-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.02);
}
.rep-export-head {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.25rem;
}
.rep-pdf-badge {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    background: #0f172a;
    color: #ffffff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    flex-shrink: 0;
}
.rep-pdf-tag {
    font-size: 0.55rem;
    font-weight: 800;
    background: #ef4444;
    color: #fff;
    padding: 1px 4px;
    border-radius: 3px;
    line-height: 1;
    position: absolute;
    bottom: 3px;
}
.rep-export-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #090d16;
    margin: 0 0 0.2rem 0;
}
.rep-export-sub {
    font-size: 0.8rem;
    color: #64748b;
    margin: 0;
}

.rep-export-form {
    display: flex;
    align-items: flex-end;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}
.rep-form-group {
    flex: 1;
    min-width: 220px;
}
.rep-form-label {
    display: block;
    font-size: 0.785rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 0.4rem;
}
.rep-select {
    width: 100%;
    padding: 0.65rem 0.9rem;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    font-size: 0.885rem;
    color: #1e293b;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.rep-select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
}
.rep-btn-generate {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.7rem 1.4rem;
    background: #090d16;
    color: #ffffff;
    border: none;
    border-radius: 10px;
    font-size: 0.885rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    white-space: nowrap;
}
.rep-btn-generate:hover {
    background: #1e293b;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(9, 13, 22, 0.2);
}

/* Quick Access Grid */
.rep-quick-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 0.75rem;
}
.rep-quick-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.95rem 0.5rem;
    border-radius: 12px;
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: 1px solid transparent;
    cursor: pointer;
    font-family: inherit;
    width: 100%;
    outline: none;
}
.rep-quick-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.rep-quick-card--blue   { background: #eff6ff; border-color: #dbeafe; }
.rep-quick-card--purple { background: #f5f3ff; border-color: #ede9fe; }
.rep-quick-card--amber  { background: #fffbeb; border-color: #fef3c7; }
.rep-quick-card--green  { background: #ecfdf5; border-color: #d1fae5; }
.rep-quick-card--red    { background: #fef2f2; border-color: #fee2e2; }
.rep-quick-card--violet { background: #faf5ff; border-color: #f3e8ff; }

.rep-quick-icon {
    display: flex;
    align-items: center;
    justify-content: center;
}
.rep-quick-icon--blue   { color: #2563eb; }
.rep-quick-icon--purple { color: #8b5cf6; }
.rep-quick-icon--amber  { color: #d97706; }
.rep-quick-icon--green  { color: #059669; }
.rep-quick-icon--red    { color: #dc2626; }
.rep-quick-icon--violet { color: #7c3aed; }

.rep-quick-label {
    font-size: 0.8rem;
    font-weight: 700;
    color: #334155;
}

/* ════════════════════════════════════════
   MODAL VISOR DE REPORTES INTEGRADO
════════════════════════════════════════ */
.rep-modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(9, 13, 22, 0.72);
    backdrop-filter: blur(5px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    padding: 16px;
    animation: repFadeIn .2s ease;
}
.rep-modal-dialog {
    background: #ffffff;
    width: 96%;
    max-width: 980px;
    height: 90vh;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.45);
    overflow: hidden;
    animation: repScaleUp .25s cubic-bezier(0.16, 1, 0.3, 1);
}
.rep-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 22px;
    background: #090d16;
    color: #ffffff;
    flex-shrink: 0;
}
.rep-modal-title-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
}
.rep-modal-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #38bdf8;
    flex-shrink: 0;
}
.rep-modal-title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.15rem;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
}
.rep-modal-subtitle {
    font-size: .78rem;
    color: #94a3b8;
    margin: 0;
}
.rep-modal-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}
.rep-btn-modal-print {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 18px;
    background: #2563eb;
    color: #ffffff;
    border: none;
    border-radius: 10px;
    font-family: inherit;
    font-size: .84rem;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    transition: all .15s ease;
}
.rep-btn-modal-print:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
}
.rep-modal-close {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    color: #cbd5e1;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all .15s;
}
.rep-modal-close:hover {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}
.rep-modal-body {
    flex: 1;
    position: relative;
    background: #f1f5f9;
    overflow: hidden;
}
.rep-modal-loader {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    background: #f8fafc;
    color: #64748b;
    font-size: .88rem;
    font-weight: 600;
    z-index: 10;
}
.rep-spinner {
    width: 38px;
    height: 38px;
    border: 3px solid #e2e8f0;
    border-top-color: #2563eb;
    border-radius: 50%;
    animation: repSpin .8s linear infinite;
}
.rep-modal-iframe {
    width: 100%;
    height: 100%;
    border: none;
    display: block;
    background: #f8fafc;
    transition: opacity .2s ease;
}
@keyframes repFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
@keyframes repScaleUp {
    from { opacity: 0; transform: scale(0.96); }
    to { opacity: 1; transform: scale(1); }
}
@keyframes repSpin {
    to { transform: rotate(360deg); }
}

/* Responsividad */
@media (max-width: 1024px) {
    .rep-sales-kpis { grid-template-columns: repeat(2, 1fr); }
    .rep-inventory-kpis { grid-template-columns: repeat(2, 1fr); }
    .rep-quick-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
    .rep-sales-kpis { grid-template-columns: 1fr; }
    .rep-charts-grid { grid-template-columns: 1fr; }
    .rep-rankings-grid { grid-template-columns: 1fr; }
    .rep-inventory-kpis { grid-template-columns: 1fr; }
    .rep-quick-grid { grid-template-columns: repeat(2, 1fr); }
    .rep-modal-dialog { height: 95vh; width: 98%; border-radius: 14px; }
}
</style>

{{-- ════════════════════════════════════════
     SCRIPTS & CHART.JS
════════════════════════════════════════ --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ── 1. Gráfica de Ingresos por mes (Línea) ──
    var ctxMes = document.getElementById('chartIngresosMes');
    if (ctxMes) {
        var lineContext = ctxMes.getContext('2d');
        var gradMes = lineContext.createLinearGradient(0, 0, 0, 200);
        gradMes.addColorStop(0, 'rgba(37, 99, 235, 0.24)');
        gradMes.addColorStop(1, 'rgba(37, 99, 235, 0.00)');

        var mesesLabels = {!! json_encode($mesesLabels) !!};
        var mesesValores = {!! json_encode($mesesValores) !!};

        new Chart(lineContext, {
            type: 'line',
            data: {
                labels: mesesLabels,
                datasets: [{
                    label: 'Ingresos ($)',
                    data: mesesValores,
                    borderColor: '#2563eb',
                    backgroundColor: gradMes,
                    borderWidth: 2.5,
                    pointBackgroundColor: '#2563eb',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2.5,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.35,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#090d16',
                        titleColor: '#ffffff',
                        bodyColor: 'rgba(255,255,255,0.85)',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(ctx) {
                                return ' Ingresos: $' + Number(ctx.parsed.y).toLocaleString('es-CO');
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 11 } }
                    },
                    y: {
                        grid: { color: 'rgba(226, 232, 240, 0.6)' },
                        ticks: {
                            color: '#94a3b8',
                            font: { size: 11 },
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });
    }

    // ── 2. Gráfica de Ventas Diarias (Barras) ──
    var ctxDia = document.getElementById('chartVentasDiarias');
    if (ctxDia) {
        var diasLabels = {!! json_encode($diasLabels) !!};
        var diasValores = {!! json_encode($diasValores) !!};

        new Chart(ctxDia, {
            type: 'bar',
            data: {
                labels: diasLabels,
                datasets: [{
                    label: 'Venta diaria ($)',
                    data: diasValores,
                    backgroundColor: 'rgba(16, 185, 129, 0.85)',
                    hoverBackgroundColor: '#10b981',
                    borderRadius: 4,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#090d16',
                        titleColor: '#ffffff',
                        bodyColor: 'rgba(255,255,255,0.85)',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(ctx) {
                                return ' Ventas: $' + Number(ctx.parsed.y).toLocaleString('es-CO');
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: '#94a3b8',
                            font: { size: 10 },
                            maxTicksLimit: 10
                        }
                    },
                    y: {
                        grid: { color: 'rgba(226, 232, 240, 0.6)' },
                        ticks: {
                            color: '#94a3b8',
                            font: { size: 11 },
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });
    }
});

// ── Visor Modal de Reportes Integrado en la Misma Ventana ──
function abrirReporteEnModal(url, titulo) {
    var modal = document.getElementById('modal-reporte-visor');
    var iframe = document.getElementById('rep-modal-iframe');
    var loader = document.getElementById('rep-modal-loader');
    var tituloElem = document.getElementById('repModalTitulo');

    if (!modal || !iframe) return;

    if (tituloElem && titulo) {
        tituloElem.textContent = titulo;
    }

    if (loader) loader.style.display = 'flex';
    iframe.style.opacity = '0';
    iframe.src = url;

    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function onReporteIframeLoaded() {
    var iframe = document.getElementById('rep-modal-iframe');
    var loader = document.getElementById('rep-modal-loader');
    if (loader) loader.style.display = 'none';
    if (iframe) iframe.style.opacity = '1';
}

function ejecutarReporteModal(e) {
    e.preventDefault();
    var tipoSelect = document.getElementById('repTipoSelect');
    var formatoSelect = document.getElementById('repFormatoSelect');
    var tipo = tipoSelect ? tipoSelect.value : 'inventario';
    var formato = formatoSelect ? formatoSelect.value : 'pantalla';
    var titulo = tipoSelect ? tipoSelect.options[tipoSelect.selectedIndex].text : 'Reporte del Sistema';

    var baseUrl = "{{ route('reportes.imprimir') }}";
    var url = baseUrl + "?tipo=" + encodeURIComponent(tipo) + "&formato=" + encodeURIComponent(formato);

    abrirReporteEnModal(url, 'Reporte: ' + titulo);
}

function cerrarModalReporte(e) {
    if (e && e.target !== document.getElementById('modal-reporte-visor') && !e.target.closest('.rep-modal-close')) {
        return;
    }
    var modal = document.getElementById('modal-reporte-visor');
    var iframe = document.getElementById('rep-modal-iframe');
    if (modal) modal.style.display = 'none';
    if (iframe) iframe.src = 'about:blank';
    document.body.style.overflow = '';
}

function imprimirDesdeModal() {
    var iframe = document.getElementById('rep-modal-iframe');
    if (iframe && iframe.contentWindow) {
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
    }
}

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        var modal = document.getElementById('modal-reporte-visor');
        if (modal && modal.style.display === 'flex') {
            cerrarModalReporte();
        }
    }
});
</script>

@endsection
