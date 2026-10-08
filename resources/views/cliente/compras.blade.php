<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mis Compras & Facturas — Almacén Europa</title>

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800;900&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ══════════════════════════════════════════════════════
           VARIABLES & PALETA AZUL INSTITUCIONAL ALMACÉN EUROPA
        ══════════════════════════════════════════════════════ */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --font-display: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-body: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-mono: 'JetBrains Mono', monospace;

            /* Colores Institucionales de Almacén Europa */
            --clr-primary: #1e3a8a;
            --clr-primary-hover: #1d4ed8;
            --clr-primary-light: #eff6ff;
            --clr-accent: #0284c7;
            --clr-cyan: #06b6d4;
            --clr-cyan-light: #67e8f9;

            /* Tipografía & Fondos */
            --clr-text-main: #0f172a;
            --clr-text-muted: #64748b;
            --clr-bg: #f8fafc;
            --clr-card: #ffffff;
            --clr-border: #e2e8f0;
            --clr-border-subtle: #f1f5f9;

            /* Sombras suaves */
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 14px -2px rgba(15, 23, 42, 0.06);
            --shadow-lg: 0 12px 30px -4px rgba(15, 23, 42, 0.08);
            --shadow-xl: 0 20px 40px -6px rgba(15, 23, 42, 0.12);
        }

        body {
            font-family: var(--font-body);
            background-color: var(--clr-bg);
            color: var(--clr-text-main);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font-family: inherit;
            cursor: pointer;
            border: none;
            background: none;
            outline: none;
        }

        /* ══════════════════════════════════════════════════════
           NAVBAR (IDÉNTICA A LA TIENDA PRINCIPAL)
        ══════════════════════════════════════════════════════ */
        .tienda-nav {
            background: #ffffff;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 36px;
            border-bottom: 1px solid #f1f5f9;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .tienda-nav__logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        .tienda-nav__logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #1d4ed8, #0284c7);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(29, 78, 216, 0.25);
            flex-shrink: 0;
        }

        .tienda-nav__logo span strong {
            background: linear-gradient(135deg, #1e3a8a, #0284c7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .tienda-nav__center {
            display: flex;
            align-items: center;
        }

        .tienda-nav__back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            padding: 8px 18px;
            border-radius: 9999px;
            font-size: 0.86rem;
            font-weight: 700;
            font-family: var(--font-display);
            transition: all 0.18s ease;
        }

        .tienda-nav__back-link:hover {
            background: #dbeafe;
            color: #1e3a8a;
            border-color: #93c5fd;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(37, 99, 235, 0.15);
        }

        .tienda-nav__user-zone {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .tienda-nav__user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tienda-nav__avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #dbeafe;
            color: #1e40af;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-size: 0.95rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .tienda-nav__username {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1e293b;
            text-transform: capitalize;
        }

        .tienda-nav__btn-logout {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
        }

        .tienda-nav__btn-logout:hover {
            background: #fee2e2;
            color: #dc2626;
            transform: scale(1.05);
        }

        /* ══════════════════════════════════════════════════════
           HERO SECTION: AZUL INSTITUCIONAL ALMACÉN EUROPA
           linear-gradient(135deg, #09215c 0%, #113a96 40%, #1952cb 75%, #0284c7 100%)
        ══════════════════════════════════════════════════════ */
        .tienda-hero {
            background: linear-gradient(135deg, #09215c 0%, #113a96 40%, #1952cb 75%, #0284c7 100%);
            padding: 50px 40px 60px;
            position: relative;
            color: #ffffff;
            box-shadow: inset 0 -1px 0 rgba(255, 255, 255, 0.1);
        }

        .tienda-hero__container {
            max-width: 1240px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .tienda-hero__top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .tienda-hero__tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(8px);
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 0.78rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 14px;
        }

        .tienda-hero__tag-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 8px #22c55e;
        }

        .tienda-hero__title {
            font-family: var(--font-display);
            font-size: 2.5rem;
            font-weight: 900;
            line-height: 1.15;
            letter-spacing: -0.03em;
            margin-bottom: 8px;
            color: #ffffff;
        }

        .tienda-hero__title-accent {
            color: #67e8f9;
        }

        .tienda-hero__subtitle {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.88);
            line-height: 1.5;
            max-width: 620px;
        }

        .tienda-hero__subtitle strong {
            color: #ffffff;
        }

        /* Stats Rápidas en Vidrio Pulido */
        .tienda-hero__stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 16px;
            width: 100%;
        }

        .tienda-stat-card {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-radius: 18px;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            color: #ffffff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease;
        }

        .tienda-stat-card:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(255, 255, 255, 0.35);
        }

        .tienda-stat-icon-wrap {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.16);
            color: #ffffff;
            flex-shrink: 0;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .tienda-stat-content {
            display: flex;
            flex-direction: column;
        }

        .tienda-stat-lbl {
            font-size: 0.74rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.05em;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2px;
        }

        .tienda-stat-val {
            font-family: var(--font-display);
            font-size: 1.65rem;
            font-weight: 800;
            line-height: 1.1;
            color: #ffffff;
            letter-spacing: -0.02em;
        }

        .tienda-stat-sub {
            font-size: 0.76rem;
            color: rgba(255, 255, 255, 0.75);
            margin-top: 3px;
        }

        /* ══════════════════════════════════════════════════════
           BARRA DE BÚSQUEDA Y FILTROS SEGMENTADOS
        ══════════════════════════════════════════════════════ */
        .cp-main {
            max-width: 1240px;
            margin: -24px auto 60px;
            padding: 0 24px;
            width: 100%;
            position: relative;
            z-index: 10;
        }

        .cp-filters-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 16px 20px;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.08);
            border: 1px solid var(--clr-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 26px;
        }

        .cp-search-form {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            min-width: 280px;
            max-width: 580px;
        }

        .cp-search-wrap {
            position: relative;
            flex: 1;
        }

        .cp-search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        .cp-search-input {
            width: 100%;
            background: #f8fafc;
            border: 1.5px solid var(--clr-border);
            border-radius: 12px;
            padding: 11px 16px 11px 40px;
            font-size: 0.88rem;
            font-family: var(--font-body);
            color: var(--clr-text-main);
            outline: none;
            transition: all 0.2s ease;
        }

        .cp-search-input:focus {
            background: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .cp-search-input::placeholder {
            color: #94a3b8;
        }

        .cp-btn-search {
            background: linear-gradient(135deg, #1d4ed8, #0284c7);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.86rem;
            padding: 11px 20px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(29, 78, 216, 0.25);
            transition: all 0.15s ease;
            white-space: nowrap;
        }

        .cp-btn-search:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(29, 78, 216, 0.35);
        }

        .cp-btn-clear {
            font-size: 0.82rem;
            font-weight: 600;
            color: #ef4444;
            padding: 9px 12px;
            border-radius: 10px;
            background: #fef2f2;
            transition: all 0.15s ease;
        }

        .cp-btn-clear:hover {
            background: #fee2e2;
        }

        /* Chips de estado segmentados */
        .cp-status-pills {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .cp-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 9999px;
            font-size: 0.84rem;
            font-weight: 600;
            background: #f8fafc;
            color: #475569;
            border: 1px solid var(--clr-border);
            transition: all 0.15s ease;
        }

        .cp-pill:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .cp-pill.active {
            background: #1e3a8a;
            color: #ffffff;
            border-color: #1e3a8a;
            box-shadow: 0 2px 8px rgba(30, 58, 138, 0.25);
        }

        .cp-pill-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
        }

        /* ══════════════════════════════════════════════════════
           TARJETAS DE COMPRA (PREMIUM ORDER CARD)
        ══════════════════════════════════════════════════════ */
        .cp-orders-list {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .cp-order-card {
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid var(--clr-border);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .cp-order-card:hover {
            box-shadow: var(--shadow-xl);
            border-color: #bfdbfe;
            transform: translateY(-2px);
        }

        /* Cabecera de la tarjeta */
        .cp-card-header {
            padding: 16px 24px;
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .cp-card-header__left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .cp-order-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            padding: 5px 12px;
            border-radius: 8px;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 0.94rem;
        }

        .cp-fac-pill {
            font-family: var(--font-mono);
            font-size: 0.8rem;
            font-weight: 600;
            background: #f8fafc;
            color: #475569;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .cp-order-datetime {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.82rem;
            color: var(--clr-text-muted);
        }

        /* Badges de estado */
        .cp-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 13px;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .cp-status-pill--pagado {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .cp-status-pill--pendiente {
            background: #fffbeb;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .cp-status-pill--entregado {
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .cp-status-pill-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
        }

        .cp-status-pill--pagado .cp-status-pill-dot {
            background: #10b981;
            box-shadow: 0 0 6px #10b981;
        }

        .cp-status-pill--pendiente .cp-status-pill-dot {
            background: #f59e0b;
        }

        .cp-status-pill--entregado .cp-status-pill-dot {
            background: #3b82f6;
        }

        /* Cuerpo principal: 2 columnas limpias */
        .cp-card-body {
            padding: 22px 24px;
            display: grid;
            grid-template-columns: 330px 1fr;
            gap: 24px;
            background: #ffffff;
        }

        @media (max-width: 900px) {
            .cp-card-body {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        /* Columna 1: Entrega y Pago */
        .cp-delivery-box {
            background: #f8fafc;
            border: 1px solid var(--clr-border);
            border-radius: 14px;
            padding: 18px 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .cp-box-title {
            font-size: 0.78rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.05em;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 2px;
        }

        .cp-info-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.85rem;
        }

        .cp-info-icon {
            color: #2563eb;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .cp-info-texts {
            display: flex;
            flex-direction: column;
            line-height: 1.35;
        }

        .cp-info-label {
            font-size: 0.72rem;
            color: #94a3b8;
            font-weight: 600;
            text-transform: uppercase;
        }

        .cp-info-val {
            font-weight: 600;
            color: #0f172a;
            word-break: break-word;
        }

        .cp-method-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            padding: 3px 9px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-top: 2px;
            width: fit-content;
        }

        /* Columna 2: Lista de Productos */
        .cp-items-box {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .cp-items-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cp-items-header-title {
            font-size: 0.78rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.05em;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .cp-items-count-badge {
            font-size: 0.75rem;
            font-weight: 700;
            background: #eff6ff;
            color: #1d4ed8;
            padding: 2px 8px;
            border-radius: 9999px;
        }

        .cp-product-rows {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .cp-product-row {
            background: #ffffff;
            border: 1px solid var(--clr-border);
            border-radius: 12px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            transition: all 0.15s ease;
        }

        .cp-product-row:hover {
            border-color: #cbd5e1;
            background: #fafafa;
        }

        .cp-product-row__info {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
            flex: 1;
        }

        .cp-product-row__icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #eff6ff;
            color: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cp-product-row__titles {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .cp-product-row__name {
            font-weight: 700;
            font-size: 0.88rem;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cp-product-row__meta {
            font-size: 0.75rem;
            color: var(--clr-text-muted);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 2px;
        }

        .cp-product-row__cat-badge {
            background: #f1f5f9;
            color: #475569;
            padding: 1px 7px;
            border-radius: 4px;
            font-weight: 600;
        }

        .cp-product-row__pricing {
            text-align: right;
            flex-shrink: 0;
        }

        .cp-product-row__subtotal {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 0.95rem;
            color: #0f172a;
        }

        .cp-product-row__unit {
            font-size: 0.74rem;
            color: #94a3b8;
            margin-top: 1px;
        }

        /* Footer con Total y Acciones */
        .cp-card-footer {
            padding: 18px 24px;
            background: #f8fafc;
            border-top: 1px solid var(--clr-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .cp-total-zone {
            display: flex;
            flex-direction: column;
        }

        .cp-total-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.05em;
            color: #64748b;
        }

        .cp-total-number {
            font-family: var(--font-display);
            font-size: 1.55rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .cp-actions-zone {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .cp-btn-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 12px;
            font-size: 0.86rem;
            font-weight: 700;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Botón Ver Factura POS */
        .cp-btn-action--outline {
            background: #ffffff;
            color: #1e3a8a;
            border: 1.5px solid #bfdbfe;
            box-shadow: var(--shadow-sm);
        }

        .cp-btn-action--outline:hover {
            background: #eff6ff;
            border-color: #2563eb;
            color: #1d4ed8;
            transform: translateY(-1px);
        }

        /* Botón Imprimir Factura POS */
        .cp-btn-action--filled {
            background: linear-gradient(135deg, #1d4ed8, #0284c7);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.28);
        }

        .cp-btn-action--filled:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(29, 78, 216, 0.38);
        }

        /* ══════════════════════════════════════════════════════
           ESTADO VACÍO (EMPTY STATE)
        ══════════════════════════════════════════════════════ */
        .cp-empty-state {
            background: #ffffff;
            border-radius: 20px;
            padding: 60px 32px;
            text-align: center;
            border: 1px solid var(--clr-border);
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 580px;
            margin: 20px auto 40px;
        }

        .cp-empty-icon {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: #eff6ff;
            color: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .cp-empty-title {
            font-family: var(--font-display);
            font-size: 1.45rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .cp-empty-desc {
            font-size: 0.9rem;
            color: var(--clr-text-muted);
            line-height: 1.5;
            margin-bottom: 24px;
        }

        .cp-btn-tienda {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #1d4ed8, #0284c7);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 12px 24px;
            border-radius: 9999px;
            box-shadow: 0 4px 14px rgba(29, 78, 216, 0.28);
            transition: all 0.2s ease;
        }

        .cp-btn-tienda:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(29, 78, 216, 0.35);
        }

        /* ══════════════════════════════════════════════════════
           MODAL DE FACTURA POS (TIRILLA TÉRMICA)
        ══════════════════════════════════════════════════════ */
        .cp-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 99999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .cp-modal-backdrop.is-open {
            display: flex;
            opacity: 1;
        }

        .cp-modal {
            background: #ffffff;
            width: 100%;
            max-width: 480px;
            max-height: 92vh;
            display: flex;
            flex-direction: column;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(15, 23, 42, 0.35);
            overflow: hidden;
            animation: modalSlideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes modalSlideUp {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(12px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .cp-modal-header {
            padding: 16px 20px;
            background: #ffffff;
            border-bottom: 1px solid var(--clr-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cp-modal-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 800;
            color: #0f172a;
        }

        .cp-modal-close {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            background: #f1f5f9;
            font-size: 1.2rem;
            transition: all 0.15s ease;
        }

        .cp-modal-close:hover {
            background: #fee2e2;
            color: #ef4444;
        }

        .cp-modal-body {
            padding: 20px;
            background: #e2e8f0;
            overflow-y: auto;
            display: flex;
            justify-content: center;
        }

        /* Tirilla POS Render */
        .pos-modal-ticket {
            width: 100%;
            max-width: 360px;
            background: #ffffff;
            padding: 24px 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12.5px;
            line-height: 1.35;
            color: #000000;
            border-radius: 4px;
        }

        .pos-modal-ticket .pos-top-line {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            margin-bottom: 12px;
        }

        .pos-modal-ticket .pos-header {
            text-align: center;
            margin-bottom: 14px;
        }

        .pos-modal-ticket .pos-store-name {
            font-size: 16px;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 2px;
            letter-spacing: 0.02em;
        }

        .pos-modal-ticket .pos-store-info {
            font-size: 11.5px;
            line-height: 1.3;
            text-transform: uppercase;
        }

        .pos-modal-ticket .pos-doc-title {
            margin-top: 10px;
            font-size: 13.5px;
            font-weight: 800;
        }

        .pos-modal-ticket .pos-regimen {
            font-size: 11.5px;
            font-weight: 700;
        }

        .pos-modal-ticket .pos-date {
            font-size: 11.5px;
            margin-top: 2px;
        }

        .pos-modal-ticket .pos-client-info {
            font-size: 12.5px;
            line-height: 1.36;
            margin-bottom: 12px;
        }

        .pos-modal-ticket .pos-client-row {
            display: flex;
        }

        .pos-modal-ticket .pos-client-lbl {
            width: 90px;
            flex-shrink: 0;
            font-weight: 400;
        }

        .pos-modal-ticket .pos-client-val {
            font-weight: 700;
        }

        .pos-modal-ticket .pos-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .pos-modal-ticket .pos-table th {
            padding: 4px 2px;
            font-weight: 800;
        }

        .pos-modal-ticket .pos-table th.col-art { text-align: left; width: 48%; }
        .pos-modal-ticket .pos-table th.col-pre { text-align: right; width: 24%; }
        .pos-modal-ticket .pos-table th.col-cant { text-align: center; width: 14%; }
        .pos-modal-ticket .pos-table th.col-desc { text-align: right; width: 14%; }

        .pos-modal-ticket .pos-table td {
            padding: 4px 2px;
            vertical-align: top;
        }

        .pos-modal-ticket .pos-table td.col-art {
            text-align: left;
            font-weight: 700;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .pos-modal-ticket .pos-table td.col-pre { text-align: right; white-space: nowrap; }
        .pos-modal-ticket .pos-table td.col-cant { text-align: center; }
        .pos-modal-ticket .pos-table td.col-desc { text-align: right; }

        .pos-modal-ticket .pos-thick-line {
            border: none;
            border-bottom: 2px solid #000;
            margin: 6px 0 8px;
        }

        .pos-modal-ticket .pos-totals-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12.5px;
            margin-bottom: 10px;
        }

        .pos-modal-ticket .pos-totals-table td { padding: 2px 2px; }
        .pos-modal-ticket .pos-totals-table .pos-tot-lbl { text-align: right; padding-right: 12px; width: 60%; }
        .pos-modal-ticket .pos-totals-table .pos-tot-val { text-align: right; font-weight: 700; width: 40%; white-space: nowrap; }
        .pos-modal-ticket .pos-total-highlight { font-size: 13.5px; font-weight: 900; }

        .pos-modal-ticket .pos-payment-block { margin-top: 6px; }
        .pos-modal-ticket .pos-pay-row { display: flex; justify-content: flex-end; gap: 14px; font-size: 12.5px; margin-bottom: 3px; }
        .pos-modal-ticket .pos-pay-lbl { font-weight: 400; }
        .pos-modal-ticket .pos-pay-val { font-weight: 700; min-width: 85px; text-align: right; }

        .pos-modal-ticket .pos-dashed-line {
            border: none;
            border-bottom: 1px dashed #000;
            margin: 8px 0;
        }

        .pos-modal-ticket .pos-loyalty { font-size: 11.5px; line-height: 1.4; margin-bottom: 6px; }
        .pos-modal-ticket .pos-custom-text { text-align: center; font-size: 11.5px; line-height: 1.35; margin: 8px 0; }
        .pos-modal-ticket .pos-footer-credits { text-align: center; font-size: 10.5px; line-height: 1.35; margin-top: 4px; }

        .cp-modal-footer {
            padding: 14px 20px;
            background: #ffffff;
            border-top: 1px solid var(--clr-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* ══════════════════════════════════════════════════════
           FOOTER GENERAL
        ══════════════════════════════════════════════════════ */
        .cp-footer {
            background: #ffffff;
            border-top: 1px solid var(--clr-border);
            padding: 28px 32px;
            text-align: center;
            font-size: 0.82rem;
            color: var(--clr-text-muted);
            margin-top: auto;
        }

        .cp-footer strong {
            color: #0f172a;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <!-- ══════════════════════════════════════════════════════
         NAVBAR SUPERIOR
    ══════════════════════════════════════════════════════ -->
    <header class="tienda-nav">
        <a href="{{ route('tienda') }}" class="tienda-nav__logo">
            <div class="tienda-nav__logo-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="3" width="20" height="14" rx="3" fill="white" fill-opacity="0.25" stroke="white" stroke-width="1.8"/>
                    <path d="M7 9h10M7 12h6" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M8 17v4M16 17v4M5 21h14" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>
            <span>Almacén<strong>Europa</strong></span>
        </a>

        <div class="tienda-nav__center">
            <a href="{{ route('tienda') }}" class="tienda-nav__back-link">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Volver a la Tienda</span>
            </a>
        </div>

        <div class="tienda-nav__user-zone">
            <div class="tienda-nav__user-chip">
                <div class="tienda-nav__avatar">
                    {{ strtoupper(substr($user->nombre ?? 'C', 0, 1)) }}
                </div>
                <span class="tienda-nav__username">{{ strtolower($user->nombre ?? 'Cliente') }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="tienda-nav__btn-logout" title="Cerrar sesión">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                </button>
            </form>
        </div>
    </header>

    <!-- ══════════════════════════════════════════════════════
         HERO SECTION: AZUL INSTITUCIONAL ALMACÉN EUROPA
    ══════════════════════════════════════════════════════ -->
    <section class="tienda-hero">
        <div class="tienda-hero__container">
            <div class="tienda-hero__top">
                <div>
                    <div class="tienda-hero__tag">
                        <span class="tienda-hero__tag-dot"></span>
                        Módulo de Compras del Cliente — Almacén Europa
                    </div>

                    <h1 class="tienda-hero__title">
                        Mis Compras &amp; <span class="tienda-hero__title-accent">Facturas</span>
                    </h1>

                    <p class="tienda-hero__subtitle">
                        Hola <strong>{{ $user->nombre }}</strong>, aquí encuentras el registro de todas tus compras, copia de tus facturas y el estado de tus pedidos.
                    </p>
                </div>
            </div>

            <!-- Stats Rápidas en Vidrio Pulido -->
            <div class="tienda-hero__stats">
                <!-- Card 1: Total Pedidos -->
                <div class="tienda-stat-card">
                    <div class="tienda-stat-icon-wrap">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </div>
                    <div class="tienda-stat-content">
                        <span class="tienda-stat-lbl">Total Pedidos</span>
                        <span class="tienda-stat-val">{{ $totalCompras }}</span>
                        <span class="tienda-stat-sub">{{ $totalCompras === 1 ? '1 compra efectuada' : $totalCompras . ' compras efectuadas' }}</span>
                    </div>
                </div>

                <!-- Card 2: Inversión Total -->
                <div class="tienda-stat-card">
                    <div class="tienda-stat-icon-wrap">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                        </svg>
                    </div>
                    <div class="tienda-stat-content">
                        <span class="tienda-stat-lbl">Inversión Total</span>
                        <span class="tienda-stat-val">${{ number_format($gastoTotal, 0, ',', '.') }}</span>
                        <span class="tienda-stat-sub">Acumulado en compras</span>
                    </div>
                </div>

                <!-- Card 3: Último Pedido -->
                <div class="tienda-stat-card">
                    <div class="tienda-stat-icon-wrap">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div class="tienda-stat-content">
                        <span class="tienda-stat-lbl">Último Pedido</span>
                        <span class="tienda-stat-val" style="font-size: 1.25rem;">
                            {{ $ultimaCompra ? $ultimaCompra->fecha_formateada : 'Ninguno' }}
                        </span>
                        <span class="tienda-stat-sub">{{ $ultimaCompra ? $ultimaCompra->numero_venta : 'Sin registros' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════════════════════
         CONTENIDO PRINCIPAL
    ══════════════════════════════════════════════════════ -->
    <main class="cp-main">

        <!-- Barra de Búsqueda y Chips de Estado -->
        <div class="cp-filters-card">
            <form action="{{ route('cliente.compras') }}" method="GET" class="cp-search-form">
                @if($estado)
                    <input type="hidden" name="estado" value="{{ $estado }}">
                @endif
                <div class="cp-search-wrap">
                    <svg class="cp-search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        class="cp-search-input"
                        placeholder="Buscar por # de pedido, factura o producto..."
                        value="{{ $search }}"
                    >
                </div>
                <button type="submit" class="cp-btn-search">
                    Buscar
                </button>
                @if($search || $estado)
                    <a href="{{ route('cliente.compras') }}" class="cp-btn-clear">Limpiar</a>
                @endif
            </form>

            <!-- Segmented Pills -->
            <div class="cp-status-pills">
                <a href="{{ route('cliente.compras', array_filter(['search' => $search])) }}"
                   class="cp-pill {{ empty($estado) ? 'active' : '' }}">
                    Todos ({{ $totalCompras }})
                </a>
                <a href="{{ route('cliente.compras', array_filter(['estado' => 'pagado', 'search' => $search])) }}"
                   class="cp-pill {{ $estado === 'pagado' ? 'active' : '' }}">
                    <span class="cp-pill-dot" style="background:#10b981;"></span>
                    Pagados
                </a>
                <a href="{{ route('cliente.compras', array_filter(['estado' => 'pendiente_entrega', 'search' => $search])) }}"
                   class="cp-pill {{ $estado === 'pendiente_entrega' ? 'active' : '' }}">
                    <span class="cp-pill-dot" style="background:#f59e0b;"></span>
                    Contra Entrega
                </a>
                <a href="{{ route('cliente.compras', array_filter(['estado' => 'completado', 'search' => $search])) }}"
                   class="cp-pill {{ $estado === 'completado' ? 'active' : '' }}">
                    <span class="cp-pill-dot" style="background:#0284c7;"></span>
                    Entregados
                </a>
            </div>
        </div>

        <!-- Listado de Compras -->
        @if($compras->isEmpty())
            <div class="cp-empty-state">
                <div class="cp-empty-icon">
                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </div>
                <h3 class="cp-empty-title">
                    @if($search || $estado)
                        No hay pedidos con esos criterios
                    @else
                        Aún no tienes compras realizadas
                    @endif
                </h3>
                <p class="cp-empty-desc">
                    @if($search || $estado)
                        Intenta con otra palabra clave o limpia los filtros para ver todos tus pedidos.
                    @else
                        ¡Visita nuestro catálogo en línea y descubre nuestras promociones y productos de alta calidad!
                    @endif
                </p>
                <a href="{{ route('tienda') }}" class="cp-btn-tienda">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                    </svg>
                    <span>Ir al Catálogo de Productos</span>
                </a>
            </div>
        @else
            <div class="cp-orders-list">
                @foreach($compras as $compra)
                    <article class="cp-order-card" id="pedido-{{ $compra->ventas }}">
                        <!-- Header de la compra -->
                        <div class="cp-card-header">
                            <div class="cp-card-header__left">
                                <span class="cp-order-badge">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                    Pedido {{ $compra->numero_venta }}
                                </span>

                                <span class="cp-fac-pill" title="Factura Oficial">
                                    {{ $compra->numero_factura }}
                                </span>

                                <span class="cp-order-datetime">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    {{ $compra->fecha_formateada }} a las {{ $compra->hora_formateada }}
                                </span>
                            </div>

                            <div>
                                @php
                                    $pillClass = match($compra->estado) {
                                        'pagado' => 'cp-status-pill--pagado',
                                        'pendiente_entrega' => 'cp-status-pill--pendiente',
                                        default => 'cp-status-pill--entregado'
                                    };
                                @endphp
                                <span class="cp-status-pill {{ $pillClass }}">
                                    <span class="cp-status-pill-dot"></span>
                                    {{ $compra->estado_etiqueta }}
                                </span>
                            </div>
                        </div>

                        <!-- Cuerpo de la compra (2 columnas equilibradas) -->
                        <div class="cp-card-body">
                            <!-- Columna 1: Información de Entrega & Pago -->
                            <div class="cp-delivery-box">
                                <div class="cp-box-title">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="1" y="3" width="15" height="13" rx="1"></rect>
                                        <path d="M16 8h4l3 5v3h-7V8z"></path>
                                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                    </svg>
                                    <span>Entrega &amp; Destinatario</span>
                                </div>

                                <div class="cp-info-item">
                                    <div class="cp-info-icon">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </div>
                                    <div class="cp-info-texts">
                                        <span class="cp-info-label">Destinatario</span>
                                        <span class="cp-info-val">{{ $compra->usuarioObj->nombre ?? 'Cliente' }} {{ $compra->usuarioObj->apellido ?? '' }}</span>
                                    </div>
                                </div>

                                <div class="cp-info-item">
                                    <div class="cp-info-icon">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                    </div>
                                    <div class="cp-info-texts">
                                        <span class="cp-info-label">Dirección de Entrega</span>
                                        <span class="cp-info-val">{{ $compra->direccion_envio ?: 'Dirección principal registrada' }}</span>
                                        <span style="font-size: 0.78rem; color: #64748b; margin-top: 1px;">
                                            {{ $compra->ciudad ? ($compra->ciudad . ', ' . $compra->departamento) : 'Neiva, Huila' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="cp-info-item">
                                    <div class="cp-info-icon">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                    </div>
                                    <div class="cp-info-texts">
                                        <span class="cp-info-label">Teléfono de Contacto</span>
                                        <span class="cp-info-val">{{ $compra->telefono ?: ($compra->usuarioObj->movil ?? '—') }}</span>
                                    </div>
                                </div>

                                <div class="cp-info-item">
                                    <div class="cp-info-icon">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                            <line x1="2" y1="10" x2="22" y2="10"></line>
                                        </svg>
                                    </div>
                                    <div class="cp-info-texts">
                                        <span class="cp-info-label">Método de Pago</span>
                                        <div class="cp-method-tag">
                                            {{ $compra->metodo_pago }}
                                        </div>
                                    </div>
                                </div>

                                @if($compra->notas)
                                    <div class="cp-info-item">
                                        <div class="cp-info-icon">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                            </svg>
                                        </div>
                                        <div class="cp-info-texts">
                                            <span class="cp-info-label">Nota / Cupón</span>
                                            <span style="font-size: 0.8rem; color: #475569;">{{ $compra->notas }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Columna 2: Productos Comprados -->
                            <div class="cp-items-box">
                                <div class="cp-items-header">
                                    <div class="cp-items-header-title">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                        </svg>
                                        <span>Artículos del Pedido</span>
                                    </div>
                                    <span class="cp-items-count-badge">
                                        {{ $compra->detalles->sum('cantidad') }} {{ $compra->detalles->sum('cantidad') === 1 ? 'unidad' : 'unidades' }}
                                    </span>
                                </div>

                                <div class="cp-product-rows">
                                    @foreach($compra->detalles as $det)
                                        @php
                                            $sub = $det->cantidad * $det->precio;
                                        @endphp
                                        <div class="cp-product-row">
                                            <div class="cp-product-row__info">
                                                <div class="cp-product-row__icon">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                    </svg>
                                                </div>
                                                <div class="cp-product-row__titles">
                                                    <span class="cp-product-row__name">{{ $det->productoObj->nombre ?? 'Producto Almacén Europa' }}</span>
                                                    <div class="cp-product-row__meta">
                                                        <span class="cp-product-row__cat-badge">{{ $det->productoObj->categoriaObj->nombre ?? 'General' }}</span>
                                                        <span>·</span>
                                                        <strong style="color: #1d4ed8;">{{ $det->cantidad }} {{ $det->cantidad === 1 ? 'ud' : 'uds' }}</strong>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="cp-product-row__pricing">
                                                <div class="cp-product-row__subtotal">${{ number_format($sub, 0, ',', '.') }}</div>
                                                <div class="cp-product-row__unit">${{ number_format($det->precio, 0, ',', '.') }} c/u</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Footer de la tarjeta con Total y Acciones -->
                        <div class="cp-card-footer">
                            <div class="cp-total-zone">
                                <span class="cp-total-label">Total Cancelado</span>
                                <span class="cp-total-number">${{ number_format($compra->total, 0, ',', '.') }}</span>
                            </div>

                            <div class="cp-actions-zone">
                                <!-- Botón Ver Factura POS -->
                                <button type="button" class="cp-btn-action cp-btn-action--outline" onclick="verFacturaPos({{ $compra->ventas }})" title="Ver tirilla POS en ventana emergente">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                    </svg>
                                    <span>Ver Factura POS</span>
                                </button>

                                <!-- Botón Imprimir Factura POS -->
                                <button type="button" class="cp-btn-action cp-btn-action--filled" onclick="imprimirFacturaPosDirecto({{ $compra->ventas }})" title="Imprimir tirilla térmica directamente">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                        <rect x="6" y="14" width="12" height="8"></rect>
                                    </svg>
                                    <span>Imprimir Factura POS</span>
                                </button>
                            </div>
                        </div>
                    </article>
                @endforeach

                <!-- Paginación con estilo integrado -->
                <div style="margin-top: 16px;">
                    {{ $compras->links() }}
                </div>
            </div>
        @endif

    </main>

    <!-- ══════════════════════════════════════════════════════
         MODAL DE FACTURA POS (TIRILLA TÉRMICA)
    ══════════════════════════════════════════════════════ -->
    <div class="cp-modal-backdrop" id="modal-detalle-compra" onclick="cerrarModalClickFuera(event)">
        <div class="cp-modal" onclick="event.stopPropagation()">
            <div class="cp-modal-header">
                <div class="cp-modal-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                    <span id="md-titulo">Factura POS</span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <button type="button" class="cp-btn-action cp-btn-action--filled" onclick="imprimirTicketActual()" style="padding: 7px 14px; font-size: 0.82rem;">
                        &#128438; Imprimir
                    </button>
                    <button type="button" class="cp-modal-close" onclick="cerrarModalDetalle()" aria-label="Cerrar modal">
                        &times;
                    </button>
                </div>
            </div>

            <!-- Cuerpo del Modal: Tirilla POS idéntica al formato físico 80mm -->
            <div class="cp-modal-body">
                <div id="ticket-pos-render" class="pos-modal-ticket">
                    <div style="text-align: center; padding: 40px; color: #64748b;">
                        Cargando factura POS...
                    </div>
                </div>
            </div>

            <div class="cp-modal-footer">
                <button type="button" class="cp-btn-action cp-btn-action--outline" onclick="cerrarModalDetalle()">
                    Cerrar
                </button>

                <button type="button" class="cp-btn-action cp-btn-action--filled" onclick="imprimirTicketActual()">
                    &#128438; Imprimir Factura POS
                </button>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════════════════
         FOOTER
    ══════════════════════════════════════════════════════ -->
    <footer class="cp-footer">
        <p>&copy; {{ date('Y') }} <strong>Almacén Europa S.A.S.</strong> · Sistema POS y Control Comercial.</p>
        <p style="margin-top: 4px; color: #94a3b8;">Todos los derechos reservados. Neiva – Huila, Colombia.</p>
    </footer>

    <!-- ══════════════════════════════════════════════════════
         SCRIPTS INTERACTIVOS (FACTURA POS EN PÁGINA)
    ══════════════════════════════════════════════════════ -->
    <script>
        const modalBackdrop = document.getElementById('modal-detalle-compra');
        const mdTitulo = document.getElementById('md-titulo');
        const ticketRender = document.getElementById('ticket-pos-render');

        function escapeHtml(str) {
            if (str === null || str === undefined) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function verFacturaPos(ventaId, autoPrint = false) {
            if (!modalBackdrop || !ticketRender) return;

            modalBackdrop.classList.add('is-open');
            ticketRender.innerHTML = '<div style="text-align: center; padding: 40px; color: #64748b;">' +
                '<div style="display: inline-block; width: 32px; height: 32px; border: 3px solid #cbd5e1; border-top-color: #1d4ed8; border-radius: 50%; animation: spin 0.8s linear infinite;"></div>' +
                '<p style="margin-top: 12px; font-weight: 600;">Generando Factura POS...</p>' +
                '</div>';

            fetch('/mis-compras/' + encodeURIComponent(ventaId))
                .then(function(res) {
                    if (!res.ok) throw new Error('Error al cargar factura: ' + res.status);
                    return res.json();
                })
                .then(function(data) {
                    if (!data.success) {
                        ticketRender.innerHTML = '<div style="color: #ef4444; padding: 20px; text-align: center; font-weight: 600;">No fue posible cargar la factura POS.</div>';
                        return;
                    }

                    if (mdTitulo) {
                        mdTitulo.textContent = 'Factura POS Nro. ' + data.consecutivo_pos;
                    }

                    var itemsHtml = '';
                    if (data.detalles && data.detalles.length > 0) {
                        for (var i = 0; i < data.detalles.length; i++) {
                            var d = data.detalles[i];
                            itemsHtml += '<tr>' +
                                '<td class="col-art">' + escapeHtml(d.producto_nombre) + '</td>' +
                                '<td class="col-pre">' + escapeHtml(d.precio_formateado) + '</td>' +
                                '<td class="col-cant">' + escapeHtml(String(d.cantidad)) + '</td>' +
                                '<td class="col-desc">' + (data.descuento !== '$0' ? '10' : '0') + '</td>' +
                                '</tr>';
                        }
                    }

                    var html = '';
                    html += '<div class="pos-top-line">';
                    html += '  <span>' + escapeHtml(data.fecha) + '</span>';
                    html += '  <span>ALMACÉN EUROPA -- POS Colombia</span>';
                    html += '</div>';

                    html += '<div class="pos-header">';
                    html += '  <div class="pos-store-name">ALMACÉN EUROPA</div>';
                    html += '  <div class="pos-store-info">NIT: 901234567-8</div>';
                    html += '  <div class="pos-store-info">CRA. 5 # 12-34 BRR. CENTRO</div>';
                    html += '  <div class="pos-store-info">NEIVA - HUILA · TEL: 300 123 4567</div>';
                    html += '  <div class="pos-doc-title">FACTURA DE VENTA</div>';
                    html += '  <div class="pos-regimen">RÉGIMEN COMÚN</div>';
                    html += '  <div class="pos-date">' + escapeHtml(data.fecha) + ' ' + escapeHtml(data.hora) + '</div>';
                    html += '</div>';

                    html += '<div class="pos-client-info">';
                    html += '  <div class="pos-client-row"><span class="pos-client-lbl">Cliente:</span><span class="pos-client-val">' + escapeHtml(data.cliente_nombre) + '</span></div>';
                    html += '  <div class="pos-client-row"><span class="pos-client-lbl">NIT o CC:</span><span class="pos-client-val">' + escapeHtml(data.documento) + '</span></div>';
                    html += '  <div class="pos-client-row"><span class="pos-client-lbl">Factura Nro.:</span><span class="pos-client-val">' + escapeHtml(data.consecutivo_pos) + '</span></div>';
                    html += '  <div class="pos-client-row"><span class="pos-client-lbl">Vendedor:</span><span class="pos-client-val">' + escapeHtml(data.vendedor) + '</span></div>';
                    html += '</div>';

                    html += '<table class="pos-table">';
                    html += '  <thead><tr><th class="col-art">Artículo</th><th class="col-pre">Precio</th><th class="col-cant">Cant.</th><th class="col-desc">Desc %</th></tr></thead>';
                    html += '  <tbody>' + itemsHtml + '</tbody>';
                    html += '</table>';

                    html += '<hr class="pos-thick-line">';

                    html += '<table class="pos-totals-table">';
                    html += '  <tr><td class="pos-tot-lbl">Subtotal</td><td class="pos-tot-val">' + escapeHtml(data.subtotal_sin_iva) + '</td></tr>';
                    html += '  <tr><td class="pos-tot-lbl">IVA 19%:</td><td class="pos-tot-val">' + escapeHtml(data.iva_19) + '</td></tr>';
                    html += '  <tr><td class="pos-tot-lbl">IVA 0%:</td><td class="pos-tot-val">$0</td></tr>';
                    html += '  <tr><td class="pos-tot-lbl pos-total-highlight">Total</td><td class="pos-tot-val pos-total-highlight">' + escapeHtml(data.total) + '</td></tr>';
                    html += '</table>';

                    html += '<div class="pos-payment-block">';
                    html += '  <div class="pos-pay-row"><span class="pos-pay-lbl">Tipo de Pago &nbsp; ' + escapeHtml(data.metodo_pago) + '</span><span class="pos-pay-val">' + escapeHtml(data.total) + '</span></div>';
                    html += '  <div class="pos-pay-row"><span class="pos-pay-lbl">Cambio</span><span class="pos-pay-val">$0</span></div>';
                    html += '</div>';

                    html += '<hr class="pos-dashed-line">';

                    html += '<div class="pos-loyalty">';
                    html += '  Puntos con esta compra: <strong>' + escapeHtml(String(data.puntos_compra)) + '</strong><br>';
                    html += '  Puntos acumulados: <strong>' + escapeHtml(String(data.puntos_acumulados)) + '</strong>';
                    html += '</div>';

                    html += '<hr class="pos-dashed-line">';

                    html += '<div class="pos-custom-text">';
                    html += '  ¡Gracias por su compra en Almacén Europa!<br>';
                    html += '  Garantía: 30 días calendario con este recibo';
                    html += '</div>';

                    html += '<hr class="pos-dashed-line">';

                    html += '<div class="pos-footer-credits">';
                    html += '  www.almaceneuropa.com<br>';
                    html += '  Desarrollado para Almacén Europa<br>';
                    html += '  NIT: 901234567-8';
                    html += '</div>';

                    html += '<hr class="pos-dashed-line">';

                    ticketRender.innerHTML = html;

                    if (autoPrint) {
                        setTimeout(function() {
                            imprimirTicketActual();
                        }, 350);
                    }
                })
                .catch(function(err) {
                    console.error('Error cargando factura POS:', err);
                    ticketRender.innerHTML = '<div style="color: #ef4444; padding: 20px; text-align: center; font-weight: 600;">Error al conectar con el servidor para obtener la factura POS.</div>';
                });
        }

        function imprimirFacturaPosDirecto(ventaId) {
            verFacturaPos(ventaId, true);
        }

        function imprimirTicketActual() {
            var content = document.getElementById('ticket-pos-render');
            if (!content) return;

            var iframe = document.getElementById('pos-silent-iframe');
            if (!iframe) {
                iframe = document.createElement('iframe');
                iframe.id = 'pos-silent-iframe';
                iframe.style.position = 'fixed';
                iframe.style.right = '0';
                iframe.style.bottom = '0';
                iframe.style.width = '0';
                iframe.style.height = '0';
                iframe.style.border = '0';
                iframe.style.opacity = '0';
                iframe.style.pointerEvents = 'none';
                document.body.appendChild(iframe);
            }

            var doc = iframe.contentWindow.document;
            doc.open();
            doc.write('<!DOCTYPE html><html><head><title>Factura POS<\/title><style>' +
                '* { box-sizing: border-box; margin: 0; padding: 0; } ' +
                '@page { size: 80mm auto; margin: 0mm; } ' +
                'body { font-family: Arial, Helvetica, sans-serif; font-size: 12.5px; line-height: 1.35; color: #000; width: 78mm; margin: 0 auto; padding: 4mm 2mm; background: #fff; } ' +
                '.pos-top-line { display: flex; justify-content: space-between; font-size: 11px; margin-bottom: 12px; } ' +
                '.pos-header { text-align: center; margin-bottom: 14px; } ' +
                '.pos-store-name { font-size: 16px; font-weight: 900; text-transform: uppercase; margin-bottom: 2px; } ' +
                '.pos-store-info { font-size: 11.5px; line-height: 1.3; text-transform: uppercase; } ' +
                '.pos-doc-title { margin-top: 10px; font-size: 13.5px; font-weight: 800; } ' +
                '.pos-regimen { font-size: 11.5px; font-weight: 700; } ' +
                '.pos-date { font-size: 11.5px; margin-top: 2px; } ' +
                '.pos-client-info { font-size: 12.5px; line-height: 1.36; margin-bottom: 12px; } ' +
                '.pos-client-row { display: flex; } ' +
                '.pos-client-lbl { width: 90px; flex-shrink: 0; } ' +
                '.pos-client-val { font-weight: 600; } ' +
                '.pos-table { width: 100%; border-collapse: collapse; font-size: 12px; } ' +
                '.pos-table th { padding: 4px 2px; font-weight: 800; font-size: 12px; } ' +
                '.pos-table th.col-art { text-align: left; width: 48%; } ' +
                '.pos-table th.col-pre { text-align: right; width: 24%; } ' +
                '.pos-table th.col-cant { text-align: center; width: 14%; } ' +
                '.pos-table th.col-desc { text-align: right; width: 14%; } ' +
                '.pos-table td { padding: 4px 2px; vertical-align: top; } ' +
                '.pos-table td.col-art { text-align: left; font-weight: 700; text-transform: uppercase; line-height: 1.2; } ' +
                '.pos-table td.col-pre { text-align: right; white-space: nowrap; } ' +
                '.pos-table td.col-cant { text-align: center; } ' +
                '.pos-table td.col-desc { text-align: right; } ' +
                '.pos-thick-line { border: none; border-bottom: 2px solid #000; margin: 5px 0 8px; } ' +
                '.pos-totals-table { width: 100%; border-collapse: collapse; font-size: 12.5px; margin-bottom: 10px; } ' +
                '.pos-totals-table td { padding: 2px 2px; } ' +
                '.pos-totals-table .pos-tot-lbl { text-align: right; padding-right: 12px; width: 60%; } ' +
                '.pos-totals-table .pos-tot-val { text-align: right; font-weight: 700; width: 40%; white-space: nowrap; } ' +
                '.pos-total-highlight { font-size: 13.5px; font-weight: 900; } ' +
                '.pos-payment-block { margin-top: 6px; } ' +
                '.pos-pay-row { display: flex; justify-content: flex-end; gap: 14px; font-size: 12.5px; margin-bottom: 3px; } ' +
                '.pos-pay-lbl { font-weight: 400; } ' +
                '.pos-pay-val { font-weight: 700; min-width: 85px; text-align: right; } ' +
                '.pos-dashed-line { border: none; border-bottom: 1px dashed #000; margin: 8px 0; } ' +
                '.pos-loyalty { font-size: 11.5px; line-height: 1.4; margin-bottom: 6px; } ' +
                '.pos-custom-text { text-align: center; font-size: 11.5px; line-height: 1.35; margin: 8px 0; } ' +
                '.pos-footer-credits { text-align: center; font-size: 10.5px; line-height: 1.35; margin-top: 4px; } ' +
                '<\/style><\/head><body>' +
                content.innerHTML +
                '<\/body><\/html>');
            doc.close();

            iframe.contentWindow.focus();
            setTimeout(function() {
                iframe.contentWindow.print();
            }, 250);
        }

        function cerrarModalDetalle() {
            if (modalBackdrop) {
                modalBackdrop.classList.remove('is-open');
            }
        }

        function cerrarModalClickFuera(e) {
            if (e.target === modalBackdrop) {
                cerrarModalDetalle();
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modalBackdrop && modalBackdrop.classList.contains('is-open')) {
                cerrarModalDetalle();
            }
        });
    </script>

</body>
</html>
