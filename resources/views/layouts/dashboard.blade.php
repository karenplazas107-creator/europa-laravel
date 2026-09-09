<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') – Almacén Europa</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    @stack('styles')
</head>
<body class="db-body">

<div class="db-shell">

    {{-- ════════════════════════════════════════
         SIDEBAR
    ════════════════════════════════════════ --}}
    <aside class="db-sidebar" id="db-sidebar">

        <!-- Logo -->
        <div class="db-sidebar__logo">
            <div class="db-logo-wrap">
                <span class="db-logo-name">Europa</span>
                <span class="db-logo-sub">Sistema de Gestión</span>
            </div>
        </div>

        <!-- Navegación -->
        <nav class="db-sidebar__nav">

            <!-- Sin categoría: Inicio -->
            <div class="db-nav-section">
                <a href="{{ route('dashboard') }}"
                   class="db-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Inicio
                </a>
            </div>

            <!-- GESTIÓN -->
            <div class="db-nav-section">
                <div class="db-nav-section__label">Gestión</div>
                <a href="{{ route('clientes.index') }}"
                   class="db-nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    Clientes
                </a>
                <a href="{{ route('proveedores.index') }}"
                   class="db-nav-link {{ request()->routeIs('proveedores.*') ? 'active' : '' }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="3" width="15" height="13" rx="1"/>
                        <path d="M16 8h4l3 5v3h-7V8z"/>
                        <circle cx="5.5" cy="18.5" r="2.5"/>
                        <circle cx="18.5" cy="18.5" r="2.5"/>
                    </svg>
                    Proveedores
                </a>
            </div>

            <!-- INVENTARIO -->
            <div class="db-nav-section">
                <div class="db-nav-section__label">Inventario</div>
                <a href="{{ route('catalogo.index') }}"
                   class="db-nav-link {{ request()->routeIs('catalogo.*') ? 'active' : '' }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                        <line x1="7" y1="7" x2="7.01" y2="7"/>
                    </svg>
                    Catálogo
                </a>
                <a href="{{ route('productos.index') }}"
                   class="db-nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    </svg>
                    Productos
                </a>
                <a href="{{ route('inventario.index') }}"
                   class="db-nav-link {{ request()->routeIs('inventario.*') ? 'active' : '' }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="8" y1="6" x2="21" y2="6"/>
                        <line x1="8" y1="12" x2="21" y2="12"/>
                        <line x1="8" y1="18" x2="21" y2="18"/>
                        <line x1="3" y1="6" x2="3.01" y2="6"/>
                        <line x1="3" y1="12" x2="3.01" y2="12"/>
                        <line x1="3" y1="18" x2="3.01" y2="18"/>
                    </svg>
                    Inventario
                </a>
            </div>

            <!-- COMERCIAL -->
            <div class="db-nav-section">
                <div class="db-nav-section__label">Comercial</div>
                <a href="{{ route('ventas.index') }}"
                   class="db-nav-link {{ request()->routeIs('ventas.*') ? 'active' : '' }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"/>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                    Ventas
                </a>
                <a href="{{ route('reportes.index') }}"
                   class="db-nav-link {{ request()->routeIs('reportes.*') ? 'active' : '' }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                    Reportes / Informes
                </a>
            </div>

        </nav>

        <!-- Logout -->
        <div class="db-sidebar__footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="db-logout-btn">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>

    </aside>

    {{-- ════════════════════════════════════════
         TOPBAR
    ════════════════════════════════════════ --}}
    <header class="db-topbar">
        <div class="db-topbar__title">
            <span>Inicio -</span> @yield('page-title', 'Panel de Control')
        </div>
        <div class="db-topbar__right">
            <div class="db-user-chip">
                <div class="db-user-info">
                    <div class="db-user-name">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</div>
                    <div class="db-user-rol">{{ ucfirst(Auth::user()->rol) }}</div>
                </div>
                <div class="db-user-avatar">
                    {{ strtoupper(substr(Auth::user()->nombre, 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    {{-- ════════════════════════════════════════
         CONTENIDO PRINCIPAL
    ════════════════════════════════════════ --}}
    <main class="db-main">
        @yield('content')
    </main>

</div>

@stack('scripts')
</body>
</html>
