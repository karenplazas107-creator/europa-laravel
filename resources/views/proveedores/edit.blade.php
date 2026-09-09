@extends('layouts.dashboard')

@section('title', 'Editar Proveedor')
@section('page-title', 'Proveedores')

@section('content')
<div class="pv-form-page">

    <div class="pv-breadcrumb">
        <a href="{{ route('proveedores.index') }}" class="pv-back-link">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Volver a Proveedores
        </a>
    </div>

    <div class="pv-form-card">
        <div class="pv-form-card__header">
            <div class="pv-edit-avatar">{{ $proveedor->initiales }}</div>
            <div>
                <h2 class="pv-form-card__title">{{ $proveedor->nombre }}</h2>
                <p class="pv-form-card__sub">ID {{ $proveedor->id_formateado }}</p>
            </div>
        </div>

        <hr class="pv-divider">

        @if ($errors->any())
            <div class="pv-alert">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="POST" action="{{ route('proveedores.update', $proveedor->proveedores) }}" class="pv-form">
            @csrf
            @method('PUT')
            @include('proveedores._form', ['proveedor' => $proveedor])
            <div class="pv-form-actions">
                <a href="{{ route('proveedores.index') }}" class="pv-btn pv-btn--ghost">Cancelar</a>
                <button type="submit" class="pv-btn pv-btn--primary">
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
@include('proveedores._form_styles')
@endpush
