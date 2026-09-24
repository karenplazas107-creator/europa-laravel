@extends('layouts.dashboard')

@section('title', 'Catálogo de Productos')
@section('page-title', 'Catálogo de Productos')

@section('content')

<div class="cat-page">

    {{-- ── Encabezado ── --}}
    <div class="cat-header">
        <div>
            <h2 class="cat-header__title">Catálogo de Productos</h2>
            <p class="cat-header__sub">
                Gestiona productos, imágenes, precios y códigos de barras.
            </p>
        </div>
        <a href="{{ route('productos.create') }}" class="cat-btn-new">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nuevo Producto
        </a>
    </div>

    {{-- ── Toast ── --}}
    @if (session('success'))
        <div class="cat-toast" id="cat-toast">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ── Stats ── --}}
    <div class="cat-stats">
        <div class="cat-stat-card">
            <div class="cat-stat-icon" style="background:#eff6ff;color:#2563eb">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                </svg>
            </div>
            <div>
                <div class="cat-stat-value">{{ $totalProductos }}</div>
                <div class="cat-stat-label">Productos</div>
            </div>
        </div>

        <div class="cat-stat-card">
            <div class="cat-stat-icon" style="background:#f5f3ff;color:#8b5cf6">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                    <line x1="7" y1="7" x2="7.01" y2="7"/>
                </svg>
            </div>
            <div>
                <div class="cat-stat-value">{{ $totalCategorias }}</div>
                <div class="cat-stat-label">Categorías</div>
            </div>
        </div>

        <div class="cat-stat-card">
            <div class="cat-stat-icon" style="background:#fffbeb;color:#d97706">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
            <div>
                <div class="cat-stat-value">{{ $stockBajo }}</div>
                <div class="cat-stat-label">Stock Bajo</div>
            </div>
        </div>

        <div class="cat-stat-card">
            <div class="cat-stat-icon" style="background:#fff1f2;color:#be123c">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                </svg>
            </div>
            <div>
                <div class="cat-stat-value">{{ $sinStock }}</div>
                <div class="cat-stat-label">Sin Stock</div>
            </div>
        </div>
    </div>

    {{-- ── Buscador + toggle vista ── --}}
    <div class="cat-toolbar">
        <form method="GET" action="{{ route('catalogo.index') }}" id="cat-form" class="cat-search-wrap">
            <input type="hidden" name="vista"      value="{{ $vista }}">
            <input type="hidden" name="categoria"  value="{{ $categoriaId }}" id="hidden-cat">

            <div class="cat-search">
                <svg class="cat-search__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text" name="search"
                    id="cat-search-input"
                    class="cat-search__input"
                    placeholder="Buscar por nombre, categoría o código de barras..."
                    value="{{ $search }}"
                    autocomplete="off"
                >
                @if($search)
                    <a href="{{ route('catalogo.index', ['vista'=>$vista,'categoria'=>$categoriaId]) }}" class="cat-search__clear">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </a>
                @endif
            </div>
        </form>

        {{-- Toggle grid/lista --}}
        <div class="cat-view-toggle">
            <a href="{{ route('catalogo.index', ['search'=>$search,'categoria'=>$categoriaId,'vista'=>'grid']) }}"
               class="cat-view-btn {{ $vista === 'grid' ? 'active' : '' }}" title="Vista cuadrícula">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
            </a>
            <a href="{{ route('catalogo.index', ['search'=>$search,'categoria'=>$categoriaId,'vista'=>'lista']) }}"
               class="cat-view-btn {{ $vista === 'lista' ? 'active' : '' }}" title="Vista lista">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/>
                    <line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/>
                    <line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- ── Filtros de categoría ── --}}
    <div class="cat-filters">
        <a href="{{ route('catalogo.index', ['search'=>$search,'vista'=>$vista]) }}"
           class="cat-filter-btn {{ $categoriaId === '' ? 'active' : '' }}">
            Todos
        </a>
        @foreach ($categorias as $cat)
            <a href="{{ route('catalogo.index', ['search'=>$search,'vista'=>$vista,'categoria'=>$cat->categoria]) }}"
               class="cat-filter-btn {{ (string)$categoriaId === (string)$cat->categoria ? 'active' : '' }}">
                {{ $cat->nombre }}
            </a>
        @endforeach
    </div>

    {{-- ── Contenido: Grid o Lista ── --}}
    @if ($productos->isEmpty())
        <div class="cat-empty">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
            </svg>
            <p>No se encontraron productos
                @if($search)
                    con "<strong>{{ $search }}</strong>"
                @endif
            </p>
        </div>

    @elseif ($vista === 'lista')
        {{-- ════ VISTA LISTA ════ --}}
        <div class="cat-table-card">
            <table class="cat-table">
                <thead>
                    <tr>
                        <th>PRODUCTO</th>
                        <th>CATEGORÍA</th>
                        <th>PRECIO VENTA</th>
                        <th>STOCK</th>
                        <th>CÓDIGO</th>
                        <th>ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $p)
                        <tr>
                            <td>
                                <div class="cat-list-producto">
                                    @if ($p->imagen)
                                        <img src="{{ asset('storage/' . $p->imagen) }}" alt="{{ $p->nombre }}" class="cat-list-img">
                                    @else
                                        <div class="cat-list-img-placeholder">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="cat-list-nombre">{{ $p->nombre }}</div>
                                        <div class="cat-list-desc">{{ Str::limit($p->descripcion, 55) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="cat-cat-badge">{{ $p->categoriaObj->nombre ?? '—' }}</span></td>
                            <td class="cat-precio">{{ $p->precio_formateado }}</td>
                            <td class="cat-stock-val" style="color:{{ $p->color_stock }}">{{ $p->stock }} uds</td>
                            <td class="cat-codigo-text">{{ $p->codigo_barras ?? '—' }}</td>
                            <td>
                                <span class="cat-estado-badge" style="background:{{ $p->color_stock }}20;color:{{ $p->color_stock }}">
                                    {{ $p->etiqueta_stock }}
                                </span>
                            </td>
                            <td class="cat-td-actions">
                                <a href="{{ route('productos.edit', $p->productos) }}"
                                   class="cat-act-btn cat-act-btn--edit" title="Editar">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>
                                <form method="POST"
                                      action="{{ route('productos.destroy', $p->productos) }}"
                                      style="display:inline"
                                      onsubmit="return confirm('¿Eliminar {{ addslashes($p->nombre) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cat-act-btn cat-act-btn--delete" title="Eliminar">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else
        {{-- ════ VISTA GRID ════ --}}
        <div class="cat-grid">
            @foreach ($productos as $p)
                <div class="cat-card">
                    {{-- Imagen --}}
                    <div class="cat-card__img-wrap">
                        @if ($p->imagen)
                            <img src="{{ asset('storage/' . $p->imagen) }}"
                                 alt="{{ $p->nombre }}"
                                 class="cat-card__img">
                        @else
                            <div class="cat-card__img-placeholder">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                                <span>Sin imagen</span>
                            </div>
                        @endif

                        {{-- Badges sobre imagen --}}
                        <span class="cat-card__cat-badge">{{ $p->categoriaObj->nombre ?? '—' }}</span>
                        <span class="cat-card__estado-badge" style="background:{{ $p->color_stock }}">
                            {{ $p->etiqueta_stock }}
                        </span>
                    </div>

                    {{-- Cuerpo --}}
                    <div class="cat-card__body">
                        <h3 class="cat-card__nombre">{{ $p->nombre }}</h3>
                        <p class="cat-card__desc">{{ Str::limit($p->descripcion, 80) }}</p>

                        {{-- Precio + stock --}}
                        <div class="cat-card__pricing">
                            <div>
                                <div class="cat-card__precio-label">Precio venta</div>
                                <div class="cat-card__precio">{{ $p->precio_formateado }}</div>
                            </div>
                            <div class="cat-card__stock-wrap">
                                <div class="cat-card__precio-label">Stock</div>
                                <div class="cat-card__stock" style="color:{{ $p->color_stock }}">
                                    {{ $p->stock }} uds
                                </div>
                            </div>
                        </div>

                        {{-- Código de barras --}}
                        @if ($p->codigo_barras)
                            <div class="cat-card__barcode-wrap">
                                <div class="cat-card__barcode-label">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                        <path d="M3 9v6M6 5v14M9 9v6M12 5v14M15 9v6M18 5v14M21 9v6"/>
                                    </svg>
                                    Código de barras
                                </div>
                                <div class="cat-barcode" id="barcode-{{ $p->productos }}">
                                </div>
                                <div class="cat-barcode-num">{{ $p->codigo_barras }}</div>
                            </div>
                        @endif

                        {{-- Acciones --}}
                        <div class="cat-card__actions">
                            <a href="{{ route('productos.edit', $p->productos) }}"
                               class="cat-card__btn cat-card__btn--edit" title="Editar">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Editar
                            </a>
                            <form method="POST"
                                  action="{{ route('productos.destroy', $p->productos) }}"
                                  style="display:inline"
                                  onsubmit="return confirm('¿Eliminar {{ addslashes($p->nombre) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cat-card__btn cat-card__btn--delete" title="Eliminar">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Footer conteo --}}
    <div class="cat-footer-count">
        Mostrando {{ $productos->count() }} de {{ $totalProductos }} productos
    </div>

</div>

@endsection

@push('styles')
<style>
/* ─────────────────────────────────────────
   CATÁLOGO
───────────────────────────────────────── */
.cat-page { display: flex; flex-direction: column; gap: 20px; }

/* Header */
.cat-header__title {
    font-family: 'Outfit', sans-serif; font-size: 1.3rem;
    font-weight: 900; color: #0d1b35; letter-spacing: -.02em; margin-bottom: 3px;
}
.cat-header__sub { font-size: .82rem; color: #64748b; }

/* Stats */
.cat-stats {
    display: grid; grid-template-columns: repeat(4,1fr); gap: 16px;
}
.cat-stat-card {
    background: #fff; border-radius: 14px; border: 1px solid #e2e8f0;
    box-shadow: var(--shadow-sm);
    padding: 18px 20px; display: flex; align-items: center; gap: 14px;
    transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
}
.cat-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
    border-color: rgba(37, 99, 235, 0.25);
}
.cat-stat-icon {
    width: 46px; height: 46px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.cat-stat-value {
    font-family: 'Outfit', sans-serif; font-size: 1.65rem;
    font-weight: 900; color: #0f172a; letter-spacing: -.03em; line-height: 1;
}
.cat-stat-label { font-size: .75rem; color: #64748b; margin-top: 3px; font-weight: 500; }

/* Toolbar */
.cat-toolbar { display: flex; align-items: center; gap: 12px; }
.cat-search-wrap { flex: 1; }
.cat-search-wrap form { width: 100%; }
.cat-search {
    display: flex; align-items: center; gap: 10px;
    background: #fff; border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: var(--shadow-xs);
    padding: 11px 16px;
    transition: border-color var(--transition), box-shadow var(--transition);
}
.cat-search:focus-within {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}
.cat-search__icon  { color: #94a3b8; flex-shrink: 0; }
.cat-search__input {
    flex: 1; border: none; outline: none;
    font-family: 'Inter', sans-serif; font-size: .9rem;
    color: #0f172a; background: transparent;
}
.cat-search__input::placeholder { color: #94a3b8; }
.cat-search__clear {
    color: #94a3b8; display: flex; align-items: center;
    padding: 3px; border-radius: 50%; transition: all .2s;
}
.cat-search__clear:hover { background: #f1f5f9; color: #475569; }

/* Toggle vista */
.cat-view-toggle {
    display: flex; gap: 4px;
    background: #fff; border: 1px solid #e2e8f0;
    border-radius: 10px; padding: 4px;
    box-shadow: var(--shadow-xs);
}
.cat-view-btn {
    width: 36px; height: 36px; border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    color: #94a3b8; transition: all var(--transition); text-decoration: none;
}
.cat-view-btn:hover { background: #f1f5f9; color: #475569; }
.cat-view-btn.active {
    background: #2563eb; color: #fff;
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.35);
}

/* Filtros categoría */
.cat-filters {
    display: flex; gap: 8px; flex-wrap: wrap; align-items: center;
    background: #fff; border-radius: 12px; border: 1px solid #e2e8f0;
    padding: 12px 16px; box-shadow: var(--shadow-xs);
}
.cat-filter-btn {
    display: inline-flex; align-items: center;
    padding: 7px 18px; border-radius: 999px;
    font-size: .82rem; font-weight: 600;
    color: #475569; background: #f1f5f9;
    border: 1.5px solid transparent;
    text-decoration: none; transition: all var(--transition);
    white-space: nowrap;
}
.cat-filter-btn:hover {
    border-color: rgba(37, 99, 235, 0.4);
    color: #2563eb;
    background: #eff6ff;
}
.cat-filter-btn.active {
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    color: #fff; border-color: transparent;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
}

/* ── Grid de cards ── */
.cat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 20px;
}

.cat-card {
    background: #fff; border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
    display: flex; flex-direction: column;
}
.cat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
    border-color: rgba(37, 99, 235, 0.25);
}

/* Imagen */
.cat-card__img-wrap {
    position: relative; overflow: hidden;
    aspect-ratio: 4/3; flex-shrink: 0;
}
.cat-card__img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform .5s ease;
}
.cat-card:hover .cat-card__img { transform: scale(1.05); }
.cat-card__img-placeholder {
    width: 100%; height: 100%;
    background: linear-gradient(135deg, #f1f5fd, #e8eef8);
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 8px; color: #94a3b8;
}
.cat-card__img-placeholder span { font-size: .72rem; font-weight: 500; }

/* Badges sobre imagen */
.cat-card__cat-badge {
    position: absolute; top: 10px; left: 10px;
    background: rgba(13,27,53,.75); color: #fff;
    font-size: .68rem; font-weight: 700;
    padding: 3px 9px; border-radius: 999px;
    backdrop-filter: blur(4px);
}
.cat-card__estado-badge {
    position: absolute; top: 10px; right: 10px;
    color: #fff; font-size: .68rem; font-weight: 700;
    padding: 3px 9px; border-radius: 999px;
}

/* Cuerpo */
.cat-card__body { padding: 14px 16px 18px; flex: 1; display: flex; flex-direction: column; gap: 8px; }
.cat-card__nombre {
    font-family: 'Outfit', sans-serif; font-size: .95rem;
    font-weight: 800; color: #0d1b35; line-height: 1.3;
    display: -webkit-box; -webkit-line-clamp: 2;
    -webkit-box-orient: vertical; overflow: hidden;
}
.cat-card__desc {
    font-size: .78rem; color: #64748b; line-height: 1.5;
    display: -webkit-box; -webkit-line-clamp: 3;
    -webkit-box-orient: vertical; overflow: hidden;
    flex: 1;
}

/* Precio + stock */
.cat-card__pricing {
    display: flex; justify-content: space-between; align-items: flex-end;
    padding-top: 6px; border-top: 1px solid #f1f5fd;
}
.cat-card__precio-label { font-size: .65rem; color: #94a3b8; margin-bottom: 2px; font-weight: 500; }
.cat-card__precio {
    font-family: 'Outfit', sans-serif; font-size: 1.05rem;
    font-weight: 900; color: #0d1b35; letter-spacing: -.02em;
}
.cat-card__stock-wrap { text-align: right; }
.cat-card__stock { font-family: 'Outfit', sans-serif; font-size: .95rem; font-weight: 800; }

/* Código de barras */
.cat-card__barcode-wrap {
    border-top: 1px solid #f1f5fd; padding-top: 10px; margin-top: 4px;
}
.cat-card__barcode-label {
    font-size: .65rem; color: #94a3b8; font-weight: 600;
    display: flex; align-items: center; gap: 4px; margin-bottom: 6px;
}
.cat-barcode svg { width: 100%; height: 40px; }
.cat-barcode-num { font-size: .7rem; color: #64748b; text-align: center; margin-top: 3px; letter-spacing: .06em; }

/* ── Vista lista ── */
.cat-table-card {
    background: #fff; border-radius: 14px; border: 1px solid #e2e8f0;
    box-shadow: 0 2px 8px rgba(13,27,53,.06); overflow: hidden;
}
.cat-table { width: 100%; border-collapse: collapse; }
.cat-table th {
    padding: 11px 16px; text-align: left; font-size: .68rem;
    font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
    color: #94a3b8; background: #f8faff; border-bottom: 1px solid #e2e8f0;
}
.cat-table td {
    padding: 13px 16px; font-size: .875rem;
    color: #0d1b35; border-bottom: 1px solid #f1f5fd; vertical-align: middle;
}
.cat-table tr:last-child td { border-bottom: none; }
.cat-table tbody tr:hover td { background: #f8faff; }

.cat-list-producto { display: flex; align-items: center; gap: 12px; }
.cat-list-img {
    width: 44px; height: 44px; border-radius: 8px;
    object-fit: cover; flex-shrink: 0;
}
.cat-list-img-placeholder {
    width: 44px; height: 44px; border-radius: 8px;
    background: #f1f5fd; display: flex; align-items: center;
    justify-content: center; flex-shrink: 0; color: #94a3b8;
}
.cat-list-nombre { font-weight: 700; color: #0d1b35; font-size: .875rem; }
.cat-list-desc    { font-size: .75rem; color: #64748b; margin-top: 2px; }

.cat-cat-badge {
    background: #ede9fe; color: #7c3aed;
    font-size: .7rem; font-weight: 700;
    padding: 3px 10px; border-radius: 999px;
    display: inline-block;
}
.cat-precio { font-family: 'Outfit', sans-serif; font-weight: 800; }
.cat-stock-val { font-family: 'Outfit', sans-serif; font-weight: 700; }
.cat-codigo-text { font-size: .78rem; color: #64748b; letter-spacing: .04em; }
.cat-estado-badge {
    display: inline-flex; align-items: center;
    padding: 3px 10px; border-radius: 999px;
    font-size: .7rem; font-weight: 700; white-space: nowrap;
}

/* Vacío */
.cat-empty {
    text-align: center; padding: 56px 20px; color: #94a3b8;
    background: #fff; border-radius: 14px; border: 1px solid #e2e8f0;
}
.cat-empty svg { margin: 0 auto 14px; opacity: .35; }
.cat-empty p { font-size: .9rem; }

/* Footer conteo */
.cat-footer-count {
    font-size: .78rem; color: #94a3b8; text-align: right; padding: 0 2px;
}

/* Header con botón */
.cat-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
.cat-btn-new {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 11px 20px;
    background: linear-gradient(135deg, #0d1b35, #1a2f5e);
    color: #fff; border-radius: 10px;
    font-family: 'Outfit', sans-serif; font-size: .875rem; font-weight: 700;
    white-space: nowrap; transition: all .2s;
    box-shadow: 0 4px 14px rgba(13,27,53,.25);
}
.cat-btn-new:hover { transform: translateY(-1px); box-shadow: 0 7px 20px rgba(13,27,53,.32); }

/* Toast */
.cat-toast {
    display: flex; align-items: center; gap: 9px;
    padding: 12px 18px; border-radius: 10px;
    background: #f0fdf4; border: 1px solid #bbf7d0;
    color: #16a34a; font-size: .875rem; font-weight: 500;
    animation: slideDown .35s ease;
}
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Acciones en card grid */
.cat-card__actions {
    display: flex; gap: 8px; margin-top: 10px;
    padding-top: 10px; border-top: 1px solid #f1f5fd;
}
.cat-card__btn {
    flex: 1; display: inline-flex; align-items: center; justify-content: center;
    gap: 5px; padding: 7px 10px; border-radius: 8px;
    font-family: 'Inter', sans-serif; font-size: .75rem; font-weight: 600;
    cursor: pointer; border: none; text-decoration: none; transition: all .2s;
}
.cat-card__btn--edit   { background: #fef9c3; color: #ca8a04; }
.cat-card__btn--edit:hover { background: #fef08a; }
.cat-card__btn--delete { background: #fee2e2; color: #dc2626; }
.cat-card__btn--delete:hover { background: #fecaca; }

/* Acciones en vista lista */
.cat-td-actions { display: flex; align-items: center; gap: 6px; justify-content: center; }
.cat-act-btn {
    width: 32px; height: 32px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    border: none; cursor: pointer; transition: all .2s; text-decoration: none;
}
.cat-act-btn--edit   { background: #fef9c3; color: #ca8a04; }
.cat-act-btn--edit:hover { background: #fef08a; transform: scale(1.08); }
.cat-act-btn--delete { background: #fee2e2; color: #dc2626; }
.cat-act-btn--delete:hover { background: #fecaca; transform: scale(1.08); }

@media (max-width: 1000px) { .cat-stats { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 600px)  { .cat-stats { grid-template-columns: 1fr 1fr; } .cat-grid { grid-template-columns: 1fr 1fr; } }
@media (max-width: 420px)  { .cat-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@push('scripts')
{{-- JsBarcode para generar códigos de barras SVG --}}
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
<script>
(function () {
    // Búsqueda con debounce
    var input = document.getElementById('cat-search-input');
    var form  = document.getElementById('cat-form');
    var timer;
    if (input) {
        input.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(function () { form.submit(); }, 500);
        });
    }

    // Auto-ocultar toast
    var toast = document.getElementById('cat-toast');
    if (toast) {
        setTimeout(function () {
            toast.style.transition = 'opacity .5s';
            toast.style.opacity = '0';
            setTimeout(function () { toast.remove(); }, 500);
        }, 3500);
    }

    // Generar códigos de barras SVG
    @foreach ($productos as $p)
        @if ($p->codigo_barras)
        (function () {
            var wrap = document.getElementById('barcode-{{ $p->productos }}');
            if (!wrap) return;
            var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            wrap.appendChild(svg);
            try {
                JsBarcode(svg, '{{ $p->codigo_barras }}', {
                    format:      'CODE128',
                    width:       1.4,
                    height:      38,
                    displayValue: false,
                    margin:      0,
                    background:  'transparent',
                    lineColor:   '#334155',
                });
            } catch(e) {}
        })();
        @endif
    @endforeach
})();
</script>
@endpush
