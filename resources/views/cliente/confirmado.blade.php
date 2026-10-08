<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Pedido Confirmado! {{ $venta->numero_venta }} — Almacén Europa</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --font-display: 'Outfit', sans-serif;
            --font-body: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.5;
            padding: 40px 16px;
        }

        .conf-container {
            max-width: 740px;
            margin: 0 auto;
        }

        /* Barra de navegación superior */
        .conf-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .conf-logo {
            font-family: var(--font-display);
            font-size: 1.45rem;
            font-weight: 800;
            color: #1e3a8a;
            text-decoration: none;
            letter-spacing: -0.02em;
        }
        .conf-logo span { color: #3b82f6; }
        .conf-back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #1e3a8a;
            text-decoration: none;
        }
        .conf-back-link:hover { text-decoration: underline; }

        /* Tarjeta Principal */
        .conf-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 24px;
        }

        /* Cabecera de Éxito */
        .conf-hero {
            padding: 40px 32px 30px;
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
        }
        .conf-icon-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #ecfdf5;
            color: #059669;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            box-shadow: 0 0 0 8px #f0fdf4;
            animation: pulseSuccess 2s infinite;
        }
        @keyframes pulseSuccess {
            0%   { box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.2); }
            70%  { box-shadow: 0 0 0 14px rgba(5, 150, 105, 0); }
            100% { box-shadow: 0 0 0 0 rgba(5, 150, 105, 0); }
        }
        .conf-order-num {
            display: inline-block;
            padding: 4px 14px;
            background: #f1f5f9;
            color: #475569;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .conf-title {
            font-family: var(--font-display);
            font-size: 1.7rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }
        .conf-sub {
            font-size: 0.92rem;
            color: #64748b;
            max-width: 480px;
            margin: 0 auto;
        }

        /* Cuerpo / Detalles */
        .conf-body {
            padding: 32px;
        }

        /* Bloques de Datos */
        .conf-grid-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            background: #f8fafc;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 28px;
        }
        @media (max-width: 600px) {
            .conf-grid-info { grid-template-columns: 1fr; }
        }
        .conf-info-box h4 {
            font-family: var(--font-display);
            font-size: 0.85rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .conf-info-box p {
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 3px;
        }
        .conf-info-box p strong {
            color: #1e293b;
        }

        /* Tabla de Productos */
        .conf-items-title {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 14px;
        }
        .conf-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.88rem;
            margin-bottom: 24px;
        }
        .conf-table th {
            text-align: left;
            padding: 10px 12px;
            background: #f8fafc;
            color: #64748b;
            font-size: 0.78rem;
            font-weight: 700;
            border-bottom: 1px solid #e2e8f0;
        }
        .conf-table td {
            padding: 14px 12px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        .conf-item-name {
            font-weight: 600;
            color: #0f172a;
        }
        .conf-item-sub {
            font-size: 0.76rem;
            color: #94a3b8;
        }

        /* Desglose total */
        .conf-total-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }
        .conf-total-lbl {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
        }
        .conf-total-val {
            font-family: var(--font-display);
            font-size: 1.45rem;
            font-weight: 900;
            color: #1e3a8a;
        }

        /* Acciones */
        .conf-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }
        .conf-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 22px;
            border-radius: 10px;
            font-family: var(--font-display);
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }
        .conf-btn--primary {
            background: #0f172a;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
        }
        .conf-btn--primary:hover {
            background: #1e293b;
            transform: translateY(-1px);
        }
        .conf-btn--outline {
            background: #ffffff;
            color: #334155;
            border: 1px solid #cbd5e1;
        }
        .conf-btn--outline:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        @media print {
            body { background: #fff; padding: 0; }
            .conf-nav, .conf-actions { display: none !important; }
            .conf-card { border: none; box-shadow: none; }
        }
    </style>
</head>
<body>

<div class="conf-container">

    {{-- Navegación --}}
    <nav class="conf-nav">
        <a href="{{ route('tienda') }}" class="conf-logo">
            Almacén Europa<span>.</span>
        </a>
        <a href="{{ route('tienda') }}" class="conf-back-link">
            &larr; Volver a la Tienda
        </a>
    </nav>

    <div class="conf-card">

        {{-- Cabecera con Checkmark verde animado --}}
        <div class="conf-hero">
            <div class="conf-icon-circle">
                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <div>
                <span class="conf-order-num">{{ $venta->numero_venta }}</span>
                <h1 class="conf-title">¡Gracias por tu compra, {{ $venta->usuarioObj->nombre }}!</h1>
                <p class="conf-sub">Hemos recibido tu pedido correctamente. Nos pondremos en contacto contigo para coordinar el despacho.</p>
            </div>
        </div>

        <div class="conf-body">

            {{-- Bloques de Información de Entrega y Pago --}}
            <div class="conf-grid-info">
                <div class="conf-info-box">
                    <h4>Datos de Entrega</h4>
                    <p><strong>Destinatario:</strong> {{ $venta->usuarioObj->nombre }} {{ $venta->usuarioObj->apellido }}</p>
                    <p><strong>Documento:</strong> {{ $venta->documento ?: 'C.C. Registrada' }}</p>
                    <p><strong>Dirección:</strong> {{ $venta->direccion_envio ?: 'Dirección principal' }}</p>
                    <p><strong>Ciudad / Depto:</strong> {{ $venta->ciudad ? ($venta->ciudad . ', ' . $venta->departamento) : 'Huila, Colombia' }}</p>
                    <p><strong>Teléfono:</strong> {{ $venta->telefono ?: $venta->usuarioObj->movil }}</p>
                </div>

                <div class="conf-info-box">
                    <h4>Información del Pago</h4>
                    <p><strong>Método de pago:</strong> {{ $venta->metodo_pago }}</p>
                    <p><strong>Fecha del pedido:</strong> {{ $venta->fecha_formateada }} a las {{ $venta->hora_formateada }}</p>
                    <p><strong>Estado del pedido:</strong>
                        @if($venta->metodo_pago === 'Pago contra entrega')
                            <span style="color: #d97706; font-weight: 700;">Contra entrega (Pagas al recibir)</span>
                        @else
                            <span style="color: #059669; font-weight: 700;">Aprobado y en preparación</span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- Lista de Productos Comprados --}}
            <h3 class="conf-items-title">Resumen de Productos</h3>
            <table class="conf-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th style="text-align: center;">Cantidad</th>
                        <th style="text-align: right;">Precio Unit.</th>
                        <th style="text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->detalles as $det)
                        @php
                            $sub = $det->cantidad * $det->precio;
                        @endphp
                        <tr>
                            <td>
                                <div class="conf-item-name">{{ $det->productoObj->nombre ?? 'Producto' }}</div>
                                <div class="conf-item-sub">{{ $det->productoObj->categoriaObj->nombre ?? '' }}</div>
                            </td>
                            <td style="text-align: center; font-weight: 700;">
                                {{ $det->cantidad }}
                            </td>
                            <td style="text-align: right;">
                                ${{ number_format($det->precio, 0, ',', '.') }}
                            </td>
                            <td style="text-align: right; font-weight: 700; color: #0f172a;">
                                ${{ number_format($sub, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Total Final --}}
            <div class="conf-total-box">
                <span class="conf-total-lbl">Total Pagado</span>
                <span class="conf-total-val">${{ number_format($venta->total, 0, ',', '.') }}</span>
            </div>

            {{-- Botones de Acción --}}
            <div class="conf-actions">
                <a href="{{ route('tienda') }}" class="conf-btn conf-btn--primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"/>
                        <polyline points="12 19 5 12 12 5"/>
                    </svg>
                    <span>Seguir Comprando</span>
                </a>

                <a href="{{ route('cliente.compras') }}" class="conf-btn conf-btn--outline" style="color: #1e3a8a; border-color: #93c5fd; background: #eff6ff;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span>Ver Mis Compras</span>
                </a>

                <button type="button" class="conf-btn conf-btn--outline" onclick="abrirModalPosConfirmado()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                    <span>Ver Factura POS</span>
                </button>

                <button type="button" class="conf-btn conf-btn--outline" onclick="imprimirPosConfirmado()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 6 2 18 2 18 9"/>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                        <rect x="6" y="14" width="12" height="8"/>
                    </svg>
                    <span>Imprimir Factura POS</span>
                </button>
            </div>

        </div>

    </div>

</div>

<!-- ══════════════════════════════════════════
     MODAL DE FACTURA POS EN PÁGINA
══════════════════════════════════════════ -->
@php
    $totalFloat = (float) $venta->total;
    $subtotalSinIva = round($totalFloat / 1.19, 2);
    $iva19 = round($totalFloat - $subtotalSinIva, 2);
    $puntosCompra = max(10, (int) floor($totalFloat / 5000));
    $puntosAcumulados = $puntosCompra + 120;
    $numeroPos = sprintf('%06d', $venta->ventas);
    $descPorcentaje = $venta->descuento_calculado > 0 ? 10 : 0;
@endphp

<div id="modal-pos-confirmado" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center; padding: 16px;">
    <div style="background: #ffffff; border-radius: 16px; max-width: 460px; width: 100%; max-height: 94vh; overflow-y: auto; box-shadow: 0 20px 40px rgba(0,0,0,0.35); position: relative;">
        <!-- Header modal -->
        <div style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; background: #fff; z-index: 10;">
            <div style="font-weight: 800; font-family: var(--font-display); font-size: 1rem; color: #0f172a;">
                Factura POS {{ $numeroPos }}
            </div>
            <div style="display: flex; gap: 8px;">
                <button type="button" onclick="imprimirPosConfirmado()" style="background: #1e3a8a; color: #fff; border: none; padding: 7px 14px; border-radius: 8px; font-weight: 700; font-size: 0.82rem; cursor: pointer;">
                    &#128438; Imprimir
                </button>
                <button type="button" onclick="cerrarModalPosConfirmado()" style="background: #f1f5f9; border: none; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; font-size: 1.2rem; line-height: 1; color: #64748b;">
                    &times;
                </button>
            </div>
        </div>

        <!-- Tirilla POS idéntica a la imagen -->
        <div style="background: #94a3b8; padding: 14px; display: flex; justify-content: center;">
            <div id="ticket-pos-confirmado-render" style="width: 100%; max-width: 410px; background: #ffffff; padding: 22px 18px 28px; box-shadow: 0 4px 18px rgba(0,0,0,0.18); font-family: Arial, Helvetica, sans-serif; font-size: 13px; line-height: 1.35; color: #000000;">
                <div style="display: flex; justify-content: space-between; font-size: 11px; margin-bottom: 14px; color: #111;">
                    <span>{{ $venta->fecha_formateada }}</span>
                    <span>ALMACÉN EUROPA -- POS Colombia</span>
                </div>

                <div style="text-align: center; margin-bottom: 16px;">
                    <div style="font-size: 17px; font-weight: 900; letter-spacing: 0.02em; text-transform: uppercase; margin-bottom: 2px;">ALMACÉN EUROPA</div>
                    <div style="font-size: 12px; line-height: 1.3; text-transform: uppercase;">NIT: 901234567-8</div>
                    <div style="font-size: 12px; line-height: 1.3; text-transform: uppercase;">CRA. 5 # 12-34 BRR. CENTRO</div>
                    <div style="font-size: 12px; line-height: 1.3; text-transform: uppercase;">NEIVA - HUILA · TEL: 300 123 4567</div>

                    <div style="margin-top: 12px; font-size: 14px; font-weight: 800; letter-spacing: 0.03em;">FACTURA DE VENTA</div>
                    <div style="font-size: 12px; font-weight: 700;">RÉGIMEN COMÚN</div>
                    <div style="font-size: 12px; margin-top: 2px;">{{ $venta->fecha_formateada }} {{ $venta->hora_formateada }}</div>
                </div>

                <div style="font-size: 13px; line-height: 1.38; margin-bottom: 14px; text-align: left;">
                    <div style="display: flex;"><span style="width: 95px; flex-shrink: 0;">Cliente:</span><span style="font-weight: 600;">{{ $venta->usuarioObj->nombre ?? 'Cliente' }} {{ $venta->usuarioObj->apellido ?? '' }}</span></div>
                    <div style="display: flex;"><span style="width: 95px; flex-shrink: 0;">NIT o CC:</span><span style="font-weight: 600;">{{ $venta->documento ?: '1098746377' }}</span></div>
                    <div style="display: flex;"><span style="width: 95px; flex-shrink: 0;">Factura Nro.:</span><span style="font-weight: 600;">{{ $numeroPos }}</span></div>
                    <div style="display: flex;"><span style="width: 95px; flex-shrink: 0;">Vendedor:</span><span style="font-weight: 600;">Admin POS / Tienda Web</span></div>
                </div>

                <table style="width: 100%; border-collapse: collapse; font-size: 12.5px; margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th style="text-align: left; width: 48%; padding: 4px 2px; font-weight: 800;">Artículo</th>
                            <th style="text-align: right; width: 24%; padding: 4px 2px; font-weight: 800;">Precio</th>
                            <th style="text-align: center; width: 14%; padding: 4px 2px; font-weight: 800;">Cant.</th>
                            <th style="text-align: right; width: 14%; padding: 4px 2px; font-weight: 800;">Desc %</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($venta->detalles as $det)
                            <tr>
                                <td style="text-align: left; font-weight: 700; text-transform: uppercase; padding: 4px 2px;">{{ $det->productoObj->nombre ?? 'PRODUCTO' }}</td>
                                <td style="text-align: right; white-space: nowrap; padding: 4px 2px;">${{ number_format($det->precio, 0, ',', '.') }}</td>
                                <td style="text-align: center; padding: 4px 2px;">{{ $det->cantidad }}</td>
                                <td style="text-align: right; padding: 4px 2px;">{{ $descPorcentaje }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr style="border: none; border-bottom: 2.5px solid #000000; margin: 6px 0 10px;">

                <table style="width: 100%; border-collapse: collapse; font-size: 13px; margin-bottom: 12px;">
                    <tr>
                        <td style="text-align: right; padding-right: 14px; width: 60%;">Subtotal</td>
                        <td style="text-align: right; font-weight: 700; width: 40%;">${{ number_format($subtotalSinIva, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding-right: 14px;">IVA 19%:</td>
                        <td style="text-align: right; font-weight: 700;">${{ number_format($iva19, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding-right: 14px;">IVA 0%:</td>
                        <td style="text-align: right; font-weight: 700;">$0</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding-right: 14px; font-size: 14px; font-weight: 900;">Total</td>
                        <td style="text-align: right; font-size: 14px; font-weight: 900;">${{ number_format($venta->total, 0, ',', '.') }}</td>
                    </tr>
                </table>

                <div style="margin: 10px 0 14px;">
                    <div style="display: flex; justify-content: flex-end; gap: 16px; font-size: 13px; margin-bottom: 3px;">
                        <span>Tipo de Pago &nbsp; {{ $venta->metodo_pago }}</span>
                        <span style="font-weight: 700; min-width: 90px; text-align: right;">${{ number_format($venta->total, 0, ',', '.') }}</span>
                    </div>
                    <div style="display: flex; justify-content: flex-end; gap: 16px; font-size: 13px;">
                        <span>Cambio</span>
                        <span style="font-weight: 700; min-width: 90px; text-align: right;">$0</span>
                    </div>
                </div>

                <hr style="border: none; border-bottom: 1px dashed #000000; margin: 10px 0;">

                <div style="font-size: 12px; line-height: 1.4; margin-bottom: 8px;">
                    Puntos con esta compra: <strong>{{ $puntosCompra }}</strong><br>
                    Puntos acumulados: <strong>{{ $puntosAcumulados }}</strong>
                </div>

                <hr style="border: none; border-bottom: 1px dashed #000000; margin: 10px 0;">

                <div style="text-align: center; font-size: 12px; line-height: 1.35; margin: 10px 0;">
                    ¡Gracias por su compra en Almacén Europa!<br>
                    Garantía: 30 días calendario con este recibo
                </div>

                <hr style="border: none; border-bottom: 1px dashed #000000; margin: 10px 0;">

                <div style="text-align: center; font-size: 11px; line-height: 1.35; margin-top: 6px;">
                    www.almaceneuropa.com<br>
                    Desarrollado para Almacén Europa<br>
                    NIT: 901234567-8
                </div>

                <hr style="border: none; border-bottom: 1px dashed #000000; margin: 10px 0;">
            </div>
        </div>

        <div style="padding: 14px 20px; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; background: #f8fafc; border-radius: 0 0 16px 16px;">
            <button type="button" onclick="cerrarModalPosConfirmado()" style="background: #fff; border: 1px solid #cbd5e1; padding: 8px 16px; border-radius: 8px; font-weight: 700; cursor: pointer; color: #475569;">
                Cerrar
            </button>
            <button type="button" onclick="imprimirPosConfirmado()" style="background: #1e3a8a; border: none; padding: 8px 18px; border-radius: 8px; font-weight: 700; cursor: pointer; color: #fff;">
                &#128438; Imprimir Factura POS
            </button>
        </div>
    </div>
</div>

<script>
    function abrirModalPosConfirmado() {
        document.getElementById('modal-pos-confirmado').style.display = 'flex';
    }

    function cerrarModalPosConfirmado() {
        document.getElementById('modal-pos-confirmado').style.display = 'none';
    }

    document.getElementById('modal-pos-confirmado').addEventListener('click', function(e) {
        if (e.target === this) cerrarModalPosConfirmado();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') cerrarModalPosConfirmado();
    });

    function imprimirPosConfirmado() {
        const ticketContent = document.getElementById('ticket-pos-confirmado-render').innerHTML;
        const iframe = document.createElement('iframe');
        iframe.style.position = 'fixed';
        iframe.style.right = '0';
        iframe.style.bottom = '0';
        iframe.style.width = '0';
        iframe.style.height = '0';
        iframe.style.border = '0';
        iframe.style.opacity = '0';
        document.body.appendChild(iframe);

        const doc = iframe.contentWindow.document;
        doc.open();
        doc.write('<!DOCTYPE html><html><head><title>Factura POS<\/title><style>' +
            '* { box-sizing: border-box; margin: 0; padding: 0; } ' +
            'body { font-family: Arial, Helvetica, sans-serif; font-size: 12.5px; line-height: 1.35; color: #000; width: 78mm; margin: 0 auto; padding: 3mm 2mm; } ' +
            '@page { size: 80mm auto; margin: 0; }' +
            '<\/style><\/head><body>' +
            ticketContent +
            '<\/body><\/html>');
        doc.close();

        iframe.contentWindow.focus();
        setTimeout(() => {
            iframe.contentWindow.print();
            setTimeout(() => {
                if (document.body.contains(iframe)) {
                    document.body.removeChild(iframe);
                }
            }, 1500);
        }, 250);
    }
</script>

</body>
</html>
