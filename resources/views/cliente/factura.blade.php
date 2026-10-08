<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura POS {{ sprintf('%06d', $venta->ventas) }} — Almacén Europa</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #94a3b8;
            font-family: Arial, Helvetica, sans-serif;
            color: #000000;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 20px 10px;
            -webkit-font-smoothing: antialiased;
        }

        /* Barra de herramientas superior */
        .pos-toolbar {
            width: 100%;
            max-width: 440px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 16px;
        }

        .pos-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.15s ease;
        }

        .pos-btn--back {
            background: #ffffff;
            color: #1e293b;
            box-shadow: 0 1px 4px rgba(0,0,0,0.15);
        }

        .pos-btn--back:hover {
            background: #f1f5f9;
        }

        .pos-btn--print {
            background: #1e3a8a;
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(30, 58, 138, 0.35);
        }

        .pos-btn--print:hover {
            background: #1d4ed8;
        }

        /* ── TIRILLA POS (80mm) ── */
        .pos-paper {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            padding: 24px 20px 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
            font-size: 13px;
            line-height: 1.35;
            color: #000000;
        }

        /* Línea superior estilo POS */
        .pos-top-line {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            margin-bottom: 14px;
            color: #111111;
        }

        /* Encabezado centrado */
        .pos-header {
            text-align: center;
            margin-bottom: 16px;
        }

        .pos-store-name {
            font-size: 17px;
            font-weight: 900;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .pos-store-info {
            font-size: 12px;
            line-height: 1.3;
            text-transform: uppercase;
        }

        .pos-doc-title {
            margin-top: 12px;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.03em;
        }

        .pos-regimen {
            font-size: 12px;
            font-weight: 700;
        }

        .pos-date {
            font-size: 12px;
            margin-top: 2px;
        }

        /* Datos de cliente */
        .pos-client-info {
            font-size: 13px;
            line-height: 1.38;
            margin-bottom: 14px;
            text-align: left;
        }

        .pos-client-row {
            display: flex;
        }

        .pos-client-lbl {
            font-weight: 400;
            width: 95px;
            flex-shrink: 0;
        }

        .pos-client-val {
            font-weight: 600;
        }

        /* Tabla de Artículos */
        .pos-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12.5px;
            margin-bottom: 0;
        }

        .pos-table th {
            padding: 4px 2px;
            font-weight: 800;
            font-size: 12.5px;
        }

        .pos-table th.col-art {
            text-align: left;
            width: 48%;
        }

        .pos-table th.col-pre {
            text-align: right;
            width: 24%;
        }

        .pos-table th.col-cant {
            text-align: center;
            width: 14%;
        }

        .pos-table th.col-desc {
            text-align: right;
            width: 14%;
        }

        .pos-table td {
            padding: 4px 2px;
            vertical-align: top;
        }

        .pos-table td.col-art {
            text-align: left;
            font-weight: 700;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .pos-table td.col-pre {
            text-align: right;
            white-space: nowrap;
        }

        .pos-table td.col-cant {
            text-align: center;
        }

        .pos-table td.col-desc {
            text-align: right;
        }

        /* Línea divisoria gruesa bajo la tabla */
        .pos-thick-line {
            border: none;
            border-bottom: 2.5px solid #000000;
            margin: 6px 0 10px;
        }

        /* Desglose de Totales a la derecha */
        .pos-totals-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .pos-totals-table td {
            padding: 2px 2px;
        }

        .pos-totals-table .pos-tot-lbl {
            text-align: right;
            padding-right: 14px;
            font-weight: 400;
            width: 60%;
        }

        .pos-totals-table .pos-tot-val {
            text-align: right;
            font-weight: 700;
            width: 40%;
            white-space: nowrap;
        }

        .pos-total-highlight {
            font-size: 14px;
            font-weight: 900;
        }

        /* Línea de pago y cambio */
        .pos-payment-block {
            margin: 10px 0 14px;
        }

        .pos-pay-row {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            font-size: 13px;
            margin-bottom: 3px;
        }

        .pos-pay-lbl {
            font-weight: 400;
        }

        .pos-pay-val {
            font-weight: 700;
            min-width: 90px;
            text-align: right;
        }

        /* Separador punteado */
        .pos-dashed-line {
            border: none;
            border-bottom: 1px dashed #000000;
            margin: 10px 0;
        }

        /* Puntos de fidelización */
        .pos-loyalty {
            font-size: 12px;
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .pos-loyalty strong {
            font-weight: 800;
        }

        /* Texto personalizado y Pie de Ticket */
        .pos-custom-text {
            text-align: center;
            font-size: 12px;
            line-height: 1.35;
            margin: 10px 0;
        }

        .pos-footer-credits {
            text-align: center;
            font-size: 11px;
            line-height: 1.35;
            margin-top: 6px;
        }

        /* ── CONFIGURACIÓN DE IMPRESIÓN DIRECTA POS ── */
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .pos-toolbar {
                display: none !important;
            }

            .pos-paper {
                box-shadow: none !important;
                max-width: 100% !important;
                width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            @page {
                size: 80mm auto;
                margin: 4mm;
            }
        }
    </style>
</head>
<body>

    @php
        $totalFloat = (float) $venta->total;
        $subtotalSinIva = round($totalFloat / 1.19, 2);
        $iva19 = round($totalFloat - $subtotalSinIva, 2);
        $puntosCompra = max(10, (int) floor($totalFloat / 5000));
        $puntosAcumulados = $puntosCompra + 120;
        $numeroPos = sprintf('%06d', $venta->ventas);
        $descPorcentaje = $venta->descuento_calculado > 0 ? 10 : 0;
    @endphp

    <!-- Barra de Herramientas (No Imprimible) -->
    <div class="pos-toolbar">
        <a href="{{ route('cliente.compras') }}" class="pos-btn pos-btn--back">
            &larr; Volver a Mis Compras
        </a>

        <button type="button" class="pos-btn pos-btn--print" onclick="window.print()">
            &#128438; Imprimir Factura POS
        </button>
    </div>

    <!-- ── Hoja / Tirilla POS ── -->
    <main class="pos-paper" id="ticket-pos">

        <!-- Línea Superior del Ticket -->
        <div class="pos-top-line">
            <span>{{ $venta->fecha_formateada }}</span>
            <span>ALMACÉN EUROPA -- POS Colombia</span>
        </div>

        <!-- Encabezado de la Empresa -->
        <header class="pos-header">
            <div class="pos-store-name">ALMACÉN EUROPA</div>
            <div class="pos-store-info">NIT: 901234567-8</div>
            <div class="pos-store-info">CRA. 5 # 12-34 BRR. CENTRO</div>
            <div class="pos-store-info">NEIVA - HUILA · TEL: 300 123 4567</div>

            <div class="pos-doc-title">FACTURA DE VENTA</div>
            <div class="pos-regimen">RÉGIMEN COMÚN</div>
            <div class="pos-date">{{ $venta->fecha_formateada }} {{ $venta->hora_formateada }}</div>
        </header>

        <!-- Información del Cliente -->
        <section class="pos-client-info">
            <div class="pos-client-row">
                <span class="pos-client-lbl">Cliente:</span>
                <span class="pos-client-val">{{ $venta->usuarioObj->nombre ?? 'Cliente' }} {{ $venta->usuarioObj->apellido ?? '' }}</span>
            </div>
            <div class="pos-client-row">
                <span class="pos-client-lbl">NIT o CC:</span>
                <span class="pos-client-val">{{ $venta->documento ?: '1098746377' }}</span>
            </div>
            <div class="pos-client-row">
                <span class="pos-client-lbl">Factura Nro.:</span>
                <span class="pos-client-val">{{ $numeroPos }}</span>
            </div>
            <div class="pos-client-row">
                <span class="pos-client-lbl">Vendedor:</span>
                <span class="pos-client-val">Admin POS / Tienda Web</span>
            </div>
        </section>

        <!-- Tabla de Artículos -->
        <table class="pos-table">
            <thead>
                <tr>
                    <th class="col-art">Artículo</th>
                    <th class="col-pre">Precio</th>
                    <th class="col-cant">Cant.</th>
                    <th class="col-desc">Desc %</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalles as $det)
                    <tr>
                        <td class="col-art">{{ $det->productoObj->nombre ?? 'PRODUCTO' }}</td>
                        <td class="col-pre">${{ number_format($det->precio, 0, ',', '.') }}</td>
                        <td class="col-cant">{{ $det->cantidad }}</td>
                        <td class="col-desc">{{ $descPorcentaje }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Línea negra sólida bajo los artículos -->
        <hr class="pos-thick-line">

        <!-- Desglose de Totales a la Derecha -->
        <table class="pos-totals-table">
            <tr>
                <td class="pos-tot-lbl">Subtotal</td>
                <td class="pos-tot-val">${{ number_format($subtotalSinIva, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="pos-tot-lbl">IVA 19%:</td>
                <td class="pos-tot-val">${{ number_format($iva19, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="pos-tot-lbl">IVA 0%:</td>
                <td class="pos-tot-val">$0</td>
            </tr>
            <tr>
                <td class="pos-tot-lbl pos-total-highlight">Total</td>
                <td class="pos-tot-val pos-total-highlight">${{ number_format($venta->total, 0, ',', '.') }}</td>
            </tr>
        </table>

        <!-- Medio de Pago y Cambio -->
        <div class="pos-payment-block">
            <div class="pos-pay-row">
                <span class="pos-pay-lbl">Tipo de Pago &nbsp; {{ $venta->metodo_pago }}</span>
                <span class="pos-pay-val">${{ number_format($venta->total, 0, ',', '.') }}</span>
            </div>
            <div class="pos-pay-row">
                <span class="pos-pay-lbl">Cambio</span>
                <span class="pos-pay-val">$0</span>
            </div>
        </div>

        <!-- Línea punteada -->
        <hr class="pos-dashed-line">

        <!-- Puntos de compra -->
        <div class="pos-loyalty">
            Puntos con esta compra: <strong>{{ $puntosCompra }}</strong><br>
            Puntos acumulados: <strong>{{ $puntosAcumulados }}</strong>
        </div>

        <!-- Línea punteada -->
        <hr class="pos-dashed-line">

        <!-- Texto Personalizado / Mensaje de Agradecimiento -->
        <div class="pos-custom-text">
            ¡Gracias por su compra en Almacén Europa!<br>
            Garantía: 30 días calendario con este recibo
        </div>

        <!-- Línea punteada -->
        <hr class="pos-dashed-line">

        <!-- Pie de Ticket y Créditos -->
        <div class="pos-footer-credits">
            www.almaceneuropa.com<br>
            Desarrollado para Almacén Europa<br>
            NIT: 901234567-8
        </div>

        <!-- Línea punteada final -->
        <hr class="pos-dashed-line">

    </main>

    @if(request()->has('print'))
        <script>
            window.addEventListener('load', function() {
                window.print();
            });
        </script>
    @endif

</body>
</html>
