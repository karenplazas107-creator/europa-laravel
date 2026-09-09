<style>
/* ─── Página formulario producto ─── */
.prod-form-page { max-width: 900px; }

.prod-breadcrumb { margin-bottom: 18px; }
.prod-back-link {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: .875rem; font-weight: 600; color: #1d74e8;
    text-decoration: none; transition: color .2s;
}
.prod-back-link:hover { color: #1440b0; }

/* Card */
.prod-form-card {
    background: #fff; border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 16px rgba(13,27,53,.08);
    padding: 28px 30px 32px;
}
.prod-form-card__header {
    display: flex; align-items: center; gap: 16px; margin-bottom: 20px;
}
.prod-form-icon {
    width: 48px; height: 48px; border-radius: 12px;
    background: #eff6ff; color: #1d74e8;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.prod-form-card__title {
    font-family: 'Outfit', sans-serif; font-size: 1.15rem;
    font-weight: 800; color: #0d1b35; letter-spacing: -.02em;
}
.prod-form-card__sub { font-size: .8rem; color: #64748b; margin-top: 3px; }
.prod-divider { border: none; border-top: 1px solid #f1f5fd; margin-bottom: 22px; }

/* Alerta */
.prod-alert {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 12px 16px; border-radius: 10px; margin-bottom: 20px;
    background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; font-size: .84rem;
}
.prod-alert ul { list-style: none; }

/* Layout: imagen + campos */
.prod-form-layout {
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 28px;
    margin-bottom: 24px;
}

/* ── Imagen ── */
.prod-img-section { display: flex; flex-direction: column; gap: 12px; }
.prod-section-label {
    font-size: .845rem; font-weight: 600; color: #1e293b;
    display: block; margin-bottom: 2px;
}
.prod-img-dropzone {
    border: 2px dashed #cbd5e1; border-radius: 14px;
    background: #f8faff; cursor: pointer;
    transition: border-color .2s, background .2s;
    position: relative; overflow: hidden;
    aspect-ratio: 1;
    display: flex; align-items: center; justify-content: center;
}
.prod-img-dropzone:hover,
.prod-img-dropzone.drag-over {
    border-color: #1d74e8; background: #eff6ff;
}
.prod-img-input {
    position: absolute; inset: 0;
    opacity: 0; cursor: pointer; width: 100%; height: 100%;
}
.prod-img-placeholder {
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 6px; color: #94a3b8; padding: 20px; text-align: center;
    pointer-events: none;
}
.prod-img-placeholder__text { font-size: .82rem; font-weight: 600; color: #64748b; }
.prod-img-placeholder__sub  { font-size: .75rem; color: #94a3b8; }
.prod-img-placeholder__hint {
    font-size: .68rem; color: #cbd5e1;
    background: #f1f5f9; padding: 3px 10px; border-radius: 999px; margin-top: 2px;
}
.prod-img-preview {
    display: flex; align-items: center; justify-content: center;
    width: 100%; height: 100%; position: relative;
}
.prod-img-preview img {
    width: 100%; height: 100%; object-fit: cover;
}
.prod-img-remove {
    position: absolute; top: 8px; right: 8px;
    width: 28px; height: 28px; border-radius: 50%;
    background: rgba(0,0,0,.55); color: #fff;
    display: flex; align-items: center; justify-content: center;
    border: none; cursor: pointer; z-index: 2;
    transition: background .2s;
}
.prod-img-remove:hover { background: #ef4444; }
.prod-check-label {
    display: flex; align-items: center; gap: 7px;
    font-size: .8rem; color: #ef4444; cursor: pointer;
}

/* ── Campos ── */
.prod-col-fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    align-content: start;
}
.prod-span-full { grid-column: 1 / -1; }
.prod-form-group { display: flex; flex-direction: column; gap: 6px; }

.prod-label {
    font-size: .845rem; font-weight: 600; color: #1e293b;
}
.prod-label .req { color: #ef4444; }

.prod-input-wrap { position: relative; display: flex; align-items: center; }
.prod-input-icon {
    position: absolute; left: 12px;
    color: #94a3b8; display: flex; align-items: center; pointer-events: none;
    font-size: .82rem; font-weight: 700;
}
.prod-currency { font-style: normal; }
.prod-input {
    width: 100%; padding: 10px 12px 10px 38px;
    border: 1.5px solid #e2e8f0; border-radius: 10px;
    font-family: 'Inter', sans-serif; font-size: .875rem;
    color: #0d1b35; background: #fff; outline: none;
    transition: border-color .2s, box-shadow .2s;
}
.prod-input--currency { padding-left: 28px; }
.prod-textarea { padding: 10px 12px; resize: vertical; padding-left: 12px; }
.prod-select   { appearance: none; padding-right: 32px; }
.prod-input::placeholder { color: #94a3b8; }
.prod-input:focus { border-color: #1d74e8; box-shadow: 0 0 0 3px rgba(29,116,232,.1); }
.prod-input.is-error { border-color: #ef4444; }
.prod-input.is-error:focus { box-shadow: 0 0 0 3px rgba(239,68,68,.1); }

/* Contador caracteres */
.prod-char-count { font-size: .72rem; color: #94a3b8; text-align: right; margin-top: -2px; }

/* Margen */
.prod-margen-display {
    padding: 10px 14px; border-radius: 10px;
    background: #f8faff; border: 1.5px solid #e2e8f0;
    font-family: 'Outfit', sans-serif; font-size: 1rem;
    font-weight: 800; color: #0d1b35; min-height: 42px;
    display: flex; align-items: center;
}

/* Zona peligrosa */
.prod-danger-zone {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 18px; border-radius: 10px;
    background: #fef2f2; border: 1px solid #fecaca;
    margin-bottom: 20px;
}
.prod-danger-zone__label { font-size: .78rem; font-weight: 700; color: #dc2626; }

/* Acciones */
.prod-form-actions {
    display: flex; align-items: center; justify-content: flex-end;
    gap: 12px; padding-top: 4px;
}
.prod-btn {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 11px 24px; border-radius: 10px;
    font-family: 'Outfit', sans-serif; font-size: .9rem;
    font-weight: 700; cursor: pointer; transition: all .2s;
    text-decoration: none; border: none;
}
.prod-btn--ghost   { background: #f1f5f9; color: #475569; }
.prod-btn--ghost:hover { background: #e2e8f0; }
.prod-btn--primary {
    background: linear-gradient(135deg, #1d74e8, #1440b0);
    color: #fff; box-shadow: 0 4px 16px rgba(29,116,232,.35);
}
.prod-btn--primary:hover { box-shadow: 0 8px 24px rgba(29,116,232,.45); transform: translateY(-1px); }
.prod-btn--danger  { background: #fee2e2; color: #dc2626; padding: 8px 18px; font-size: .82rem; }
.prod-btn--danger:hover  { background: #fecaca; }

@media (max-width: 700px) {
    .prod-form-layout  { grid-template-columns: 1fr; }
    .prod-col-fields   { grid-template-columns: 1fr; }
    .prod-form-card    { padding: 20px 16px; }
}
</style>
