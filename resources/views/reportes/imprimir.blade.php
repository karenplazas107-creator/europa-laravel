<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tituloReporte }} — Almacén Europa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ════════════════════════════════════════
           RESET & GENERAL
        ════════════════════════════════════════ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            font-size: 11px;
            line-height: 1.4;
            padding: 24px;
        }

        /* ════════════════════════════════════════
           TOOLBAR DE PANTALLA (NO IMPRIMIBLE)
        ════════════════════════════════════════ */
        .doc-toolbar {
            max-width: 900px;
            margin: 0 auto 16px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #090d16;
            padding: 12px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.15);
        }
        .doc-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s ease;
        }
        .doc-btn--back {
            background: rgba(255,255,255,0.12);
            color: #ffffff;
        }
        .doc-btn--back:hover {
            background: rgba(255,255,255,0.22);
        }
        .doc-btn--print {
            background: #2563eb;
            color: #ffffff;
        }
        .doc-btn--print:hover {
            background: #1d4ed8;
            box-shadow: 0 2px 10px rgba(37, 99, 235, 0.4);
        }

        /* ════════════════════════════════════════
           HOJA DEL DOCUMENTO
        ════════════════════════════════════════ */
        .doc-sheet {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 4px;
            padding: 32px 36px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            position: relative;
            min-height: 1050px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* ════════════════════════════════════════
           ENCABEZADO CORPORATIVO
        ════════════════════════════════════════ */
        .doc-header-banner {
            background: #0f172a;
            color: #ffffff;
            padding: 18px 24px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .doc-brand-title {
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: #ffffff;
            line-height: 1.1;
        }
        .doc-brand-sub {
            font-size: 10.5px;
            color: #94a3b8;
            margin-top: 3px;
        }
        .doc-meta-right {
            text-align: right;
        }
        .doc-meta-title {
            font-size: 13px;
            font-weight: 700;
            color: #ffffff;
        }
        .doc-meta-item {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 2px;
        }

        /* Título de la sección / listado */
        .doc-section-title {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.06em;
            color: #334155;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        /* ════════════════════════════════════════
           TABLA ESTILIZADA CORPORATIVA
        ════════════════════════════════════════ */
        .doc-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
            font-size: 10.5px;
        }
        .doc-table th {
            background: #0f172a;
            color: #ffffff;
            padding: 9px 10px;
            text-align: left;
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            border: 1px solid #0f172a;
        }
        .doc-table th.text-right,
        .doc-table td.text-right {
            text-align: right;
        }
        .doc-table th.text-center,
        .doc-table td.text-center {
            text-align: center;
        }
        .doc-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #e2e8f0;
            color: #1e293b;
            vertical-align: middle;
        }
        .doc-table tr:nth-child(even) td {
            background: #f8fafc;
        }
        .doc-table tr.total-row td {
            background: #0f172a;
            color: #ffffff;
            font-weight: 700;
            border: 1px solid #0f172a;
            padding: 10px;
        }

        /* Badges de estado */
        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 9999px;
            font-size: 9px;
            font-weight: 700;
            text-align: center;
        }
        .status-badge--normal {
            background: #ecfdf5;
            color: #059669;
        }
        .status-badge--bajo {
            background: #fffbeb;
            color: #d97706;
        }
        .status-badge--agotado {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Tarjetas de Resumen */
        .resumen-cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 20px;
        }
        .resumen-card {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 14px;
            background: #f8fafc;
        }
        .resumen-card-label {
            font-size: 10px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .resumen-card-value {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin-top: 4px;
        }

        /* ════════════════════════════════════════
           PIE DE PÁGINA DEL DOCUMENTO
        ════════════════════════════════════════ */
        .doc-footer {
            border-top: 1px solid #e2e8f0;
            padding-top: 12px;
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 9.5px;
            color: #94a3b8;
        }

        /* ════════════════════════════════════════
           REGLAS PARA IMPRESIÓN (@media print)
        ════════════════════════════════════════ */
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
            .doc-sheet {
                box-shadow: none;
                padding: 10px 0;
                max-width: 100%;
                min-height: auto;
            }
            .doc-header-banner {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                background-color: #0f172a !important;
                color: #ffffff !important;
            }
            .doc-table th {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                background-color: #0f172a !important;
                color: #ffffff !important;
            }
            .doc-table tr.total-row td {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                background-color: #0f172a !important;
                color: #ffffff !important;
            }
            .status-badge {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            @page {
                size: letter portrait;
                margin: 12mm 15mm;
            }
        }
    </style>
</head>
<body>

    {{-- ── Barra de herramientas en pantalla ── --}}
    <div class="doc-toolbar no-print">
        <a href="{{ route('reportes.index') }}" class="doc-btn doc-btn--back">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"/>
                <polyline points="12 19 5 12 12 5"/>
            </svg>
            Volver a Reportes
        </a>

        <button onclick="window.print()" class="doc-btn doc-btn--print">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 6 2 18 2 18 9"/>
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                <rect x="6" y="14" width="12" height="8"/>
            </svg>
            Imprimir / Guardar como PDF
        </button>
    </div>

    {{-- ── Hoja A4 / Carta para impresión ── --}}
    <div class="doc-sheet">

        <div>
            {{-- Encabezado Corporativo --}}
            <div class="doc-header-banner">
                <div>
                    <div class="doc-brand-title">ALMACÉN EUROPA</div>
                    <div class="doc-brand-sub">Sistema de Gestión · {{ $tituloReporte }}</div>
                </div>
                <div class="doc-meta-right">
                    <div class="doc-meta-title">{{ $tituloReporte }}</div>
                    <div class="doc-meta-item">Generado: {{ $fechaGeneracion }}</div>
                    <div class="doc-meta-item">Usuario: {{ Auth::user()->nombre ?? 'Admin' }} · {{ Auth::user()->rol ?? 'administrador' }}</div>
                </div>
            </div>

            {{-- Título de la Sección --}}
            <div class="doc-section-title">{{ $subtituloReporte }}</div>

            {{-- ════════════════════════════════════════
                 CASO 1: REPORTE DE INVENTARIO / STOCK BAJO
            ════════════════════════════════════════ --}}
            @if($tipo === 'inventario' || $tipo === 'stock_bajo')
                <table class="doc-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 35px;">#</th>
                            <th>PRODUCTO</th>
                            <th>CATEGORÍA</th>
                            <th class="text-right">P. COMPRA</th>
                            <th class="text-right">P. VENTA</th>
                            <th class="text-center">STOCK</th>
                            <th class="text-center">MÍN.</th>
                            <th class="text-center">ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $index => $prod)
                            <tr>
                                <td class="text-center" style="color: #64748b;">{{ $index + 1 }}</td>
                                <td style="font-weight: 600;">{{ $prod->nombre }}</td>
                                <td style="color: #475569;">{{ $prod->categoriaObj->nombre ?? 'General' }}</td>
                                <td class="text-right">${{ number_format($prod->precio_compra, 0, ',', '.') }}</td>
                                <td class="text-right">${{ number_format($prod->precio_venta, 0, ',', '.') }}</td>
                                <td class="text-center" style="font-weight: 700;">{{ $prod->stock }}</td>
                                <td class="text-center" style="color: #64748b;">{{ $prod->stock_minimo ?? 10 }}</td>
                                <td class="text-center">
                                    @if($prod->stock <= 0)
                                        <span class="status-badge status-badge--agotado">Agotado</span>
                                    @elseif($prod->stock <= ($prod->stock_minimo ?? 10))
                                        <span class="status-badge status-badge--bajo">Bajo</span>
                                    @else
                                        <span class="status-badge status-badge--normal">Normal</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center" style="padding: 20px; color: #94a3b8;">
                                    No hay productos para mostrar en este reporte.
                                </td>
                            </tr>
                        @endforelse

                        {{-- Fila de Totales --}}
                        <tr class="total-row">
                            <td colspan="5" style="letter-spacing: 0.06em;">TOTALES</td>
                            <td class="text-center">{{ number_format($totales['unidades'], 0, ',', '.') }}</td>
                            <td></td>
                            <td class="text-right" style="font-size: 11px;">${{ number_format($totales['valor_compra'], 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

            {{-- ════════════════════════════════════════
                 CASO 2: VENTAS DEL MES
            ════════════════════════════════════════ --}}
            @elseif($tipo === 'ventas_mes')
                <table class="doc-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 40px;"># VENTA</th>
                            <th>RESPONSABLE</th>
                            <th>FECHA / HORA</th>
                            <th>MÉTODO DE PAGO</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $venta)
                            <tr>
                                <td class="text-center" style="font-weight: 700; color: #2563eb;">{{ $venta->numero_venta }}</td>
                                <td style="font-weight: 600;">{{ $venta->nombre_responsable }}</td>
                                <td style="color: #475569;">{{ $venta->fecha_formateada }} {{ $venta->hora_formateada }}</td>
                                <td><span style="text-transform: capitalize;">{{ $venta->metodo_pago ?? 'Efectivo' }}</span></td>
                                <td class="text-right" style="font-weight: 700;">{{ $venta->total_formateado }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center" style="padding: 20px; color: #94a3b8;">
                                    No hay ventas registradas en el mes actual.
                                </td>
                            </tr>
                        @endforelse

                        <tr class="total-row">
                            <td colspan="4">TOTAL VENTAS DEL MES</td>
                            <td class="text-right">${{ number_format($totales['total_general'], 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

            {{-- ════════════════════════════════════════
                 CASO 3: TOP PRODUCTOS
            ════════════════════════════════════════ --}}
            @elseif($tipo === 'top_productos')
                <table class="doc-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 40px;">POS</th>
                            <th>PRODUCTO</th>
                            <th>CATEGORÍA</th>
                            <th class="text-center">UNIDADES VENDIDAS</th>
                            <th class="text-right">INGRESOS GENERADOS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $index => $item)
                            <tr>
                                <td class="text-center" style="font-weight: 700; color: #2563eb;">#{{ $index + 1 }}</td>
                                <td style="font-weight: 600;">{{ $item->productoObj->nombre ?? 'Producto #' . $item->producto }}</td>
                                <td style="color: #475569;">{{ $item->productoObj->categoriaObj->nombre ?? 'General' }}</td>
                                <td class="text-center" style="font-weight: 700;">{{ $item->total_unidades }} uds</td>
                                <td class="text-right" style="font-weight: 700;">${{ number_format($item->total_ingresos, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center" style="padding: 20px; color: #94a3b8;">
                                    No se registran ventas para clasificar productos.
                                </td>
                            </tr>
                        @endforelse

                        <tr class="total-row">
                            <td colspan="3">TOTAL ACUMULADO TOP PRODUCTOS</td>
                            <td class="text-center">{{ number_format($totales['unidades'], 0, ',', '.') }} uds</td>
                            <td class="text-right">${{ number_format($totales['total_general'], 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

            {{-- ════════════════════════════════════════
                 CASO 4: VENDEDORES
            ════════════════════════════════════════ --}}
            @elseif($tipo === 'vendedores')
                <table class="doc-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 40px;">#</th>
                            <th>VENDEDOR / USUARIO</th>
                            <th>CORREO ELECTRÓNICO</th>
                            <th class="text-center">VENTAS REALIZADAS</th>
                            <th class="text-right">INGRESOS TOTALES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $index => $item)
                            <tr>
                                <td class="text-center" style="color: #64748b;">{{ $index + 1 }}</td>
                                <td style="font-weight: 600;">
                                    {{ $item->usuarioObj ? trim("{$item->usuarioObj->nombre} {$item->usuarioObj->apellido}") : 'Usuario desconocido' }}
                                </td>
                                <td style="color: #475569;">{{ $item->usuarioObj->email ?? 'N/A' }}</td>
                                <td class="text-center" style="font-weight: 700;">{{ $item->total_ventas }}</td>
                                <td class="text-right" style="font-weight: 700;">${{ number_format($item->total_ingresos, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center" style="padding: 20px; color: #94a3b8;">
                                    No hay registros de ventas asignadas a vendedores.
                                </td>
                            </tr>
                        @endforelse

                        <tr class="total-row">
                            <td colspan="3">TOTALES GENERALES</td>
                            <td class="text-center">{{ $totales['unidades'] }} ventas</td>
                            <td class="text-right">${{ number_format($totales['total_general'], 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

            {{-- ════════════════════════════════════════
                 CASO 5: RESUMEN EJECUTIVO
            ════════════════════════════════════════ --}}
            @elseif($tipo === 'resumen')
                <div class="resumen-cards-grid">
                    <div class="resumen-card">
                        <div class="resumen-card-label">Total Ventas</div>
                        <div class="resumen-card-value">{{ $items['total_ventas'] }}</div>
                    </div>
                    <div class="resumen-card">
                        <div class="resumen-card-label">Ingresos Totales</div>
                        <div class="resumen-card-value">${{ number_format($items['ingresos_totales'], 0, ',', '.') }}</div>
                    </div>
                    <div class="resumen-card">
                        <div class="resumen-card-label">Productos Registrados</div>
                        <div class="resumen-card-value">{{ $items['total_productos'] }}</div>
                    </div>
                    <div class="resumen-card">
                        <div class="resumen-card-label">Unidades en Stock</div>
                        <div class="resumen-card-value">{{ number_format($items['unidades_stock'], 0, ',', '.') }}</div>
                    </div>
                    <div class="resumen-card">
                        <div class="resumen-card-label">Valor del Inventario</div>
                        <div class="resumen-card-value">${{ number_format($items['valor_inventario'], 0, ',', '.') }}</div>
                    </div>
                    <div class="resumen-card">
                        <div class="resumen-card-label">Productos Stock Crítico</div>
                        <div class="resumen-card-value" style="color: {{ $items['stock_critico'] > 0 ? '#dc2626' : '#059669' }};">
                            {{ $items['stock_critico'] }}
                        </div>
                    </div>
                </div>
            @endif

        </div>

        {{-- Pie de Página Institucional --}}
        <div class="doc-footer">
            <div>Almacén Europa — Sistema de Gestión</div>
            <div>{{ $tituloReporte }} — Generado el {{ $fechaGeneracion }}</div>
            <div>Usuario: {{ Auth::user()->nombre ?? 'Karen' }}</div>
        </div>

    </div>

    <script>
        // Si está embebido en el visor modal del sistema, ocultar la barra exterior y adaptar estilo
        if (window.self !== window.top) {
            document.documentElement.classList.add('in-modal-frame');
            var tb = document.querySelector('.doc-toolbar');
            if (tb) tb.style.display = 'none';
            document.body.style.backgroundColor = '#f8fafc';
            document.body.style.padding = '14px 16px 24px 16px';
        }
    </script>

    {{-- Script para auto-impresión si se solicitó descargar directo --}}
    @if($formato === 'pdf_imprimir')
        <script>
            window.addEventListener('load', function () {
                setTimeout(function() {
                    window.print();
                }, 350);
            });
        </script>
    @endif

</body>
</html>
