@extends('layouts.app')

@section('title', 'Almacén Europa – Control Total para su Almacén')

@section('content')

{{-- ══════════════════════════════════════════
     HERO SECTION
══════════════════════════════════════════ --}}
<section class="europa-hero" id="inicio">
    <div class="europa-hero__container">

        {{-- ── Texto izquierdo ── --}}
        <div class="europa-hero__text">
            <div class="europa-badge">
                <span class="europa-badge__dot"></span>
                Sistema de Gestión v2.0
            </div>

            <h1 class="europa-hero__title">
                Control Total<br>
                para su<br>
                <span class="europa-hero__accent">Almacén.</span>
            </h1>

            <p class="europa-hero__desc">
                Optimice el inventario, acelere sus ventas y tome decisiones
                inteligentes en tiempo real con la plataforma diseñada
                exclusivamente para el Almacén Europa.
            </p>

            <div class="europa-hero__cta">
                <a href="{{ url('/carrito') }}" class="europa-btn europa-btn--white">
                    Comenzar Ahora ⚡
                </a>
                <a href="#caracteristicas" class="europa-btn europa-btn--ghost">
                    Ver Características
                </a>
            </div>
        </div>

        {{-- ── Mockup derecha ── --}}
        <div class="europa-hero__visual">
            <div class="europa-mockup">
                {{-- Barra de título --}}
                <div class="europa-mockup__bar">
                    <span class="dot red"></span>
                    <span class="dot yellow"></span>
                    <span class="dot green"></span>
                </div>

                <div class="europa-mockup__content">
                    <div class="europa-mockup__header">
                        <span class="mockup-label">USERS: LAST 7 DAYS USING MEDIAN ↓</span>
                    </div>

                    {{-- Gráficas --}}
                    <div class="europa-charts">
                        <div class="europa-chart">
                            <div class="chart-label">LOAD TIME VS BOUNCE RATE</div>
                            <div class="chart-bar-area">
                                <div class="chart-highlight-box">57.1%</div>
                                <div class="chart-bars">
                                    <div class="bar" style="height:88%"></div>
                                    <div class="bar" style="height:72%"></div>
                                    <div class="bar" style="height:54%"></div>
                                    <div class="bar" style="height:40%"></div>
                                    <div class="bar" style="height:30%"></div>
                                    <div class="bar" style="height:22%"></div>
                                    <div class="bar" style="height:16%"></div>
                                    <div class="bar" style="height:10%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="europa-chart">
                            <div class="chart-label">START RENDER VS BOUNCE RATE</div>
                            <div class="chart-bars chart-bars--teal">
                                <div class="bar" style="height:28%"></div>
                                <div class="bar" style="height:66%"></div>
                                <div class="bar" style="height:100%"></div>
                                <div class="bar" style="height:82%"></div>
                                <div class="bar" style="height:56%"></div>
                                <div class="bar" style="height:34%"></div>
                                <div class="bar" style="height:18%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Fila de stats --}}
                    <div class="europa-stats-row">
                        <div class="stat-card">
                            <div class="stat-label">Page Views</div>
                            <div class="stat-val">0.7x</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Sessions</div>
                            <div class="stat-val stat-green">2.7Mpvs</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Bounce Rate</div>
                            <div class="stat-val stat-yellow">40.6%</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Sessions</div>
                            <div class="stat-val">479K</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Session Len.</div>
                            <div class="stat-val">17min</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">P/s Session</div>
                            <div class="stat-val">2pvs</div>
                        </div>
                    </div>
                </div>

                {{-- Badge flotante de ventas --}}
                <div class="europa-float-badge">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                        <polyline points="17 6 23 6 23 12"/>
                    </svg>
                    <div>
                        <div class="float-badge__title">Ventas de Hoy</div>
                        <div class="float-badge__value">+24%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Separador wave --}}
    <div class="europa-hero__wave">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,20 C300,80 900,0 1440,50 L1440,80 L0,80 Z" fill="#f4f7fe"/>
        </svg>
    </div>

    {{-- Stats inferiores --}}
    <div class="europa-hero__stats">
        <div class="hero-stat">
            <div class="hero-stat__number">100%</div>
            <div class="hero-stat__label">Control de Stock</div>
        </div>
        <div class="hero-stat__sep"></div>
        <div class="hero-stat">
            <div class="hero-stat__number">24/7</div>
            <div class="hero-stat__label">Disponibilidad</div>
        </div>
        <div class="hero-stat__sep"></div>
        <div class="hero-stat">
            <div class="hero-stat__number">+500</div>
            <div class="hero-stat__label">En facturación</div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════
     PROMOCIONES
══════════════════════════════════════════ --}}
<section class="europa-promo" id="promociones">
    <div class="europa-promo__container">

        <div class="europa-section-header">
            <span class="europa-section-tag">Ofertas Especiales</span>
            <h2 class="europa-section-title">Promociones del Mes</h2>
            <p class="europa-section-desc">
                Los mejores precios en aseo, ropa, herramientas y abarrotes. ¡Solo en Almacén Europa!
            </p>
        </div>

        {{-- Filtros de categoría --}}
        <div class="europa-filters" id="promo-filters">
            <button class="europa-filter active" data-filter="todos">Todos</button>
            <button class="europa-filter" data-filter="aseo">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M12 2a7 7 0 0 1 7 7c0 5-7 13-7 13S5 14 5 9a7 7 0 0 1 7-7z"/></svg>
                Aseo
            </button>
            <button class="europa-filter" data-filter="ropa">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M20.38 3.46L16 2l-4 4-4-4-4.38 1.46a1 1 0 0 0-.62.95v15.18a1 1 0 0 0 1.04 1l14-.87a1 1 0 0 0 .96-1V4.41a1 1 0 0 0-.62-.95z"/></svg>
                Ropa
            </button>
            <button class="europa-filter" data-filter="herramientas">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                Herramientas
            </button>
            <button class="europa-filter" data-filter="abarrotes">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                Abarrotes
            </button>
        </div>

        {{-- Grid de productos --}}
        <div class="europa-products" id="products-grid">

            {{-- Producto 1 --}}
            <div class="europa-product-card" data-category="aseo">
                <div class="europa-product-card__img-wrap">
                    <img src="https://images.unsplash.com/photo-1583947581924-860bda6a26df?w=400&h=300&fit=crop&auto=format" alt="Detergente en Polvo 1kg" loading="lazy">
                    <span class="europa-badge-tag europa-badge-tag--red">-20%</span>
                </div>
                <div class="europa-product-card__body">
                    <span class="product-category">Aseo del Hogar</span>
                    <h3 class="product-name">Detergente en Polvo 1kg</h3>
                    <div class="product-pricing">
                        <span class="price-old">$8.500</span>
                        <span class="price-new">$6.800</span>
                        <button class="btn-cart" aria-label="Agregar al carrito">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Producto 2 --}}
            <div class="europa-product-card" data-category="aseo">
                <div class="europa-product-card__img-wrap">
                    <img src="https://images.unsplash.com/photo-1556909172-54557c7e4fb7?w=400&h=300&fit=crop&auto=format" alt="Jabón de Baño x3 und" loading="lazy">
                    <span class="europa-badge-tag europa-badge-tag--green">NUEVO</span>
                </div>
                <div class="europa-product-card__body">
                    <span class="product-category">Aseo Personal</span>
                    <h3 class="product-name">Jabón de Baño x3 und</h3>
                    <div class="product-pricing">
                        <span class="price-new">$4.200</span>
                        <button class="btn-cart" aria-label="Agregar al carrito">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Producto 3 --}}
            <div class="europa-product-card" data-category="aseo">
                <div class="europa-product-card__img-wrap">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop&auto=format" alt="Escoba + Recogedor" loading="lazy">
                    <span class="europa-badge-tag europa-badge-tag--yellow">OFERTA</span>
                </div>
                <div class="europa-product-card__body">
                    <span class="product-category">Aseo del Hogar</span>
                    <h3 class="product-name">Escoba + Recogedor</h3>
                    <div class="product-pricing">
                        <span class="price-old">$18.000</span>
                        <span class="price-new">$14.500</span>
                        <button class="btn-cart" aria-label="Agregar al carrito">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Producto 4 --}}
            <div class="europa-product-card" data-category="ropa">
                <div class="europa-product-card__img-wrap">
                    <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400&h=300&fit=crop&auto=format" alt="Camiseta Algodón Unisex" loading="lazy">
                    <span class="europa-badge-tag europa-badge-tag--red">-30%</span>
                </div>
                <div class="europa-product-card__body">
                    <span class="product-category">Ropa</span>
                    <h3 class="product-name">Camiseta Algodón Unisex</h3>
                    <div class="product-pricing">
                        <span class="price-old">$25.000</span>
                        <span class="price-new">$17.500</span>
                        <button class="btn-cart" aria-label="Agregar al carrito">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Producto 5 --}}
            <div class="europa-product-card" data-category="herramientas">
                <div class="europa-product-card__img-wrap">
                    <img src="https://images.unsplash.com/photo-1504148455328-c376907d081c?w=400&h=300&fit=crop&auto=format" alt="Juego de Llaves 12 pzs" loading="lazy">
                    <span class="europa-badge-tag europa-badge-tag--yellow">OFERTA</span>
                </div>
                <div class="europa-product-card__body">
                    <span class="product-category">Herramientas</span>
                    <h3 class="product-name">Juego de Llaves 12 pzs</h3>
                    <div class="product-pricing">
                        <span class="price-old">$35.000</span>
                        <span class="price-new">$27.000</span>
                        <button class="btn-cart" aria-label="Agregar al carrito">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Producto 6 --}}
            <div class="europa-product-card" data-category="abarrotes">
                <div class="europa-product-card__img-wrap">
                    <img src="https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400&h=300&fit=crop&auto=format" alt="Aceite Girasol 1L" loading="lazy">
                    <span class="europa-badge-tag europa-badge-tag--green">NUEVO</span>
                </div>
                <div class="europa-product-card__body">
                    <span class="product-category">Abarrotes</span>
                    <h3 class="product-name">Aceite Girasol 1L</h3>
                    <div class="product-pricing">
                        <span class="price-new">$12.000</span>
                        <button class="btn-cart" aria-label="Agregar al carrito">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Producto 7 --}}
            <div class="europa-product-card" data-category="ropa">
                <div class="europa-product-card__img-wrap">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=300&fit=crop&auto=format" alt="Tenis Deportivos" loading="lazy">
                    <span class="europa-badge-tag europa-badge-tag--red">-15%</span>
                </div>
                <div class="europa-product-card__body">
                    <span class="product-category">Ropa</span>
                    <h3 class="product-name">Tenis Deportivos</h3>
                    <div class="product-pricing">
                        <span class="price-old">$85.000</span>
                        <span class="price-new">$72.000</span>
                        <button class="btn-cart" aria-label="Agregar al carrito">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Producto 8 --}}
            <div class="europa-product-card" data-category="abarrotes">
                <div class="europa-product-card__img-wrap">
                    <img src="https://images.unsplash.com/photo-1550583724-b2692b85b150?w=400&h=300&fit=crop&auto=format" alt="Arroz Premium 5kg" loading="lazy">
                    <span class="europa-badge-tag europa-badge-tag--yellow">OFERTA</span>
                </div>
                <div class="europa-product-card__body">
                    <span class="product-category">Abarrotes</span>
                    <h3 class="product-name">Arroz Premium 5kg</h3>
                    <div class="product-pricing">
                        <span class="price-old">$22.000</span>
                        <span class="price-new">$18.500</span>
                        <button class="btn-cart" aria-label="Agregar al carrito">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>{{-- /products-grid --}}
    </div>
</section>


{{-- ══════════════════════════════════════════
     CÓMO FUNCIONA
══════════════════════════════════════════ --}}
<section class="europa-how" id="caracteristicas">
    <div class="europa-how__container">

        {{-- Pasos izquierda --}}
        <div class="europa-how__steps">
            <div class="europa-section-header europa-section-header--left">
                <span class="europa-section-tag">Cómo Funciona</span>
                <h2 class="europa-section-title">Simple y Rápido</h2>
                <p class="europa-section-desc">
                    Solo 3 pasos para gestionar tu almacén de forma inteligente.
                </p>
            </div>

            <div class="europa-steps">
                <div class="europa-step">
                    <div class="europa-step__num">1</div>
                    <div class="europa-step__content">
                        <h4>Elige tus Productos</h4>
                        <p>Agrega productos a tu carrito. Ajusta cantidades y visualiza el total actualizado en tiempo real.</p>
                    </div>
                </div>
                <div class="europa-step">
                    <div class="europa-step__num" style="background: linear-gradient(135deg,var(--clr-blue),var(--clr-blue-dark))">2</div>
                    <div class="europa-step__content">
                        <h4>Revisa tu Pedido</h4>
                        <p>Verifica el resumen de tu carrito con precios, cantidades y el total final antes de confirmar.</p>
                    </div>
                </div>
                <div class="europa-step">
                    <div class="europa-step__num" style="background: linear-gradient(135deg,#22c55e,#16a34a)">3</div>
                    <div class="europa-step__content">
                        <h4>Confirma y Recibe tu Factura</h4>
                        <p>Confirma tu pedido y recibe al instante tu factura POS digital lista para imprimir.</p>
                    </div>
                </div>
            </div>

            <a href="{{ url('/carrito') }}" class="europa-btn europa-btn--dark">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                Ir a la Tienda →
            </a>
        </div>

        {{-- Preview carrito --}}
        <div class="europa-cart-preview">
            <div class="cart-preview__card">
                <div class="cart-preview__header">
                    <span>Tu Carrito</span>
                    <span class="cart-preview__count">3 productos</span>
                </div>
                <div class="cart-preview__items">
                    <div class="cart-item">
                        <div class="cart-item__icon" style="background:#fef3c7">🧼</div>
                        <div class="cart-item__info">
                            <span class="cart-item__name">Jabón Rey x3</span>
                            <span class="cart-item__price">$5.200</span>
                        </div>
                        <span class="cart-item__qty">x 2</span>
                    </div>
                    <div class="cart-item">
                        <div class="cart-item__icon" style="background:#dbeafe">🛁</div>
                        <div class="cart-item__info">
                            <span class="cart-item__name">Detergente Ariel 1kg</span>
                            <span class="cart-item__price">$10.000</span>
                        </div>
                        <span class="cart-item__qty">x 1</span>
                    </div>
                    <div class="cart-item">
                        <div class="cart-item__icon" style="background:#fce7f3">🫒</div>
                        <div class="cart-item__info">
                            <span class="cart-item__name">Aceite Girasol 1L</span>
                            <span class="cart-item__price">$12.000</span>
                        </div>
                        <span class="cart-item__qty">x 1</span>
                    </div>
                </div>
                <div class="cart-preview__total">
                    <span>Total</span>
                    <span class="cart-total-price">$27.200</span>
                </div>
                <a href="{{ url('/carrito') }}" class="europa-btn europa-btn--primary europa-btn--full">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                    Confirmar Pedido
                </a>
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    // ── Filtro de categorías ──
    const filterBtns = document.querySelectorAll('.europa-filter');
    const products   = document.querySelectorAll('.europa-product-card');

    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const filter = this.dataset.filter;

            filterBtns.forEach(function (b) { b.classList.remove('active'); });
            this.classList.add('active');

            products.forEach(function (card) {
                if (filter === 'todos' || card.dataset.category === filter) {
                    card.style.display = '';
                    card.style.animation = 'none';
                    // Forzar reflow para reiniciar la animación
                    void card.offsetWidth;
                    card.style.animation = 'fadeInUp 0.35s ease forwards';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // ── Animación botón carrito ──
    document.querySelectorAll('.btn-cart').forEach(function (btn) {
        btn.addEventListener('click', function () {
            this.style.transform = 'scale(0.82)';
            var self = this;
            setTimeout(function () { self.style.transform = ''; }, 180);
        });
    });
})();
</script>
@endpush
