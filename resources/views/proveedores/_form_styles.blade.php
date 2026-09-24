<style>
.pv-form-page { max-width: 720px; }

.pv-breadcrumb { margin-bottom: 18px; }
.pv-back-link {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: .875rem; font-weight: 600; color: #2563eb;
    text-decoration: none; transition: color .2s;
}
.pv-back-link:hover { color: #1d4ed8; }

.pv-form-card {
    background: #fff; border-radius: 18px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(9, 13, 22, 0.04), 0 8px 24px -4px rgba(9, 13, 22, 0.06);
    padding: 28px 32px 32px;
}
.pv-form-card__header {
    display: flex; align-items: center; gap: 16px; margin-bottom: 20px;
}
.pv-form-icon {
    width: 48px; height: 48px; border-radius: 13px;
    background: #eff6ff; color: #2563eb;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.pv-edit-avatar {
    width: 48px; height: 48px; border-radius: 13px;
    background: linear-gradient(135deg, #2563eb, #06b6d4);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Outfit', sans-serif; font-size: 1rem;
    font-weight: 800; color: #fff; flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
}
.pv-form-card__title {
    font-family: 'Outfit', sans-serif; font-size: 1.25rem;
    font-weight: 800; color: #090d16; letter-spacing: -.025em;
}
.pv-form-card__sub { font-size: .82rem; color: #64748b; margin-top: 3px; }
.pv-divider { border: none; border-top: 1px solid #f1f5f9; margin-bottom: 22px; }

.pv-alert {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 12px 16px; border-radius: 12px; margin-bottom: 20px;
    background: #fff1f2; border: 1px solid #fecdd3; color: #9f1239; font-size: .84rem;
}
.pv-alert ul { list-style: none; margin: 0; padding: 0; }

.pv-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px; margin-bottom: 26px;
}
.pv-span-full { grid-column: 1 / -1; }
.pv-form-group { display: flex; flex-direction: column; gap: 7px; }
.pv-form-label { font-size: .845rem; font-weight: 600; color: #1e293b; }

.pv-input-wrap { position: relative; display: flex; align-items: center; }
.pv-input-icon {
    position: absolute; left: 12px; top: 50%;
    transform: translateY(-50%);
    color: #94a3b8; display: flex; align-items: center; pointer-events: none;
}
.pv-input {
    width: 100%;
    padding: 11px 14px 11px 38px;
    border: 1.5px solid #e2e8f0; border-radius: 12px;
    font-family: 'Inter', sans-serif; font-size: .875rem;
    color: #090d16; background: #fff; outline: none;
    transition: border-color .2s, box-shadow .2s;
    resize: none;
}
.pv-textarea { padding-top: 11px; padding-bottom: 11px; resize: vertical; }
.pv-input::placeholder { color: #94a3b8; }
.pv-input:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, .12); }
.pv-input.is-error { border-color: #f43f5e; }

.pv-form-actions {
    display: flex; align-items: center; justify-content: flex-end;
    gap: 12px; padding-top: 4px;
}
.pv-btn {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 22px; border-radius: 12px;
    font-family: 'Outfit', sans-serif; font-size: .88rem;
    font-weight: 700; cursor: pointer;
    transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
    text-decoration: none; border: none;
}
.pv-btn--ghost  { background: #f1f5f9; color: #475569; }
.pv-btn--ghost:hover { background: #e2e8f0; color: #090d16; }
.pv-btn--primary {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff; box-shadow: 0 4px 14px rgba(37, 99, 235, .28);
}
.pv-btn--primary:hover { box-shadow: 0 8px 22px rgba(37, 99, 235, .38); transform: translateY(-1px); }

@media (max-width: 600px) {
    .pv-form-grid { grid-template-columns: 1fr; }
    .pv-form-card { padding: 20px 18px; }
}
</style>
