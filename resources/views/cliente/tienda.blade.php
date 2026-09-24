<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Almacén Europa – Tienda en Línea</title>

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* ══════════════════════════════════════════
           VARIABLES & RESET
        ══════════════════════════════════════════ */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --font-display: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-body: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            --clr-primary: #1e3a8a;
            --clr-primary-light: #2563eb;
            --clr-cyan: #06b6d4;
            --clr-text-main: #0f172a;
            --clr-text-muted: #64748b;
            --clr-bg: #f8fafc;
            --clr-card: #ffffff;
            --clr-border: #e2e8f0;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--clr-bg);
            color: var(--clr-text-main);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
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

        /* Search input */
        .tienda-nav__search {
            flex: 1;
            max-width: 520px;
            margin: 0 24px;
            position: relative;
        }

        .tienda-nav__search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        .tienda-nav__search-input {
            width: 100%;
            height: 42px;
            background: #f1f5f9;
            border: 1px solid transparent;
            border-radius: 9999px;
            padding: 0 18px 0 44px;
            font-size: 0.88rem;
            color: #0f172a;
            outline: none;
            transition: all 0.2s ease;
        }

        .tienda-nav__search-input:focus {
            background: #ffffff;
            border-color: #cbd5e1;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .tienda-nav__search-input::placeholder {
            color: #94a3b8;
        }

        /* User & Actions */
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

        .tienda-nav__btn-cart {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #1e3a8a;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: transform 0.15s ease, background 0.15s ease;
        }

        .tienda-nav__btn-cart:hover {
            background: #1d4ed8;
            transform: scale(1.05);
        }

        .tienda-nav__cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #ef4444;
            color: #ffffff;
            font-size: 0.7rem;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            transition: transform 0.2s ease;
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
           HERO SECTION
        ══════════════════════════════════════════ */
        .tienda-hero {
            background: linear-gradient(135deg, #09215c 0%, #113a96 40%, #1952cb 75%, #0284c7 100%);
            padding: 56px 48px;
            position: relative;
            color: #ffffff;
        }

        .tienda-hero__container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }

        .tienda-hero__left {
            flex: 1;
            max-width: 620px;
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
            margin-bottom: 20px;
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
            font-size: 3rem;
            font-weight: 900;
            line-height: 1.12;
            letter-spacing: -0.03em;
            margin-bottom: 12px;
        }

        .tienda-hero__title-user {
            color: #67e8f9;
        }

        .tienda-hero__subtitle {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.55;
            margin-bottom: 28px;
            max-width: 520px;
        }

        .tienda-hero__actions {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .tienda-btn-catalogo {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ffffff;
            color: #0d2975;
            padding: 12px 26px;
            border-radius: 9999px;
            font-size: 0.9rem;
            font-weight: 700;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            transition: all 0.2s ease;
        }

        .tienda-btn-catalogo:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            background: #f8fafc;
        }

        .tienda-btn-carrito {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(15, 23, 42, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(8px);
            color: #ffffff;
            padding: 12px 26px;
            border-radius: 9999px;
            font-size: 0.9rem;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .tienda-btn-carrito:hover {
            background: rgba(15, 23, 42, 0.65);
            transform: translateY(-2px);
        }

        /* Hero Right: Stats */
        .tienda-hero__stats {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .tienda-stat-card {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(14px);
            border-radius: 20px;
            padding: 24px 26px;
            min-width: 130px;
            text-align: center;
            color: #ffffff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease;
        }

        .tienda-stat-card:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.16);
        }

        .tienda-stat-card__icon {
            display: flex;
            justify-content: center;
            margin-bottom: 12px;
        }

        .tienda-stat-card__val {
            font-family: var(--font-display);
            font-size: 1.85rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }

        .tienda-stat-card__lbl {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }

        /* ══════════════════════════════════════════
           PRODUCTOS SECTION
        ══════════════════════════════════════════ */
        .tienda-productos {
            max-width: 1280px;
            margin: 0 auto;
            padding: 44px 36px 80px;
        }

        .tienda-productos__header {
            margin-bottom: 22px;
        }

        .tienda-productos__title {
            font-family: var(--font-display);
            font-size: 1.65rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        .tienda-productos__sub {
            font-size: 0.9rem;
            color: var(--clr-text-muted);
            margin-top: 4px;
        }

        /* Category filters */
        .tienda-filtros {
            display: flex;
            align-items: center;
            gap: 10px;
            overflow-x: auto;
            padding: 4px 2px 14px;
            margin-bottom: 28px;
            scrollbar-width: thin;
        }

        .tienda-filtros::-webkit-scrollbar {
            height: 4px;
        }

        .tienda-filtros::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .tienda-filtro-btn {
            background: #ffffff;
            border: 1px solid var(--clr-border);
            color: #475569;
            padding: 8px 18px;
            border-radius: 9999px;
            font-size: 0.86rem;
            font-weight: 500;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s ease;
        }

        .tienda-filtro-btn:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .tienda-filtro-btn.active {
            background: #1e293b;
            color: #ffffff;
            border-color: #1e293b;
            box-shadow: 0 2px 8px rgba(30, 41, 59, 0.25);
        }

        /* Products Grid */
        .tienda-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 22px;
        }

        .tienda-card {
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid var(--clr-border);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            position: relative;
        }

        .tienda-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px -6px rgba(15, 23, 42, 0.08);
            border-color: #cbd5e1;
        }

        .tienda-card__img-wrap {
            position: relative;
            width: 100%;
            height: 180px;
            background: #f1f5f9;
            overflow: hidden;
        }

        .tienda-card__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .tienda-card:hover .tienda-card__img {
            transform: scale(1.04);
        }

        .tienda-card__badge-cat {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            color: #334155;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 9999px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
            text-transform: capitalize;
        }

        .tienda-card__body {
            padding: 16px 18px 18px;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: space-between;
        }

        .tienda-card__nombre {
            font-family: var(--font-body);
            font-size: 0.95rem;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 14px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 38px;
        }

        .tienda-card__footer {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }

        .tienda-card__precio {
            font-family: var(--font-display);
            font-size: 1.22rem;
            font-weight: 800;
            color: #1e3a8a;
            line-height: 1;
        }

        .tienda-card__stock {
            font-size: 0.74rem;
            color: #94a3b8;
            margin-top: 4px;
        }

        .tienda-card__btn-add {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .tienda-card__btn-add:hover {
            background: #1e3a8a;
            color: #ffffff;
            transform: scale(1.1);
        }

        .tienda-empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            background: #ffffff;
            border-radius: 20px;
            border: 1px dashed #cbd5e1;
            color: #64748b;
        }

        /* ══════════════════════════════════════════
           DRAWER DEL CARRITO (SLIDE-OVER)
        ══════════════════════════════════════════ */
        .cart-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .cart-backdrop.open {
            opacity: 1;
            pointer-events: auto;
        }

        .cart-drawer {
            position: fixed;
            top: 0;
            right: 0;
            width: 410px;
            max-width: 90vw;
            height: 100vh;
            background: #ffffff;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            box-shadow: -10px 0 35px rgba(0, 0, 0, 0.15);
            transform: translateX(100%);
            transition: transform 0.32s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .cart-drawer.open {
            transform: translateX(0);
        }

        .cart-drawer__header {
            background: #162547;
            color: #ffffff;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cart-drawer__title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
        }

        .cart-drawer__close {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s ease;
        }

        .cart-drawer__close:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .cart-drawer__body {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
            display: flex;
            flex-direction: column;
        }

        /* Empty state */
        .cart-drawer__empty {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #94a3b8;
            padding: 40px 20px;
        }

        .cart-drawer__empty-icon {
            margin-bottom: 20px;
            color: #cbd5e1;
        }

        .cart-drawer__empty-title {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 4px;
        }

        .cart-drawer__empty-sub {
            font-size: 0.85rem;
            color: #94a3b8;
        }

        /* Items in cart */
        .cart-items-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .cart-item__img {
            width: 56px;
            height: 56px;
            border-radius: 10px;
            object-fit: cover;
            background: #f1f5f9;
            flex-shrink: 0;
        }

        .cart-item__details {
            flex: 1;
            min-width: 0;
        }

        .cart-item__name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cart-item__price {
            font-size: 0.82rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-top: 2px;
        }

        .cart-item__ctrl {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 6px;
        }

        .cart-qty-btn {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: #f1f5f9;
            color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            transition: background 0.15s ease;
        }

        .cart-qty-btn:hover {
            background: #e2e8f0;
        }

        .cart-qty-val {
            font-size: 0.85rem;
            font-weight: 600;
            min-width: 20px;
            text-align: center;
        }

        .cart-item__remove {
            color: #94a3b8;
            padding: 6px;
            border-radius: 6px;
            transition: color 0.15s ease;
        }

        .cart-item__remove:hover {
            color: #ef4444;
            background: #fee2e2;
        }

        .cart-drawer__footer {
            border-top: 1px solid #f1f5f9;
            padding: 20px 24px;
            background: #ffffff;
        }

        .cart-drawer__total-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .cart-drawer__total-label {
            font-size: 0.95rem;
            color: #64748b;
            font-weight: 500;
        }

        .cart-drawer__total-val {
            font-family: var(--font-display);
            font-size: 1.4rem;
            font-weight: 800;
            color: #0f172a;
        }

        .cart-drawer__btn-checkout {
            width: 100%;
            background: #1e3a8a;
            color: #ffffff;
            padding: 14px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 700;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.25);
        }

        .cart-drawer__btn-checkout:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(30, 58, 138, 0.35);
        }

        .cart-drawer__btn-checkout:disabled {
            background: #94a3b8;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* ══════════════════════════════════════════
           TOAST NOTIFICATION
        ══════════════════════════════════════════ */
        .tienda-toast {
            position: fixed;
            bottom: 28px;
            right: 28px;
            background: #0f172a;
            color: #ffffff;
            padding: 14px 22px;
            border-radius: 12px;
            font-size: 0.88rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 2000;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .tienda-toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .tienda-toast--success svg {
            color: #22c55e;
        }

        /* ══════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════ */
        @media (max-width: 900px) {
            .tienda-hero__container {
                flex-direction: column;
                align-items: flex-start;
            }
            .tienda-hero__stats {
                width: 100%;
                justify-content: space-between;
            }
            .tienda-stat-card {
                flex: 1;
                min-width: 0;
                padding: 16px 12px;
            }
        }

        @media (max-width: 640px) {
            .tienda-nav {
                padding: 0 18px;
            }
            .tienda-nav__search {
                display: none;
            }
            .tienda-hero {
                padding: 36px 20px;
            }
            .tienda-hero__title {
                font-size: 2.2rem;
            }
            .tienda-productos {
                padding: 28px 18px 60px;
            }
        }
    </style>
</head>
<body>

    <!-- ══════════════════════════════════════════
         TOP NAVBAR
    ══════════════════════════════════════════ -->
    <header class="tienda-nav">
        <!-- Logo -->
        <a href="{{ route('tienda') }}" class="tienda-nav__logo">
            <div class="tienda-nav__logo-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="3" width="20" height="14" rx="3" fill="white" fill-opacity="0.18" stroke="white" stroke-width="1.8"/>
                    <path d="M7 9h10M7 12h6" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M8 17v4M16 17v4M5 21h14" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>
            <span>Almacén<strong>Europa</strong></span>
        </a>

        <!-- Buscador central -->
        <div class="tienda-nav__search">
            <svg class="tienda-nav__search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input
                type="text"
                id="search-input"
                class="tienda-nav__search-input"
                placeholder="Buscar productos..."
                value="{{ $search }}"
                autocomplete="off"
            >
        </div>

        <!-- Usuario & Carrito -->
        <div class="tienda-nav__user-zone">
            <div class="tienda-nav__avatar">
                {{ strtoupper(substr(Auth::user()->nombre ?? 'C', 0, 1)) }}
            </div>
            <span class="tienda-nav__username">{{ strtolower(Auth::user()->nombre ?? 'Cliente') }}</span>

            <!-- Botón carrito -->
            <button class="tienda-nav__btn-cart" id="btn-open-cart" aria-label="Abrir carrito">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span class="tienda-nav__cart-badge" id="cart-badge" style="display: none;">0</span>
            </button>

            <!-- Botón cerrar sesión -->
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
         HERO SECTION
    ══════════════════════════════════════════ -->
    <section class="tienda-hero">
        <div class="tienda-hero__container">
            <div class="tienda-hero__left">
                <div class="tienda-hero__tag">
                    <span class="tienda-hero__tag-dot"></span>
                    Tienda en línea — Almacén Europa
                </div>

                <h1 class="tienda-hero__title">
                    Hola, <span class="tienda-hero__title-user">{{ strtolower(Auth::user()->nombre ?? 'Cliente') }}</span> 👋<br>
                    ¿Qué vas a llevar hoy?
                </h1>

                <p class="tienda-hero__subtitle">
                    Explora nuestro catálogo completo. Encuentra los mejores productos al mejor precio.
                </p>

                <div class="tienda-hero__actions">
                    <a href="#catalogo" class="tienda-btn-catalogo">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                            <line x1="7" y1="7" x2="7.01" y2="7"></line>
                        </svg>
                        Ver Catálogo
                    </a>

                    <button class="tienda-btn-carrito" id="hero-btn-cart">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        Mi Carrito
                    </button>
                </div>
            </div>

            <!-- Stats flotantes -->
            <div class="tienda-hero__stats">
                <div class="tienda-stat-card">
                    <div class="tienda-stat-card__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        </svg>
                    </div>
                    <div class="tienda-stat-card__val">{{ $totalProductos }}</div>
                    <div class="tienda-stat-card__lbl">Productos</div>
                </div>

                <div class="tienda-stat-card">
                    <div class="tienda-stat-card__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                            <line x1="7" y1="7" x2="7.01" y2="7"></line>
                        </svg>
                    </div>
                    <div class="tienda-stat-card__val">{{ $totalCategorias }}</div>
                    <div class="tienda-stat-card__lbl">Categorías</div>
                </div>

                <div class="tienda-stat-card">
                    <div class="tienda-stat-card__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#facc15" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13" rx="1"></rect>
                            <path d="M16 8h4l3 5v3h-7V8z"></path>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                    </div>
                    <div class="tienda-stat-card__val" style="font-size: 1.45rem; padding-top: 4px;">Rápido</div>
                    <div class="tienda-stat-card__lbl">Despacho</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════════
         NUESTROS PRODUCTOS
    ══════════════════════════════════════════ -->
    <main class="tienda-productos" id="catalogo">
        <div class="tienda-productos__header">
            <h2 class="tienda-productos__title">Nuestros Productos</h2>
            <p class="tienda-productos__sub">
                <span id="products-visible-count">{{ $productos->count() }}</span> productos disponibles
            </p>
        </div>

        <!-- Filtros de Categorías -->
        <div class="tienda-filtros">
            <button
                class="tienda-filtro-btn {{ empty($categoriaId) ? 'active' : '' }}"
                data-cat=""
            >
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                Todos
            </button>

            @foreach ($categorias as $c)
                <button
                    class="tienda-filtro-btn {{ (string)$categoriaId === (string)$c->categoria ? 'active' : '' }}"
                    data-cat="{{ $c->categoria }}"
                >
                    {{ strtolower($c->nombre) }}
                </button>
            @endforeach
        </div>

        <!-- Grid de productos -->
        <div class="tienda-grid" id="productos-grid">
            @forelse ($productos as $p)
                <div
                    class="tienda-card"
                    data-id="{{ $p->productos }}"
                    data-nombre="{{ strtolower($p->nombre) }}"
                    data-cat="{{ $p->categoria }}"
                    data-precio="{{ $p->precio_venta }}"
                    data-precio-formateado="{{ $p->precio_formateado }}"
                    data-stock="{{ $p->stock }}"
                    data-imagen="{{ $p->imagen_url }}"
                >
                    <!-- Imagen -->
                    <div class="tienda-card__img-wrap">
                        <img src="{{ $p->imagen_url }}" alt="{{ $p->nombre }}" class="tienda-card__img" loading="lazy">
                        <span class="tienda-card__badge-cat">
                            {{ strtolower($p->categoriaObj->nombre ?? 'general') }}
                        </span>
                    </div>

                    <!-- Contenido -->
                    <div class="tienda-card__body">
                        <h3 class="tienda-card__nombre">{{ $p->nombre }}</h3>

                        <div class="tienda-card__footer">
                            <div>
                                <div class="tienda-card__precio">{{ $p->precio_formateado }}</div>
                                <div class="tienda-card__stock">{{ $p->stock }} disponibles</div>
                            </div>

                            <button
                                class="tienda-card__btn-add"
                                data-add-id="{{ $p->productos }}"
                                title="Agregar al carrito"
                                aria-label="Agregar {{ $p->nombre }} al carrito"
                            >
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="tienda-empty">
                    <p>No hay productos disponibles en este momento.</p>
                </div>
            @endforelse
        </div>
    </main>

    <!-- ══════════════════════════════════════════
         DRAWER DE MI CARRITO (SLIDE-OVER)
    ══════════════════════════════════════════ -->
    <div class="cart-backdrop" id="cart-backdrop"></div>

    <aside class="cart-drawer" id="cart-drawer">
        <!-- Header -->
        <div class="cart-drawer__header">
            <div class="cart-drawer__title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                Mi Carrito
            </div>

            <button class="cart-drawer__close" id="btn-close-cart" aria-label="Cerrar carrito">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <!-- Body -->
        <div class="cart-drawer__body" id="cart-drawer-body">
            <!-- Renderizado dinámicamente por JavaScript -->
            <div class="cart-drawer__empty" id="cart-empty-view">
                <div class="cart-drawer__empty-icon">
                    <svg width="68" height="68" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="2 7 22 7 19 21 5 21 2 7"></polygon>
                        <circle cx="12" cy="14" r="2"></circle>
                        <path d="M9 7V4a3 3 0 0 1 6 0v3"></path>
                    </svg>
                </div>
                <div class="cart-drawer__empty-title">Tu carrito está vacío</div>
                <div class="cart-drawer__empty-sub">Agrega productos para continuar</div>
            </div>

            <div class="cart-items-list" id="cart-items-list" style="display: none;"></div>
        </div>

        <!-- Footer -->
        <div class="cart-drawer__footer" id="cart-drawer-footer" style="display: none;">
            <div class="cart-drawer__total-row">
                <span class="cart-drawer__total-label">Total a pagar</span>
                <span class="cart-drawer__total-val" id="cart-total-display">$0</span>
            </div>

            <button class="cart-drawer__btn-checkout" id="btn-checkout">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                Finalizar Compra
            </button>
        </div>
    </aside>

    <!-- Toast Notification -->
    <div class="tienda-toast tienda-toast--success" id="tienda-toast">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <span id="toast-message">Producto agregado al carrito</span>
    </div>

    <!-- ══════════════════════════════════════════
         JAVASCRIPT DE LA TIENDA Y CARRITO
    ══════════════════════════════════════════ -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            /* ──────────────────────────────
               ESTADO DEL CARRITO
            ────────────────────────────── */
            const CART_STORAGE_KEY = 'europa_cart_items';
            let cart = [];

            try {
                const stored = localStorage.getItem(CART_STORAGE_KEY);
                if (stored) {
                    cart = JSON.parse(stored);
                }
            } catch (e) {
                cart = [];
            }

            /* ──────────────────────────────
               REFERENCIAS DOM
            ────────────────────────────── */
            const cartDrawer = document.getElementById('cart-drawer');
            const cartBackdrop = document.getElementById('cart-backdrop');
            const btnOpenCart = document.getElementById('btn-open-cart');
            const heroBtnCart = document.getElementById('hero-btn-cart');
            const btnCloseCart = document.getElementById('btn-close-cart');
            const cartBadge = document.getElementById('cart-badge');
            const cartEmptyView = document.getElementById('cart-empty-view');
            const cartItemsList = document.getElementById('cart-items-list');
            const cartDrawerFooter = document.getElementById('cart-drawer-footer');
            const cartTotalDisplay = document.getElementById('cart-total-display');
            const btnCheckout = document.getElementById('btn-checkout');
            const toast = document.getElementById('tienda-toast');
            const toastMessage = document.getElementById('toast-message');

            const searchInput = document.getElementById('search-input');
            const categoryButtons = document.querySelectorAll('.tienda-filtro-btn');
            const productCards = document.querySelectorAll('.tienda-card');
            const productsVisibleCount = document.getElementById('products-visible-count');

            /* ──────────────────────────────
               TOAST HELPER
            ────────────────────────────── */
            let toastTimer = null;
            function showToast(msg) {
                toastMessage.textContent = msg;
                toast.classList.add('show');
                clearTimeout(toastTimer);
                toastTimer = setTimeout(() => {
                    toast.classList.remove('show');
                }, 2800);
            }

            /* ──────────────────────────────
               DRAWER OPEN / CLOSE
            ────────────────────────────── */
            function openDrawer() {
                cartDrawer.classList.add('open');
                cartBackdrop.classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            function closeDrawer() {
                cartDrawer.classList.remove('open');
                cartBackdrop.classList.remove('open');
                document.body.style.overflow = '';
            }

            btnOpenCart.addEventListener('click', openDrawer);
            if (heroBtnCart) heroBtnCart.addEventListener('click', openDrawer);
            btnCloseCart.addEventListener('click', closeDrawer);
            cartBackdrop.addEventListener('click', closeDrawer);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && cartDrawer.classList.contains('open')) {
                    closeDrawer();
                }
            });

            /* ──────────────────────────────
               FORMAT CURRENCY
            ────────────────────────────── */
            function formatCOP(num) {
                return '$' + Number(num).toLocaleString('es-CO', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            /* ──────────────────────────────
               RENDERIZAR CARRITO
            ────────────────────────────── */
            function saveCart() {
                localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
                updateCartUI();
            }

            function updateCartUI() {
                const totalItems = cart.reduce((acc, item) => acc + item.cantidad, 0);

                // Badge navbar
                if (totalItems > 0) {
                    cartBadge.textContent = totalItems;
                    cartBadge.style.display = 'flex';
                } else {
                    cartBadge.style.display = 'none';
                }

                // Vista vacía o llena
                if (cart.length === 0) {
                    cartEmptyView.style.display = 'flex';
                    cartItemsList.style.display = 'none';
                    cartDrawerFooter.style.display = 'none';
                } else {
                    cartEmptyView.style.display = 'none';
                    cartItemsList.style.display = 'flex';
                    cartDrawerFooter.style.display = 'block';

                    let totalPagar = 0;
                    cartItemsList.innerHTML = '';

                    cart.forEach((item, index) => {
                        const subtotal = item.precio * item.cantidad;
                        totalPagar += subtotal;

                        const itemEl = document.createElement('div');
                        itemEl.className = 'cart-item';
                        itemEl.innerHTML = `
                            <img src="${item.imagen}" alt="${item.nombre}" class="cart-item__img">
                            <div class="cart-item__details">
                                <div class="cart-item__name">${item.nombre}</div>
                                <div class="cart-item__price">${formatCOP(item.precio)}</div>
                                <div class="cart-item__ctrl">
                                    <button class="cart-qty-btn" data-action="dec" data-index="${index}">−</button>
                                    <span class="cart-qty-val">${item.cantidad}</span>
                                    <button class="cart-qty-btn" data-action="inc" data-index="${index}">+</button>
                                </div>
                            </div>
                            <button class="cart-item__remove" data-action="remove" data-index="${index}" title="Eliminar">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        `;
                        cartItemsList.appendChild(itemEl);
                    });

                    cartTotalDisplay.textContent = formatCOP(totalPagar);
                }
            }

            // Delegación de eventos del carrito (qty + / -, eliminar)
            cartItemsList.addEventListener('click', (e) => {
                const btn = e.target.closest('button');
                if (!btn) return;

                const action = btn.dataset.action;
                const index = parseInt(btn.dataset.index, 10);
                if (isNaN(index) || !cart[index]) return;

                if (action === 'inc') {
                    if (cart[index].cantidad < cart[index].stock) {
                        cart[index].cantidad++;
                        saveCart();
                    } else {
                        showToast(`Máximo stock disponible alcanzado (${cart[index].stock})`);
                    }
                } else if (action === 'dec') {
                    if (cart[index].cantidad > 1) {
                        cart[index].cantidad--;
                        saveCart();
                    } else {
                        cart.splice(index, 1);
                        saveCart();
                    }
                } else if (action === 'remove') {
                    cart.splice(index, 1);
                    saveCart();
                    showToast('Producto retirado del carrito');
                }
            });

            /* ──────────────────────────────
               AGREGAR PRODUCTO AL CARRITO
            ────────────────────────────── */
            document.querySelectorAll('[data-add-id]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const card = btn.closest('.tienda-card');
                    if (!card) return;

                    const id = parseInt(card.dataset.id, 10);
                    const nombre = card.querySelector('.tienda-card__nombre').textContent.trim();
                    const precio = parseFloat(card.dataset.precio);
                    const stock = parseInt(card.dataset.stock, 10);
                    const imagen = card.dataset.imagen;

                    if (stock <= 0) {
                        showToast('Este producto no tiene stock disponible.');
                        return;
                    }

                    const existing = cart.find(item => item.id === id);
                    if (existing) {
                        if (existing.cantidad < stock) {
                            existing.cantidad++;
                            saveCart();
                            showToast(`Agregaste otra unidad de "${nombre}"`);
                        } else {
                            showToast(`No puedes agregar más. Stock disponible: ${stock}`);
                        }
                    } else {
                        cart.push({
                            id,
                            nombre,
                            precio,
                            stock,
                            imagen,
                            cantidad: 1
                        });
                        saveCart();
                        showToast(`"${nombre}" agregado al carrito`);
                    }

                    // Animación ligera en botón del carrito
                    btnOpenCart.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        btnOpenCart.style.transform = '';
                    }, 200);
                });
            });

            /* ──────────────────────────────
               FINALIZAR COMPRA (IR A CHECKOUT)
            ────────────────────────────── */
            btnCheckout.addEventListener('click', () => {
                if (cart.length === 0) {
                    showToast('Tu carrito está vacío. Agrega productos antes de finalizar la compra.');
                    return;
                }
                // Redirigir a la pantalla de Checkout con datos de entrega y métodos de pago
                window.location.href = "{{ route('checkout') }}";
            });

            /* ──────────────────────────────
               FILTRO EN VIVO (Buscador & Categorías)
            ────────────────────────────── */
            let activeCategory = "{{ $categoriaId }}";

            function filterProducts() {
                const term = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                productCards.forEach(card => {
                    const name = card.dataset.nombre;
                    const cat = card.dataset.cat;

                    const matchSearch = term === '' || name.includes(term);
                    const matchCategory = activeCategory === '' || cat === activeCategory;

                    if (matchSearch && matchCategory) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (productsVisibleCount) {
                    productsVisibleCount.textContent = visibleCount;
                }
            }

            searchInput.addEventListener('input', filterProducts);

            categoryButtons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    categoryButtons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    activeCategory = btn.dataset.cat;
                    filterProducts();
                });
            });

            // Inicializar carrito en carga
            updateCartUI();
        });
    </script>
</body>
</html>
