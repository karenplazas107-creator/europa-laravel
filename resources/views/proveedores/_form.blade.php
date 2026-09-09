{{-- Partial reutilizable: campos del formulario de proveedor --}}
<div class="pv-form-grid">

    <div class="pv-form-group pv-span-full">
        <label class="pv-form-label" for="nombre">Nombre del Proveedor</label>
        <div class="pv-input-wrap">
            <span class="pv-input-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="3" width="15" height="13" rx="1"/>
                    <path d="M16 8h4l3 5v3h-7V8z"/>
                    <circle cx="5.5" cy="18.5" r="2.5"/>
                    <circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
            </span>
            <input type="text" id="nombre" name="nombre"
                class="pv-input @error('nombre') is-error @enderror"
                placeholder="Ej. Brilladora El Diamante"
                value="{{ old('nombre', $proveedor->nombre ?? '') }}"
                required>
        </div>
    </div>

    <div class="pv-form-group">
        <label class="pv-form-label" for="telefono">Teléfono</label>
        <div class="pv-input-wrap">
            <span class="pv-input-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 9.07 19.79 19.79 0 0 1 1.58.42 2 2 0 0 1 3.55 0h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 7c1.37 2.37 3.54 4.54 5.91 5.91l.83-.81a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
            </span>
            <input type="tel" id="telefono" name="telefono"
                class="pv-input @error('telefono') is-error @enderror"
                placeholder="3110987600"
                value="{{ old('telefono', $proveedor->telefono ?? '') }}"
                required>
        </div>
    </div>

    <div class="pv-form-group">
        <label class="pv-form-label" for="email">Correo Electrónico</label>
        <div class="pv-input-wrap">
            <span class="pv-input-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
            </span>
            <input type="email" id="email" name="email"
                class="pv-input @error('email') is-error @enderror"
                placeholder="proveedor@ejemplo.com"
                value="{{ old('email', $proveedor->email ?? '') }}"
                required>
        </div>
    </div>

    <div class="pv-form-group pv-span-full">
        <label class="pv-form-label" for="direccion">Dirección</label>
        <div class="pv-input-wrap">
            <span class="pv-input-icon" style="top:14px;align-items:flex-start">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
            </span>
            <textarea id="direccion" name="direccion" rows="2"
                class="pv-input pv-textarea @error('direccion') is-error @enderror"
                placeholder="Ej. Avenida 5 Norte # 20N-75, Barrio Versalles, Cali"
                required>{{ old('direccion', $proveedor->direccion ?? '') }}</textarea>
        </div>
    </div>

</div>
