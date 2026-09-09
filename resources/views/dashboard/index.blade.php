@extends('layouts.dashboard')

@section('title', 'Panel de Control')
@section('page-title', 'Panel de Control')

@section('content')

{{-- ── Bienvenida ── --}}
<div class="db-welcome">
    <h1 class="db-welcome__title">
        ¡Bienvenido, {{ Auth::user()->nombre }}! 👋
    </h1>
    <p class="db-welcome__sub">
        Este es el resumen general de tu gestión como
        <strong>{{ Auth::user()->rol }}</strong>.
    </p>
</div>

{{-- ── Tarjetas de estadísticas ── --}}
<div class="db-stats">

    <div class="db-stat-card db-stat-card--green">
        <div class="db-stat-card__top">
            <span class="db-stat-card__label">Ventas del Mes</span>
            <div class="db-stat-card__icon db-stat-card__icon--green">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                    <polyline points="17 6 23 6 23 12"/>
                </svg>
            </div>
        </div>
        <div class="db-stat-card__value">$24,500</div>
        <div class="db-stat-card__footer">
            <span class="up">↑ 12.5%</span> vs mes anterior
        </div>
    </div>

    <div class="db-stat-card db-stat-card--blue">
        <div class="db-stat-card__top">
            <span class="db-stat-card__label">Total Inventario</span>
            <div class="db-stat-card__icon db-stat-card__icon--blue">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                </svg>
            </div>
        </div>
        <div class="db-stat-card__value">1,248</div>
        <div class="db-stat-card__footer">
            <span class="up">+ 45 nuevos</span> esta semana
        </div>
    </div>

    <div class="db-stat-card db-stat-card--purple">
        <div class="db-stat-card__top">
            <span class="db-stat-card__label">Nuevos Clientes</span>
            <div class="db-stat-card__icon db-stat-card__icon--purple">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
        </div>
        <div class="db-stat-card__value">124</div>
        <div class="db-stat-card__footer">
            <span class="up">↑ 8.2%</span> vs mes anterior
        </div>
    </div>

    <div class="db-stat-card db-stat-card--red">
        <div class="db-stat-card__top">
            <span class="db-stat-card__label">Stock Crítico</span>
            <div class="db-stat-card__icon db-stat-card__icon--red">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
        </div>
        <div class="db-stat-card__value">12</div>
        <div class="db-stat-card__footer">
            <span class="warn">Requieren atención</span> inmediata
        </div>
    </div>

</div>

{{-- ── Gráficas ── --}}
<div class="db-charts">

    {{-- Gráfica de líneas --}}
    <div class="db-chart-card">
        <div class="db-chart-card__title">Crecimiento de Ventas (Últimos 6 meses)</div>
        <div class="db-chart-card__sub">Evolución mensual de ingresos en miles de pesos</div>
        <div class="db-chart-wrap">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    {{-- Gráfica donut --}}
    <div class="db-chart-card">
        <div class="db-chart-card__title">Estado del Inventario (Ruleta)</div>
        <div class="db-chart-card__sub">Distribución por categoría</div>
        <div class="db-donut-wrap">
            <div class="db-donut-chart">
                <canvas id="donutChart" width="180" height="180"></canvas>
                <div class="db-donut-center">
                    <div class="db-donut-center__val">1,248</div>
                    <div class="db-donut-center__label">Total</div>
                </div>
            </div>
            <div class="db-legend">
                <div class="db-legend-item">
                    <div class="db-legend-left">
                        <div class="db-legend-dot" style="background:#22c55e"></div>
                        <span class="db-legend-name">Aseo</span>
                    </div>
                    <span class="db-legend-value">38%</span>
                </div>
                <div class="db-legend-item">
                    <div class="db-legend-left">
                        <div class="db-legend-dot" style="background:#1d74e8"></div>
                        <span class="db-legend-name">Abarrotes</span>
                    </div>
                    <span class="db-legend-value">27%</span>
                </div>
                <div class="db-legend-item">
                    <div class="db-legend-left">
                        <div class="db-legend-dot" style="background:#f59e0b"></div>
                        <span class="db-legend-name">Ropa</span>
                    </div>
                    <span class="db-legend-value">20%</span>
                </div>
                <div class="db-legend-item">
                    <div class="db-legend-left">
                        <div class="db-legend-dot" style="background:#ef4444"></div>
                        <span class="db-legend-name">Herramientas</span>
                    </div>
                    <span class="db-legend-value">15%</span>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ── Tabla ventas recientes ── --}}
<div class="db-table-card">
    <div class="db-table-header">
        <span class="db-table-header__title">Ventas Recientes</span>
        <a href="{{ route('ventas.index') }}" class="db-table-header__link">Ver todas →</a>
    </div>
    <table class="db-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Productos</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#0041</td>
                <td>María González</td>
                <td>3 productos</td>
                <td>$42.500</td>
                <td>Hoy, 10:24 am</td>
                <td><span class="db-badge db-badge--green">Completada</span></td>
            </tr>
            <tr>
                <td>#0040</td>
                <td>Pedro Ramírez</td>
                <td>1 producto</td>
                <td>$18.000</td>
                <td>Hoy, 09:15 am</td>
                <td><span class="db-badge db-badge--green">Completada</span></td>
            </tr>
            <tr>
                <td>#0039</td>
                <td>Ana Martínez</td>
                <td>5 productos</td>
                <td>$87.200</td>
                <td>Ayer, 04:48 pm</td>
                <td><span class="db-badge db-badge--yellow">Pendiente</span></td>
            </tr>
            <tr>
                <td>#0038</td>
                <td>Luis Torres</td>
                <td>2 productos</td>
                <td>$29.900</td>
                <td>Ayer, 11:30 am</td>
                <td><span class="db-badge db-badge--green">Completada</span></td>
            </tr>
            <tr>
                <td>#0037</td>
                <td>Sandra López</td>
                <td>4 productos</td>
                <td>$63.400</td>
                <td>{{ now()->subDays(2)->format('d/m/Y') }}</td>
                <td><span class="db-badge db-badge--red">Cancelada</span></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
(function () {
    // ── Colores comunes ──
    var blue   = '#1d74e8';
    var blueT  = 'rgba(29,116,232,.12)';

    // ════════════════════════════════
    // Gráfica de líneas
    // ════════════════════════════════
    var lineCtx = document.getElementById('lineChart').getContext('2d');

    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre'],
            datasets: [{
                label: 'Ventas ($)',
                data: [12000, 19500, 15200, 14800, 21000, 24500],
                borderColor: blue,
                backgroundColor: blueT,
                borderWidth: 2.5,
                pointBackgroundColor: blue,
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                fill: true,
                tension: 0.42,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0d1b35',
                    titleColor: '#fff',
                    bodyColor: 'rgba(255,255,255,.7)',
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: function (ctx) {
                            return ' $' + ctx.parsed.y.toLocaleString('es-CO');
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { color: '#94a3b8', font: { size: 12 } }
                },
                y: {
                    grid: { color: '#f1f5fd', borderDash: [4,4] },
                    border: { display: false },
                    ticks: {
                        color: '#94a3b8',
                        font: { size: 11 },
                        callback: function (v) { return '$' + (v/1000) + 'k'; }
                    }
                }
            }
        }
    });

    // ════════════════════════════════
    // Gráfica Donut
    // ════════════════════════════════
    var donutCtx = document.getElementById('donutChart').getContext('2d');

    new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Aseo', 'Abarrotes', 'Ropa', 'Herramientas'],
            datasets: [{
                data: [38, 27, 20, 15],
                backgroundColor: ['#22c55e', '#1d74e8', '#f59e0b', '#ef4444'],
                borderColor: '#fff',
                borderWidth: 3,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: false,
            cutout: '68%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0d1b35',
                    titleColor: '#fff',
                    bodyColor: 'rgba(255,255,255,.7)',
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: function (ctx) {
                            return ' ' + ctx.label + ': ' + ctx.parsed + '%';
                        }
                    }
                }
            }
        }
    });
})();
</script>
@endpush
