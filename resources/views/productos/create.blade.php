@extends('layouts.dashboard')

@section('title', 'Nuevo Producto')
@section('page-title', 'Catálogo de Productos')

@section('content')
<div class="prod-form-page">

    <div class="prod-breadcrumb">
        <a href="{{ route('catalogo.index') }}" class="prod-back-link">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Volver al Catálogo
        </a>
    </div>

    <div class="prod-form-card">

        <div class="prod-form-card__header">
            <div class="prod-form-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                </svg>
            </div>
            <div>
                <h2 class="prod-form-card__title">Nuevo Producto</h2>
                <p class="prod-form-card__sub">Completa la información del producto para el catálogo</p>
            </div>
        </div>

        <hr class="prod-divider">

        @if ($errors->any())
            <div class="prod-alert">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <ul>
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ route('productos.store') }}"
              enctype="multipart/form-data"
              class="prod-form"
              id="prod-form">
            @csrf

            <div class="prod-form-layout">

                {{-- ── Columna izquierda: imagen ── --}}
                <div class="prod-col-img">
                    <div class="prod-img-section">
                        <span class="prod-section-label">Imagen del producto</span>

                        <div class="prod-img-dropzone" id="img-dropzone">
                            <div class="prod-img-preview" id="img-preview" style="display:none">
                                <img id="preview-img" src="" alt="Preview">
                                <button type="button" class="prod-img-remove" id="img-remove" title="Quitar imagen">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                </button>
                            </div>
                            <div class="prod-img-placeholder" id="img-placeholder">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                                <p class="prod-img-placeholder__text">Arrastra una imagen aquí</p>
                                <p class="prod-img-placeholder__sub">o haz clic para seleccionar</p>
                                <span class="prod-img-placeholder__hint">JPG, PNG, WEBP · máx 2MB</span>
                            </div>
                            <input type="file" name="imagen" id="imagen-input"
                                   accept="image/jpg,image/jpeg,image/png,image/webp"
                                   class="prod-img-input">
                        </div>
                    </div>
                </div>

                {{-- ── Columna derecha: campos ── --}}
                <div class="prod-col-fields">

                    {{-- Nombre --}}
                    <div class="prod-form-group prod-span-full">
                        <label class="prod-label" for="nombre">Nombre del producto <span class="req">*</span></label>
                        <div class="prod-input-wrap">
                            <span class="prod-input-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                                </svg>
                            </span>
                            <input type="text" id="nombre" name="nombre"
                                   class="prod-input @error('nombre') is-error @enderror"
                                   placeholder="Ej. Detergente en Polvo 1kg"
                                   value="{{ old('nombre') }}" required>
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="prod-form-group prod-span-full">
                        <label class="prod-label" for="descripcion">Descripción <span class="req">*</span></label>
                        <textarea id="descripcion" name="descripcion" rows="3"
                                  class="prod-input prod-textarea @error('descripcion') is-error @enderror"
                                  placeholder="Describe brevemente el producto..."
                                  required>{{ old('descripcion') }}</textarea>
                        <span class="prod-char-count"><span id="desc-count">0</span>/500</span>
                    </div>

                    {{-- Categoría --}}
                    <div class="prod-form-group">
                        <label class="prod-label" for="categoria">Categoría <span class="req">*</span></label>
                        <div class="prod-input-wrap">
                            <span class="prod-input-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                    <line x1="7" y1="7" x2="7.01" y2="7"/>
                                </svg>
                            </span>
                            <select id="categoria" name="categoria"
                                    class="prod-input prod-select @error('categoria') is-error @enderror" required>
                                <option value="">Seleccionar categoría...</option>
                                @foreach ($categorias as $cat)
                                    <option value="{{ $cat->categoria }}"
                                        {{ old('categoria') == $cat->categoria ? 'selected' : '' }}>
                                        {{ $cat->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Stock --}}
                    <div class="prod-form-group">
                        <label class="prod-label" for="stock">Stock inicial <span class="req">*</span></label>
                        <div class="prod-input-wrap">
                            <span class="prod-input-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/>
                                    <line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/>
                                    <line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>
                                </svg>
                            </span>
                            <input type="number" id="stock" name="stock"
                                   class="prod-input @error('stock') is-error @enderror"
                                   placeholder="0" min="0"
                                   value="{{ old('stock', 0) }}" required>
                        </div>
                    </div>

                    {{-- Precio compra --}}
                    <div class="prod-form-group">
                        <label class="prod-label" for="precio_compra">Precio de compra <span class="req">*</span></label>
                        <div class="prod-input-wrap">
                            <span class="prod-input-icon prod-currency">$</span>
                            <input type="number" id="precio_compra" name="precio_compra"
                                   class="prod-input prod-input--currency @error('precio_compra') is-error @enderror"
                                   placeholder="0.00" min="0" step="0.01"
                                   value="{{ old('precio_compra') }}" required>
                        </div>
                    </div>

                    {{-- Precio venta --}}
                    <div class="prod-form-group">
                        <label class="prod-label" for="precio_venta">Precio de venta <span class="req">*</span></label>
                        <div class="prod-input-wrap">
                            <span class="prod-input-icon prod-currency">$</span>
                            <input type="number" id="precio_venta" name="precio_venta"
                                   class="prod-input prod-input--currency @error('precio_venta') is-error @enderror"
                                   placeholder="0.00" min="0" step="0.01"
                                   value="{{ old('precio_venta') }}" required>
                        </div>
                    </div>

                    {{-- Código de barras --}}
                    <div class="prod-form-group">
                        <label class="prod-label" for="codigo_barras">Código de barras</label>
                        <div class="prod-input-wrap">
                            <span class="prod-input-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 9v6M6 5v14M9 9v6M12 5v14M15 9v6M18 5v14M21 9v6"/>
                                </svg>
                            </span>
                            <input type="text" id="codigo_barras" name="codigo_barras"
                                   class="prod-input @error('codigo_barras') is-error @enderror"
                                   placeholder="Ej. 7501234567890"
                                   value="{{ old('codigo_barras') }}">
                        </div>
                    </div>

                    {{-- Margen --}}
                    <div class="prod-form-group">
                        <label class="prod-label">Margen estimado</label>
                        <div class="prod-margen-display" id="margen-display">
                            <span id="margen-valor">—</span>
                        </div>
                    </div>

                </div>{{-- /col-fields --}}
            </div>{{-- /layout --}}

            <div class="prod-form-actions">
                <a href="{{ route('catalogo.index') }}" class="prod-btn prod-btn--ghost">Cancelar</a>
                <button type="submit" class="prod-btn prod-btn--primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Crear Producto
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@push('styles')
@include('productos._form_styles')
@endpush

@push('scripts')
@include('productos._form_scripts')
@endpush
