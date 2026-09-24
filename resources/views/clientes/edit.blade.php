@extends('layouts.dashboard')

@section('title', 'Editar Cliente')
@section('page-title', 'Gestión de Clientes')

@section('content')

<div class="cl-edit-page">

    {{-- Breadcrumb --}}
    <div class="cl-breadcrumb">
        <a href="{{ route('clientes.index') }}" class="cl-breadcrumb__back">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Volver a Clientes
        </a>
    </div>

    <div class="cl-edit-card">

        {{-- Cabecera del card --}}
        <div class="cl-edit-card__header">
            <div class="cl-edit-avatar">
                {{ strtoupper(substr($cliente->nombre, 0, 1)) }}{{ strtoupper(substr($cliente->apellido, 0, 1)) }}
            </div>
            <div>
                <h2 class="cl-edit-card__title">{{ $cliente->nombre }} {{ $cliente->apellido }}</h2>
                <p class="cl-edit-card__sub">Móvil: {{ $cliente->movil }} · <span class="cl-badge-sm">Comprador</span></p>
            </div>
        </div>

        <hr class="cl-divider">

        {{-- Errores --}}
        @if ($errors->any())
            <div class="cl-alert cl-alert--error">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario --}}
        <form method="POST"
              action="{{ route('clientes.update', $cliente->usuario) }}"
              class="cl-edit-form">
            @csrf
            @method('PUT')

            <div class="cl-form-grid">

                <div class="cl-form-group">
                    <label class="cl-form-label" for="nombre">Nombres</label>
                    <div class="cl-input-wrap">
                        <span class="cl-input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                        </span>
                        <input type="text" id="nombre" name="nombre"
                            class="cl-input @error('nombre') is-error @enderror"
                            value="{{ old('nombre', $cliente->nombre) }}"
                            required>
                    </div>
                </div>

                <div class="cl-form-group">
                    <label class="cl-form-label" for="apellido">Apellidos</label>
                    <div class="cl-input-wrap">
                        <span class="cl-input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                        </span>
                        <input type="text" id="apellido" name="apellido"
                            class="cl-input @error('apellido') is-error @enderror"
                            value="{{ old('apellido', $cliente->apellido) }}"
                            required>
                    </div>
                </div>

                <div class="cl-form-group">
                    <label class="cl-form-label" for="email">Correo Electrónico</label>
                    <div class="cl-input-wrap">
                        <span class="cl-input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </span>
                        <input type="email" id="email" name="email"
                            class="cl-input @error('email') is-error @enderror"
                            value="{{ old('email', $cliente->email) }}"
                            placeholder="correo@ejemplo.com">
                    </div>
                </div>

                <div class="cl-form-group">
                    <label class="cl-form-label" for="movil">Móvil</label>
                    <div class="cl-input-wrap">
                        <span class="cl-input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/>
                            </svg>
                        </span>
                        <input type="tel" id="movil" name="movil"
                            class="cl-input @error('movil') is-error @enderror"
                            value="{{ old('movil', $cliente->movil) }}"
                            required>
                    </div>
                </div>

                <div class="cl-form-group">
                    <label class="cl-form-label" for="password">
                        Nueva Contraseña
                        <span class="cl-form-label__hint">(dejar vacío para no cambiar)</span>
                    </label>
                    <div class="cl-input-wrap">
                        <span class="cl-input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        <input type="password" id="password" name="password"
                            class="cl-input @error('password') is-error @enderror"
                            placeholder="••••••••"
                            autocomplete="new-password">
                    </div>
                </div>

                <div class="cl-form-group">
                    <label class="cl-form-label" for="password_confirmation">Confirmar Contraseña</label>
                    <div class="cl-input-wrap">
                        <span class="cl-input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="cl-input"
                            placeholder="••••••••"
                            autocomplete="new-password">
                    </div>
                </div>

            </div>

            <div class="cl-edit-actions">
                <a href="{{ route('clientes.index') }}" class="cl-btn cl-btn--ghost">
                    Cancelar
                </a>
                <button type="submit" class="cl-btn cl-btn--primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<style>
.cl-edit-page { max-width: 740px; }

/* Breadcrumb */
.cl-breadcrumb { margin-bottom: 18px; }
.cl-breadcrumb__back {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: .875rem;
    font-weight: 600;
    color: #2563eb;
    text-decoration: none;
    transition: color .2s;
}
.cl-breadcrumb__back:hover { color: #1d4ed8; }

/* Card */
.cl-edit-card {
    background: #fff;
    border-radius: 18px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(9, 13, 22, 0.04), 0 8px 24px -4px rgba(9, 13, 22, 0.06);
    padding: 28px 32px 32px;
}
.cl-edit-card__header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 22px;
}
.cl-edit-avatar {
    width: 52px; height: 52px;
    background: linear-gradient(135deg, #2563eb, #06b6d4);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Outfit', sans-serif;
    font-size: 1.1rem;
    font-weight: 800;
    color: #fff;
    flex-shrink: 0;
    letter-spacing: -.02em;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
}
.cl-edit-card__title {
    font-family: 'Outfit', sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    color: #090d16;
    letter-spacing: -.02em;
}
.cl-edit-card__sub {
    font-size: .82rem;
    color: #64748b;
    margin-top: 3px;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.cl-badge-sm {
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #a7f3d0;
    font-size: .7rem;
    font-weight: 700;
    padding: 2px 9px;
    border-radius: 999px;
}
.cl-divider {
    border: none;
    border-top: 1px solid #f1f5f9;
    margin-bottom: 22px;
}

/* Alerta */
.cl-alert {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 12px 16px;
    border-radius: 12px;
    font-size: .84rem;
    margin-bottom: 20px;
}
.cl-alert ul { list-style: none; margin: 0; padding: 0; }
.cl-alert--error { background: #fff1f2; border: 1px solid #fecdd3; color: #9f1239; }

/* Form grid */
.cl-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    margin-bottom: 26px;
}
.cl-form-group { display: flex; flex-direction: column; gap: 7px; }
.cl-form-label {
    font-size: .845rem;
    font-weight: 600;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 6px;
}
.cl-form-label__hint { font-size: .74rem; color: #94a3b8; font-weight: 400; }
.cl-input-wrap { position: relative; display: flex; align-items: center; }
.cl-input-icon {
    position: absolute;
    left: 12px;
    color: #94a3b8;
    display: flex;
    align-items: center;
    pointer-events: none;
}
.cl-input {
    width: 100%;
    padding: 11px 14px 11px 38px;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    font-family: 'Inter', sans-serif;
    font-size: .875rem;
    color: #090d16;
    background: #fff;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
}
.cl-input::placeholder { color: #94a3b8; }
.cl-input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
}
.cl-input.is-error { border-color: #f43f5e; }

/* Acciones */
.cl-edit-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 4px;
}
.cl-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    border-radius: 12px;
    font-family: 'Outfit', sans-serif;
    font-size: .88rem;
    font-weight: 700;
    cursor: pointer;
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
    text-decoration: none;
    border: none;
}
.cl-btn--ghost {
    background: #f1f5f9;
    color: #475569;
}
.cl-btn--ghost:hover { background: #e2e8f0; color: #090d16; }
.cl-btn--primary {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;
    box-shadow: 0 4px 14px rgba(37, 99, 235, .28);
}
.cl-btn--primary:hover {
    box-shadow: 0 8px 22px rgba(37, 99, 235, .38);
    transform: translateY(-1px);
}

@media (max-width: 600px) {
    .cl-form-grid { grid-template-columns: 1fr; }
    .cl-edit-card { padding: 20px 18px; }
}
</style>
@endpush
