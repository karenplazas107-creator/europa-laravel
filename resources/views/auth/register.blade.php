<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta – Almacén Europa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* ── Reset ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { height: 100%; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: #eef2fb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Card ── */
        .reg-card {
            display: grid;
            grid-template-columns: 1fr 1.35fr;
            width: 100%;
            max-width: 920px;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 24px 80px rgba(13,27,72,.18), 0 4px 20px rgba(13,27,72,.08);
        }

        /* ══════════════════════════════
           PANEL IZQUIERDO
        ══════════════════════════════ */
        .reg-left {
            background: linear-gradient(160deg, #0d1f5c 0%, #122580 42%, #1440b0 100%);
            padding: 36px 34px 40px;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }
        .reg-left::before {
            content: '';
            position: absolute;
            top: -25%; right: -25%;
            width: 65%; height: 65%;
            background: radial-gradient(circle, rgba(56,189,248,.18) 0%, transparent 65%);
            pointer-events: none;
        }
        .reg-left::after {
            content: '';
            position: absolute;
            bottom: 5%; left: -20%;
            width: 55%; height: 50%;
            background: radial-gradient(circle, rgba(29,116,232,.13) 0%, transparent 65%);
            pointer-events: none;
        }

        /* Volver */
        .reg-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: rgba(255,255,255,.7);
            font-size: .825rem;
            font-weight: 500;
            text-decoration: none;
            transition: color .2s;
            position: relative; z-index: 1;
            margin-bottom: auto;
        }
        .reg-back:hover { color: #fff; }

        /* Cuerpo izquierdo */
        .reg-left__body {
            position: relative; z-index: 1;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 28px 0 36px;
        }

        .reg-logo-icon {
            width: 54px; height: 54px;
            background: linear-gradient(135deg, #1d74e8, #38bdf8);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 26px;
            box-shadow: 0 6px 22px rgba(29,116,232,.45);
        }
        .reg-logo-icon svg { width: 28px; height: 28px; }

        .reg-left__title {
            font-family: 'Outfit', sans-serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: #fff;
            line-height: 1.1;
            letter-spacing: -.03em;
            margin-bottom: 18px;
        }
        .reg-left__desc {
            font-size: .875rem;
            color: rgba(255,255,255,.62);
            line-height: 1.72;
            max-width: 250px;
        }

        /* Badge seguridad */
        .reg-security-badge {
            position: relative; z-index: 1;
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.15);
            backdrop-filter: blur(8px);
            border-radius: 14px;
            padding: 14px 18px;
        }
        .security-icon {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: rgba(29,116,232,.2);
            border: 1px solid rgba(29,116,232,.35);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            color: #38bdf8;
        }
        .security-info strong {
            display: block;
            font-size: .875rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 2px;
        }
        .security-info span {
            font-size: .74rem;
            color: rgba(255,255,255,.5);
        }

        /* ══════════════════════════════
           PANEL DERECHO – Formulario
        ══════════════════════════════ */
        .reg-right {
            padding: 40px 44px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .reg-right__title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.85rem;
            font-weight: 900;
            color: #0d1b35;
            letter-spacing: -.03em;
            margin-bottom: 5px;
        }
        .reg-right__sub {
            font-size: .875rem;
            color: #64748b;
            margin-bottom: 28px;
        }

        /* Alerta de error */
        .reg-alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: .84rem;
            color: #dc2626;
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }
        .reg-alert svg { flex-shrink: 0; margin-top: 1px; }

        /* Grid 2 columnas */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 18px;
            margin-bottom: 22px;
        }
        .form-grid .span-full { grid-column: 1 / -1; }

        /* Grupo */
        .form-group { display: flex; flex-direction: column; gap: 7px; }
        .form-label {
            font-size: .845rem;
            font-weight: 600;
            color: #1e293b;
        }
        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-icon {
            position: absolute;
            left: 13px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            pointer-events: none;
        }
        .form-input {
            width: 100%;
            padding: 12px 14px 12px 40px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: .875rem;
            color: #0d1b35;
            background: #fff;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-input::placeholder { color: #94a3b8; }
        .form-input:focus {
            border-color: #1d74e8;
            box-shadow: 0 0 0 3px rgba(29,116,232,.11);
        }
        .form-input.is-error { border-color: #ef4444; }
        .form-input.is-error:focus { box-shadow: 0 0 0 3px rgba(239,68,68,.1); }

        /* Toggle password */
        .input-toggle {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            cursor: pointer;
            color: #94a3b8;
            display: flex;
            align-items: center;
            padding: 4px;
            transition: color .2s;
        }
        .input-toggle:hover { color: #475569; }

        /* Fuerza de contraseña */
        .password-strength {
            display: flex;
            gap: 4px;
            margin-top: 6px;
        }
        .strength-bar {
            flex: 1;
            height: 3px;
            border-radius: 3px;
            background: #e2e8f0;
            transition: background .3s;
        }
        .strength-bar.active-weak   { background: #ef4444; }
        .strength-bar.active-fair   { background: #f59e0b; }
        .strength-bar.active-good   { background: #22c55e; }
        .strength-bar.active-strong { background: #16a34a; }

        /* Botón submit */
        .btn-register {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #1d74e8, #1440b0);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Outfit', sans-serif;
            font-size: .975rem;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: .01em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: opacity .2s, transform .2s, box-shadow .2s;
            box-shadow: 0 6px 24px rgba(29,116,232,.38);
            margin-bottom: 20px;
        }
        .btn-register:hover {
            opacity: .92;
            transform: translateY(-1px);
            box-shadow: 0 10px 30px rgba(29,116,232,.48);
        }
        .btn-register:active { transform: translateY(0); }

        /* Spinner */
        .btn-spinner {
            display: none;
            width: 18px; height: 18px;
            border: 2.5px solid rgba(255,255,255,.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .btn-register.loading .btn-text   { display: none; }
        .btn-register.loading .btn-spinner { display: block; }

        /* Ir a login */
        .reg-login-link {
            text-align: center;
            font-size: .875rem;
            color: #64748b;
        }
        .reg-login-link a {
            color: #1d74e8;
            font-weight: 700;
            text-decoration: none;
            transition: color .2s;
        }
        .reg-login-link a:hover { color: #1440b0; text-decoration: underline; }

        /* Responsive */
        @media (max-width: 700px) {
            body { padding: 16px; }
            .reg-card { grid-template-columns: 1fr; max-width: 440px; }
            .reg-left { display: none; }
            .reg-right { padding: 32px 24px 36px; }
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="reg-card">

    {{-- ── Panel izquierdo ── --}}
    <div class="reg-left">
        <a href="{{ url('/') }}" class="reg-back">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Volver al inicio
        </a>

        <div class="reg-left__body">
            <div class="reg-logo-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="8" r="4" fill="white" fill-opacity="0.85"/>
                    <path d="M4 20c0-4 3.582-7 8-7s8 3 8 7" stroke="white" stroke-width="1.6" stroke-linecap="round"/>
                    <circle cx="19" cy="5" r="3" fill="white" fill-opacity="0.9"/>
                    <path d="M19 3.5v3M17.5 5h3" stroke="#1d74e8" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
            </div>

            <h1 class="reg-left__title">Únete como<br>Cliente</h1>
            <p class="reg-left__desc">
                Crea tu cuenta para explorar nuestro catálogo completo, realizar
                pedidos en línea y acceder a promociones exclusivas del Almacén Europa.
            </p>
        </div>

        <div class="reg-security-badge">
            <div class="security-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
            </div>
            <div class="security-info">
                <strong>Registro Seguro</strong>
                <span>Tus datos están protegidos</span>
            </div>
        </div>
    </div>

    {{-- ── Panel derecho ── --}}
    <div class="reg-right">
        <h2 class="reg-right__title">Crear Cuenta</h2>
        <p class="reg-right__sub">Completa tus datos para realizar compras en línea</p>

        {{-- Errores --}}
        @if ($errors->any())
            <div class="reg-alert">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <ul style="padding-left:4px; list-style:none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}" id="reg-form" novalidate>
            @csrf

            <div class="form-grid">

                {{-- Nombre --}}
                <div class="form-group">
                    <label class="form-label" for="nombre">Nombres</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                        </span>
                        <input type="text" id="nombre" name="nombre"
                            class="form-input @error('nombre') is-error @enderror"
                            placeholder="Ej. Juan Carlos"
                            value="{{ old('nombre') }}"
                            required autocomplete="given-name">
                    </div>
                </div>

                {{-- Apellido --}}
                <div class="form-group">
                    <label class="form-label" for="apellido">Apellidos</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                        </span>
                        <input type="text" id="apellido" name="apellido"
                            class="form-input @error('apellido') is-error @enderror"
                            placeholder="Ej. Pérez"
                            value="{{ old('apellido') }}"
                            required autocomplete="family-name">
                    </div>
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">Correo Electrónico</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </span>
                        <input type="email" id="email" name="email"
                            class="form-input @error('email') is-error @enderror"
                            placeholder="correo@ejemplo.com"
                            value="{{ old('email') }}"
                            autocomplete="email">
                    </div>
                </div>

                {{-- Móvil --}}
                <div class="form-group">
                    <label class="form-label" for="movil">Móvil</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                                <line x1="12" y1="18" x2="12.01" y2="18"/>
                            </svg>
                        </span>
                        <input type="tel" id="movil" name="movil"
                            class="form-input @error('movil') is-error @enderror"
                            placeholder="300 000 0000"
                            value="{{ old('movil') }}"
                            required autocomplete="tel">
                    </div>
                </div>

                {{-- Contraseña --}}
                <div class="form-group">
                    <label class="form-label" for="password">Contraseña</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        <input type="password" id="password" name="password"
                            class="form-input @error('password') is-error @enderror"
                            placeholder="••••••••"
                            required autocomplete="new-password"
                            id="password">
                        <button type="button" class="input-toggle" id="toggle-pass" aria-label="Mostrar contraseña">
                            <svg id="eye-pass" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    {{-- Barra de fuerza --}}
                    <div class="password-strength" id="strength-bars">
                        <div class="strength-bar" id="bar1"></div>
                        <div class="strength-bar" id="bar2"></div>
                        <div class="strength-bar" id="bar3"></div>
                        <div class="strength-bar" id="bar4"></div>
                    </div>
                </div>

                {{-- Confirmar contraseña --}}
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-input"
                            placeholder="••••••••"
                            required autocomplete="new-password">
                        <button type="button" class="input-toggle" id="toggle-confirm" aria-label="Mostrar confirmación">
                            <svg id="eye-confirm" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>{{-- /form-grid --}}

            <button type="submit" class="btn-register" id="btn-reg">
                <span class="btn-text">
                    Registrarme
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                        <line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>
                    </svg>
                </span>
                <div class="btn-spinner"></div>
            </button>
        </form>

        <p class="reg-login-link">
            ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
        </p>
    </div>

</div>

<script>
(function () {
    // ── Toggle contraseña principal ──
    function toggleInput(btnId, inputId, iconId) {
        document.getElementById(btnId).addEventListener('click', function () {
            var input = document.getElementById(inputId);
            var icon  = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
            }
        });
    }
    toggleInput('toggle-pass',    'password',              'eye-pass');
    toggleInput('toggle-confirm', 'password_confirmation', 'eye-confirm');

    // ── Medidor de fuerza de contraseña ──
    var pwInput = document.getElementById('password');
    var bars    = [
        document.getElementById('bar1'),
        document.getElementById('bar2'),
        document.getElementById('bar3'),
        document.getElementById('bar4'),
    ];

    pwInput.addEventListener('input', function () {
        var val      = this.value;
        var strength = 0;
        if (val.length >= 6)                         strength++;
        if (val.length >= 10)                        strength++;
        if (/[A-Z]/.test(val) && /[0-9]/.test(val)) strength++;
        if (/[^A-Za-z0-9]/.test(val))               strength++;

        var classes = ['', 'active-weak', 'active-fair', 'active-good', 'active-strong'];
        bars.forEach(function (bar, i) {
            bar.className = 'strength-bar';
            if (i < strength) bar.classList.add(classes[strength]);
        });
    });

    // ── Spinner al enviar ──
    document.getElementById('reg-form').addEventListener('submit', function () {
        var btn = document.getElementById('btn-reg');
        btn.classList.add('loading');
        btn.disabled = true;
    });
})();
</script>

</body>
</html>
