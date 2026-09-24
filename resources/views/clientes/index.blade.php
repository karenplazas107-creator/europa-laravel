@extends('layouts.dashboard')

@section('title', 'Gestión de Clientes')
@section('page-title', 'Gestión de Clientes')

@section('content')

<div class="cl-page">

    {{-- ── Encabezado ── --}}
    <div class="cl-header">
        <div>
            <h2 class="cl-header__title">Directorio de Clientes</h2>
            <p class="cl-header__sub">Personas registradas como compradores en la plataforma.</p>
        </div>
        <div class="cl-header__meta">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            <span><strong>{{ $total }}</strong> clientes registrados</span>
        </div>
    </div>

    {{-- ── Toast de éxito ── --}}
    @if (session('success'))
        <div class="cl-toast cl-toast--success" id="cl-toast">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ── Buscador ── --}}
    <div class="cl-search-wrap">
        <form method="GET" action="{{ route('clientes.index') }}" id="search-form">
            <div class="cl-search">
                <svg class="cl-search__icon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text"
                    name="search"
                    id="search-input"
                    class="cl-search__input"
                    placeholder="Buscar por nombre, apellido, email o móvil..."
                    value="{{ $search }}"
                    autocomplete="off"
                >
                @if($search)
                    <a href="{{ route('clientes.index') }}" class="cl-search__clear" title="Limpiar búsqueda">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- ── Tabla ── --}}
    <div class="cl-table-card">
        <table class="cl-table">
            <thead>
                <tr>
                    <th>ROL</th>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>MÓVIL</th>
                    <th>EMAIL</th>
                    <th class="cl-th-actions">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
                        </svg>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                    <tr>
                        <td>
                            <span class="cl-badge cl-badge--green">Comprador</span>
                        </td>
                        <td class="cl-td-nombre">{{ $cliente->nombre }}</td>
                        <td class="cl-td-apellido">{{ $cliente->apellido }}</td>
                        <td class="cl-td-movil">{{ $cliente->movil }}</td>
                        <td class="cl-td-email">{{ $cliente->email ?? '—' }}</td>
                        <td class="cl-td-actions">
                            {{-- Editar --}}
                            <a href="{{ route('clientes.edit', $cliente->usuario) }}"
                               class="cl-btn-action cl-btn-action--edit"
                               title="Editar cliente">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                            </a>
                            {{-- Eliminar --}}
                            <form method="POST"
                                  action="{{ route('clientes.destroy', $cliente->usuario) }}"
                                  class="cl-form-delete"
                                  onsubmit="return confirmDelete('{{ addslashes($cliente->nombre) }} {{ addslashes($cliente->apellido) }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="cl-btn-action cl-btn-action--delete"
                                        title="Eliminar cliente">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                        <td colspan="6" class="cl-empty">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                            </svg>
                            <p>No se encontraron clientes
                                @if($search)
                                    con "<strong>{{ $search }}</strong>"
                                @endif
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Footer de tabla --}}
        <div class="cl-table-footer">
            {{ $clientes->count() }} de {{ $total }} clientes
        </div>
    </div>

</div>

@endsection

@push('styles')
<style>
/* ── Página clientes ── */
.cl-page { display: flex; flex-direction: column; gap: 20px; }

/* Header */
.cl-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}
.cl-header__title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.35rem;
    font-weight: 800;
    color: #090d16;
    letter-spacing: -.025em;
    margin-bottom: 3px;
}
.cl-header__sub { font-size: .84rem; color: #64748b; }
.cl-header__meta {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: .82rem;
    color: #2563eb;
    font-weight: 600;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: 999px;
    padding: 6px 14px;
    white-space: nowrap;
}

/* Toast */
.cl-toast {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 12px 18px;
    border-radius: 12px;
    font-size: .875rem;
    font-weight: 500;
    animation: slideDown .35s ease;
}
.cl-toast--success {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #065f46;
}
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Buscador */
.cl-search-wrap {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(9, 13, 22, 0.04);
    padding: 4px 6px;
}
.cl-search {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 12px;
    position: relative;
}
.cl-search__icon  { color: #94a3b8; flex-shrink: 0; }
.cl-search__input {
    flex: 1;
    border: none;
    outline: none;
    font-family: 'Inter', sans-serif;
    font-size: .875rem;
    color: #090d16;
    background: transparent;
}
.cl-search__input::placeholder { color: #94a3b8; }
.cl-search__clear {
    color: #94a3b8;
    display: flex;
    align-items: center;
    padding: 4px;
    border-radius: 50%;
    transition: background .2s, color .2s;
}
.cl-search__clear:hover { background: #f1f5f9; color: #475569; }

/* Tabla */
.cl-table-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(9, 13, 22, 0.04), 0 4px 12px rgba(9, 13, 22, 0.02);
    overflow: hidden;
}
.cl-table {
    width: 100%;
    border-collapse: collapse;
}
.cl-table th {
    padding: 14px 20px;
    text-align: left;
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: #64748b;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}
.cl-th-actions { text-align: center; width: 80px; }
.cl-table td {
    padding: 14px 20px;
    font-size: .875rem;
    color: #090d16;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}
.cl-table tr:last-child td { border-bottom: none; }
.cl-table tbody tr { transition: background .15s ease; }
.cl-table tbody tr:hover td { background: #f8fafc; }

/* Columnas específicas */
.cl-td-nombre   { font-weight: 600; color: #090d16; }
.cl-td-apellido { color: #2563eb; font-weight: 600; }
.cl-td-movil    { color: #475569; font-size: .84rem; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; }
.cl-td-email    { color: #475569; font-size: .84rem; }
.cl-td-actions  { text-align: center; }

/* Badge rol */
.cl-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 11px;
    border-radius: 999px;
    font-size: .72rem;
    font-weight: 700;
    white-space: nowrap;
}
.cl-badge--green { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }

/* Botones acción */
.cl-td-actions  { display: flex; align-items: center; justify-content: center; gap: 6px; }
.cl-form-delete { display: inline-flex; }
.cl-btn-action {
    width: 32px; height: 32px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
    flex-shrink: 0;
    border: none;
    cursor: pointer;
    text-decoration: none;
}
.cl-btn-action--edit  { background: #fffbeb; color: #d97706; }
.cl-btn-action--edit:hover  { background: #fef3c7; transform: translateY(-1px); }
.cl-btn-action--delete { background: #fff1f2; color: #e11d48; }
.cl-btn-action--delete:hover { background: #ffe4e6; transform: translateY(-1px); }

/* Vacío */
.cl-empty {
    text-align: center;
    padding: 48px 20px !important;
    color: #94a3b8;
}
.cl-empty svg { margin: 0 auto 12px; opacity: .4; }
.cl-empty p   { font-size: .9rem; }

/* Footer tabla */
.cl-table-footer {
    padding: 12px 20px;
    font-size: .78rem;
    color: #64748b;
    border-top: 1px solid #f1f5f9;
    background: #f8fafc;
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    // Búsqueda con debounce (500ms)
    var input = document.getElementById('search-input');
    var form  = document.getElementById('search-form');
    var timer;

    if (input) {
        input.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(function () { form.submit(); }, 500);
        });
    }

    // Auto-ocultar toast
    var toast = document.getElementById('cl-toast');
    if (toast) {
        setTimeout(function () {
            toast.style.transition = 'opacity .5s';
            toast.style.opacity    = '0';
            setTimeout(function () { toast.remove(); }, 500);
        }, 3500);
    }
})();

function confirmDelete(nombre) {
    return confirm('¿Eliminar al cliente ' + nombre + '?\nEsta acción no se puede deshacer.');
}
</script>
@endpush
