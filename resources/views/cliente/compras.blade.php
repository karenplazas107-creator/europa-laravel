<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mis Compras & Facturas — Almacén Europa</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800;900&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --font-display: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-body: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
            --clr-primary: #1e3a8a;
            --clr-primary-light: #2563eb;
            --clr-accent: #0284c7;
            --clr-cyan: #06b6d4;
            --clr-text-main: #0f172a;
            --clr-text-muted: #64748b;
            --clr-bg: #f8fafc;
            --clr-card: #ffffff;
            --clr-border: #e2e8f0;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--clr-bg);
            color: var(--clr-text-main);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font-family: inherit;
            cursor: pointer;
            border: none;
            outline: none;
            background: none;
        }

        /* ══════════════════════════════════════════
           TOP NAVBAR
        ══════════════════════════════════════════ */
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
            text-decoration: none;
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
            color: #2563eb;
            font-weight: 800;
        }

        .tienda-nav__center {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .tienda-nav__back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.88rem;
            font-weight: 600;
            color: #1e3a8a;
            padding: 8px 16px;
            border-radius: 9999px;
            background: #f1f5f9;
            transition: all 0.2s ease;
        }

        .tienda-nav__back-link:hover {
            background: #e2e8f0;
            transform: translateX(-2px);
        }

        .tienda-nav__user-zone {
            display: flex;
            align-items: center;
            gap: 12px;
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
            width: 40px;
            height: 40px;
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

        /* ══════════════════════════════════════════
           HERO BANNER
        ══════════════════════════════════════════ */
        .cp-hero {
            background: linear-gradient(135deg, #09215c 0%, #113a96 45%, #1952cb 80%, #0284c7 100%);
            padding: 48px 36px 36px;
            position: relative;
            color: #ffffff;
        }

        .cp-hero__container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 32px;
            flex-wrap: wrap;
        }

        .cp-hero__left {
            max-width: 600px;
        }

        .cp-hero__tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(8px);
            padding: 5px 14px;
            border-radius: 9999px;
            font-size: 0.76rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 16px;
        }

        .cp-hero__tag-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 8px #22c55e;
        }

        .cp-hero__title {
            font-family: var(--font-display);
            font-size: 2.35rem;
            font-weight: 900;
            line-height: 1.15;
            letter-spacing: -0.02em;
            margin-bottom: 10px;
        }

        .cp-hero__title span {
            color: #67e8f9;
        }

        .cp-hero__desc {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.5;
            margin-bottom: 20px;
        }

        /* Stats Cards */
        .cp-stats-grid {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .cp-stat-card {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            border-radius: 14px;
            padding: 16px 20px;
            min-width: 160px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            transition: transform 0.2s ease;
        }

        .cp-stat-card:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.17);
        }

        .cp-stat-card__lbl {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: rgba(255, 255, 255, 0.75);
        }

        .cp-stat-card__val {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 900;
            color: #ffffff;
        }

        .cp-stat-card__sub {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
        }

        /* ══════════════════════════════════════════
           MAIN CONTENT
        ══════════════════════════════════════════ */
        .cp-main {
            max-width: 1200px;
            margin: -20px auto 60px;
            padding: 0 24px;
            width: 100%;
            position: relative;
            z-index: 10;
            flex: 1;
        }

        /* Barra de Filtros y Búsqueda */
        .cp-filters-card {
            background: #ffffff;
            border: 1px solid var(--clr-border);
            border-radius: 16px;
            padding: 18px 24px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .cp-search-form {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            max-width: 480px;
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
            height: 42px;
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 9999px;
            padding: 0 16px 0 42px;
            font-size: 0.88rem;
            color: var(--clr-text-main);
            outline: none;
            transition: all 0.2s ease;
        }

        .cp-search-input:focus {
            background: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .cp-btn-search {
            background: #1e3a8a;
            color: #ffffff;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 0.85rem;
            height: 42px;
            padding: 0 18px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .cp-btn-search:hover {
            background: #1d4ed8;
        }

        .cp-btn-clear {
            font-size: 0.82rem;
            color: #64748b;
            font-weight: 600;
            padding: 8px 12px;
            text-decoration: underline;
        }

        /* Píldoras de Estado */
        .cp-status-pills {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .cp-pill {
            font-size: 0.82rem;
            font-weight: 600;
            padding: 7px 14px;
            border-radius: 9999px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #475569;
            transition: all 0.18s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .cp-pill:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: #0f172a;
        }

        .cp-pill.active {
            background: #1e3a8a;
            border-color: #1e3a8a;
            color: #ffffff;
            font-weight: 700;
        }

        /* ══════════════════════════════════════════
           LISTADO DE COMPRAS (CARDS)
        ══════════════════════════════════════════ */
        .cp-orders-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .cp-order-card {
            background: #ffffff;
            border: 1px solid var(--clr-border);
            border-radius: 18px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .cp-order-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }

        /* Header de la Tarjeta */
        .cp-order-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .cp-order-id-group {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .cp-order-tag {
            font-family: var(--font-display);
            font-size: 0.95rem;
            font-weight: 800;
            color: #0f172a;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .cp-fac-badge {
            font-family: var(--font-mono);
            font-size: 0.78rem;
            font-weight: 700;
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            padding: 3px 10px;
            border-radius: 6px;
        }

        .cp-order-date {
            font-size: 0.82rem;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* Badges de Estado */
        .cp-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .badge-pagado {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .badge-pendiente {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fde68a;
        }

        .badge-completado {
            background: #f0f9ff;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }

        .badge-cancelado {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .badge-default {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        /* Cuerpo de la Tarjeta */
        .cp-order-body {
            padding: 24px;
            display: grid;
            grid-template-columns: 1fr 1.3fr;
            gap: 28px;
        }

        @media (max-width: 860px) {
            .cp-order-body {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        /* Datos de Entrega y Pago */
        .cp-order-info-block h4 {
            font-family: var(--font-display);
            font-size: 0.82rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #64748b;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .cp-info-row {
            display: flex;
            font-size: 0.86rem;
            margin-bottom: 8px;
            line-height: 1.45;
        }

        .cp-info-row strong {
            width: 110px;
            flex-shrink: 0;
            color: #64748b;
            font-weight: 600;
        }

        .cp-info-row span {
            color: #1e293b;
            font-weight: 500;
        }

        .cp-method-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #f1f5f9;
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
            color: #1e3a8a;
        }

        /* Tabla / Lista de Productos del Pedido */
        .cp-order-items-block h4 {
            font-family: var(--font-display);
            font-size: 0.82rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #64748b;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .cp-items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .cp-items-table th {
            text-align: left;
            padding: 8px 10px;
            background: #f8fafc;
            color: #64748b;
            font-size: 0.74rem;
            font-weight: 700;
            text-transform: uppercase;
            border-bottom: 1px solid #e2e8f0;
        }

        .cp-items-table td {
            padding: 10px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .cp-items-table tr:last-child td {
            border-bottom: none;
        }

        .cp-item-title {
            font-weight: 600;
            color: #0f172a;
        }

        .cp-item-cat {
            font-size: 0.72rem;
            color: #94a3b8;
        }

        /* Footer de la Tarjeta */
        .cp-order-footer {
            background: #fafafa;
            border-top: 1px solid #f1f5f9;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .cp-total-display {
            display: flex;
            align-items: baseline;
            gap: 10px;
        }

        .cp-total-lbl {
            font-size: 0.82rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
        }

        .cp-total-val {
            font-family: var(--font-display);
            font-size: 1.45rem;
            font-weight: 900;
            color: #1e3a8a;
        }

        .cp-actions-group {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .cp-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: 10px;
            font-family: var(--font-display);
            font-size: 0.86rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .cp-btn--primary {
            background: #1e3a8a;
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(30, 58, 138, 0.2);
        }

        .cp-btn--primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .cp-btn--outline {
            background: #ffffff;
            color: #334155;
            border: 1px solid #cbd5e1;
        }

        .cp-btn--outline:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        .cp-btn--factura {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .cp-btn--factura:hover {
            background: #d1fae5;
            color: #047857;
            transform: translateY(-1px);
        }

        /* ══════════════════════════════════════════
           ESTADO VACÍO (EMPTY STATE)
        ══════════════════════════════════════════ */
        .cp-empty-state {
            background: #ffffff;
            border: 1px dashed #cbd5e1;
            border-radius: 20px;
            padding: 60px 24px;
            text-align: center;
            max-width: 600px;
            margin: 40px auto;
        }

        .cp-empty-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #eff6ff;
            color: #2563eb;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.12);
        }

        .cp-empty-title {
            font-family: var(--font-display);
            font-size: 1.45rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .cp-empty-desc {
            font-size: 0.92rem;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 24px;
            max-width: 440px;
            margin-left: auto;
            margin-right: auto;
        }

        .cp-btn-tienda {
            background: #1e3a8a;
            color: #ffffff;
            padding: 12px 28px;
            border-radius: 9999px;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 0.92rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(30, 58, 138, 0.25);
            transition: all 0.2s ease;
        }

        .cp-btn-tienda:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        /* ══════════════════════════════════════════
           MODAL DE DETALLE RÁPIDO / FACTURA
        ══════════════════════════════════════════ */
        .cp-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.25s ease;
        }

        .cp-modal-backdrop.is-open {
            opacity: 1;
            visibility: visible;
        }

        .cp-modal {
            background: #ffffff;
            border-radius: 16px;
            max-width: 480px;
            width: 100%;
            max-height: 94vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
            position: relative;
            transform: scale(0.95);
            transition: transform 0.25s ease;
        }

        .cp-modal-backdrop.is-open .cp-modal {
            transform: scale(1);
        }

        .cp-modal-body {
            padding: 16px;
            background: #94a3b8;
            display: flex;
            justify-content: center;
        }

        /* ── TIRILLA POS RENDER DENTRO DEL MODAL ── */
        .pos-modal-ticket {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            padding: 24px 20px 30px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.18);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            line-height: 1.35;
            color: #000000;
        }

        .pos-modal-ticket .pos-top-line {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            margin-bottom: 14px;
            color: #111111;
        }

        .pos-modal-ticket .pos-header {
            text-align: center;
            margin-bottom: 16px;
        }

        .pos-modal-ticket .pos-store-name {
            font-size: 17px;
            font-weight: 900;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .pos-modal-ticket .pos-store-info {
            font-size: 12px;
            line-height: 1.3;
            text-transform: uppercase;
        }

        .pos-modal-ticket .pos-doc-title {
            margin-top: 12px;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.03em;
        }

        .pos-modal-ticket .pos-regimen {
            font-size: 12px;
            font-weight: 700;
        }

        .pos-modal-ticket .pos-date {
            font-size: 12px;
            margin-top: 2px;
        }

        .pos-modal-ticket .pos-client-info {
            font-size: 13px;
            line-height: 1.38;
            margin-bottom: 14px;
            text-align: left;
        }

        .pos-modal-ticket .pos-client-row {
            display: flex;
        }

        .pos-modal-ticket .pos-client-lbl {
            font-weight: 400;
            width: 95px;
            flex-shrink: 0;
        }

        .pos-modal-ticket .pos-client-val {
            font-weight: 600;
        }

        .pos-modal-ticket .pos-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12.5px;
            margin-bottom: 0;
        }

        .pos-modal-ticket .pos-table th {
            padding: 4px 2px;
            font-weight: 800;
            font-size: 12.5px;
        }

        .pos-modal-ticket .pos-table th.col-art {
            text-align: left;
            width: 48%;
        }

        .pos-modal-ticket .pos-table th.col-pre {
            text-align: right;
            width: 24%;
        }

        .pos-modal-ticket .pos-table th.col-cant {
            text-align: center;
            width: 14%;
        }

        .pos-modal-ticket .pos-table th.col-desc {
            text-align: right;
            width: 14%;
        }

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

        .pos-modal-ticket .pos-table td.col-pre {
            text-align: right;
            white-space: nowrap;
        }

        .pos-modal-ticket .pos-table td.col-cant {
            text-align: center;
        }

        .pos-modal-ticket .pos-table td.col-desc {
            text-align: right;
        }

        .pos-modal-ticket .pos-thick-line {
            border: none;
            border-bottom: 2.5px solid #000000;
            margin: 6px 0 10px;
        }

        .pos-modal-ticket .pos-totals-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .pos-modal-ticket .pos-totals-table td {
            padding: 2px 2px;
        }

        .pos-modal-ticket .pos-totals-table .pos-tot-lbl {
            text-align: right;
            padding-right: 14px;
            font-weight: 400;
            width: 60%;
        }

        .pos-modal-ticket .pos-totals-table .pos-tot-val {
            text-align: right;
            font-weight: 700;
            width: 40%;
            white-space: nowrap;
        }

        .pos-modal-ticket .pos-total-highlight {
            font-size: 14px;
            font-weight: 900;
        }

        .pos-modal-ticket .pos-payment-block {
            margin: 10px 0 14px;
        }

        .pos-modal-ticket .pos-pay-row {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            font-size: 13px;
            margin-bottom: 3px;
        }

        .pos-modal-ticket .pos-pay-lbl {
            font-weight: 400;
        }

        .pos-modal-ticket .pos-pay-val {
            font-weight: 700;
            min-width: 90px;
            text-align: right;
        }

        .pos-modal-ticket .pos-dashed-line {
            border: none;
            border-bottom: 1px dashed #000000;
            margin: 10px 0;
        }

        .pos-modal-ticket .pos-loyalty {
            font-size: 12px;
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .pos-modal-ticket .pos-loyalty strong {
            font-weight: 800;
        }

        .pos-modal-ticket .pos-custom-text {
            text-align: center;
            font-size: 12px;
            line-height: 1.35;
            margin: 10px 0;
        }

        .pos-modal-ticket .pos-footer-credits {
            text-align: center;
            font-size: 11px;
            line-height: 1.35;
            margin-top: 6px;
        }

        .cp-modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            background: #ffffff;
            z-index: 10;
        }

        .cp-modal-title {
            font-family: var(--font-display);
            font-size: 1.2rem;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cp-modal-close {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .cp-modal-close:hover {
            background: #fee2e2;
            color: #dc2626;
        }

        .cp-modal-body {
            padding: 24px;
        }

        .cp-modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            border-radius: 0 0 20px 20px;
        }

        /* ══════════════════════════════════════════
           FOOTER GENERAL
        ══════════════════════════════════════════ */
        .cp-footer {
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 24px 36px;
            text-align: center;
            font-size: 0.82rem;
            color: #64748b;
            margin-top: auto;
        }

        .cp-footer strong {
            color: #1e3a8a;
        }
    </style>
</head>
<body>

    <!-- ══════════════════════════════════════════
         TOP NAVBAR
    ══════════════════════════════════════════ -->
    <header class="tienda-nav">
        <a href="{{ route('tienda') }}" class="tienda-nav__logo">
            <div class="tienda-nav__logo-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="3" width="20" height="14" rx="3" fill="white" fill-opacity="0.2" stroke="white" stroke-width="1.8"/>
                    <path d="M7 9h10M7 12h6" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M8 17v4M16 17v4M5 21h14" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>
            <span>Almacén<strong>Europa</strong></span>
        </a>

        <div class="tienda-nav__center">
            <a href="{{ route('tienda') }}" class="tienda-nav__back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Volver a la Tienda</span>
            </a>
        </div>

        <div class="tienda-nav__user-zone">
            <div class="tienda-nav__avatar">
                {{ strtoupper(substr($user->nombre ?? 'C', 0, 1)) }}
            </div>
            <span class="tienda-nav__username">{{ strtolower($user->nombre ?? 'Cliente') }}</span>

            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="tienda-nav__btn-logout" title="Cerrar sesión">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                </button>
            </form>
        </div>
    </header>

    <!-- ══════════════════════════════════════════
         HERO SECTION: MIS COMPRAS & STATS
    ══════════════════════════════════════════ -->
    <section class="cp-hero">
        <div class="cp-hero__container">
            <div class="cp-hero__left">
                <div class="cp-hero__tag">
                    <span class="cp-hero__tag-dot"></span>
                    Módulo de Compras del Cliente — Almacén Europa
                </div>

                <h1 class="cp-hero__title">
                    Mis Compras &amp; <span>Facturas</span> 📦
                </h1>

                <p class="cp-hero__desc">
                    Hola <strong>{{ $user->nombre }}</strong>, aquí encuentras el registro de todas tus compras, copia de tus facturas electrónicas oficiales y el estado de tus entregas.
                </p>
            </div>

            <!-- Stats Rápidas -->
            <div class="cp-stats-grid">
                <div class="cp-stat-card">
                    <span class="cp-stat-card__lbl">Total Pedidos</span>
                    <span class="cp-stat-card__val">{{ $totalCompras }}</span>
                    <span class="cp-stat-card__sub">{{ $totalCompras === 1 ? '1 compra efectuada' : $totalCompras . ' compras efectuadas' }}</span>
                </div>

                <div class="cp-stat-card">
                    <span class="cp-stat-card__lbl">Inversión Total</span>
                    <span class="cp-stat-card__val">${{ number_format($gastoTotal, 0, ',', '.') }}</span>
                    <span class="cp-stat-card__sub">Acumulado en compras</span>
                </div>

                <div class="cp-stat-card">
                    <span class="cp-stat-card__lbl">Último Pedido</span>
                    <span class="cp-stat-card__val" style="font-size: 1.15rem; padding-top: 5px;">
                        {{ $ultimaCompra ? $ultimaCompra->fecha_formateada : 'Ninguno' }}
                    </span>
                    <span class="cp-stat-card__sub">{{ $ultimaCompra ? $ultimaCompra->numero_venta : 'Sin registros' }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════════
         CONTENEDOR PRINCIPAL
    ══════════════════════════════════════════ -->
    <main class="cp-main">

        <!-- Barra de Búsqueda y Filtros -->
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

            <!-- Píldoras de Estado -->
            <div class="cp-status-pills">
                <a href="{{ route('cliente.compras', array_filter(['search' => $search])) }}"
                   class="cp-pill {{ empty($estado) ? 'active' : '' }}">
                    Todos ({{ $totalCompras }})
                </a>
                <a href="{{ route('cliente.compras', array_filter(['estado' => 'pagado', 'search' => $search])) }}"
                   class="cp-pill {{ $estado === 'pagado' ? 'active' : '' }}">
                    <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#10b981;"></span>
                    Pagados
                </a>
                <a href="{{ route('cliente.compras', array_filter(['estado' => 'pendiente_entrega', 'search' => $search])) }}"
                   class="cp-pill {{ $estado === 'pendiente_entrega' ? 'active' : '' }}">
                    <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#f59e0b;"></span>
                    Contra Entrega
                </a>
                <a href="{{ route('cliente.compras', array_filter(['estado' => 'completado', 'search' => $search])) }}"
                   class="cp-pill {{ $estado === 'completado' ? 'active' : '' }}">
                    <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#0284c7;"></span>
                    Entregados
                </a>
            </div>
        </div>

        <!-- Listado de Compras -->
        @if($compras->isEmpty())
            <div class="cp-empty-state">
                <div class="cp-empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </div>
                <h3 class="cp-empty-title">
                    @if($search || $estado)
                        No se encontraron pedidos con ese criterio
                    @else
                        Aún no tienes compras realizadas
                    @endif
                </h3>
                <p class="cp-empty-desc">
                    @if($search || $estado)
                        Intenta buscar con otro término o limpia los filtros para ver todo tu historial.
                    @else
                        Explora nuestro catálogo en línea, aprovecha nuestras promociones y haz tu primer pedido hoy mismo. ¡Te lo enviamos de inmediato!
                    @endif
                </p>
                <a href="{{ route('tienda') }}" class="cp-btn-tienda">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                    </svg>
                    <span>Ir a la Tienda / Ver Productos</span>
                </a>
            </div>
        @else
            <div class="cp-orders-list">
                @foreach($compras as $compra)
                    <article class="cp-order-card" id="pedido-{{ $compra->ventas }}">
                        <!-- Header de la compra -->
                        <div class="cp-order-header">
                            <div class="cp-order-id-group">
                                <span class="cp-order-tag">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                    Pedido {{ $compra->numero_venta }}
                                </span>
                                <span class="cp-fac-badge" title="Número de Factura Electrónica">
                                    {{ $compra->numero_factura }}
                                </span>
                                <span class="cp-order-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    {{ $compra->fecha_formateada }} a las {{ $compra->hora_formateada }}
                                </span>
                            </div>

                            <div>
                                <span class="cp-status-badge {{ $compra->estado_badge_class }}">
                                    ● {{ $compra->estado_etiqueta }}
                                </span>
                            </div>
                        </div>

                        <!-- Cuerpo de la compra -->
                        <div class="cp-order-body">
                            <!-- Datos de entrega y pago -->
                            <div class="cp-order-info-block">
                                <h4>
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="1" y="3" width="15" height="13" rx="1"></rect>
                                        <path d="M16 8h4l3 5v3h-7V8z"></path>
                                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                    </svg>
                                    Detalles de Entrega &amp; Pago
                                </h4>

                                <div class="cp-info-row">
                                    <strong>Destinatario:</strong>
                                    <span>{{ $compra->usuarioObj->nombre ?? 'Cliente' }} {{ $compra->usuarioObj->apellido ?? '' }}</span>
                                </div>
                                <div class="cp-info-row">
                                    <strong>Dirección:</strong>
                                    <span>{{ $compra->direccion_envio ?: 'Dirección principal registrada' }}</span>
                                </div>
                                <div class="cp-info-row">
                                    <strong>Ciudad:</strong>
                                    <span>{{ $compra->ciudad ? ($compra->ciudad . ', ' . $compra->departamento) : 'Neiva, Huila' }}</span>
                                </div>
                                <div class="cp-info-row">
                                    <strong>Teléfono:</strong>
                                    <span>{{ $compra->telefono ?: ($compra->usuarioObj->movil ?? '—') }}</span>
                                </div>
                                <div class="cp-info-row">
                                    <strong>Método Pago:</strong>
                                    <span class="cp-method-badge">
                                        {{ $compra->metodo_pago }}
                                    </span>
                                </div>
                                @if($compra->notas)
                                <div class="cp-info-row">
                                    <strong>Nota / Cupón:</strong>
                                    <span style="font-size: 0.8rem; color: #475569;">{{ $compra->notas }}</span>
                                </div>
                                @endif
                            </div>

                            <!-- Resumen de productos -->
                            <div class="cp-order-items-block">
                                <h4>
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                    </svg>
                                    Productos Comprados ({{ $compra->detalles->sum('cantidad') }} uds.)
                                </h4>

                                <table class="cp-items-table">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th style="text-align: center; width: 60px;">Cant.</th>
                                            <th style="text-align: right; width: 100px;">Unitario</th>
                                            <th style="text-align: right; width: 110px;">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($compra->detalles as $det)
                                            @php
                                                $sub = $det->cantidad * $det->precio;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="cp-item-title">{{ $det->productoObj->nombre ?? 'Producto Almacén Europa' }}</div>
                                                    <div class="cp-item-cat">{{ $det->productoObj->categoriaObj->nombre ?? 'General' }}</div>
                                                </td>
                                                <td style="text-align: center; font-weight: 700; color: #1e3a8a;">
                                                    {{ $det->cantidad }}
                                                </td>
                                                <td style="text-align: right; color: #64748b;">
                                                    ${{ number_format($det->precio, 0, ',', '.') }}
                                                </td>
                                                <td style="text-align: right; font-weight: 700; color: #0f172a;">
                                                    ${{ number_format($sub, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Footer con Total y Acciones -->
                        <div class="cp-order-footer">
                            <div class="cp-total-display">
                                <span class="cp-total-lbl">Total Cancelado:</span>
                                <span class="cp-total-val">${{ number_format($compra->total, 0, ',', '.') }}</span>
                            </div>

                            <div class="cp-actions-group">
                                <!-- Botón Ver Factura POS (Abre el modal aquí mismo sin navegar a otra página) -->
                                <button type="button" class="cp-btn cp-btn--factura" onclick="verFacturaPos({{ $compra->ventas }})" title="Ver tirilla POS sin salir de la página">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                    </svg>
                                    <span>Ver Factura POS</span>
                                </button>

                                <!-- Botón Imprimir Factura POS directo desde aquí sin ir a otra página -->
                                <button type="button" class="cp-btn cp-btn--primary" onclick="imprimirFacturaPosDirecto({{ $compra->ventas }})" title="Imprimir tirilla POS directamente">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
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

                <!-- Paginación -->
                <div style="margin-top: 24px;">
                    {{ $compras->links() }}
                </div>
            </div>
        @endif

    </main>

    <!-- ══════════════════════════════════════════
         MODAL DE FACTURA POS (TIRILLA TÉRMICA)
    ══════════════════════════════════════════ -->
    <div class="cp-modal-backdrop" id="modal-detalle-compra" onclick="cerrarModalClickFuera(event)">
        <div class="cp-modal" onclick="event.stopPropagation()">
            <div class="cp-modal-header">
                <div class="cp-modal-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                    <span id="md-titulo">Factura POS</span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <button type="button" class="cp-btn cp-btn--primary" onclick="imprimirTicketActual()" style="padding: 7px 14px; font-size: 0.82rem;">
                        &#128438; Imprimir POS
                    </button>
                    <button type="button" class="cp-modal-close" onclick="cerrarModalDetalle()" aria-label="Cerrar modal">
                        &times;
                    </button>
                </div>
            </div>

            <!-- Cuerpo del Modal: Tirilla POS idéntica a la imagen -->
            <div class="cp-modal-body">
                <div id="ticket-pos-render" class="pos-modal-ticket">
                    <div style="text-align: center; padding: 40px; color: #64748b;">
                        Cargando factura POS...
                    </div>
                </div>
            </div>

            <div class="cp-modal-footer">
                <button type="button" class="cp-btn cp-btn--outline" onclick="cerrarModalDetalle()">
                    Cerrar
                </button>

                <button type="button" class="cp-btn cp-btn--primary" onclick="imprimirTicketActual()">
                    &#128438; Imprimir Factura POS
                </button>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════
         FOOTER
    ══════════════════════════════════════════ -->
    <footer class="cp-footer">
        <p>&copy; {{ date('Y') }} <strong>Almacén Europa S.A.S.</strong> · Sistema POS y Control Comercial.</p>
        <p style="margin-top: 4px; color: #94a3b8;">Todos los derechos reservados. Neiva – Huila, Colombia.</p>
    </footer>

    <!-- ══════════════════════════════════════════
         SCRIPTS INTERACTIVOS (FACTURA POS EN PÁGINA)
    ══════════════════════════════════════════ -->
    <script>
        const modalBackdrop = document.getElementById('modal-detalle-compra');
        const mdTitulo = document.getElementById('md-titulo');
        const ticketRender = document.getElementById('ticket-pos-render');

        function verFacturaPos(ventaId, autoPrint = false) {
            modalBackdrop.classList.add('is-open');
            ticketRender.innerHTML = `
                <div style="text-align: center; padding: 40px; color: #64748b;">
                    <div style="display: inline-block; width: 32px; height: 32px; border: 3px solid #cbd5e1; border-top-color: #1e3a8a; border-radius: 50%; animation: spin 0.8s linear infinite;"></div>
                    <p style="margin-top: 12px; font-weight: 600;">Generando Factura POS..</p>
                </div>
            `;

            fetch(`/mis-compras/${ventaId}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        ticketRender.innerHTML = `<div style="color: #ef4444; padding: 20px; text-align: center;">No fue posible cargar la factura POS.</div>`;
                        return;
                    }

                    mdTitulo.textContent = `Factura POS Nro. ${data.consecutivo_pos}`;

                    let itemsRows = data.detalles.map(d => `
                        <tr>
                            <td class="col-art">${d.producto_nombre}</td>
                            <td class="col-pre">${d.precio_formateado}</td>
                            <td class="col-cant">${d.cantidad}</td>
                            <td class="col-desc">${data.descuento !== '$0' ? '10' : '0'}</td>
                        </tr>
                    `).join('');

                    ticketRender.innerHTML = `
                        <!-- Línea Superior del Ticket -->
                        <div class="pos-top-line">
                            <span>${data.fecha}</span>
                            <span>ALMACÉN EUROPA -- POS Colombia</span>
                        </div>

                        <!-- Encabezado de la Empresa -->
                        <div class="pos-header">
                            <div class="pos-store-name">ALMACÉN EUROPA</div>
                            <div class="pos-store-info">NIT: 901234567-8</div>
                            <div class="pos-store-info">CRA. 5 # 12-34 BRR. CENTRO</div>
                            <div class="pos-store-info">NEIVA - HUILA · TEL: 300 123 4567</div>

                            <div class="pos-doc-title">FACTURA DE VENTA</div>
                            <div class="pos-regimen">RÉGIMEN COMÚN</div>
                            <div class="pos-date">${data.fecha} ${data.hora}</div>
                        </div>

                        <!-- Información del Cliente -->
                        <div class="pos-client-info">
                            <div class="pos-client-row">
                                <span class="pos-client-lbl">Cliente:</span>
                                <span class="pos-client-val">${data.cliente_nombre}</span>
                            </div>
                            <div class="pos-client-row">
                                <span class="pos-client-lbl">NIT o CC:</span>
                                <span class="pos-client-val">${data.documento}</span>
                            </div>
                            <div class="pos-client-row">
                                <span class="pos-client-lbl">Factura Nro.:</span>
                                <span class="pos-client-val">${data.consecutivo_pos}</span>
                            </div>
                            <div class="pos-client-row">
                                <span class="pos-client-lbl">Vendedor:</span>
                                <span class="pos-client-val">${data.vendedor}</span>
                            </div>
                        </div>

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
                                ${itemsRows}
                            </tbody>
                        </table>

                        <!-- Línea negra sólida bajo los artículos -->
                        <hr class="pos-thick-line">

                        <!-- Desglose de Totales a la Derecha -->
                        <table class="pos-totals-table">
                            <tr>
                                <td class="pos-tot-lbl">Subtotal</td>
                                <td class="pos-tot-val">${data.subtotal_sin_iva}</td>
                            </tr>
                            <tr>
                                <td class="pos-tot-lbl">IVA 19%:</td>
                                <td class="pos-tot-val">${data.iva_19}</td>
                            </tr>
                            <tr>
                                <td class="pos-tot-lbl">IVA 0%:</td>
                                <td class="pos-tot-val">$0</td>
                            </tr>
                            <tr>
                                <td class="pos-tot-lbl pos-total-highlight">Total</td>
                                <td class="pos-tot-val pos-total-highlight">${data.total}</td>
                            </tr>
                        </table>

                        <!-- Medio de Pago y Cambio -->
                        <div class="pos-payment-block">
                            <div class="pos-pay-row">
                                <span class="pos-pay-lbl">Tipo de Pago &nbsp; ${data.metodo_pago}</span>
                                <span class="pos-pay-val">${data.total}</span>
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
                            Puntos con esta compra: <strong>${data.puntos_compra}</strong><br>
                            Puntos acumulados: <strong>${data.puntos_acumulados}</strong>
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
                    `;

                    if (autoPrint) {
                        setTimeout(() => {
                            imprimirTicketActual();
                        }, 400);
                    }
                })
                .catch(err => {
                    ticketRender.innerHTML = `<div style="color: #ef4444; padding: 20px; text-align: center;">Error al cargar datos de la factura POS.</div>`;
                });
        }

        // Imprime directamente la factura POS sin salir de la página
        function imprimirFacturaPosDirecto(ventaId) {
            verFacturaPos(ventaId, true);
        }

        // Impresión mediante iframe oculto para no salir de la página ni distorsionar la vista
        function imprimirTicketActual() {
            const ticketContent = ticketRender.innerHTML;
            const iframe = document.createElement('iframe');
            iframe.style.position = 'fixed';
            iframe.style.right = '0';
            iframe.style.bottom = '0';
            iframe.style.width = '0';
            iframe.style.height = '0';
            iframe.style.border = '0';
            document.body.appendChild(iframe);

            const doc = iframe.contentWindow.document;
            doc.open();
            doc.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Factura POS</title>
                    <style>
                        * { box-sizing: border-box; margin: 0; padding: 0; }
                        body {
                            font-family: Arial, Helvetica, sans-serif;
                            font-size: 12.5px;
                            line-height: 1.35;
                            color: #000;
                            width: 78mm;
                            margin: 0 auto;
                            padding: 3mm 2mm;
                        }
                        @page { size: 80mm auto; margin: 0; }
                        .pos-top-line { display: flex; justify-content: space-between; font-size: 11px; margin-bottom: 12px; }
                        .pos-header { text-align: center; margin-bottom: 14px; }
                        .pos-store-name { font-size: 16px; font-weight: 900; text-transform: uppercase; margin-bottom: 2px; }
                        .pos-store-info { font-size: 11.5px; line-height: 1.3; text-transform: uppercase; }
                        .pos-doc-title { margin-top: 10px; font-size: 13.5px; font-weight: 800; }
                        .pos-regimen { font-size: 11.5px; font-weight: 700; }
                        .pos-date { font-size: 11.5px; margin-top: 2px; }
                        .pos-client-info { font-size: 12.5px; line-height: 1.36; margin-bottom: 12px; }
                        .pos-client-row { display: flex; }
                        .pos-client-lbl { width: 90px; flex-shrink: 0; }
                        .pos-client-val { font-weight: 600; }
                        .pos-table { width: 100%; border-collapse: collapse; font-size: 12px; }
                        .pos-table th { padding: 4px 2px; font-weight: 800; font-size: 12px; }
                        .pos-table th.col-art { text-align: left; width: 48%; }
                        .pos-table th.col-pre { text-align: right; width: 24%; }
                        .pos-table th.col-cant { text-align: center; width: 14%; }
                        .pos-table th.col-desc { text-align: right; width: 14%; }
                        .pos-table td { padding: 4px 2px; vertical-align: top; }
                        .pos-table td.col-art { text-align: left; font-weight: 700; text-transform: uppercase; line-height: 1.2; }
                        .pos-table td.col-pre { text-align: right; white-space: nowrap; }
                        .pos-table td.col-cant { text-align: center; }
                        .pos-table td.col-desc { text-align: right; }
                        .pos-thick-line { border: none; border-bottom: 2px solid #000; margin: 5px 0 8px; }
                        .pos-totals-table { width: 100%; border-collapse: collapse; font-size: 12.5px; margin-bottom: 10px; }
                        .pos-totals-table td { padding: 2px 2px; }
                        .pos-totals-table .pos-tot-lbl { text-align: right; padding-right: 12px; width: 60%; }
                        .pos-totals-table .pos-tot-val { text-align: right; font-weight: 700; width: 40%; white-space: nowrap; }
                        .pos-total-highlight { font-size: 13.5px; font-weight: 900; }
                        .pos-pay-row { display: flex; justify-content: flex-end; gap: 14px; font-size: 12.5px; margin-bottom: 3px; }
                        .pos-pay-lbl { font-weight: 400; }
                        .pos-pay-val { font-weight: 700; min-width: 85px; text-align: right; }
                        .pos-dashed-line { border: none; border-bottom: 1px dashed #000; margin: 8px 0; }
                        .pos-loyalty { font-size: 11.5px; line-height: 1.4; margin-bottom: 6px; }
                        .pos-custom-text { text-align: center; font-size: 11.5px; line-height: 1.35; margin: 8px 0; }
                        .pos-footer-credits { text-align: center; font-size: 10.5px; line-height: 1.35; margin-top: 4px; }
                    </style>
                </head>
                <body>
                    ${ticketContent}
                </body>
                </html>
            `);
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

        function cerrarModalDetalle() {
            modalBackdrop.classList.remove('is-open');
        }

        function cerrarModalClickFuera(e) {
            if (e.target === modalBackdrop) {
                cerrarModalDetalle();
            }
        }

        // Cerrar con Escape
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape' && modalBackdrop.classList.contains('is-open')) {
                cerrarModalDetalle();
            }
        });
    </script>

    <style>
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>

</body>
</html>
