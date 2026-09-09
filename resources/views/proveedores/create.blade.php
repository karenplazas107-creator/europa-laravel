@extends('layouts.dashboard')

@section('title', 'Nuevo Proveedor')
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
            <div class="pv-form-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="3" width="15" height="13" rx="1"/>
                    <path d="M16 8h4l3 5v3h-7V8z"/>
                    <circle cx="5.5" cy="18.5" r="2.5"/>
                    <circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
            </div>
            <div>
                <h2 class="pv-form-card__title">Nuevo Proveedor</h2>
                <p class="pv-form-card__sub">Completa los datos del proveedor</p>
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

        <form method="POST" action="{{ route('proveedores.store') }}" class="pv-form">
            @csrf
            @include('proveedores._form')
            <div class="pv-form-actions">
                <a href="{{ route('proveedores.index') }}" class="pv-btn pv-btn--ghost">Cancelar</a>
                <button type="submit" class="pv-btn pv-btn--primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Crear Proveedor
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
@include('proveedores._form_styles')
@endpush
