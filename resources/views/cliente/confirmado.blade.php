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

                <button type="button" class="conf-btn conf-btn--outline" onclick="window.print()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 6 2 18 2 18 9"/>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                        <rect x="6" y="14" width="12" height="8"/>
                    </svg>
                    <span>Imprimir Comprobante</span>
                </button>
            </div>

        </div>

    </div>

</div>

</body>
</html>
