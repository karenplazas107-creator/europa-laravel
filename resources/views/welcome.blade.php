<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacén Europa – Control Total para su Almacén</title>

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
            --clr-hero-bg: #0b132b;
            --clr-navy-dark: #070e1f;
            --clr-navy-btn: #1e3a8a;
            --clr-navy-hover: #172554;
            --clr-blue-brand: #2563eb;
            --clr-cyan-accent: #38bdf8;
            --clr-text-main: #0f172a;
            --clr-text-muted: #64748b;
            --clr-green: #10b981;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            background-color: #ffffff;
            color: var(--clr-text-main);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            line-height: 1.5;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ══════════════════════════════════════════
           NAVBAR (Blanco, limpio y elegante)
        ══════════════════════════════════════════ */
        .europa-navbar {
            background: #ffffff;
            height: 76px;
            width: 100%;
            border-bottom: 1px solid #f1f5f9;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .europa-navbar__inner {
            max-width: 1280px;
            height: 100%;
            margin: 0 auto;
            padding: 0 36px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Logo */
        .europa-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .europa-logo__icon {
            width: 42px;
            height: 42px;
            background: var(--clr-blue-brand);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
            flex-shrink: 0;
        }

        .europa-logo__text {
            font-family: var(--font-display);
            font-size: 1.45rem;
            letter-spacing: -0.02em;
            line-height: 1;
        }

        .logo-main {
            color: #0f172a;
            font-weight: 800;
        }

        .logo-accent {
            color: var(--clr-blue-brand);
            font-weight: 800;
        }

        /* Enlaces & Botón */
        .europa-navbar__right {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .europa-nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .europa-nav-link {
            font-family: var(--font-body);
            font-size: 0.95rem;
            font-weight: 500;
            color: #475569;
            transition: color 0.18s ease;
        }

        .europa-nav-link:hover,
        .europa-nav-link.active {
            color: #0f172a;
            font-weight: 600;
        }

        .europa-btn-ingresar {
            background-color: var(--clr-navy-btn);
            color: #ffffff;
            font-family: var(--font-display);
            font-size: 0.95rem;
            font-weight: 700;
            padding: 10px 24px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(30, 58, 138, 0.3);
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .europa-btn-ingresar:hover {
            background-color: var(--clr-navy-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.4);
        }

        /* ══════════════════════════════════════════
           HERO SECTION (Oscuro con patrón de puntos)
        ══════════════════════════════════════════ */
        .europa-hero-section {
            background-color: var(--clr-hero-bg);
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1.4px, transparent 1.4px);
            background-size: 26px 26px;
            position: relative;
            overflow: hidden;
            padding: 68px 36px 120px;
        }

        .europa-hero-container {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            align-items: center;
            gap: 52px;
            position: relative;
            z-index: 2;
        }

        /* Columna Izquierda: Textos y CTAs */
        .europa-hero-content {
            max-width: 580px;
        }

        .europa-version-badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.13);
            border-radius: 9999px;
            padding: 7px 16px;
            margin-bottom: 26px;
            color: rgba(255, 255, 255, 0.88);
            font-size: 0.84rem;
            font-weight: 500;
            letter-spacing: 0.02em;
        }

        .version-dot {
            width: 8px;
            height: 8px;
            background-color: var(--clr-green);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--clr-green);
            flex-shrink: 0;
            animation: pulseDot 2.2s infinite;
        }

        @keyframes pulseDot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.75; transform: scale(1.25); }
        }

        .europa-hero-headline {
            font-family: var(--font-display);
            font-size: clamp(3.2rem, 5.2vw, 4.5rem);
            font-weight: 900;
            line-height: 1.08;
            color: #ffffff;
            letter-spacing: -0.035em;
            margin-bottom: 24px;
        }

        .headline-highlight {
            color: var(--clr-cyan-accent);
        }

        .europa-hero-subheadline {
            font-size: 1.05rem;
            line-height: 1.68;
            color: #94a3b8;
            margin-bottom: 38px;
            font-weight: 400;
            max-width: 500px;
        }

        .europa-hero-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            background-color: #ffffff;
            color: var(--clr-navy-btn);
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 1rem;
            padding: 15px 30px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
            transition: all 0.2s ease;
        }

        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.45);
            background-color: #f8fafc;
        }

        .btn-hero-primary .bolt-icon {
            color: var(--clr-blue-brand);
            font-size: 1.05rem;
        }

        .btn-hero-secondary {
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.16);
            color: #ffffff;
            font-family: var(--font-display);
            font-weight: 600;
            font-size: 1rem;
            padding: 15px 28px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .btn-hero-secondary:hover {
            background-color: rgba(255, 255, 255, 0.14);
            border-color: rgba(255, 255, 255, 0.28);
            transform: translateY(-2px);
        }

        /* Columna Derecha: Mockup Visual de Analítica */
        .europa-hero-visual {
            position: relative;
            width: 100%;
            max-width: 580px;
            margin: 0 auto;
        }

        .mockup-frame {
            background: #0d1527;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6), 0 0 50px rgba(37, 99, 235, 0.18);
            overflow: hidden;
            position: relative;
        }

        .mockup-topbar {
            background: #111a30;
            padding: 13px 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .mac-dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            display: inline-block;
        }
        .mac-dot--red    { background-color: #ef4444; }
        .mac-dot--yellow { background-color: #f59e0b; }
        .mac-dot--green  { background-color: #10b981; }

        .mockup-content {
            padding: 18px 20px 22px;
        }

        .mockup-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            font-size: 0.72rem;
            color: #94a3b8;
            letter-spacing: 0.04em;
        }

        .mockup-user-title {
            color: #ffffff;
            font-size: 0.74rem;
        }
        .mockup-user-title strong {
            font-weight: 700;
        }

        .mockup-header-icons {
            display: flex;
            gap: 8px;
        }

        /* Gráficas */
        .mockup-charts-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 16px;
        }

        .mockup-chart-box {
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 10px;
            padding: 12px 14px;
        }

        .chart-meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.65rem;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .chart-title {
            color: #cbd5e1;
            font-size: 0.65rem;
        }

        .chart-options {
            color: #64748b;
            font-size: 0.62rem;
        }

        .chart-canvas-wrap {
            position: relative;
            height: 120px;
            width: 100%;
        }

        .chart-svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        /* Tooltip flotante 57.1% */
        .chart-tooltip-tag {
            position: absolute;
            top: 24px;
            left: 58px;
            background: #ffffff;
            color: #0f172a;
            border-radius: 6px;
            padding: 4px 8px;
            font-size: 0.65rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);
            text-align: center;
            line-height: 1.2;
            pointer-events: none;
        }

        .tooltip-label {
            font-size: 0.58rem;
            color: #64748b;
            display: block;
        }
        .tooltip-percent {
            font-size: 0.78rem;
            font-weight: 800;
            color: #0f172a;
        }

        /* Métricas inferiores */
        .mockup-metrics-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 6px;
            padding-top: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        .metric-cell {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .metric-name {
            font-size: 0.55rem;
            color: #64748b;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .metric-num {
            font-size: 0.8rem;
            font-weight: 700;
            color: #ffffff;
        }
        .metric-num.text-cyan   { color: #38bdf8; }
        .metric-num.text-orange { color: #fbbf24; }

        /* Floating Badge Ventas de Hoy */
        .floating-sales-card {
            position: absolute;
            bottom: 20px;
            left: -22px;
            background: rgba(13, 21, 39, 0.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 14px;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.5);
            z-index: 10;
            animation: floatBadge 4.5s ease-in-out infinite;
        }

        @keyframes floatBadge {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-8px); }
        }

        .sales-icon-box {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(16, 185, 129, 0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--clr-green);
            flex-shrink: 0;
        }

        .sales-text-group {
            display: flex;
            flex-direction: column;
        }

        .sales-label {
            font-size: 0.74rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .sales-value {
            font-family: var(--font-display);
            font-size: 1.35rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.1;
        }

        /* Curva Inferior / Wave hacia blanco */
        .europa-bottom-wave {
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            z-index: 1;
        }

        .europa-bottom-wave svg {
            position: relative;
            display: block;
            width: 100%;
            height: 70px;
        }

        /* ══════════════════════════════════════════
           SECCIÓN DE CARACTERÍSTICAS
        ══════════════════════════════════════════ */
        .europa-features-section {
            padding: 100px 36px 90px;
            background: #ffffff;
            max-width: 1280px;
            margin: 0 auto;
        }

        .section-header-center {
            text-align: center;
            max-width: 680px;
            margin: 0 auto 60px;
        }

        .section-pill-tag {
            display: inline-block;
            font-family: var(--font-display);
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--clr-blue-brand);
            background: #eff6ff;
            padding: 6px 14px;
            border-radius: 9999px;
            margin-bottom: 14px;
        }

        .section-headline {
            font-family: var(--font-display);
            font-size: 2.4rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
            letter-spacing: -0.03em;
            margin-bottom: 16px;
        }

        .section-desc {
            font-size: 1.05rem;
            color: #64748b;
            line-height: 1.6;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .feature-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 32px 24px;
            transition: all 0.25s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            background: #ffffff;
            border-color: #cbd5e1;
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.08);
        }

        .feature-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
        }

        .icon-blue   { background: #eff6ff; color: #2563eb; }
        .icon-cyan   { background: #ecfeff; color: #0891b2; }
        .icon-green  { background: #ecfdf5; color: #059669; }
        .icon-purple { background: #faf5ff; color: #9333ea; }

        .feature-title {
            font-family: var(--font-display);
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .feature-text {
            font-size: 0.92rem;
            color: #64748b;
            line-height: 1.6;
        }

        /* ══════════════════════════════════════════
           BANNER DE ACCESO RÁPIDO
        ══════════════════════════════════════════ */
        .europa-cta-banner {
            max-width: 1280px;
            margin: 0 auto 90px;
            padding: 0 36px;
        }

        .cta-card {
            background: linear-gradient(135deg, #0b132b 0%, #1e3a8a 100%);
            border-radius: 24px;
            padding: 60px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #ffffff;
            box-shadow: 0 20px 40px rgba(11, 19, 43, 0.25);
            position: relative;
            overflow: hidden;
        }

        .cta-text-side {
            max-width: 600px;
            position: relative;
            z-index: 2;
        }

        .cta-title {
            font-family: var(--font-display);
            font-size: 2.2rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 12px;
        }

        .cta-desc {
            font-size: 1rem;
            color: #cbd5e1;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 14px;
            position: relative;
            z-index: 2;
        }

        .btn-cta-white {
            background: #ffffff;
            color: var(--clr-navy-btn);
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 0.98rem;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .btn-cta-white:hover {
            transform: translateY(-2px);
            background: #f8fafc;
        }

        .btn-cta-outline {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            font-family: var(--font-display);
            font-weight: 600;
            font-size: 0.98rem;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .btn-cta-outline:hover {
            background: rgba(255, 255, 255, 0.18);
            border-color: #ffffff;
        }

        /* ══════════════════════════════════════════
           FOOTER
        ══════════════════════════════════════════ */
        .europa-footer-site {
            background: #0f172a;
            color: #94a3b8;
            padding: 60px 36px 36px;
            border-top: 1px solid #1e293b;
        }

        .europa-footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 30px;
            border-bottom: 1px solid #1e293b;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-brand .logo-main { color: #ffffff; }

        .footer-links {
            display: flex;
            gap: 24px;
            font-size: 0.9rem;
        }

        .footer-links a:hover {
            color: #ffffff;
        }

        .footer-bottom {
            max-width: 1280px;
            margin: 24px auto 0;
            text-align: center;
            font-size: 0.82rem;
            color: #64748b;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .europa-hero-container {
                grid-template-columns: 1fr;
                gap: 48px;
                text-align: center;
            }
            .europa-hero-content {
                max-width: 100%;
                margin: 0 auto;
            }
            .europa-hero-actions {
                justify-content: center;
            }
            .floating-sales-card {
                left: 10px;
                bottom: -15px;
            }
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .cta-card {
                flex-direction: column;
                text-align: center;
                gap: 28px;
            }
            .promotions-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .europa-hero-stats {
                padding: 18px 16px;
            }
            .hero-stat-item {
                padding: 0 24px;
            }
        }

        @media (max-width: 768px) {
            .europa-navbar__inner {
                padding: 0 20px;
            }
            .europa-nav-links {
                display: none;
            }
            .features-grid {
                grid-template-columns: 1fr;
            }
            .mockup-metrics-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 640px) {
            .promotions-grid {
                grid-template-columns: 1fr;
            }
            .europa-hero-stats {
                flex-direction: column;
                gap: 16px;
                padding: 20px;
            }
            .hero-stat-separator {
                width: 80px;
                height: 1px;
            }
            .hero-stat-item {
                padding: 0;
            }
            .promo-filter-btn {
                padding: 7px 16px;
                font-size: 0.85rem;
            }
        }

        /* ══════════════════════════════════════════
           STATS DEL HERO (Control de Stock, etc.)
        ══════════════════════════════════════════ */
        .europa-hero-stats {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px 28px;
            margin-top: 50px;
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: relative;
            z-index: 2;
        }

        .hero-stat-item {
            text-align: center;
            padding: 0 48px;
        }

        .hero-stat-number {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 900;
            color: #ffffff;
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .hero-stat-label {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 6px;
            font-weight: 500;
        }

        .hero-stat-separator {
            width: 1px;
            height: 44px;
            background: rgba(255, 255, 255, 0.12);
            flex-shrink: 0;
        }

        /* ══════════════════════════════════════════
           SECCIÓN PROMOCIONES DEL MES (PRODUCTOS)
        ══════════════════════════════════════════ */
        .europa-promotions-section {
            padding: 80px 36px 90px;
            background: #ffffff;
            position: relative;
        }

        .europa-promotions-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .promotions-header {
            text-align: center;
            max-width: 720px;
            margin: 0 auto 36px;
        }

        .promotions-tag {
            display: inline-block;
            font-family: var(--font-display);
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--clr-blue-brand);
            margin-bottom: 8px;
        }

        .promotions-title {
            font-family: var(--font-display);
            font-size: clamp(2.2rem, 3.8vw, 3rem);
            font-weight: 800;
            color: #0f172a;
            line-height: 1.15;
            letter-spacing: -0.03em;
            margin-bottom: 12px;
        }

        .promotions-subtitle {
            font-size: 1.05rem;
            color: #64748b;
            line-height: 1.6;
        }

        /* Filtros de Categoría */
        .promotions-filters {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 48px;
        }

        .promo-filter-btn {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 9999px;
            padding: 9px 24px;
            font-family: var(--font-body);
            font-size: 0.92rem;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .promo-filter-btn:hover {
            border-color: #cbd5e1;
            color: #0f172a;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .promo-filter-btn.active {
            background-color: var(--clr-navy-btn);
            color: #ffffff;
            border-color: var(--clr-navy-btn);
            box-shadow: 0 4px 16px rgba(30, 58, 138, 0.32);
        }

        /* Grid de Productos */
        .promotions-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .promo-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
            transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
            display: flex;
            flex-direction: column;
        }

        .promo-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.09);
            border-color: #cbd5e1;
        }

        .promo-card__img-wrap {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 10;
            overflow: hidden;
            background: #f1f5f9;
        }

        .promo-card__img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.45s ease;
        }

        .promo-card:hover .promo-card__img-wrap img {
            transform: scale(1.06);
        }

        /* Badges de oferta en tarjeta */
        .promo-card-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 0.72rem;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 6px;
            z-index: 2;
            letter-spacing: 0.02em;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .promo-card-badge--red {
            background: #ef4444;
            color: #ffffff;
        }

        .promo-card-badge--green {
            background: #10b981;
            color: #ffffff;
        }

        .promo-card-badge--yellow {
            background: #f59e0b;
            color: #000000;
        }

        /* Contenido de tarjeta */
        .promo-card__body {
            padding: 16px 18px 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .promo-card__category {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--clr-blue-brand);
            letter-spacing: 0.04em;
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        .promo-card__title {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 14px;
            flex-grow: 1;
        }

        .promo-card__footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
        }

        .promo-card__pricing {
            display: flex;
            align-items: baseline;
            gap: 8px;
        }

        .promo-price-old {
            font-size: 0.82rem;
            color: #94a3b8;
            text-decoration: line-through;
            font-weight: 500;
        }

        .promo-price-new {
            font-family: var(--font-display);
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--clr-navy-btn);
        }

        .promo-btn-cart {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: var(--clr-navy-btn);
            color: #ffffff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.28);
            transition: all 0.2s ease;
            flex-shrink: 0;
            text-decoration: none;
        }

        .promo-btn-cart:hover {
            background-color: var(--clr-blue-brand);
            transform: scale(1.1);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
            color: #ffffff;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <!-- ══════════════════════════════════════════
         NAVBAR
    ══════════════════════════════════════════ -->
    <header class="europa-navbar">
        <div class="europa-navbar__inner">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="europa-logo">
                <div class="europa-logo__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                </div>
                <span class="europa-logo__text">
                    <span class="logo-main">Almacén</span><span class="logo-accent">Europa</span>
                </span>
            </a>

            <!-- Navegación & Botón Ingresar -->
            <div class="europa-navbar__right">
                <nav class="europa-nav-links">
                    <a href="{{ url('/') }}" class="europa-nav-link active">Inicio</a>
                    <a href="#promociones" class="europa-nav-link">Promociones</a>
                    <a href="{{ route('tienda') }}" class="europa-nav-link">Carrito</a>
                </nav>

                <div class="europa-nav-auth">
                    @auth
                        @if(Auth::user()->isCliente())
                            <a href="{{ route('tienda') }}" class="europa-btn-ingresar">
                                Tienda 🛍️
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="europa-btn-ingresar">
                                Dashboard →
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="europa-btn-ingresar">
                            Ingresar →
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- ══════════════════════════════════════════
         HERO SECTION (Oscuro con patrón de puntos)
    ══════════════════════════════════════════ -->
    <section class="europa-hero-section">
        <div class="europa-hero-container">
            
            <!-- Columna Izquierda: Textos y CTAs -->
            <div class="europa-hero-content">
                <div class="europa-version-badge">
                    <span class="version-dot"></span>
                    <span>Sistema de Gestión v2.0</span>
                </div>

                <h1 class="europa-hero-headline">
                    Control Total<br>
                    para su<br>
                    <span class="headline-highlight">Almacén.</span>
                </h1>

                <p class="europa-hero-subheadline">
                    Optimice el inventario, acelere sus ventas y tome decisiones inteligentes en tiempo real con la plataforma diseñada exclusivamente para el Almacén Europa.
                </p>

                <div class="europa-hero-actions">
                    <a href="{{ route('tienda') }}" class="btn-hero-primary">
                        Comenzar Ahora <span class="bolt-icon">⚡</span>
                    </a>
                    <a href="#caracteristicas" class="btn-hero-secondary">
                        Ver Características
                    </a>
                </div>
            </div>

            <!-- Columna Derecha: Mockup Visual de Analítica -->
            <div class="europa-hero-visual">
                <div class="mockup-frame">
                    
                    <!-- macOS top bar -->
                    <div class="mockup-topbar">
                        <span class="mac-dot mac-dot--red"></span>
                        <span class="mac-dot mac-dot--yellow"></span>
                        <span class="mac-dot mac-dot--green"></span>
                    </div>

                    <!-- Dashboard Inside -->
                    <div class="mockup-content">
                        <div class="mockup-header-row">
                            <span class="mockup-user-title">USERS: <strong>LAST 7 DAYS</strong> USING <strong>MEDIAN</strong> ▾</span>
                            <div class="mockup-header-icons">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="3" x2="9" y2="21"/></svg>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </div>
                        </div>

                        <!-- Gráficas -->
                        <div class="mockup-charts-grid">
                            
                            <!-- Chart 1: Load time vs bounce rate -->
                            <div class="mockup-chart-box">
                                <div class="chart-meta-row">
                                    <span class="chart-title">LOAD TIME VS BOUNCE RATE</span>
                                    <span class="chart-options">⚙ OPTIONS</span>
                                </div>
                                <div class="chart-canvas-wrap">
                                    <svg class="chart-svg" viewBox="0 0 260 140" preserveAspectRatio="none">
                                        <!-- Grid lines -->
                                        <line x1="0" y1="20" x2="260" y2="20" stroke="rgba(255,255,255,0.06)" stroke-dasharray="3 3"/>
                                        <line x1="0" y1="60" x2="260" y2="60" stroke="rgba(255,255,255,0.06)" stroke-dasharray="3 3"/>
                                        <line x1="0" y1="100" x2="260" y2="100" stroke="rgba(255,255,255,0.06)" stroke-dasharray="3 3"/>
                                        
                                        <!-- Histogram bars -->
                                        <rect x="15" y="105" width="8" height="25" fill="rgba(148, 163, 184, 0.25)" rx="1"/>
                                        <rect x="27" y="85" width="8" height="45" fill="rgba(148, 163, 184, 0.35)" rx="1"/>
                                        <rect x="39" y="55" width="8" height="75" fill="rgba(148, 163, 184, 0.45)" rx="1"/>
                                        <rect x="51" y="40" width="8" height="90" fill="rgba(148, 163, 184, 0.55)" rx="1"/>
                                        <rect x="63" y="60" width="8" height="70" fill="rgba(148, 163, 184, 0.45)" rx="1"/>
                                        <rect x="75" y="75" width="8" height="55" fill="rgba(148, 163, 184, 0.35)" rx="1"/>
                                        <rect x="87" y="90" width="8" height="40" fill="rgba(148, 163, 184, 0.28)" rx="1"/>
                                        <rect x="99" y="100" width="8" height="30" fill="rgba(148, 163, 184, 0.22)" rx="1"/>
                                        <rect x="111" y="108" width="8" height="22" fill="rgba(148, 163, 184, 0.18)" rx="1"/>
                                        <rect x="123" y="115" width="8" height="15" fill="rgba(148, 163, 184, 0.15)" rx="1"/>
                                        <rect x="135" y="118" width="8" height="12" fill="rgba(148, 163, 184, 0.12)" rx="1"/>

                                        <!-- Trend curves -->
                                        <path d="M 10 120 Q 40 85, 70 65 T 140 78 T 200 82 T 250 85" fill="none" stroke="rgba(255,255,255,0.7)" stroke-width="1.8"/>
                                        <path d="M 10 110 Q 50 45, 75 52 T 130 95 T 190 92 T 250 88" fill="none" stroke="#93c5fd" stroke-width="1.6"/>
                                        
                                        <!-- Tooltip guide -->
                                        <line x1="75" y1="35" x2="75" y2="130" stroke="rgba(255,255,255,0.4)" stroke-dasharray="2 2"/>
                                        <circle cx="75" cy="52" r="3.5" fill="#38bdf8"/>
                                    </svg>
                                    
                                    <!-- Tooltip tag 57.1% -->
                                    <div class="chart-tooltip-tag">
                                        <span class="tooltip-label">Bounce Rate</span>
                                        <strong class="tooltip-percent">57.1%</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Chart 2: Start render vs bounce rate -->
                            <div class="mockup-chart-box">
                                <div class="chart-meta-row">
                                    <span class="chart-title">START RENDER VS BOUNCE RATE</span>
                                    <span class="chart-options">⚙ OPTIONS</span>
                                </div>
                                <div class="chart-canvas-wrap">
                                    <svg class="chart-svg" viewBox="0 0 240 140" preserveAspectRatio="none">
                                        <line x1="0" y1="20" x2="240" y2="20" stroke="rgba(255,255,255,0.06)" stroke-dasharray="3 3"/>
                                        <line x1="0" y1="60" x2="240" y2="60" stroke="rgba(255,255,255,0.06)" stroke-dasharray="3 3"/>
                                        <line x1="0" y1="100" x2="240" y2="100" stroke="rgba(255,255,255,0.06)" stroke-dasharray="3 3"/>
                                        
                                        <rect x="10" y="110" width="7" height="20" fill="rgba(148, 163, 184, 0.3)" rx="1"/>
                                        <rect x="20" y="95" width="7" height="35" fill="rgba(148, 163, 184, 0.38)" rx="1"/>
                                        <rect x="30" y="70" width="7" height="60" fill="rgba(148, 163, 184, 0.48)" rx="1"/>
                                        <rect x="40" y="45" width="7" height="85" fill="rgba(148, 163, 184, 0.58)" rx="1"/>
                                        <rect x="50" y="25" width="7" height="105" fill="rgba(148, 163, 184, 0.7)" rx="1"/>
                                        <rect x="60" y="38" width="7" height="92" fill="rgba(148, 163, 184, 0.62)" rx="1"/>
                                        <rect x="70" y="60" width="7" height="70" fill="rgba(148, 163, 184, 0.5)" rx="1"/>
                                        <rect x="80" y="78" width="7" height="52" fill="rgba(148, 163, 184, 0.4)" rx="1"/>
                                        <rect x="90" y="92" width="7" height="38" fill="rgba(148, 163, 184, 0.32)" rx="1"/>
                                        <rect x="100" y="105" width="7" height="25" fill="rgba(148, 163, 184, 0.25)" rx="1"/>
                                        <rect x="110" y="112" width="7" height="18" fill="rgba(148, 163, 184, 0.2)" rx="1"/>
                                        <rect x="120" y="118" width="7" height="12" fill="rgba(148, 163, 184, 0.15)" rx="1"/>

                                        <line x1="110" y1="20" x2="110" y2="130" stroke="rgba(255,255,255,0.3)" stroke-dasharray="2 2"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Métricas inferiores -->
                        <div class="mockup-metrics-grid">
                            <div class="metric-cell">
                                <span class="metric-name">PAGE LOAD (LUX)</span>
                                <span class="metric-num">0.7s</span>
                            </div>
                            <div class="metric-cell">
                                <span class="metric-name">PAGE VIEWS (LUX)</span>
                                <span class="metric-num text-cyan">2.7Mpvs</span>
                            </div>
                            <div class="metric-cell">
                                <span class="metric-name">BOUNCE RATE (LUX)</span>
                                <span class="metric-num text-orange">40.6%</span>
                            </div>
                            <div class="metric-cell">
                                <span class="metric-name">SESSIONS (LUX)</span>
                                <span class="metric-num">479K</span>
                            </div>
                            <div class="metric-cell">
                                <span class="metric-name">SESSION LENGTH (LUX)</span>
                                <span class="metric-num">17min</span>
                            </div>
                            <div class="metric-cell">
                                <span class="metric-name">PVS PER SESSION (LUX)</span>
                                <span class="metric-num">2pvs</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating Card Ventas de Hoy -->
                <div class="floating-sales-card">
                    <div class="sales-icon-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                    </div>
                    <div class="sales-text-group">
                        <span class="sales-label">Ventas de Hoy</span>
                        <strong class="sales-value">+24%</strong>
                    </div>
                </div>

            </div>
        </div>

        <!-- Stats Bar at bottom of Hero -->
        <div class="europa-hero-stats">
            <div class="hero-stat-item">
                <div class="hero-stat-number">100%</div>
                <div class="hero-stat-label">Control de Stock</div>
            </div>
            <div class="hero-stat-separator"></div>
            <div class="hero-stat-item">
                <div class="hero-stat-number">24/7</div>
                <div class="hero-stat-label">Disponibilidad</div>
            </div>
            <div class="hero-stat-separator"></div>
            <div class="hero-stat-item">
                <div class="hero-stat-number">+500</div>
                <div class="hero-stat-label">En facturación</div>
            </div>
        </div>

        <!-- Curva inferior hacia fondo blanco -->
        <div class="europa-bottom-wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,60 C400,120 1000,120 1440,30 L1440,120 L0,120 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <!-- ══════════════════════════════════════════
         SECCIÓN PROMOCIONES DEL MES (PRODUCTOS)
    ══════════════════════════════════════════ -->
    <section class="europa-promotions-section" id="promociones">
        <div class="europa-promotions-container">

            <div class="promotions-header">
                <span class="promotions-tag">Ofertas Especiales</span>
                <h2 class="promotions-title">Promociones del Mes</h2>
                <p class="promotions-subtitle">
                    Los mejores precios en aseo, ropa, herramientas y abarrotes. ¡Solo en Almacén Europa!
                </p>
            </div>

            <!-- Filtros de categoría -->
            <div class="promotions-filters" id="promotions-filters">
                <button type="button" class="promo-filter-btn active" data-filter="todos">
                    Todos
                </button>
                <button type="button" class="promo-filter-btn" data-filter="aseo">
                    🧹 Aseo
                </button>
                <button type="button" class="promo-filter-btn" data-filter="ropa">
                    👕 Ropa
                </button>
                <button type="button" class="promo-filter-btn" data-filter="herramientas">
                    🔧 Herramientas
                </button>
                <button type="button" class="promo-filter-btn" data-filter="abarrotes">
                    🛒 Abarrotes
                </button>
            </div>

            <!-- Grid de productos -->
            <div class="promotions-grid" id="promotions-grid">

                <!-- Producto 1 -->
                <div class="promo-card" data-category="aseo">
                    <div class="promo-card__img-wrap">
                        <img src="https://images.unsplash.com/photo-1583947581924-860bda6a26df?w=600&h=450&fit=crop&auto=format" alt="Detergente en Polvo 1kg" loading="lazy">
                        <span class="promo-card-badge promo-card-badge--red">🔥 -20%</span>
                    </div>
                    <div class="promo-card__body">
                        <span class="promo-card__category">Aseo del Hogar</span>
                        <h3 class="promo-card__title">Detergente en Polvo 1kg</h3>
                        <div class="promo-card__footer">
                            <div class="promo-card__pricing">
                                <span class="promo-price-old">$8.500</span>
                                <span class="promo-price-new">$6.800</span>
                            </div>
                            <a href="{{ route('tienda') }}" class="promo-btn-cart" title="Comprar en la tienda">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Producto 2 -->
                <div class="promo-card" data-category="aseo">
                    <div class="promo-card__img-wrap">
                        <img src="https://images.unsplash.com/photo-1556909172-54557c7e4fb7?w=600&h=450&fit=crop&auto=format" alt="Jabón de Baño x3 und" loading="lazy">
                        <span class="promo-card-badge promo-card-badge--green">✅ NUEVO</span>
                    </div>
                    <div class="promo-card__body">
                        <span class="promo-card__category">Aseo Personal</span>
                        <h3 class="promo-card__title">Jabón de Baño x3 und</h3>
                        <div class="promo-card__footer">
                            <div class="promo-card__pricing">
                                <span class="promo-price-new">$4.200</span>
                            </div>
                            <a href="{{ route('tienda') }}" class="promo-btn-cart" title="Comprar en la tienda">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Producto 3 -->
                <div class="promo-card" data-category="aseo">
                    <div class="promo-card__img-wrap">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=450&fit=crop&auto=format" alt="Escoba + Recogedor" loading="lazy">
                        <span class="promo-card-badge promo-card-badge--yellow">⭐ OFERTA</span>
                    </div>
                    <div class="promo-card__body">
                        <span class="promo-card__category">Aseo del Hogar</span>
                        <h3 class="promo-card__title">Escoba + Recogedor</h3>
                        <div class="promo-card__footer">
                            <div class="promo-card__pricing">
                                <span class="promo-price-old">$18.000</span>
                                <span class="promo-price-new">$14.500</span>
                            </div>
                            <a href="{{ route('tienda') }}" class="promo-btn-cart" title="Comprar en la tienda">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Producto 4 -->
                <div class="promo-card" data-category="ropa">
                    <div class="promo-card__img-wrap">
                        <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=600&h=450&fit=crop&auto=format" alt="Camiseta Algodón Unisex" loading="lazy">
                        <span class="promo-card-badge promo-card-badge--red">🔥 -30%</span>
                    </div>
                    <div class="promo-card__body">
                        <span class="promo-card__category">Ropa</span>
                        <h3 class="promo-card__title">Camiseta Algodón Unisex</h3>
                        <div class="promo-card__footer">
                            <div class="promo-card__pricing">
                                <span class="promo-price-old">$25.000</span>
                                <span class="promo-price-new">$17.500</span>
                            </div>
                            <a href="{{ route('tienda') }}" class="promo-btn-cart" title="Comprar en la tienda">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Producto 5 -->
                <div class="promo-card" data-category="herramientas">
                    <div class="promo-card__img-wrap">
                        <img src="https://images.unsplash.com/photo-1504148455328-c376907d081c?w=600&h=450&fit=crop&auto=format" alt="Juego de Llaves 12 pzs" loading="lazy">
                        <span class="promo-card-badge promo-card-badge--yellow">⭐ OFERTA</span>
                    </div>
                    <div class="promo-card__body">
                        <span class="promo-card__category">Herramientas</span>
                        <h3 class="promo-card__title">Juego de Llaves 12 pzs</h3>
                        <div class="promo-card__footer">
                            <div class="promo-card__pricing">
                                <span class="promo-price-old">$35.000</span>
                                <span class="promo-price-new">$27.000</span>
                            </div>
                            <a href="{{ route('tienda') }}" class="promo-btn-cart" title="Comprar en la tienda">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Producto 6 -->
                <div class="promo-card" data-category="abarrotes">
                    <div class="promo-card__img-wrap">
                        <img src="https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=600&h=450&fit=crop&auto=format" alt="Aceite Girasol 1L" loading="lazy">
                        <span class="promo-card-badge promo-card-badge--green">✅ NUEVO</span>
                    </div>
                    <div class="promo-card__body">
                        <span class="promo-card__category">Abarrotes</span>
                        <h3 class="promo-card__title">Aceite Girasol 1L</h3>
                        <div class="promo-card__footer">
                            <div class="promo-card__pricing">
                                <span class="promo-price-new">$12.000</span>
                            </div>
                            <a href="{{ route('tienda') }}" class="promo-btn-cart" title="Comprar en la tienda">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Producto 7 -->
                <div class="promo-card" data-category="ropa">
                    <div class="promo-card__img-wrap">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&h=450&fit=crop&auto=format" alt="Tenis Deportivos" loading="lazy">
                        <span class="promo-card-badge promo-card-badge--red">🔥 -15%</span>
                    </div>
                    <div class="promo-card__body">
                        <span class="promo-card__category">Ropa</span>
                        <h3 class="promo-card__title">Tenis Deportivos</h3>
                        <div class="promo-card__footer">
                            <div class="promo-card__pricing">
                                <span class="promo-price-old">$85.000</span>
                                <span class="promo-price-new">$72.000</span>
                            </div>
                            <a href="{{ route('tienda') }}" class="promo-btn-cart" title="Comprar en la tienda">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Producto 8 -->
                <div class="promo-card" data-category="abarrotes">
                    <div class="promo-card__img-wrap">
                        <img src="https://images.unsplash.com/photo-1550583724-b2692b85b150?w=600&h=450&fit=crop&auto=format" alt="Arroz Premium 5kg" loading="lazy">
                        <span class="promo-card-badge promo-card-badge--yellow">⭐ OFERTA</span>
                    </div>
                    <div class="promo-card__body">
                        <span class="promo-card__category">Abarrotes</span>
                        <h3 class="promo-card__title">Arroz Premium 5kg</h3>
                        <div class="promo-card__footer">
                            <div class="promo-card__pricing">
                                <span class="promo-price-old">$22.000</span>
                                <span class="promo-price-new">$18.500</span>
                            </div>
                            <a href="{{ route('tienda') }}" class="promo-btn-cart" title="Comprar en la tienda">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ══════════════════════════════════════════
         SECCIÓN DE CARACTERÍSTICAS
    ══════════════════════════════════════════ -->
    <section class="europa-features-section" id="caracteristicas">
        <div class="section-header-center">
            <span class="section-pill-tag">Tecnología & Eficiencia</span>
            <h2 class="section-headline">Todo lo que su negocio necesita para crecer</h2>
            <p class="section-desc">
                Una solución moderna y robusta construida específicamente para el Almacén Europa, optimizando desde el inventario hasta la atención al cliente.
            </p>
        </div>

        <div class="features-grid">
            <!-- Feature 1 -->
            <div class="feature-card">
                <div class="feature-icon-wrapper icon-blue">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Inventario en Tiempo Real</h3>
                <p class="feature-text">
                    Control absoluto de stock con alertas de existencias mínimas, categorización dinámica y trazabilidad completa.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card">
                <div class="feature-icon-wrapper icon-cyan">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Tienda & Punto de Venta</h3>
                <p class="feature-text">
                    Carrito dinámico para clientes, checkout modal con cupones y pasarelas de pago colombianas (PSE, Wompi, Contraentrega).
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card">
                <div class="feature-icon-wrapper icon-green">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Reportes y Estadísticas</h3>
                <p class="feature-text">
                    Visualice el crecimiento de ventas diarias, ingresos consolidados y genere comprobantes PDF al instante sin salir del sistema.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="feature-card">
                <div class="feature-icon-wrapper icon-purple">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Gestión de Usuarios</h3>
                <p class="feature-text">
                    Control de roles y permisos para Administradores, Vendedores, Auxiliares de Bodega y Clientes con máxima seguridad.
                </p>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════════
         BANNER DE LLAMADO A LA ACCIÓN (CTA)
    ══════════════════════════════════════════ -->
    <div class="europa-cta-banner">
        <div class="cta-card">
            <div class="cta-text-side">
                <h2 class="cta-title">Impulse la productividad de su almacén hoy</h2>
                <p class="cta-desc">
                    Descubra la plataforma más avanzada y acelere la experiencia de compra de todos sus clientes.
                </p>
            </div>
            <div class="cta-buttons">
                <a href="{{ route('tienda') }}" class="btn-cta-white">Ir a la Tienda</a>
                @guest
                    <a href="{{ route('login') }}" class="btn-cta-outline">Iniciar Sesión</a>
                @endguest
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════
         FOOTER
    ══════════════════════════════════════════ -->
    <footer class="europa-footer-site">
        <div class="europa-footer-inner">
            <div class="footer-brand">
                <div class="europa-logo__icon" style="width: 36px; height: 36px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                </div>
                <span class="europa-logo__text" style="font-size: 1.25rem;">
                    <span class="logo-main">Almacén</span><span class="logo-accent">Europa</span>
                </span>
            </div>

            <div class="footer-links">
                <a href="{{ url('/') }}">Inicio</a>
                <a href="{{ url('/tienda') }}">Tienda en Línea</a>
                <a href="#promociones">Promociones</a>
                <a href="{{ route('login') }}">Acceso Empleados</a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Almacén Europa – Sistema de Gestión v2.0. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- ══════════════════════════════════════════
         SCRIPTS: FILTROS Y CARRITO
    ══════════════════════════════════════════ -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ── Filtro de Categorías en Promociones ──
            const filterBtns = document.querySelectorAll('.promo-filter-btn');
            const productCards = document.querySelectorAll('.promo-card');

            filterBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const filter = this.dataset.filter;

                    filterBtns.forEach(function (b) { b.classList.remove('active'); });
                    this.classList.add('active');

                    productCards.forEach(function (card) {
                        if (filter === 'todos' || card.dataset.category === filter) {
                            card.style.display = 'flex';
                            card.style.animation = 'none';
                            void card.offsetWidth; // Forzar reflow para reiniciar la animación
                            card.style.animation = 'fadeInUp 0.35s ease forwards';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });

            // ── Efecto clic botón carrito ──
            document.querySelectorAll('.promo-btn-cart').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    this.style.transform = 'scale(0.85)';
                    const self = this;
                    setTimeout(function () {
                        self.style.transform = '';
                    }, 180);
                });
            });
        });
    </script>

</body>
</html>
