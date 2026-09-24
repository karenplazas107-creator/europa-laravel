@extends('layouts.dashboard')

@section('title', 'Proveedores')
@section('page-title', 'Proveedores')

@section('content')

<div class="pv-page">

    {{-- ── Encabezado ── --}}
    <div class="pv-header">
        <h2 class="pv-header__title">Proveedores</h2>
        <p class="pv-header__sub">Gestiona los proveedores del almacén.</p>
    </div>

    {{-- ── Toast ── --}}
    @if (session('success'))
        <div class="pv-toast" id="pv-toast">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ── Stats cards ── --}}
    <div class="pv-stats">
        <div class="pv-stat-card">
            <div class="pv-stat-icon pv-stat-icon--blue">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="3" width="15" height="13" rx="1"/>
                    <path d="M16 8h4l3 5v3h-7V8z"/>
                    <circle cx="5.5" cy="18.5" r="2.5"/>
                    <circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
            </div>
            <div>
                <div class="pv-stat-value">{{ $total }}</div>
                <div class="pv-stat-label">Proveedores registrados</div>
            </div>
        </div>

        <div class="pv-stat-card">
            <div class="pv-stat-icon pv-stat-icon--green">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
            </div>
            <div>
                <div class="pv-stat-value">{{ $conEmail }}</div>
                <div class="pv-stat-label">Con email registrado</div>
            </div>
        </div>

        <div class="pv-stat-card">
            <div class="pv-stat-icon pv-stat-icon--purple">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 9.07 19.79 19.79 0 0 1 1.58 0.42 2 2 0 0 1 3.55 0h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 7c1.37 2.37 3.54 4.54 5.91 5.91l.83-.81a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
            </div>
            <div>
                <div class="pv-stat-value">{{ $conTelefono }}</div>
                <div class="pv-stat-label">Con teléfono registrado</div>
            </div>
        </div>
    </div>

    {{-- ── Buscador + botón nuevo ── --}}
    <div class="pv-toolbar">
        <form method="GET" action="{{ route('proveedores.index') }}" id="pv-search-form" class="pv-search-wrap">
            <div class="pv-search">
                <svg class="pv-search__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text"
                    name="search"
                    id="pv-search-input"
                    class="pv-search__input"
                    placeholder="Buscar por nombre, email, teléfono o dirección..."
                    value="{{ $search }}"
                    autocomplete="off"
                >
                @if($search)
                    <a href="{{ route('proveedores.index') }}" class="pv-search__clear">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </a>
                @endif
            </div>
        </form>

        <a href="{{ route('proveedores.create') }}" class="pv-btn-new">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nuevo Proveedor
        </a>
    </div>

    {{-- ── Tabla ── --}}
    <div class="pv-table-card">
        <table class="pv-table">
            <thead>
                <tr>
                    <th>PROVEEDOR</th>
                    <th>TELÉFONO</th>
                    <th>EMAIL</th>
                    <th>DIRECCIÓN</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proveedores as $pv)
                    <tr>
                        {{-- Avatar + nombre + ID --}}
                        <td>
                            <div class="pv-proveedor-cell">
                                <div class="pv-avatar">{{ $pv->initiales }}</div>
                                <div>
                                    <div class="pv-nombre">{{ $pv->nombre }}</div>
                                    <div class="pv-id">ID {{ $pv->id_formateado }}</div>
                                </div>
                            </div>
                        </td>
                        {{-- Teléfono --}}
                        <td>
                            <div class="pv-tel-cell">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#1d74e8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 9.07 19.79 19.79 0 0 1 1.58.42 2 2 0 0 1 3.55 0h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 7c1.37 2.37 3.54 4.54 5.91 5.91l.83-.81a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                                {{ $pv->telefono }}
                            </div>
                        </td>
                        {{-- Email --}}
                        <td>
                            <div class="pv-email-cell">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                {{ $pv->email }}
                            </div>
                        </td>
                        {{-- Dirección --}}
                        <td>
                            <div class="pv-dir-cell">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#9333ea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                {{ $pv->direccion }}
                            </div>
                        </td>
                        {{-- Acciones --}}
                        <td class="pv-td-actions">
                            <a href="{{ route('proveedores.edit', $pv->proveedores) }}"
                               class="pv-btn-action pv-btn-action--edit" title="Editar">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                            </a>
                            <form method="POST"
                                  action="{{ route('proveedores.destroy', $pv->proveedores) }}"
                                  style="display:inline-flex"
                                  onsubmit="return confirmDelete('{{ addslashes($pv->nombre) }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="pv-btn-action pv-btn-action--delete"
                                        title="Eliminar">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                        <path d="M10 11v6M14 11v6"/>
                                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="pv-empty">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13" rx="1"/>
                                <path d="M16 8h4l3 5v3h-7V8z"/>
                                <circle cx="5.5" cy="18.5" r="2.5"/>
                                <circle cx="18.5" cy="18.5" r="2.5"/>
                            </svg>
                            <p>
                                No se encontraron proveedores
                                @if($search)
                                    con "<strong>{{ $search }}</strong>"
                                @endif
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pv-table-footer">
            {{ $proveedores->count() }} de {{ $total }} proveedores
        </div>
    </div>

</div>

@endsection

@push('styles')
<style>
.pv-page { display: flex; flex-direction: column; gap: 20px; }

.pv-header__title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.35rem; font-weight: 800;
    color: #090d16; letter-spacing: -.025em;
    margin-bottom: 3px;
}
.pv-header__sub { font-size: .84rem; color: #64748b; }

/* Toast */
.pv-toast {
    display: flex; align-items: center; gap: 9px;
    padding: 12px 18px; border-radius: 12px;
    background: #ecfdf5; border: 1px solid #a7f3d0;
    color: #065f46; font-size: .875rem; font-weight: 500;
    animation: slideDown .35s ease;
}
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Stats */
.pv-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}
.pv-stat-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(9, 13, 22, 0.04), 0 4px 12px rgba(9, 13, 22, 0.02);
    padding: 20px 22px;
    display: flex; align-items: center; gap: 16px;
    transition: all .25s ease;
}
.pv-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px -4px rgba(9, 13, 22, 0.08);
}
.pv-stat-icon {
    width: 48px; height: 48px;
    border-radius: 13px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    transition: transform .2s ease;
}
.pv-stat-card:hover .pv-stat-icon { transform: scale(1.06); }
.pv-stat-icon--blue   { background: #eff6ff; color: #2563eb; }
.pv-stat-icon--green  { background: #ecfdf5; color: #10b981; }
.pv-stat-icon--purple { background: #f5f3ff; color: #8b5cf6; }
.pv-stat-value {
    font-family: 'Outfit', sans-serif;
    font-size: 1.7rem; font-weight: 800;
    color: #090d16; letter-spacing: -.03em; line-height: 1;
}
.pv-stat-label { font-size: .78rem; color: #64748b; margin-top: 4px; font-weight: 500; }

/* Toolbar */
.pv-toolbar { display: flex; gap: 12px; align-items: center; }
.pv-search-wrap { flex: 1; }
.pv-search-wrap form { width: 100%; }
.pv-search {
    display: flex; align-items: center; gap: 10px;
    background: #fff; border-radius: 14px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(9, 13, 22, 0.04);
    padding: 10px 16px;
}
.pv-search__icon { color: #94a3b8; flex-shrink: 0; }
.pv-search__input {
    flex: 1; border: none; outline: none;
    font-family: 'Inter', sans-serif;
    font-size: .875rem; color: #090d16; background: transparent;
}
.pv-search__input::placeholder { color: #94a3b8; }
.pv-search__clear {
    color: #94a3b8; display: flex; align-items: center;
    padding: 3px; border-radius: 50%; transition: all .2s;
}
.pv-search__clear:hover { background: #f1f5f9; color: #475569; }

.pv-btn-new {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff; border-radius: 12px;
    font-family: 'Outfit', sans-serif;
    font-size: .88rem; font-weight: 700;
    white-space: nowrap;
    text-decoration: none;
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 14px rgba(37, 99, 235, .28);
}
.pv-btn-new:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(37, 99, 235, .4);
    color: #fff;
}

/* Tabla */
.pv-table-card {
    background: #fff; border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(9, 13, 22, 0.04), 0 4px 12px rgba(9, 13, 22, 0.02);
    overflow: hidden;
}
.pv-table { width: 100%; border-collapse: collapse; }
.pv-table th {
    padding: 14px 18px;
    text-align: left;
    font-size: .7rem; font-weight: 700;
    letter-spacing: .06em; text-transform: uppercase;
    color: #64748b; background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}
.pv-table td {
    padding: 14px 18px;
    font-size: .875rem; color: #090d16;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}
.pv-table tr:last-child td { border-bottom: none; }
.pv-table tbody tr:hover td { background: #f8fafc; }

/* Proveedor cell */
.pv-proveedor-cell { display: flex; align-items: center; gap: 12px; }
.pv-avatar {
    width: 40px; height: 40px;
    border-radius: 11px;
    background: linear-gradient(135deg, #2563eb, #06b6d4);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Outfit', sans-serif;
    font-size: .84rem; font-weight: 800; color: #fff;
    flex-shrink: 0; letter-spacing: -.02em;
    box-shadow: 0 3px 8px rgba(37, 99, 235, 0.2);
}
.pv-nombre { font-weight: 700; color: #090d16; font-size: .9rem; }
.pv-id     { font-size: .72rem; color: #94a3b8; margin-top: 2px; }

/* Celdas con iconos */
.pv-tel-cell,
.pv-email-cell,
.pv-dir-cell {
    display: flex; align-items: flex-start; gap: 7px;
    font-size: .84rem; color: #475569; line-height: 1.4;
}
.pv-tel-cell svg,
.pv-email-cell svg,
.pv-dir-cell svg { flex-shrink: 0; margin-top: 1px; }
.pv-email-cell { color: #2563eb; font-weight: 500; }

/* Acciones */
.pv-td-actions { display: flex; align-items: center; gap: 6px; justify-content: flex-end; }
.pv-btn-action {
    width: 32px; height: 32px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
    border: none; cursor: pointer; text-decoration: none;
}
.pv-btn-action--edit  { background: #fffbeb; color: #d97706; }
.pv-btn-action--edit:hover  { background: #fef3c7; transform: translateY(-1px); }
.pv-btn-action--delete { background: #fff1f2; color: #e11d48; }
.pv-btn-action--delete:hover { background: #ffe4e6; transform: translateY(-1px); }

/* Vacío */
.pv-empty { text-align: center; padding: 48px 20px !important; color: #94a3b8; }
.pv-empty svg { margin: 0 auto 12px; opacity: .4; }
.pv-empty p   { font-size: .9rem; }

/* Footer */
.pv-table-footer {
    padding: 12px 18px; font-size: .78rem; color: #64748b;
    border-top: 1px solid #f1f5f9; background: #f8fafc;
}

@media (max-width: 900px) { .pv-stats { grid-template-columns: 1fr 1fr; } }
@media (max-width: 600px) { .pv-stats { grid-template-columns: 1fr; } }
</style>
@endpush

@push('scripts')
<script>
(function () {
    var input = document.getElementById('pv-search-input');
    var form  = document.getElementById('pv-search-form');
    var timer;
    if (input) {
        input.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(function () { form.submit(); }, 500);
        });
    }
    var toast = document.getElementById('pv-toast');
    if (toast) {
        setTimeout(function () {
            toast.style.transition = 'opacity .5s';
            toast.style.opacity = '0';
            setTimeout(function () { toast.remove(); }, 500);
        }, 3500);
    }
})();

function confirmDelete(nombre) {
    return confirm('¿Eliminar al proveedor ' + nombre + '?\nEsta acción no se puede deshacer.');
}
</script>
@endpush
