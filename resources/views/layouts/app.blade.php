<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Almacén Europa - Sistema de Gestión v2.0. Control total de inventario, ventas y decisiones inteligentes en tiempo real.">
    <title>@yield('title', 'Almacén Europa – Control Total para su Almacén')</title>

    <!-- Google Fonts: Inter + Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Europa CSS -->
    <link rel="stylesheet" href="{{ asset('css/europa.css') }}">

    @stack('styles')
</head>
<body class="europa-body">

    <!-- ══════════════════════════════════════════
         NAVBAR
    ══════════════════════════════════════════ -->
    <nav class="europa-nav" id="main-nav">
        <div class="europa-nav__container">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="europa-nav__logo">
                <div class="europa-logo-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="3" width="20" height="14" rx="3" fill="white" fill-opacity="0.15" stroke="white" stroke-width="1.5"/>
                        <path d="M7 9h10M7 12h6" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M8 17v4M16 17v4M5 21h14" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="europa-logo-text">Almacén<strong>Europa</strong></span>
            </a>

            <!-- Nav Links -->
            <ul class="europa-nav__links" id="nav-links">
                <li><a href="{{ url('/') }}" class="europa-nav__link {{ request()->is('/') ? 'active' : '' }}">Inicio</a></li>
                <li><a href="{{ url('/promociones') }}" class="europa-nav__link {{ request()->is('promociones') ? 'active' : '' }}">Promociones</a></li>
                <li>
                    <a href="{{ url('/carrito') }}" class="europa-nav__link {{ request()->is('carrito') ? 'active' : '' }}">
                        <span class="europa-cart-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        </span>
                        Carrito
                    </a>
                </li>
            </ul>

            <!-- Auth Button -->
            <div class="europa-nav__actions">
                @auth
                    <a href="{{ url('/dashboard') }}" class="europa-btn-nav">Dashboard →</a>
                @else
                    <a href="{{ url('/login') }}" class="europa-btn-nav">Ingresar →</a>
                @endauth
            </div>

            <!-- Mobile toggle -->
            <button class="europa-hamburger" id="hamburger-btn" aria-label="Menú">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <!-- Page Content -->
    <main id="main-content">
        @yield('content')
    </main>

    <!-- ══════════════════════════════════════════
         FOOTER
    ══════════════════════════════════════════ -->
    <footer class="europa-footer">
        <div class="europa-footer__container">
            <!-- Brand -->
            <div class="europa-footer__brand">
                <a href="{{ url('/') }}" class="europa-nav__logo">
                    <div class="europa-logo-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2" y="3" width="20" height="14" rx="3" fill="white" fill-opacity="0.15" stroke="white" stroke-width="1.5"/>
                            <path d="M7 9h10M7 12h6" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M8 17v4M16 17v4M5 21h14" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span class="europa-logo-text">Almacén<strong>Europa</strong></span>
                </a>
                <p class="europa-footer__desc">
                    Solución tecnológica <span class="highlight-link">integral</span> para la gestión comercial
                    moderna. Innovación y precisión en cada transacción
                    para impulsar su crecimiento.
                </p>
                <div class="europa-footer__social">
                    <a href="#" class="europa-social-btn" aria-label="Facebook">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" class="europa-social-btn" aria-label="Instagram">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="#" class="europa-social-btn" aria-label="WhatsApp">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Sistema -->
            <div class="europa-footer__col">
                <h4 class="europa-footer__heading">Sistema</h4>
                <ul class="europa-footer__links">
                    <li><a href="{{ url('/login') }}">Iniciar Sesión</a></li>
                    <li><a href="{{ url('/') }}#caracteristicas">Características</a></li>
                    <li><a href="#">Soporte Técnico</a></li>
                </ul>
            </div>

            <!-- Contacto -->
            <div class="europa-footer__col">
                <h4 class="europa-footer__heading">Contacto</h4>
                <ul class="europa-footer__contact-list">
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>Parque Principal Fundadores<br>Sede Principal</span>
                    </li>
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <a href="mailto:admin@almaceneuropa.com">admin@almaceneuropa.com</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="europa-footer__bottom">
            <p>&copy; {{ date('Y') }} Almacén Europa. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
    (function(){
        const hamburger = document.getElementById('hamburger-btn');
        const navLinks  = document.getElementById('nav-links');
        const mainNav   = document.getElementById('main-nav');

        if(hamburger){
            hamburger.addEventListener('click', function(){
                navLinks.classList.toggle('open');
                hamburger.classList.toggle('open');
            });
        }

        window.addEventListener('scroll', function(){
            if(window.scrollY > 20){
                mainNav.classList.add('scrolled');
            } else {
                mainNav.classList.remove('scrolled');
            }
        });
    })();
    </script>

    @stack('scripts')
</body>
</html>

