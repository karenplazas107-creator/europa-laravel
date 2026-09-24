@extends('layouts.dashboard')

@section('title', 'Gestión de Usuarios y Roles')
@section('page-title', 'Gestión de Usuarios')

@section('content')

<div class="usr-page">

    {{-- ── Encabezado ── --}}
    <div class="usr-header">
        <div>
            <h2 class="usr-header__title">Gestión de Usuarios y Roles</h2>
            <p class="usr-header__sub">Crea y administra usuarios del sistema, credenciales y asigna roles como <strong>Vendedor</strong> o <strong>Auxiliar de Bodega</strong>.</p>
        </div>
        <a href="{{ route('usuarios.create') }}" class="usr-btn-new">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            <span>Nuevo Usuario</span>
        </a>
    </div>

    {{-- ── Alertas / Toasts ── --}}
    @if (session('success'))
        <div class="usr-toast usr-toast--success">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="usr-toast usr-toast--error">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- ── Tarjetas de Estadísticas ── --}}
    <div class="usr-stats">
        <a href="{{ route('usuarios.index') }}" class="usr-stat-card {{ $rolFiltro === '' ? 'is-active' : '' }}">
            <div class="usr-stat-icon usr-stat-icon--blue">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div>
                <div class="usr-stat-value">{{ $totalUsuarios }}</div>
                <div class="usr-stat-label">Total Usuarios</div>
            </div>
        </a>

        <a href="{{ route('usuarios.index', ['rol' => 'administrador']) }}" class="usr-stat-card {{ in_array($rolFiltro, ['admin', 'administrador']) ? 'is-active' : '' }}">
            <div class="usr-stat-icon usr-stat-icon--indigo">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
            </div>
            <div>
                <div class="usr-stat-value">{{ $totalAdmins }}</div>
                <div class="usr-stat-label">Administradores</div>
            </div>
        </a>

        <a href="{{ route('usuarios.index', ['rol' => 'vendedor']) }}" class="usr-stat-card {{ $rolFiltro === 'vendedor' ? 'is-active' : '' }}">
            <div class="usr-stat-icon usr-stat-icon--green">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                </svg>
            </div>
            <div>
                <div class="usr-stat-value">{{ $totalVendedores }}</div>
                <div class="usr-stat-label">Vendedores</div>
            </div>
        </a>

        <a href="{{ route('usuarios.index', ['rol' => 'auxiliar_bodega']) }}" class="usr-stat-card {{ in_array($rolFiltro, ['auxiliar_bodega', 'bodega']) ? 'is-active' : '' }}">
            <div class="usr-stat-icon usr-stat-icon--amber">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/>
                    <line x1="10" y1="12" x2="14" y2="12"/>
                </svg>
            </div>
            <div>
                <div class="usr-stat-value">{{ $totalBodega }}</div>
                <div class="usr-stat-label">Aux. Bodega</div>
            </div>
        </a>

        <a href="{{ route('usuarios.index', ['rol' => 'cliente']) }}" class="usr-stat-card {{ $rolFiltro === 'cliente' ? 'is-active' : '' }}">
            <div class="usr-stat-icon usr-stat-icon--slate">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <div>
                <div class="usr-stat-value">{{ $totalClientes }}</div>
                <div class="usr-stat-label">Clientes</div>
            </div>
        </a>
    </div>

    {{-- ── Barra de Filtros y Búsqueda ── --}}
    <div class="usr-toolbar">
        <form method="GET" action="{{ route('usuarios.index') }}" class="usr-search-form">
            <div class="usr-search-box">
                <svg class="usr-search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text"
                    name="search"
                    class="usr-search-input"
                    placeholder="Buscar por nombre, apellido, correo o teléfono..."
                    value="{{ $search }}"
                >
                @if($search)
                    <a href="{{ route('usuarios.index', ['rol' => $rolFiltro]) }}" class="usr-search-clear" title="Limpiar búsqueda">
                        &times;
                    </a>
                @endif
            </div>

            <div class="usr-filter-group">
                <label for="filter-rol" class="usr-filter-label">Rol:</label>
                <select name="rol" id="filter-rol" class="usr-select-filter" onchange="this.form.submit()">
                    <option value="">Todos los roles</option>
                    <option value="administrador" {{ in_array($rolFiltro, ['admin', 'administrador']) ? 'selected' : '' }}>Administrador</option>
                    <option value="vendedor" {{ $rolFiltro === 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                    <option value="auxiliar_bodega" {{ in_array($rolFiltro, ['auxiliar_bodega', 'bodega']) ? 'selected' : '' }}>Auxiliar de Bodega</option>
                    <option value="cliente" {{ $rolFiltro === 'cliente' ? 'selected' : '' }}>Cliente</option>
                </select>
            </div>
        </form>
    </div>

    {{-- ── Tabla de Usuarios ── --}}
    <div class="usr-table-card">
        @if($usuarios->count() > 0)
            <div class="usr-table-wrap">
                <table class="usr-table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Móvil / Contacto</th>
                            <th>Rol Asignado</th>
                            <th>Permisos del Rol</th>
                            <th>Fecha Registro</th>
                            <th style="text-align: right;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $u)
                            @php
                                $isMe = (int) $u->usuario === (int) Auth::user()->usuario;
                                $rolNorm = $u->rol_normalizado;
                            @endphp
                            <tr>
                                <td>
                                    <div class="usr-user-cell">
                                        <div class="usr-avatar usr-avatar--{{ in_array($rolNorm, ['admin', 'administrador']) ? 'admin' : ($rolNorm === 'vendedor' ? 'vendedor' : ($rolNorm === 'auxiliar_bodega' ? 'bodega' : 'cliente')) }}">
                                            {{ strtoupper(substr($u->nombre, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="usr-user-name">
                                                {{ $u->nombre }} {{ $u->apellido }}
                                                @if($isMe)
                                                    <span class="usr-badge-you">Tú</span>
                                                @endif
                                            </div>
                                            <div class="usr-user-email">
                                                {{ $u->email ?: 'Sin correo registrado' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="usr-cell-movil">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                                            <line x1="12" y1="18" x2="12.01" y2="18"/>
                                        </svg>
                                        <span>{{ $u->movil }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if(in_array($rolNorm, ['admin', 'administrador']))
                                        <span class="usr-role-pill usr-role-pill--admin">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                            Administrador
                                        </span>
                                    @elseif($rolNorm === 'vendedor')
                                        <span class="usr-role-pill usr-role-pill--vendedor">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                                            Vendedor
                                        </span>
                                    @elseif(in_array($rolNorm, ['auxiliar_bodega', 'bodega', 'auxiliar de bodega']))
                                        <span class="usr-role-pill usr-role-pill--bodega">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/></svg>
                                            Auxiliar de Bodega
                                        </span>
                                    @else
                                        <span class="usr-role-pill usr-role-pill--cliente">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                            Cliente
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="usr-perm-desc">
                                        @if(in_array($rolNorm, ['admin', 'administrador']))
                                            Control total del sistema
                                        @elseif($rolNorm === 'vendedor')
                                            Ventas, Facturación y Clientes
                                        @elseif(in_array($rolNorm, ['auxiliar_bodega', 'bodega', 'auxiliar de bodega']))
                                            Inventario, Stock y Productos
                                        @else
                                            Catálogo y Tienda Online
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span class="usr-date">
                                        {{ $u->created_at ? $u->created_at->format('d/m/Y') : '—' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="usr-actions">
                                        <a href="{{ route('usuarios.edit', $u->usuario) }}" class="usr-action-btn usr-action-btn--edit" title="Editar Usuario y Rol">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                            </svg>
                                            <span>Editar</span>
                                        </a>

                                        @if(!$isMe)
                                            <form method="POST" action="{{ route('usuarios.destroy', $u->usuario) }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar permanentemente al usuario {{ $u->nombre }} {{ $u->apellido }}?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="usr-action-btn usr-action-btn--delete" title="Eliminar Usuario">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6"/>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                    </svg>
                                                    <span>Eliminar</span>
                                                </button>
                                            </form>
                                        @else
                                            <span class="usr-locked-btn" title="No puedes eliminar tu propia cuenta en sesión">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="usr-table-footer">
                <div class="usr-footer-count">
                    Mostrando {{ $usuarios->count() }} de {{ $usuarios->total() }} usuarios
                </div>
                @if($usuarios->hasPages())
                    <div class="usr-pagination">
                        {{ $usuarios->links() }}
                    </div>
                @endif
            </div>

        @else
            <div class="usr-empty">
                <div class="usr-empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><line x1="8" y1="12" x2="16" y2="12"/>
                    </svg>
                </div>
                <h3 class="usr-empty-title">No se encontraron usuarios</h3>
                <p class="usr-empty-desc">
                    @if($search || $rolFiltro)
                        No hay usuarios que coincidan con los filtros aplicados.
                    @else
                        Aún no se han registrado usuarios en el sistema.
                    @endif
                </p>
                @if($search || $rolFiltro)
                    <a href="{{ route('usuarios.index') }}" class="usr-btn-clear">Limpiar filtros</a>
                @endif
            </div>
        @endif
    </div>

</div>

@endsection

@push('styles')
<style>
/* ── Estilos de Gestión de Usuarios ── */
.usr-page {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

/* Encabezado */
.usr-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
}
.usr-header__title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.6rem;
    font-weight: 800;
    color: #090d16;
    letter-spacing: -.025em;
    margin-bottom: 4px;
}
.usr-header__sub {
    font-size: .88rem;
    color: #64748b;
    max-width: 600px;
    line-height: 1.45;
}
.usr-header__sub strong {
    color: #1e293b;
}

/* Botón Nuevo Usuario */
.usr-btn-new {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    background: #0f172a;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-family: 'Outfit', sans-serif;
    font-size: .9rem;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(15, 23, 42, 0.28);
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
}
.usr-btn-new:hover {
    background: #1e293b;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(15, 23, 42, 0.35);
    color: #fff;
}

/* Toasts */
.usr-toast {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    border-radius: 12px;
    font-size: .88rem;
    font-weight: 600;
    animation: usrSlideDown .3s ease;
}
.usr-toast--success {
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}
.usr-toast--error {
    background: #fef2f2;
    color: #991b1b;
    border: 1px solid #fecaca;
}
@keyframes usrSlideDown {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Estadísticas Cards */
.usr-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 14px;
}
.usr-stat-card {
    display: flex;
    align-items: center;
    gap: 14px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 16px 18px;
    text-decoration: none;
    transition: all .2s ease;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
}
.usr-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.06);
    border-color: #cbd5e1;
}
.usr-stat-card.is-active {
    border-color: #0f172a;
    background: #f8fafc;
    box-shadow: 0 0 0 2px #0f172a;
}
.usr-stat-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.usr-stat-icon--blue { background: #eff6ff; color: #2563eb; }
.usr-stat-icon--indigo { background: #eef2ff; color: #4f46e5; }
.usr-stat-icon--green { background: #ecfdf5; color: #059669; }
.usr-stat-icon--amber { background: #fffbeb; color: #d97706; }
.usr-stat-icon--slate { background: #f1f5f9; color: #475569; }

.usr-stat-value {
    font-family: 'Outfit', sans-serif;
    font-size: 1.45rem;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.1;
}
.usr-stat-label {
    font-size: .78rem;
    color: #64748b;
    font-weight: 600;
    margin-top: 2px;
}

/* Toolbar */
.usr-toolbar {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 14px 18px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
}
.usr-search-form {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 14px;
}
.usr-search-box {
    position: relative;
    flex: 1;
    min-width: 260px;
}
.usr-search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    pointer-events: none;
}
.usr-search-input {
    width: 100%;
    padding: 10px 38px 10px 38px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    font-size: .88rem;
    color: #0f172a;
    background: #f8fafc;
    transition: all .2s;
}
.usr-search-input:focus {
    outline: none;
    border-color: #0f172a;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(15,23,42,0.08);
}
.usr-search-clear {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.2rem;
    color: #94a3b8;
    text-decoration: none;
    line-height: 1;
}
.usr-filter-group {
    display: flex;
    align-items: center;
    gap: 8px;
}
.usr-filter-label {
    font-size: .82rem;
    font-weight: 600;
    color: #475569;
}
.usr-select-filter {
    padding: 9px 14px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    font-size: .85rem;
    color: #0f172a;
    background: #f8fafc;
    cursor: pointer;
}
.usr-select-filter:focus {
    outline: none;
    border-color: #0f172a;
    background: #fff;
}

/* Tabla */
.usr-table-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
}
.usr-table-wrap {
    overflow-x: auto;
}
.usr-table {
    width: 100%;
    border-collapse: collapse;
    font-size: .88rem;
    text-align: left;
}
.usr-table th {
    padding: 14px 18px;
    background: #f8fafc;
    color: #475569;
    font-size: .78rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
    border-bottom: 1px solid #e2e8f0;
}
.usr-table td {
    padding: 16px 18px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}
.usr-table tbody tr:hover {
    background: #f8fafc;
}

/* Celdas especiales */
.usr-user-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}
.usr-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: .95rem;
    flex-shrink: 0;
}
.usr-avatar--admin   { background: #eef2ff; color: #4338ca; }
.usr-avatar--vendedor{ background: #ecfdf5; color: #047857; }
.usr-avatar--bodega  { background: #fffbeb; color: #b45309; }
.usr-avatar--cliente { background: #f1f5f9; color: #475569; }

.usr-user-name {
    font-weight: 700;
    color: #090d16;
    display: flex;
    align-items: center;
    gap: 6px;
}
.usr-badge-you {
    display: inline-block;
    padding: 2px 7px;
    background: #0f172a;
    color: #fff;
    font-size: .68rem;
    font-weight: 700;
    border-radius: 6px;
}
.usr-user-email {
    font-size: .78rem;
    color: #64748b;
    margin-top: 2px;
}
.usr-cell-movil {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #334155;
    font-weight: 600;
    font-size: .85rem;
}
.usr-cell-movil svg {
    color: #94a3b8;
}

/* Badges de Roles */
.usr-role-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .01em;
}
.usr-role-pill--admin {
    background: #eef2ff;
    color: #4338ca;
    border: 1px solid #c7d2fe;
}
.usr-role-pill--vendedor {
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}
.usr-role-pill--bodega {
    background: #fffbeb;
    color: #92400e;
    border: 1px solid #fde68a;
}
.usr-role-pill--cliente {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #cbd5e1;
}

.usr-perm-desc {
    font-size: .8rem;
    color: #64748b;
}
.usr-date {
    font-size: .82rem;
    color: #64748b;
}

/* Botones de acción */
.usr-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
}
.usr-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: .78rem;
    font-weight: 700;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all .15s ease;
}
.usr-action-btn--edit {
    background: #f8fafc;
    color: #334155;
    border: 1px solid #e2e8f0;
}
.usr-action-btn--edit:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: #0f172a;
}
.usr-action-btn--delete {
    background: #fff;
    color: #dc2626;
    border: 1px solid #fee2e2;
}
.usr-action-btn--delete:hover {
    background: #fef2f2;
    border-color: #fca5a5;
    color: #b91c1c;
}
.usr-locked-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 10px;
    color: #cbd5e1;
    cursor: not-allowed;
}

/* Footer / Paginación */
.usr-table-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    border-top: 1px solid #f1f5f9;
    background: #fff;
    flex-wrap: wrap;
    gap: 12px;
}
.usr-footer-count {
    font-size: .82rem;
    color: #64748b;
    font-weight: 500;
}

/* Estado Vacío */
.usr-empty {
    padding: 50px 20px;
    text-align: center;
}
.usr-empty-icon {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #f1f5f9;
    color: #94a3b8;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
}
.usr-empty-title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.15rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 6px;
}
.usr-empty-desc {
    font-size: .85rem;
    color: #64748b;
    margin-bottom: 16px;
}
.usr-btn-clear {
    display: inline-block;
    padding: 8px 16px;
    background: #0f172a;
    color: #fff;
    border-radius: 8px;
    font-size: .82rem;
    font-weight: 600;
    text-decoration: none;
}
</style>
@endpush
