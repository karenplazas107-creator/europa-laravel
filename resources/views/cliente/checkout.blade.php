<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Finalizar Compra — Almacén Europa</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --font-display: 'Outfit', sans-serif;
            --font-body: 'Inter', sans-serif;
            --color-primary: #1e3a8a;
            --color-primary-hover: #172554;
            --color-dark: #0f172a;
            --color-border: #e2e8f0;
            --color-bg-summary: #fafafa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background-color: #ffffff;
            color: #1e293b;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        /* ══════════════════════════════════════════
           LAYOUT PRINCIPAL (2 COLUMNAS TIPO SHOPIFY)
        ══════════════════════════════════════════ */
        .chk-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* Columna Izquierda (Formulario) */
        .chk-main {
            flex: 1.2;
            padding: 40px 60px 60px 80px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            max-width: 760px;
            margin-left: auto;
        }

        /* Columna Derecha (Resumen Sticky) */
        .chk-sidebar {
            flex: 0.95;
            background-color: var(--color-bg-summary);
            border-left: 1px solid var(--color-border);
            padding: 40px 80px 60px 50px;
        }

        @media (max-width: 1024px) {
            .chk-container {
                flex-direction: column-reverse;
            }
            .chk-main {
                padding: 30px 24px 60px 24px;
                max-width: 100%;
                margin: 0;
            }
            .chk-sidebar {
                padding: 24px;
                border-left: none;
                border-bottom: 1px solid var(--color-border);
            }
        }

        /* ══════════════════════════════════════════
           HEADER & BREADCRUMBS
        ══════════════════════════════════════════ */
        .chk-header {
            margin-bottom: 24px;
        }
        .chk-logo-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }
        .chk-logo {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e3a8a;
            text-decoration: none;
            letter-spacing: -0.03em;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .chk-logo span {
            color: #3b82f6;
        }
        .chk-security-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            color: #059669;
            font-weight: 600;
            background: #ecfdf5;
            padding: 5px 10px;
            border-radius: 20px;
            border: 1px solid #a7f3d0;
        }
        .chk-nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            color: #64748b;
        }
        .chk-nav-links a {
            color: #1e3a8a;
            text-decoration: none;
            font-weight: 500;
        }
        .chk-nav-links a:hover {
            text-decoration: underline;
        }
        .chk-nav-links span.active {
            font-weight: 700;
            color: #0f172a;
        }

        /* ══════════════════════════════════════════
           SECCIONES DEL FORMULARIO
        ══════════════════════════════════════════ */
        .chk-section {
            margin-bottom: 32px;
        }
        .chk-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }
        .chk-section-title {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f172a;
        }
        .chk-login-link {
            font-size: 0.82rem;
            color: #1e3a8a;
            text-decoration: none;
            font-weight: 600;
        }
        .chk-login-link:hover {
            text-decoration: underline;
        }

        /* Inputs y Campos */
        .chk-field-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .chk-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .chk-row-3 {
            display: grid;
            grid-template-columns: 1.2fr 1.2fr 1fr;
            gap: 12px;
        }
        @media (max-width: 640px) {
            .chk-row-2, .chk-row-3 {
                grid-template-columns: 1fr;
            }
        }

        .chk-input-wrap {
            position: relative;
        }
        .chk-input, .chk-select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.88rem;
            font-family: var(--font-body);
            color: #0f172a;
            background: #ffffff;
            transition: all 0.2s ease;
        }
        .chk-input:focus, .chk-select:focus {
            outline: none;
            border-color: #1e3a8a;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.12);
        }
        .chk-input::placeholder {
            color: #94a3b8;
        }
        .chk-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 38px;
            cursor: pointer;
        }

        .chk-checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.83rem;
            color: #475569;
            cursor: pointer;
            margin-top: 4px;
            user-select: none;
        }
        .chk-checkbox {
            width: 17px;
            height: 17px;
            border-radius: 4px;
            accent-color: #1e3a8a;
            cursor: pointer;
        }

        /* ══════════════════════════════════════════
           CAJAS DE MÉTODOS DE PAGO (ACORDEÓN)
        ══════════════════════════════════════════ */
        .chk-payment-box {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            overflow: hidden;
            background: #ffffff;
        }
        .chk-payment-option {
            border-bottom: 1px solid #e2e8f0;
            transition: background 0.2s ease;
        }
        .chk-payment-option:last-child {
            border-bottom: none;
        }
        .chk-payment-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            cursor: pointer;
            user-select: none;
        }
        .chk-payment-option.is-active .chk-payment-head {
            background: #f8fafc;
        }
        .chk-payment-left {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.88rem;
            font-weight: 600;
            color: #0f172a;
        }
        .chk-radio {
            width: 18px;
            height: 18px;
            accent-color: #1e3a8a;
            cursor: pointer;
        }
        .chk-badges-wrap {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .chk-badge-pill {
            font-size: 0.68rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 4px;
            text-transform: uppercase;
        }
        .chk-badge--addi   { background: #e0e7ff; color: #3730a3; }
        .chk-badge--pse    { background: #eff6ff; color: #1d4ed8; }
        .chk-badge--wompi  { background: #fef3c7; color: #92400e; }
        .chk-badge--cash   { background: #ecfdf5; color: #065f46; }
        .chk-badge--nequi  { background: #fae8ff; color: #86198f; }

        .chk-payment-body {
            display: none;
            padding: 16px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            font-size: 0.82rem;
            color: #475569;
            line-height: 1.5;
        }
        .chk-payment-option.is-active .chk-payment-body {
            display: block;
        }

        /* ══════════════════════════════════════════
           DIRECCIÓN DE FACTURACIÓN
        ══════════════════════════════════════════ */
        .chk-billing-box {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            overflow: hidden;
            background: #ffffff;
            margin-top: 12px;
        }
        .chk-billing-item {
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #0f172a;
            border-bottom: 1px solid #e2e8f0;
            cursor: pointer;
        }
        .chk-billing-item:last-child {
            border-bottom: none;
        }

        /* Botón de Pagar */
        .chk-submit-btn {
            width: 100%;
            padding: 16px 24px;
            background-color: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.25);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 24px;
        }
        .chk-submit-btn:hover {
            background-color: #1e293b;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.35);
        }
        .chk-submit-btn:disabled {
            opacity: 0.65;
            cursor: not-allowed;
            transform: none;
        }

        /* Footer enlaces */
        .chk-footer-links {
            margin-top: 36px;
            padding-top: 18px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            font-size: 0.74rem;
            color: #94a3b8;
        }
        .chk-footer-links a {
            color: #64748b;
            text-decoration: none;
        }
        .chk-footer-links a:hover {
            color: #0f172a;
            text-decoration: underline;
        }

        /* ══════════════════════════════════════════
           COLUMNA DERECHA (RESUMEN DEL PEDIDO)
        ══════════════════════════════════════════ */
        .chk-summary-sticky {
            position: sticky;
            top: 40px;
        }
        .chk-items-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 24px;
            max-height: 380px;
            overflow-y: auto;
            padding-right: 6px;
        }
        .chk-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }
        .chk-item-thumb-wrap {
            position: relative;
            width: 62px;
            height: 62px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
        }
        .chk-item-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }
        .chk-item-qty {
            position: absolute;
            top: -7px;
            right: -7px;
            width: 20px;
            height: 20px;
            background: #0f172a;
            color: #ffffff;
            font-size: 0.7rem;
            font-weight: 700;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .chk-item-info {
            flex: 1;
            min-width: 0;
        }
        .chk-item-title {
            font-size: 0.86rem;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.3;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .chk-item-meta {
            font-size: 0.74rem;
            color: #64748b;
            margin-top: 2px;
        }
        .chk-item-price {
            font-size: 0.88rem;
            font-weight: 700;
            color: #0f172a;
            text-align: right;
            white-space: nowrap;
        }

        /* Cupones */
        .chk-coupon-wrap {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid #e2e8f0;
        }
        .chk-coupon-btn {
            padding: 0 18px;
            background: #e2e8f0;
            color: #475569;
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .chk-coupon-btn:hover {
            background: #cbd5e1;
            color: #0f172a;
        }

        /* Líneas de Total */
        .chk-breakdown-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.86rem;
            color: #475569;
            margin-bottom: 10px;
        }
        .chk-breakdown-row strong {
            color: #0f172a;
        }
        .chk-divider-breakdown {
            height: 1px;
            background: #e2e8f0;
            margin: 16px 0;
        }
        .chk-total-row {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
        }
        .chk-total-label {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f172a;
        }
        .chk-total-price-wrap {
            text-align: right;
        }
        .chk-total-currency {
            font-size: 0.75rem;
            color: #64748b;
            margin-right: 4px;
            font-weight: 500;
        }
        .chk-total-amount {
            font-family: var(--font-display);
            font-size: 1.55rem;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: -0.02em;
        }
        .chk-tax-note {
            font-size: 0.72rem;
            color: #94a3b8;
            margin-top: 3px;
        }

        /* Alertas de Cupón y Notificaciones */
        .cupon-alert {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 0.82rem;
            line-height: 1.35;
            animation: fadeIn 0.2s ease;
        }
        .cupon-alert--warning {
            background: #fffbeb;
            color: #92400e;
            border: 1px solid #fde68a;
        }
        .cupon-alert--error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .cupon-alert--success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .chk-toast-banner {
            display: none;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 0.86rem;
            margin-bottom: 20px;
            animation: fadeIn 0.25s ease;
        }
        .chk-toast-banner--error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .chk-toast-banner--success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        /* Spinner */
        .animate-spin {
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-3px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="chk-container">

    {{-- ══════════════════════════════════════════
         COLUMNA IZQUIERDA: FORMULARIO DE CHECKOUT
    ══════════════════════════════════════════ --}}
    <main class="chk-main">

        {{-- Header & Navegación --}}
        <header class="chk-header">
            <div class="chk-logo-bar">
                <a href="{{ route('tienda') }}" class="chk-logo">
                    Almacén Europa<span>.</span>
                </a>
                <div class="chk-security-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    Pago Seguro SSL
                </div>
            </div>

            <div class="chk-nav-links">
                <a href="{{ route('tienda') }}">Tienda</a>
                <span>&rsaquo;</span>
                <a href="#" onclick="history.back(); return false;">Carrito</a>
                <span>&rsaquo;</span>
                <span class="active">Información y Pago</span>
            </div>
        </header>

        {{-- Banner de alertas / errores en checkout --}}
        <div id="chk-error-banner" class="chk-toast-banner" style="display: none;"></div>

        <form id="chk-form" onsubmit="realizarPago(event)">
            @csrf

            {{-- 1. CONTACTO --}}
            <section class="chk-section">
                <div class="chk-section-header">
                    <h2 class="chk-section-title">Contacto</h2>
                    <span style="font-size: 0.8rem; color: #64748b;">Sesión iniciada como <strong>{{ $user->nombre }}</strong></span>
                </div>
                <div class="chk-field-group">
                    <div class="chk-input-wrap">
                        <input
                            type="text"
                            id="email_contacto"
                            name="email_contacto"
                            class="chk-input"
                            placeholder="Email o número de teléfono móvil"
                            value="{{ $user->email ?: $user->movil }}"
                            required
                        >
                    </div>
                    <label class="chk-checkbox-label">
                        <input type="checkbox" name="noticias" class="chk-checkbox" checked>
                        <span>Enviarme novedades y ofertas por correo electrónico</span>
                    </label>
                </div>
            </section>

            {{-- 2. ENTREGA --}}
            <section class="chk-section">
                <div class="chk-section-header">
                    <h2 class="chk-section-title">Entrega</h2>
                </div>
                <div class="chk-field-group">
                    {{-- País --}}
                    <div>
                        <select name="pais" class="chk-select">
                            <option value="Colombia">Colombia</option>
                        </select>
                    </div>

                    {{-- Nombre y Apellidos --}}
                    <div class="chk-row-2">
                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            class="chk-input"
                            placeholder="Nombre"
                            value="{{ $user->nombre }}"
                            required
                        >
                        <input
                            type="text"
                            name="apellido"
                            id="apellido"
                            class="chk-input"
                            placeholder="Apellidos"
                            value="{{ $user->apellido }}"
                            required
                        >
                    </div>

                    {{-- Número de documento --}}
                    <div>
                        <input
                            type="text"
                            name="documento"
                            id="documento"
                            class="chk-input"
                            placeholder="Número de documento (Cédula de Ciudadanía)"
                            required
                        >
                    </div>

                    {{-- Dirección --}}
                    <div>
                        <input
                            type="text"
                            name="direccion"
                            id="direccion"
                            class="chk-input"
                            placeholder="Dirección (Calle, carrera, número de casa)"
                            required
                        >
                    </div>

                    {{-- Casa, apto, etc --}}
                    <div>
                        <input
                            type="text"
                            name="complemento"
                            id="complemento"
                            class="chk-input"
                            placeholder="Casa, apartamento, torre, etc. (opcional)"
                        >
                    </div>

                    {{-- Ciudad, Depto, Código Postal --}}
                    <div class="chk-row-3">
                        <input
                            type="text"
                            name="ciudad"
                            id="ciudad"
                            class="chk-input"
                            placeholder="Ciudad"
                            value="Neiva"
                            required
                        >
                        <select name="departamento" id="departamento" class="chk-select" required>
                            <option value="">Provincia / Estado</option>
                            @foreach($departamentos as $depto)
                                <option value="{{ $depto }}" {{ $depto === 'Huila' ? 'selected' : '' }}>
                                    {{ $depto }}
                                </option>
                            @endforeach
                        </select>
                        <input
                            type="text"
                            name="codigo_postal"
                            id="codigo_postal"
                            class="chk-input"
                            placeholder="Cód. postal"
                        >
                    </div>

                    {{-- Teléfono --}}
                    <div>
                        <input
                            type="text"
                            name="telefono"
                            id="telefono"
                            class="chk-input"
                            placeholder="Teléfono móvil de contacto"
                            value="{{ $user->movil }}"
                            required
                        >
                    </div>

                    <label class="chk-checkbox-label">
                        <input type="checkbox" name="guardar_datos" class="chk-checkbox" checked>
                        <span>Guardar mi información y consultar más rápidamente la próxima vez</span>
                    </label>
                </div>
            </section>

            {{-- 3. PAGO --}}
            <section class="chk-section">
                <div class="chk-section-header">
                    <div>
                        <h2 class="chk-section-title">Pago</h2>
                        <p style="font-size: 0.78rem; color: #64748b; margin-top: 2px;">Todas las transacciones son seguras y están encriptadas.</p>
                    </div>
                </div>

                <div class="chk-payment-box">

                    {{-- Opción 1: PSE / Addi --}}
                    <div class="chk-payment-option is-active" id="opt-pse">
                        <div class="chk-payment-head" onclick="seleccionarPago('pse')">
                            <label class="chk-payment-left">
                                <input type="radio" name="metodo_pago" value="pse" class="chk-radio" checked>
                                <span>Paga a Crédito o Débito con PSE</span>
                            </label>
                            <div class="chk-badges-wrap">
                                <span class="chk-badge-pill chk-badge--addi">Addi</span>
                                <span class="chk-badge-pill chk-badge--pse">PSE</span>
                            </div>
                        </div>
                        <div class="chk-payment-body">
                            <p>Se te conectará de forma protegida con la red <strong>PSE / Débito Bancario</strong> para completar tu compra al instante desde tu banco favorito.</p>
                        </div>
                    </div>

                    {{-- Opción 2: Wompi (Tarjetas) --}}
                    <div class="chk-payment-option" id="opt-wompi">
                        <div class="chk-payment-head" onclick="seleccionarPago('wompi')">
                            <label class="chk-payment-left">
                                <input type="radio" name="metodo_pago" value="wompi" class="chk-radio">
                                <span>Wompi (Tarjetas Crédito / Débito)</span>
                            </label>
                            <div class="chk-badges-wrap">
                                <span class="chk-badge-pill chk-badge--wompi">Visa</span>
                                <span class="chk-badge-pill chk-badge--wompi">Mastercard</span>
                                <span class="chk-badge-pill chk-badge--wompi">+3</span>
                            </div>
                        </div>
                        <div class="chk-payment-body">
                            <p>Aceptamos tarjetas Visa, Mastercard, American Express y Bancolombia con la pasarela segura de Wompi.</p>
                        </div>
                    </div>

                    {{-- Opción 3: Pago Contra Entrega --}}
                    <div class="chk-payment-option" id="opt-contraentrega">
                        <div class="chk-payment-head" onclick="seleccionarPago('contraentrega')">
                            <label class="chk-payment-left">
                                <input type="radio" name="metodo_pago" value="contraentrega" class="chk-radio">
                                <span>Pago contra entrega</span>
                            </label>
                            <div class="chk-badges-wrap">
                                <span class="chk-badge-pill chk-badge--cash">Efectivo</span>
                            </div>
                        </div>
                        <div class="chk-payment-body">
                            <p>Pagas en <strong>efectivo directamente al repartidor</strong> cuando recibas el paquete en tu domicilio.</p>
                        </div>
                    </div>

                    {{-- Opción 4: Transferencia / Nequi / Daviplata --}}
                    <div class="chk-payment-option" id="opt-transferencia">
                        <div class="chk-payment-head" onclick="seleccionarPago('transferencia')">
                            <label class="chk-payment-left">
                                <input type="radio" name="metodo_pago" value="transferencia" class="chk-radio">
                                <span>Transferencia Bancaria / Nequi / Daviplata</span>
                            </label>
                            <div class="chk-badges-wrap">
                                <span class="chk-badge-pill chk-badge--nequi">Nequi</span>
                                <span class="chk-badge-pill chk-badge--nequi">Daviplata</span>
                            </div>
                        </div>
                        <div class="chk-payment-body">
                            <p>Transfiere de inmediato a nuestras cuentas oficiales:
                               <br>• <strong>Nequi / Daviplata:</strong> <code>300 123 4567</code> (Almacén Europa)
                               <br>• <strong>Bancolombia Ahorros:</strong> <code>123-456789-00</code>
                            </p>
                        </div>
                    </div>

                </div>
            </section>

            {{-- 4. DIRECCIÓN DE FACTURACIÓN --}}
            <section class="chk-section">
                <div class="chk-section-header">
                    <h2 class="chk-section-title">Dirección de facturación</h2>
                </div>
                <div class="chk-billing-box">
                    <label class="chk-billing-item">
                        <input type="radio" name="billing_choice" value="same" class="chk-radio" checked>
                        <span>La misma dirección de envío</span>
                    </label>
                    <label class="chk-billing-item">
                        <input type="radio" name="billing_choice" value="different" class="chk-radio">
                        <span>Usar una dirección de facturación distinta</span>
                    </label>
                </div>
            </section>

            {{-- Botón Pagar Ahora --}}
            <button type="submit" class="chk-submit-btn" id="btn-submit-order">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="5" width="20" height="14" rx="2"/>
                    <line x1="2" y1="10" x2="22" y2="10"/>
                </svg>
                <span id="btn-submit-text">Pagar ahora</span>
            </button>

            {{-- Enlaces Institucionales Footer --}}
            <footer class="chk-footer-links">
                <a href="#">Política de reembolso</a>
                <a href="#">Envíos</a>
                <a href="#">Política de privacidad</a>
                <a href="#">Términos del servicio</a>
                <a href="#">Contacto</a>
            </footer>

        </form>

    </main>


    {{-- ══════════════════════════════════════════
         COLUMNA DERECHA: RESUMEN DE LA COMPRA
    ══════════════════════════════════════════ --}}
    <aside class="chk-sidebar">
        <div class="chk-summary-sticky">

            {{-- Lista de Productos en el Carrito --}}
            <div class="chk-items-list" id="chk-items-container">
                <!-- Se llena dinámicamente con JavaScript desde localStorage -->
            </div>

            {{-- Cupón de descuento --}}
            <div class="chk-coupon-wrap">
                <input
                    type="text"
                    id="input-cupon"
                    class="chk-input"
                    placeholder="Código de descuento o tarjeta de regalo"
                    onkeydown="if(event.key==='Enter'){event.preventDefault(); aplicarCupon();}"
                    autocomplete="off"
                >
                <button type="button" class="chk-coupon-btn" id="btn-cupon" onclick="aplicarCupon()">Aplicar</button>
            </div>
            <div id="cupon-feedback-msg" style="display: none;"></div>

            {{-- Desglose de Precios --}}
            <div class="chk-breakdown-row">
                <span>Subtotal</span>
                <strong id="chk-subtotal-val">$0</strong>
            </div>

            <div class="chk-breakdown-row" id="chk-descuento-row" style="display: none; color: #059669;">
                <span>Descuento <span id="chk-cupon-tag" style="background: #dcfce7; color: #166534; font-size: 0.72rem; padding: 2px 6px; border-radius: 4px; font-weight: 600; margin-left: 4px;"></span></span>
                <strong id="chk-descuento-val">-$0</strong>
            </div>

            <div class="chk-breakdown-row">
                <span>Envío <span title="Envío estándar a nivel nacional" style="cursor:help;">&#9432;</span></span>
                <span style="color: #059669; font-weight: 600;">Gratis</span>
            </div>

            <div class="chk-divider-breakdown"></div>

            {{-- Total Final --}}
            <div class="chk-total-row">
                <span class="chk-total-label">Total</span>
                <div class="chk-total-price-wrap">
                    <span class="chk-total-currency">COP</span>
                    <span class="chk-total-amount" id="chk-total-val">$0</span>
                    <div class="chk-tax-note">Incluye impuestos aplicables de ley</div>
                </div>
            </div>

        </div>
    </aside>

</div>

<script>
    // ── Clave sincronizada con la tienda ──
    const CART_STORAGE_KEY = 'europa_cart_items';
    let cart = [];
    try {
        const stored = localStorage.getItem(CART_STORAGE_KEY) || localStorage.getItem('almacen_europa_cart');
        if (stored) {
            cart = JSON.parse(stored);
        }
    } catch(e) {
        cart = [];
    }

    let cuponActivo = null;
    let descuentoMonto = 0;

    function renderSummary() {
        const container = document.getElementById('chk-items-container');
        const subtotalVal = document.getElementById('chk-subtotal-val');
        const totalVal = document.getElementById('chk-total-val');
        const btnText = document.getElementById('btn-submit-text');
        const btnOrder = document.getElementById('btn-submit-order');
        const rowDescuento = document.getElementById('chk-descuento-row');
        const valDescuento = document.getElementById('chk-descuento-val');

        if (!container) return;

        if (cart.length === 0) {
            container.innerHTML = `
                <div style="text-align: center; padding: 36px 16px; color: #64748b;">
                    <div style="width: 52px; height: 52px; margin: 0 auto 12px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </div>
                    <p style="font-weight: 700; font-size: 1rem; color: #1e293b; margin-bottom: 6px;">Tu carrito está vacío</p>
                    <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 14px;">No tienes productos seleccionados para comprar.</p>
                    <a href="{{ route('tienda') }}" style="display: inline-flex; align-items: center; gap: 6px; background: #1e3a8a; color: #ffffff; text-decoration: none; font-size: 0.82rem; font-weight: 600; padding: 9px 18px; border-radius: 8px;">
                        &larr; Volver a la tienda a agregar productos
                    </a>
                </div>
            `;
            subtotalVal.textContent = '$0';
            totalVal.textContent = '$0';
            if (rowDescuento) rowDescuento.style.display = 'none';
            if (btnOrder) btnOrder.disabled = true;
            if (btnText) btnText.textContent = 'Pagar ahora — $0';
            return;
        }

        if (btnOrder) btnOrder.disabled = false;

        let subtotal = 0;
        let html = '';

        cart.forEach(item => {
            const sub = item.precio * item.cantidad;
            subtotal += sub;

            html += `
                <div class="chk-item">
                    <div class="chk-item-thumb-wrap">
                        <img src="${item.imagen || '/img/placeholder.png'}" alt="${item.nombre}" class="chk-item-img" onerror="this.src='/img/placeholder.png'">
                        <span class="chk-item-qty">${item.cantidad}</span>
                    </div>
                    <div class="chk-item-info">
                        <div class="chk-item-title" title="${item.nombre}">${item.nombre}</div>
                        <div class="chk-item-meta">${item.categoria || 'Producto'} &bull; ${item.cantidad}x $${item.precio.toLocaleString('es-CO')}</div>
                    </div>
                    <div class="chk-item-price">
                        $${sub.toLocaleString('es-CO')}
                    </div>
                </div>
            `;
        });

        container.innerHTML = html;

        // Calcular descuento si hay cupón activo
        if (cuponActivo && cuponActivo.descuentoPorcentaje > 0) {
            descuentoMonto = Math.round(subtotal * cuponActivo.descuentoPorcentaje);
            if (rowDescuento) {
                rowDescuento.style.display = 'flex';
                document.getElementById('chk-cupon-tag').textContent = `${cuponActivo.codigo} (-${cuponActivo.descuentoPorcentaje * 100}%)`;
                valDescuento.textContent = '-$' + descuentoMonto.toLocaleString('es-CO');
            }
        } else {
            descuentoMonto = 0;
            if (rowDescuento) rowDescuento.style.display = 'none';
        }

        const totalFinal = Math.max(0, subtotal - descuentoMonto);

        subtotalVal.textContent = '$ ' + subtotal.toLocaleString('es-CO');
        totalVal.textContent = '$ ' + totalFinal.toLocaleString('es-CO');
        if (btnText) {
            btnText.textContent = 'Pagar ahora — $' + totalFinal.toLocaleString('es-CO');
        }
    }

    // ── Seleccionar Método de Pago (Acordeón) ──
    function seleccionarPago(metodo) {
        document.querySelectorAll('.chk-payment-option').forEach(el => {
            el.classList.remove('is-active');
            const radio = el.querySelector('input[type="radio"]');
            if (radio) radio.checked = false;
        });

        const target = document.getElementById('opt-' + metodo);
        if (target) {
            target.classList.add('is-active');
            const radio = target.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;
        }
    }

    // ── Cupones (Sin browser alerts, mensaje visual moderno) ──
    function aplicarCupon() {
        const inp = document.getElementById('input-cupon');
        const feedback = document.getElementById('cupon-feedback-msg');
        if (!inp || !feedback) return;

        const codigo = inp.value.trim().toUpperCase();

        if (!codigo) {
            feedback.style.display = 'flex';
            feedback.className = 'cupon-alert cupon-alert--warning';
            feedback.innerHTML = `
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>Por favor ingresa un código de cupón antes de aplicar.</span>
            `;
            inp.focus();
            return;
        }

        if (cart.length === 0) {
            feedback.style.display = 'flex';
            feedback.className = 'cupon-alert cupon-alert--warning';
            feedback.innerHTML = `
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>Primero agrega productos a tu carrito para aplicar un cupón.</span>
            `;
            return;
        }

        // Cupones promocionales válidos
        const cuponesValidos = {
            'EUROPA10': 0.10,
            'DESCUENTO10': 0.10,
            'BIENVENIDO': 0.10,
            'CLIENTE10': 0.10,
        };

        if (cuponesValidos[codigo]) {
            cuponActivo = {
                codigo: codigo,
                descuentoPorcentaje: cuponesValidos[codigo]
            };
            feedback.style.display = 'flex';
            feedback.className = 'cupon-alert cupon-alert--success';
            feedback.innerHTML = `
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span>¡Excelente! Cupón <strong>${codigo}</strong> aplicado (10% de descuento).</span>
            `;
            inp.disabled = true;
            const btnCupon = document.getElementById('btn-cupon');
            if (btnCupon) {
                btnCupon.textContent = 'Aplicado';
                btnCupon.disabled = true;
                btnCupon.style.background = '#059669';
            }
            renderSummary();
        } else {
            feedback.style.display = 'flex';
            feedback.className = 'cupon-alert cupon-alert--error';
            feedback.innerHTML = `
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                <span>El cupón <strong>"${codigo}"</strong> no es válido. Prueba con <code>EUROPA10</code>.</span>
            `;
        }
    }

    function mostrarBannerError(mensaje) {
        const banner = document.getElementById('chk-error-banner');
        if (!banner) {
            alert(mensaje);
            return;
        }
        banner.style.display = 'flex';
        banner.className = 'chk-toast-banner chk-toast-banner--error';
        banner.innerHTML = `
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            <div>${mensaje}</div>
        `;
        banner.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // ── Procesar Pago y Registrar Venta ──
    async function realizarPago(e) {
        e.preventDefault();

        if (cart.length === 0) {
            mostrarBannerError('Tu carrito está vacío. Agrega productos antes de pagar.');
            return;
        }

        const btn = document.getElementById('btn-submit-order');
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="animate-spin" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle>
                <path d="M12 2a10 10 0 0 1 10 10" stroke="#fff"></path>
            </svg>
            Procesando pedido de forma segura...
        `;

        const form = document.getElementById('chk-form');
        const formData = new FormData(form);

        const itemsPayload = cart.map(item => ({
            producto_id: item.id,
            cantidad: item.cantidad
        }));

        const payload = {
            items: itemsPayload,
            email_contacto: formData.get('email_contacto'),
            nombre: formData.get('nombre'),
            apellido: formData.get('apellido'),
            documento: formData.get('documento'),
            direccion: formData.get('direccion'),
            complemento: formData.get('complemento'),
            ciudad: formData.get('ciudad'),
            departamento: formData.get('departamento'),
            codigo_postal: formData.get('codigo_postal'),
            telefono: formData.get('telefono'),
            metodo_pago: formData.get('metodo_pago') || 'pse',
            cupon: cuponActivo ? cuponActivo.codigo : '',
        };

        try {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const res = await fetch("{{ route('checkout.process') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();

            if (res.ok && data.success) {
                // Limpiar ambos identificadores en localStorage
                localStorage.removeItem('europa_cart_items');
                localStorage.removeItem('almacen_europa_cart');
                // Redirigir a confirmación de pedido
                window.location.href = data.redirect_url;
            } else {
                mostrarBannerError(data.message || 'Error al procesar el pedido.');
                btn.disabled = false;
                renderSummary();
            }
        } catch (err) {
            mostrarBannerError('Error de conexión con el servidor. Intenta nuevamente.');
            btn.disabled = false;
            renderSummary();
        }
    }

    // Inicializar resumen al cargar
    document.addEventListener('DOMContentLoaded', renderSummary);
</script>

</body>
</html>
