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

        /* ══════════════════════════════════════════
           MODAL DE CHECKOUT (VENTANA FLOTANTE)
        ══════════════════════════════════════════ */
        .chk-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.78);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            overflow-y: auto;
            animation: fadeIn 0.2s ease;
        }

        .chk-modal-container {
            background: #ffffff;
            width: 100%;
            max-width: 1060px;
            max-height: 92vh;
            border-radius: 20px;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            animation: modalPop 0.28s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes modalPop {
            from { opacity: 0; transform: scale(0.96) translateY(12px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .chk-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            flex-shrink: 0;
        }

        .chk-modal-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chk-modal-logo {
            font-family: var(--font-display);
            font-size: 1.35rem;
            font-weight: 800;
            color: #1e3a8a;
            letter-spacing: -0.02em;
        }

        .chk-modal-logo span {
            color: #2563eb;
        }

        .chk-modal-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.74rem;
            font-weight: 600;
            color: #059669;
            background: #ecfdf5;
            padding: 4px 10px;
            border-radius: 9999px;
            border: 1px solid #a7f3d0;
        }

        .chk-modal-nav-crumbs {
            font-size: 0.8rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        @media (max-width: 768px) {
            .chk-modal-nav-crumbs { display: none; }
        }

        .chk-modal-close {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .chk-modal-close:hover {
            background: #fee2e2;
            color: #ef4444;
            transform: rotate(90deg);
        }

        .chk-modal-body {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            flex: 1;
            overflow-y: auto;
            min-height: 0;
        }

        @media (max-width: 900px) {
            .chk-modal-body {
                grid-template-columns: 1fr;
            }
        }

        .chk-modal-col-form {
            padding: 24px 28px 32px;
            overflow-y: auto;
        }

        .chk-modal-col-summary {
            background: #f8fafc;
            border-left: 1px solid #e2e8f0;
            padding: 24px 28px 32px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .chk-summary-title {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 16px;
        }

        /* Secciones del Formulario */
        .chk-section {
            margin-bottom: 22px;
            padding-bottom: 22px;
            border-bottom: 1px solid #f1f5f9;
        }
        .chk-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .chk-section-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        .chk-section-title {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
        }

        /* Inputs y Campos */
        .chk-field-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .chk-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .chk-row-3 {
            display: grid;
            grid-template-columns: 1.2fr 1.2fr 1fr;
            gap: 10px;
        }
        @media (max-width: 600px) {
            .chk-row-2, .chk-row-3 {
                grid-template-columns: 1fr;
            }
        }

        .chk-input, .chk-select {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.86rem;
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
            background-position: right 12px center;
            padding-right: 36px;
            cursor: pointer;
        }

        .chk-checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.82rem;
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

        .chk-billing-box {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            overflow: hidden;
            background: #ffffff;
            margin-top: 8px;
        }
        .chk-billing-item {
            padding: 12px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.84rem;
            font-weight: 500;
            color: #0f172a;
            border-bottom: 1px solid #e2e8f0;
            cursor: pointer;
        }
        .chk-billing-item:last-child {
            border-bottom: none;
        }

        /* Acordeón de Métodos de Pago */
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
            padding: 12px 14px;
            cursor: pointer;
            user-select: none;
        }
        .chk-payment-option.is-active .chk-payment-head {
            background: #f8fafc;
        }
        .chk-payment-left {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #0f172a;
            cursor: pointer;
        }
        .chk-radio {
            width: 17px;
            height: 17px;
            accent-color: #1e3a8a;
            cursor: pointer;
        }
        .chk-badges-wrap {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .chk-badge-pill {
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 6px;
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
            padding: 14px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            font-size: 0.8rem;
            color: #475569;
            line-height: 1.45;
        }
        .chk-payment-option.is-active .chk-payment-body {
            display: block;
        }

        /* Resumen en Columna Derecha */
        .chk-items-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
            max-height: 280px;
            overflow-y: auto;
            padding-right: 4px;
        }
        .chk-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .chk-item-thumb-wrap {
            position: relative;
            width: 54px;
            height: 54px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3px;
        }
        .chk-item-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }
        .chk-item-qty {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 18px;
            height: 18px;
            background: #0f172a;
            color: #ffffff;
            font-size: 0.68rem;
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
            font-size: 0.84rem;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.3;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .chk-item-meta {
            font-size: 0.72rem;
            color: #64748b;
            margin-top: 2px;
        }
        .chk-item-price {
            font-size: 0.86rem;
            font-weight: 700;
            color: #0f172a;
            text-align: right;
            white-space: nowrap;
        }

        /* Cupones */
        .chk-coupon-wrap {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        .chk-coupon-btn {
            padding: 0 16px;
            background: #e2e8f0;
            color: #475569;
            border: none;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .chk-coupon-btn:hover {
            background: #cbd5e1;
            color: #0f172a;
        }

        /* Alertas de Cupón */
        .cupon-alert {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
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

        /* Desglose de Precios */
        .chk-breakdown-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.84rem;
            color: #475569;
            margin-bottom: 8px;
        }
        .chk-breakdown-row strong {
            color: #0f172a;
        }
        .chk-divider-breakdown {
            height: 1px;
            background: #e2e8f0;
            margin: 14px 0;
        }
        .chk-total-row {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .chk-total-label {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
        }
        .chk-total-price-wrap {
            text-align: right;
        }
        .chk-total-currency {
            font-size: 0.72rem;
            color: #64748b;
            margin-right: 4px;
            font-weight: 500;
        }
        .chk-total-amount {
            font-family: var(--font-display);
            font-size: 1.45rem;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        /* Botón Pagar Ahora */
        .chk-submit-btn {
            width: 100%;
            padding: 14px 20px;
            background-color: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-family: var(--font-display);
            font-size: 0.98rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.25);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
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

        .chk-back-btn {
            width: 100%;
            margin-top: 10px;
            padding: 8px;
            background: none;
            border: none;
            color: #1e3a8a;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: underline;
        }
        .chk-back-btn:hover {
            color: #2563eb;
        }

        .chk-toast-banner {
            display: none;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.84rem;
            margin-bottom: 16px;
            animation: fadeIn 0.2s ease;
        }
        .chk-toast-banner--error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .animate-spin {
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
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

    <!-- ══════════════════════════════════════════
         MODAL DE CHECKOUT (VENTANA FLOTANTE)
    ══════════════════════════════════════════ -->
    <div class="chk-modal-backdrop" id="checkout-modal-backdrop">
        <div class="chk-modal-container" id="checkout-modal" role="dialog" aria-modal="true" aria-labelledby="modal-checkout-title">
            
            <!-- Encabezado del Modal -->
            <div class="chk-modal-header">
                <div class="chk-modal-brand">
                    <div class="chk-modal-logo">Almacén <span>Europa .</span></div>
                    <div class="chk-modal-badge">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Pago Seguro SSL
                    </div>
                    <div class="chk-modal-nav-crumbs">
                        <span>Tienda</span> &rsaquo; <span>Carrito</span> &rsaquo; <strong style="color: #0f172a;" id="modal-checkout-title">Información y Pago</strong>
                    </div>
                </div>
                <button type="button" class="chk-modal-close" onclick="cerrarCheckoutModal()" title="Cerrar (Esc)" aria-label="Cerrar modal">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Cuerpo del Modal (2 Columnas) -->
            <div class="chk-modal-body">
                
                <!-- Columna Izquierda: Formulario de Datos y Pago -->
                <div class="chk-modal-col-form">
                    <form id="chk-modal-form" onsubmit="realizarPagoModal(event)">
                        
                        <!-- Banner de Errores -->
                        <div id="chk-modal-error-banner" class="chk-toast-banner chk-toast-banner--error"></div>

                        <!-- 1. Contacto -->
                        <section class="chk-section">
                            <div class="chk-section-header">
                                <h2 class="chk-section-title">Contacto</h2>
                                <span style="font-size: 0.8rem; color: #64748b;">
                                    Sesión iniciada como <strong>{{ $user ? $user->nombre : 'Invitado' }}</strong>
                                </span>
                            </div>
                            <div class="chk-field-group">
                                <input
                                    type="text"
                                    id="chk_modal_email"
                                    name="email_contacto"
                                    class="chk-input"
                                    placeholder="Email o número de teléfono móvil"
                                    value="{{ $user ? ($user->email ?: $user->movil) : '' }}"
                                    required
                                >
                                <label class="chk-checkbox-label">
                                    <input type="checkbox" name="noticias" class="chk-checkbox" checked>
                                    <span>Enviarme novedades y ofertas por correo electrónico</span>
                                </label>
                            </div>
                        </section>

                        <!-- 2. Entrega -->
                        <section class="chk-section">
                            <div class="chk-section-header">
                                <h2 class="chk-section-title">Entrega</h2>
                            </div>
                            <div class="chk-field-group">
                                <div>
                                    <select name="pais" class="chk-select">
                                        <option value="Colombia">Colombia</option>
                                    </select>
                                </div>

                                <div class="chk-row-2">
                                    <input
                                        type="text"
                                        name="nombre"
                                        id="chk_modal_nombre"
                                        class="chk-input"
                                        placeholder="Nombre"
                                        value="{{ $user ? $user->nombre : '' }}"
                                        required
                                    >
                                    <input
                                        type="text"
                                        name="apellido"
                                        id="chk_modal_apellido"
                                        class="chk-input"
                                        placeholder="Apellidos"
                                        value="{{ $user ? $user->apellido : '' }}"
                                        required
                                    >
                                </div>

                                <div>
                                    <input
                                        type="text"
                                        name="documento"
                                        id="chk_modal_documento"
                                        class="chk-input"
                                        placeholder="Número de documento (Cédula de Ciudadanía)"
                                        required
                                    >
                                </div>

                                <div>
                                    <input
                                        type="text"
                                        name="direccion"
                                        id="chk_modal_direccion"
                                        class="chk-input"
                                        placeholder="Dirección (Calle, carrera, número de casa)"
                                        required
                                    >
                                </div>

                                <div>
                                    <input
                                        type="text"
                                        name="complemento"
                                        id="chk_modal_complemento"
                                        class="chk-input"
                                        placeholder="Casa, apartamento, torre, etc. (opcional)"
                                    >
                                </div>

                                <div class="chk-row-3">
                                    <input
                                        type="text"
                                        name="ciudad"
                                        id="chk_modal_ciudad"
                                        class="chk-input"
                                        placeholder="Ciudad"
                                        value="Neiva"
                                        required
                                    >
                                    <select name="departamento" id="chk_modal_departamento" class="chk-select" required>
                                        <option value="">Departamento / Estado</option>
                                        @if(isset($departamentos))
                                            @foreach($departamentos as $depto)
                                                <option value="{{ $depto }}" {{ $depto === 'Huila' ? 'selected' : '' }}>
                                                    {{ $depto }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <input
                                        type="text"
                                        name="codigo_postal"
                                        id="chk_modal_codigo_postal"
                                        class="chk-input"
                                        placeholder="Cód. postal"
                                    >
                                </div>

                                <div>
                                    <input
                                        type="text"
                                        name="telefono"
                                        id="chk_modal_telefono"
                                        class="chk-input"
                                        placeholder="Teléfono móvil de contacto"
                                        value="{{ $user ? $user->movil : '' }}"
                                        required
                                    >
                                </div>

                                <label class="chk-checkbox-label">
                                    <input type="checkbox" name="guardar_datos" class="chk-checkbox" checked>
                                    <span>Guardar mi información para la próxima vez</span>
                                </label>
                            </div>
                        </section>

                        <!-- 3. Pago -->
                        <section class="chk-section">
                            <div class="chk-section-header">
                                <div>
                                    <h2 class="chk-section-title">Pago</h2>
                                    <p style="font-size: 0.78rem; color: #64748b; margin-top: 2px;">Todas las transacciones son seguras y encriptadas.</p>
                                </div>
                            </div>

                            <div class="chk-payment-box">
                                <!-- Opción 1: PSE / Addi -->
                                <div class="chk-payment-option is-active" id="opt-modal-pse">
                                    <div class="chk-payment-head" onclick="seleccionarPagoModal('pse')">
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
                                        <p>Conéctate de forma protegida con la red <strong>PSE / Débito Bancario</strong> para completar tu compra al instante desde tu banco favorito.</p>
                                    </div>
                                </div>

                                <!-- Opción 2: Wompi -->
                                <div class="chk-payment-option" id="opt-modal-wompi">
                                    <div class="chk-payment-head" onclick="seleccionarPagoModal('wompi')">
                                        <label class="chk-payment-left">
                                            <input type="radio" name="metodo_pago" value="wompi" class="chk-radio">
                                            <span>Wompi (Tarjetas Crédito / Débito)</span>
                                        </label>
                                        <div class="chk-badges-wrap">
                                            <span class="chk-badge-pill chk-badge--wompi">Visa</span>
                                            <span class="chk-badge-pill chk-badge--wompi">Mastercard</span>
                                        </div>
                                    </div>
                                    <div class="chk-payment-body">
                                        <p>Aceptamos tarjetas Visa, Mastercard, American Express y Bancolombia mediante la pasarela segura Wompi.</p>
                                    </div>
                                </div>

                                <!-- Opción 3: Contra Entrega -->
                                <div class="chk-payment-option" id="opt-modal-contraentrega">
                                    <div class="chk-payment-head" onclick="seleccionarPagoModal('contraentrega')">
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

                                <!-- Opción 4: Transferencia / Nequi / Daviplata -->
                                <div class="chk-payment-option" id="opt-modal-transferencia">
                                    <div class="chk-payment-head" onclick="seleccionarPagoModal('transferencia')">
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
                                        <p>Transfiere a nuestras cuentas oficiales:
                                           <br>&bull; <strong>Nequi / Daviplata:</strong> <code>300 123 4567</code> (Almacén Europa)
                                           <br>&bull; <strong>Bancolombia Ahorros:</strong> <code>123-456789-00</code>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- 4. Dirección de facturación -->
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

                        <!-- Botón Pagar Ahora -->
                        <button type="submit" class="chk-submit-btn" id="btn-submit-modal-order">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="5" width="20" height="14" rx="2"/>
                                <line x1="2" y1="10" x2="22" y2="10"/>
                            </svg>
                            <span id="btn-submit-modal-text">Pagar ahora</span>
                        </button>

                        <!-- Botón Volver al Carrito -->
                        <button type="button" class="chk-back-btn" onclick="volverAlCarritoDesdeModal()">
                            &larr; Volver al carrito de compras
                        </button>
                    </form>
                </div>

                <!-- Columna Derecha: Resumen de Compra -->
                <div class="chk-modal-col-summary">
                    <h3 class="chk-summary-title">Resumen del Pedido</h3>

                    <!-- Lista de Productos en el Carrito -->
                    <div class="chk-items-list" id="chk-modal-items-container">
                        <!-- Llenado dinámicamente desde cart -->
                    </div>

                    <!-- Cupón de Descuento -->
                    <div class="chk-coupon-wrap">
                        <input
                            type="text"
                            id="input-modal-cupon"
                            class="chk-input"
                            placeholder="Código de descuento (ej. EUROPA10)"
                            onkeydown="if(event.key==='Enter'){event.preventDefault(); aplicarCuponModal();}"
                            autocomplete="off"
                        >
                        <button type="button" class="chk-coupon-btn" id="btn-modal-cupon" onclick="aplicarCuponModal()">Aplicar</button>
                    </div>
                    <div id="cupon-modal-feedback-msg" style="display: none;"></div>

                    <!-- Desglose de Precios -->
                    <div class="chk-breakdown-row">
                        <span>Subtotal</span>
                        <strong id="chk-modal-subtotal-val">$0</strong>
                    </div>

                    <div class="chk-breakdown-row" id="chk-modal-descuento-row" style="display: none; color: #059669;">
                        <span>Descuento <span id="chk-modal-cupon-tag" style="background: #dcfce7; color: #166534; font-size: 0.72rem; padding: 2px 6px; border-radius: 4px; font-weight: 600; margin-left: 4px;"></span></span>
                        <strong id="chk-modal-descuento-val">-$0</strong>
                    </div>

                    <div class="chk-breakdown-row">
                        <span>Envío <span title="Envío estándar a nivel nacional" style="cursor:help;">&#9432;</span></span>
                        <span style="color: #059669; font-weight: 600;">Gratis</span>
                    </div>

                    <div class="chk-divider-breakdown"></div>

                    <!-- Total Final -->
                    <div class="chk-total-row">
                        <span class="chk-total-label">Total</span>
                        <div class="chk-total-price-wrap">
                            <span class="chk-total-currency">COP</span>
                            <span class="chk-total-amount" id="chk-modal-total-val">$0</span>
                            <div class="chk-tax-note">Incluye impuestos aplicables de ley</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

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
                if (e.key === 'Escape') {
                    const modalBackdrop = document.getElementById('checkout-modal-backdrop');
                    if (modalBackdrop && modalBackdrop.style.display === 'flex') {
                        cerrarCheckoutModal();
                    } else if (cartDrawer.classList.contains('open')) {
                        closeDrawer();
                    }
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
               MODAL DE CHECKOUT (VENTANA FLOTANTE)
            ────────────────────────────── */
            const checkoutModalBackdrop = document.getElementById('checkout-modal-backdrop');
            let cuponModalActivo = null;
            let descuentoModalMonto = 0;

            function formatPrice(val) {
                return '$ ' + Number(val).toLocaleString('es-CO');
            }

            window.openCheckoutModal = function() {
                if (cart.length === 0) {
                    showToast('Tu carrito está vacío. Agrega productos antes de finalizar la compra.');
                    return;
                }
                closeDrawer();
                renderModalSummary();
                if (checkoutModalBackdrop) {
                    checkoutModalBackdrop.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                }
            };

            window.cerrarCheckoutModal = function() {
                if (checkoutModalBackdrop) {
                    checkoutModalBackdrop.style.display = 'none';
                    document.body.style.overflow = '';
                }
            };

            window.volverAlCarritoDesdeModal = function() {
                cerrarCheckoutModal();
                openDrawer();
            };

            // Cerrar al hacer clic en el fondo oscuro
            if (checkoutModalBackdrop) {
                checkoutModalBackdrop.addEventListener('click', (e) => {
                    if (e.target === checkoutModalBackdrop) {
                        cerrarCheckoutModal();
                    }
                });
            }

            // Botón de checkout del drawer abre el modal
            btnCheckout.addEventListener('click', () => {
                openCheckoutModal();
            });

            // Selección de método de pago en el modal (acordeón)
            window.seleccionarPagoModal = function(metodo) {
                document.querySelectorAll('#checkout-modal .chk-payment-option').forEach(el => {
                    el.classList.remove('is-active');
                    const radio = el.querySelector('input[type="radio"]');
                    if (radio) radio.checked = false;
                });

                const target = document.getElementById('opt-modal-' + metodo);
                if (target) {
                    target.classList.add('is-active');
                    const radio = target.querySelector('input[type="radio"]');
                    if (radio) radio.checked = true;
                }
            };

            // Cupones de descuento en el modal
            window.aplicarCuponModal = function() {
                const inp = document.getElementById('input-modal-cupon');
                const feedback = document.getElementById('cupon-modal-feedback-msg');
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
                        <span>Primero agrega productos al carrito para aplicar un cupón.</span>
                    `;
                    return;
                }

                const cuponesValidos = {
                    'EUROPA10': 0.10,
                    'DESCUENTO10': 0.10,
                    'BIENVENIDO': 0.10,
                    'CLIENTE10': 0.10,
                };

                if (cuponesValidos[codigo]) {
                    cuponModalActivo = {
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
                    const btnCupon = document.getElementById('btn-modal-cupon');
                    if (btnCupon) {
                        btnCupon.textContent = 'Aplicado';
                        btnCupon.disabled = true;
                        btnCupon.style.background = '#059669';
                    }
                    renderModalSummary();
                } else {
                    feedback.style.display = 'flex';
                    feedback.className = 'cupon-alert cupon-alert--error';
                    feedback.innerHTML = `
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        <span>El cupón <strong>"${codigo}"</strong> no es válido. Prueba con <code>EUROPA10</code>.</span>
                    `;
                }
            };

            function renderModalSummary() {
                const container = document.getElementById('chk-modal-items-container');
                const subtotalVal = document.getElementById('chk-modal-subtotal-val');
                const totalVal = document.getElementById('chk-modal-total-val');
                const btnText = document.getElementById('btn-submit-modal-text');
                const btnOrder = document.getElementById('btn-submit-modal-order');
                const rowDescuento = document.getElementById('chk-modal-descuento-row');
                const valDescuento = document.getElementById('chk-modal-descuento-val');

                if (!container) return;

                if (cart.length === 0) {
                    container.innerHTML = `
                        <div style="text-align: center; padding: 24px 10px; color: #64748b;">
                            <p style="font-weight: 700; color: #1e293b; margin-bottom: 4px;">Tu carrito está vacío</p>
                            <p style="font-size: 0.8rem; margin-bottom: 10px;">Agrega productos para continuar.</p>
                        </div>
                    `;
                    if (subtotalVal) subtotalVal.textContent = '$ 0';
                    if (totalVal) totalVal.textContent = '$ 0';
                    if (rowDescuento) rowDescuento.style.display = 'none';
                    if (btnOrder) btnOrder.disabled = true;
                    if (btnText) btnText.textContent = 'Pagar ahora — $ 0';
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
                                <div class="chk-item-meta">${item.cantidad} &times; ${formatPrice(item.precio)}</div>
                            </div>
                            <div class="chk-item-price">
                                ${formatPrice(sub)}
                            </div>
                        </div>
                    `;
                });

                container.innerHTML = html;

                // Calcular descuento si hay cupón activo
                if (cuponModalActivo && cuponModalActivo.descuentoPorcentaje > 0) {
                    descuentoModalMonto = Math.round(subtotal * cuponModalActivo.descuentoPorcentaje);
                    if (rowDescuento) {
                        rowDescuento.style.display = 'flex';
                        const tagEl = document.getElementById('chk-modal-cupon-tag');
                        if (tagEl) tagEl.textContent = `${cuponModalActivo.codigo} (-${cuponModalActivo.descuentoPorcentaje * 100}%)`;
                        if (valDescuento) valDescuento.textContent = '-' + formatPrice(descuentoModalMonto);
                    }
                } else {
                    descuentoModalMonto = 0;
                    if (rowDescuento) rowDescuento.style.display = 'none';
                }

                const totalFinal = Math.max(0, subtotal - descuentoModalMonto);

                if (subtotalVal) subtotalVal.textContent = formatPrice(subtotal);
                if (totalVal) totalVal.textContent = formatPrice(totalFinal);
                if (btnText) {
                    btnText.textContent = 'Pagar ahora — ' + formatPrice(totalFinal);
                }
            }

            function mostrarBannerErrorModal(mensaje) {
                const banner = document.getElementById('chk-modal-error-banner');
                if (!banner) return;
                banner.style.display = 'flex';
                banner.className = 'chk-toast-banner chk-toast-banner--error';
                banner.innerHTML = `
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    <div>${mensaje}</div>
                `;
                banner.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }

            // Procesar el pago desde el modal
            window.realizarPagoModal = async function(e) {
                e.preventDefault();

                if (cart.length === 0) {
                    mostrarBannerErrorModal('Tu carrito está vacío. Agrega productos antes de pagar.');
                    return;
                }

                const btn = document.getElementById('btn-submit-modal-order');
                btn.disabled = true;
                btn.innerHTML = `
                    <svg class="animate-spin" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle>
                        <path d="M12 2a10 10 0 0 1 10 10" stroke="#fff"></path>
                    </svg>
                    Procesando pedido de forma segura...
                `;

                const form = document.getElementById('chk-modal-form');
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
                    cupon: cuponModalActivo ? cuponModalActivo.codigo : '',
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
                        localStorage.removeItem('europa_cart_items');
                        localStorage.removeItem('almacen_europa_cart');
                        window.location.href = data.redirect_url;
                    } else {
                        mostrarBannerErrorModal(data.message || 'Error al procesar el pedido.');
                        btn.disabled = false;
                        renderModalSummary();
                    }
                } catch (err) {
                    mostrarBannerErrorModal('Error de conexión con el servidor. Intenta nuevamente.');
                    btn.disabled = false;
                    renderModalSummary();
                }
            };

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
