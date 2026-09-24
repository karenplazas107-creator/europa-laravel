@extends('layouts.dashboard')

@section('title', 'Nuevo Usuario – Almacén Europa')
@section('page-title', 'Crear Usuario')

@section('content')

<div class="usr-form-page">

    {{-- Breadcrumb --}}
    <div class="usr-breadcrumb">
        <a href="{{ route('usuarios.index') }}" class="usr-back-link">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Volver a Usuarios y Roles
        </a>
    </div>

    <div class="usr-form-card">
        <div class="usr-form-card__header">
            <div class="usr-form-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <line x1="19" y1="8" x2="19" y2="14"/>
                    <line x1="22" y1="11" x2="16" y2="11"/>
                </svg>
            </div>
            <div>
                <h2 class="usr-form-card__title">Registrar Nuevo Usuario</h2>
                <p class="usr-form-card__sub">Ingresa la información del usuario y asígnale su rol en el sistema.</p>
            </div>
        </div>

        <hr class="usr-divider">

        @if ($errors->any())
            <div class="usr-alert usr-alert--danger">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <div>
                    <strong>Por favor corrige los siguientes errores:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('usuarios.store') }}" class="usr-form">
            @csrf

            {{-- Sección 1: Datos Personales --}}
            <div class="usr-form-section">
                <h3 class="usr-section-title">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Información Básica
                </h3>

                <div class="usr-grid-2">
                    <div class="usr-form-group">
                        <label class="usr-label" for="nombre">Nombre <span class="usr-req">*</span></label>
                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            class="usr-input @error('nombre') is-invalid @enderror"
                            placeholder="Ej. Carlos"
                            value="{{ old('nombre') }}"
                            required
                        >
                        @error('nombre') <span class="usr-err-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="usr-form-group">
                        <label class="usr-label" for="apellido">Apellido <span class="usr-req">*</span></label>
                        <input
                            type="text"
                            name="apellido"
                            id="apellido"
                            class="usr-input @error('apellido') is-invalid @enderror"
                            placeholder="Ej. Gómez"
                            value="{{ old('apellido') }}"
                            required
                        >
                        @error('apellido') <span class="usr-err-msg">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="usr-grid-2">
                    <div class="usr-form-group">
                        <label class="usr-label" for="movil">Teléfono / Móvil <span class="usr-req">*</span></label>
                        <input
                            type="text"
                            name="movil"
                            id="movil"
                            class="usr-input @error('movil') is-invalid @enderror"
                            placeholder="Ej. 3101234567"
                            value="{{ old('movil') }}"
                            required
                        >
                        <span class="usr-help">Identificador principal para inicio de sesión en el sistema.</span>
                        @error('movil') <span class="usr-err-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="usr-form-group">
                        <label class="usr-label" for="email">Correo Electrónico (Opcional)</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="usr-input @error('email') is-invalid @enderror"
                            placeholder="Ej. carlos@almaceneuropa.com"
                            value="{{ old('email') }}"
                        >
                        <span class="usr-help">También puede usarse para iniciar sesión y notificaciones.</span>
                        @error('email') <span class="usr-err-msg">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- Sección 2: Asignación de Rol --}}
            <div class="usr-form-section">
                <h3 class="usr-section-title">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Rol y Nivel de Acceso <span class="usr-req">*</span>
                </h3>
                <p class="usr-section-desc">Selecciona las responsabilidades y permisos que tendrá este usuario en Almacén Europa:</p>

                <div class="usr-roles-grid">
                    @php $selectedRol = old('rol', 'vendedor'); @endphp

                    {{-- Tarjeta Rol: Vendedor --}}
                    <label class="usr-role-card">
                        <input type="radio" name="rol" value="vendedor" class="usr-role-radio" {{ $selectedRol === 'vendedor' ? 'checked' : '' }}>
                        <div class="usr-role-card-inner usr-role-card-inner--vendedor">
                            <div class="usr-role-header">
                                <div class="usr-role-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                                </div>
                                <span class="usr-role-badge">Ventas</span>
                            </div>
                            <h4 class="usr-role-title">Vendedor</h4>
                            <p class="usr-role-text">Acceso al Punto de Venta, registro de ventas, emisión de recibos, consulta de catálogo y clientes.</p>
                        </div>
                    </label>

                    {{-- Tarjeta Rol: Auxiliar de Bodega --}}
                    <label class="usr-role-card">
                        <input type="radio" name="rol" value="auxiliar_bodega" class="usr-role-radio" {{ $selectedRol === 'auxiliar_bodega' ? 'checked' : '' }}>
                        <div class="usr-role-card-inner usr-role-card-inner--bodega">
                            <div class="usr-role-header">
                                <div class="usr-role-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/></svg>
                                </div>
                                <span class="usr-role-badge">Inventario</span>
                            </div>
                            <h4 class="usr-role-title">Auxiliar de Bodega</h4>
                            <p class="usr-role-text">Control de inventario, stock físico, entrada y salida de mercancía, catálogo y proveedores.</p>
                        </div>
                    </label>

                    {{-- Tarjeta Rol: Administrador --}}
                    <label class="usr-role-card">
                        <input type="radio" name="rol" value="administrador" class="usr-role-radio" {{ $selectedRol === 'administrador' ? 'checked' : '' }}>
                        <div class="usr-role-card-inner usr-role-card-inner--admin">
                            <div class="usr-role-header">
                                <div class="usr-role-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                </div>
                                <span class="usr-role-badge">Total</span>
                            </div>
                            <h4 class="usr-role-title">Administrador</h4>
                            <p class="usr-role-text">Control total del sistema: gestión de usuarios, roles, compras, ventas, inventario y reportes financieros.</p>
                        </div>
                    </label>

                    {{-- Tarjeta Rol: Cliente --}}
                    <label class="usr-role-card">
                        <input type="radio" name="rol" value="cliente" class="usr-role-radio" {{ $selectedRol === 'cliente' ? 'checked' : '' }}>
                        <div class="usr-role-card-inner usr-role-card-inner--cliente">
                            <div class="usr-role-header">
                                <div class="usr-role-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </div>
                                <span class="usr-role-badge">Tienda</span>
                            </div>
                            <h4 class="usr-role-title">Cliente Comprador</h4>
                            <p class="usr-role-text">Acceso a la vitrina virtual y pedidos online. No puede ingresar a paneles administrativos.</p>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Sección 3: Seguridad y Contraseña --}}
            <div class="usr-form-section">
                <h3 class="usr-section-title">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Seguridad y Contraseña
                </h3>

                <div class="usr-grid-2">
                    <div class="usr-form-group">
                        <label class="usr-label" for="password">Contraseña <span class="usr-req">*</span></label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="usr-input @error('password') is-invalid @enderror"
                            placeholder="Mínimo 6 caracteres"
                            required
                        >
                        @error('password') <span class="usr-err-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="usr-form-group">
                        <label class="usr-label" for="password_confirmation">Confirmar Contraseña <span class="usr-req">*</span></label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="usr-input"
                            placeholder="Repite la contraseña"
                            required
                        >
                    </div>
                </div>
            </div>

            {{-- Botones de Acción --}}
            <div class="usr-form-actions">
                <a href="{{ route('usuarios.index') }}" class="usr-btn usr-btn--ghost">Cancelar</a>
                <button type="submit" class="usr-btn usr-btn--primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <span>Guardar y Crear Usuario</span>
                </button>
            </div>

        </form>
    </div>

</div>

@endsection

@push('styles')
<style>
.usr-form-page {
    max-width: 820px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 18px;
}
.usr-breadcrumb {
    display: flex;
    align-items: center;
}
.usr-back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: #64748b;
    text-decoration: none;
    font-size: .85rem;
    font-weight: 600;
    transition: color .15s;
}
.usr-back-link:hover {
    color: #0f172a;
}

.usr-form-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
}
.usr-form-card__header {
    display: flex;
    align-items: center;
    gap: 16px;
}
.usr-form-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: #0f172a;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.usr-form-card__title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.4rem;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -.02em;
    margin-bottom: 2px;
}
.usr-form-card__sub {
    font-size: .86rem;
    color: #64748b;
}
.usr-divider {
    border: none;
    border-top: 1px solid #f1f5f9;
    margin: 22px 0 26px 0;
}

/* Alertas */
.usr-alert {
    display: flex;
    gap: 12px;
    padding: 14px 18px;
    border-radius: 12px;
    font-size: .85rem;
    margin-bottom: 24px;
}
.usr-alert--danger {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #991b1b;
}
.usr-alert ul {
    margin: 6px 0 0 18px;
    padding: 0;
}

/* Secciones del formulario */
.usr-form {
    display: flex;
    flex-direction: column;
    gap: 28px;
}
.usr-form-section {
    display: flex;
    flex-direction: column;
    gap: 14px;
}
.usr-section-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: 1.05rem;
    font-weight: 700;
    color: #0f172a;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 8px;
    margin: 0;
}
.usr-section-title svg {
    color: #64748b;
}
.usr-section-desc {
    font-size: .84rem;
    color: #64748b;
    margin-top: -6px;
    margin-bottom: 6px;
}

/* Layout inputs */
.usr-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}
@media (max-width: 640px) {
    .usr-grid-2 { grid-template-columns: 1fr; }
}

.usr-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.usr-label {
    font-size: .83rem;
    font-weight: 700;
    color: #334155;
}
.usr-req {
    color: #ef4444;
}
.usr-help {
    font-size: .75rem;
    color: #94a3b8;
}
.usr-err-msg {
    font-size: .78rem;
    color: #ef4444;
    font-weight: 600;
}

.usr-input {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    font-size: .88rem;
    color: #0f172a;
    background: #fff;
    transition: all .2s;
}
.usr-input:focus {
    outline: none;
    border-color: #0f172a;
    box-shadow: 0 0 0 3px rgba(15,23,42,0.08);
}
.usr-input.is-invalid {
    border-color: #ef4444;
    background: #fef2f2;
}

/* Selector de Roles Visual */
.usr-roles-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}
@media (max-width: 640px) {
    .usr-roles-grid { grid-template-columns: 1fr; }
}

.usr-role-card {
    position: relative;
    cursor: pointer;
    display: block;
}
.usr-role-radio {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}
.usr-role-card-inner {
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    padding: 16px 18px;
    background: #fff;
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
}
.usr-role-card:hover .usr-role-card-inner {
    border-color: #cbd5e1;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.usr-role-radio:checked + .usr-role-card-inner {
    border-color: #0f172a;
    background: #f8fafc;
    box-shadow: 0 0 0 2px #0f172a;
}
.usr-role-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}
.usr-role-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.usr-role-card-inner--vendedor .usr-role-icon { background: #ecfdf5; color: #059669; }
.usr-role-card-inner--bodega   .usr-role-icon { background: #fffbeb; color: #d97706; }
.usr-role-card-inner--admin    .usr-role-icon { background: #eef2ff; color: #4f46e5; }
.usr-role-card-inner--cliente  .usr-role-icon { background: #f1f5f9; color: #475569; }

.usr-role-badge {
    font-size: .68rem;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 6px;
    background: #f1f5f9;
    color: #475569;
    text-transform: uppercase;
}
.usr-role-title {
    font-family: 'Outfit', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 4px 0;
}
.usr-role-text {
    font-size: .78rem;
    color: #64748b;
    margin: 0;
    line-height: 1.4;
    flex: 1;
}

/* Botones */
.usr-form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
}
.usr-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    border-radius: 12px;
    font-family: 'Outfit', sans-serif;
    font-size: .9rem;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    border: none;
    transition: all .2s;
}
.usr-btn--ghost {
    background: #f1f5f9;
    color: #475569;
}
.usr-btn--ghost:hover {
    background: #e2e8f0;
    color: #1e293b;
}
.usr-btn--primary {
    background: #0f172a;
    color: #fff;
    box-shadow: 0 4px 14px rgba(15, 23, 42, 0.28);
}
.usr-btn--primary:hover {
    background: #1e293b;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(15, 23, 42, 0.35);
}
</style>
@endpush
