<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – Almacén Europa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: #f1f5fd;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }

        /* Topbar */
        .dash-topbar {
            background: #0d1b35;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            box-shadow: 0 2px 12px rgba(0,0,0,.18);
        }
        .dash-logo {
            display: flex; align-items: center; gap: 10px;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem; font-weight: 800;
            color: #fff; text-decoration: none;
        }
        .dash-logo-icon {
            width: 34px; height: 34px;
            background: linear-gradient(135deg,#1d74e8,#38bdf8);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }
        .dash-logo-icon svg { width: 18px; height: 18px; }

        .dash-user {
            display: flex; align-items: center; gap: 12px;
        }
        .dash-user-info { text-align: right; }
        .dash-user-name { font-size: .875rem; font-weight: 600; color: #fff; }
        .dash-user-rol  { font-size: .75rem; color: rgba(255,255,255,.5); }
        .dash-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg,#1d74e8,#38bdf8);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Outfit', sans-serif;
            font-size: .9rem; font-weight: 800; color: #fff;
        }

        /* Main */
        .dash-main {
            flex: 1;
            max-width: 1100px;
            margin: 48px auto;
            padding: 0 28px;
            width: 100%;
        }
        .dash-welcome {
            font-family: 'Outfit', sans-serif;
            font-size: 1.75rem; font-weight: 900;
            color: #0d1b35;
            letter-spacing: -.03em;
            margin-bottom: 6px;
        }
        .dash-sub {
            font-size: .9rem; color: #64748b; margin-bottom: 36px;
        }

        /* Cards */
        .dash-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 36px;
        }
        .dash-card {
            background: #fff;
            border-radius: 16px;
            padding: 22px 24px;
            box-shadow: 0 2px 16px rgba(13,27,53,.07);
            border: 1px solid #e8eef8;
        }
        .dash-card__icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
            font-size: 1.3rem;
        }
        .dash-card__label {
            font-size: .78rem; color: #64748b;
            font-weight: 600; letter-spacing: .04em;
            text-transform: uppercase; margin-bottom: 6px;
        }
        .dash-card__value {
            font-family: 'Outfit', sans-serif;
            font-size: 1.6rem; font-weight: 900;
            color: #0d1b35; letter-spacing: -.03em;
        }

        /* Logout */
        .dash-actions { margin-top: 12px; }
        .btn-logout {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 22px;
            background: #0d1b35; color: #fff;
            border: none; border-radius: 10px;
            font-family: 'Outfit', sans-serif;
            font-size: .9rem; font-weight: 700;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }
        .btn-logout:hover { background: #1a2f5e; transform: translateY(-1px); }
    </style>
</head>
<body>

    {{-- Topbar --}}
    <header class="dash-topbar">
        <a href="{{ url('/') }}" class="dash-logo">
            <div class="dash-logo-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <rect x="2" y="3" width="20" height="14" rx="3" fill="white" fill-opacity="0.2" stroke="white" stroke-width="1.5"/>
                    <path d="M7 9h10M7 12h6" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M8 17v4M16 17v4M5 21h14" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
            AlmacénEuropa
        </a>

        <div class="dash-user">
            <div class="dash-user-info">
                <div class="dash-user-name">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</div>
                <div class="dash-user-rol">{{ ucfirst(Auth::user()->rol) }}</div>
            </div>
            <div class="dash-avatar">
                {{ strtoupper(substr(Auth::user()->nombre, 0, 1)) }}
            </div>
        </div>
    </header>

    {{-- Contenido --}}
    <main class="dash-main">
        <h1 class="dash-welcome">
            ¡Hola, {{ Auth::user()->nombre }}! 👋
        </h1>
        <p class="dash-sub">Bienvenido al panel de gestión de Almacén Europa.</p>

        <div class="dash-cards">
            <div class="dash-card">
                <div class="dash-card__icon" style="background:#eff6ff">📦</div>
                <div class="dash-card__label">Inventario</div>
                <div class="dash-card__value">—</div>
            </div>
            <div class="dash-card">
                <div class="dash-card__icon" style="background:#f0fdf4">💰</div>
                <div class="dash-card__label">Ventas Hoy</div>
                <div class="dash-card__value">—</div>
            </div>
            <div class="dash-card">
                <div class="dash-card__icon" style="background:#fefce8">🛒</div>
                <div class="dash-card__label">Compras</div>
                <div class="dash-card__value">—</div>
            </div>
            <div class="dash-card">
                <div class="dash-card__icon" style="background:#fdf4ff">👥</div>
                <div class="dash-card__label">Proveedores</div>
                <div class="dash-card__value">—</div>
            </div>
        </div>

        <div class="dash-actions">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </main>

</body>
</html>
