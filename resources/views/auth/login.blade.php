<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar – Almacén Europa</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

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

        /* ── Card contenedor ── */
        .login-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
            max-width: 880px;
            min-height: 520px;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 24px 80px rgba(13,27,72,.18), 0 4px 20px rgba(13,27,72,.08);
        }

        /* ══════════════════════════════
           PANEL IZQUIERDO – Azul
        ══════════════════════════════ */
        .login-left {
            background: linear-gradient(160deg, #0d1f5c 0%, #122580 40%, #1440b0 100%);
            padding: 36px 36px 40px;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        /* Efecto de fondo radial */
        .login-left::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -30%;
            width: 70%;
            height: 70%;
            background: radial-gradient(circle, rgba(56,189,248,.18) 0%, transparent 65%);
            pointer-events: none;
        }
        .login-left::after {
            content: '';
            position: absolute;
            bottom: 10%;
            left: -20%;
            width: 60%;
            height: 50%;
            background: radial-gradient(circle, rgba(29,116,232,.14) 0%, transparent 65%);
            pointer-events: none;
        }

        /* Volver al inicio */
        .login-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: rgba(255,255,255,.72);
            font-size: .825rem;
            font-weight: 500;
            text-decoration: none;
            transition: color .2s;
            position: relative; z-index: 1;
            margin-bottom: auto;
        }
        .login-back:hover { color: #fff; }
        .login-back svg { flex-shrink: 0; }

        /* Logo y texto central */
        .login-left__body {
            position: relative; z-index: 1;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 32px 0 36px;
        }

        .login-logo-icon {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, #1d74e8, #38bdf8);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 28px;
            box-shadow: 0 6px 20px rgba(29,116,232,.45);
        }
        .login-logo-icon svg { width: 26px; height: 26px; }

        .login-left__title {
            font-family: 'Outfit', sans-serif;
            font-size: 2.25rem;
            font-weight: 900;
            color: #fff;
            line-height: 1.1;
            letter-spacing: -.03em;
            margin-bottom: 18px;
        }
        .login-left__desc {
            font-size: .9rem;
            color: rgba(255,255,255,.65);
            line-height: 1.7;
            max-width: 260px;
        }

        /* Badge servidor conectado */
        .login-server-badge {
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
        .server-dot {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: rgba(34,197,94,.15);
            border: 1px solid rgba(34,197,94,.3);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .server-dot-inner {
            width: 12px; height: 12px;
            background: #22c55e;
            border-radius: 50%;
            box-shadow: 0 0 0 4px rgba(34,197,94,.25);
            animation: pulse-server 2.2s ease-in-out infinite;
        }
        @keyframes pulse-server {
            0%, 100% { box-shadow: 0 0 0 4px rgba(34,197,94,.25); }
            50%       { box-shadow: 0 0 0 8px rgba(34,197,94,.1); }
        }
        .server-info strong {
            display: block;
            font-size: .875rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 2px;
        }
        .server-info span {
            font-size: .75rem;
            color: rgba(255,255,255,.5);
        }

        /* ══════════════════════════════
           PANEL DERECHO – Formulario
        ══════════════════════════════ */
        .login-right {
            padding: 44px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right__title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.9rem;
            font-weight: 900;
            color: #0d1b35;
            letter-spacing: -.03em;
            margin-bottom: 6px;
        }
        .login-right__sub {
            font-size: .9rem;
            color: #64748b;
            margin-bottom: 36px;
        }

        /* Alerta de error */
        .login-alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: .85rem;
            color: #dc2626;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .login-alert svg { flex-shrink: 0; }

        /* Grupos de campo */
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: .875rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }
        .form-label a {
            font-size: .8rem;
            font-weight: 500;
            color: #1d74e8;
            text-decoration: none;
            transition: color .2s;
        }
        .form-label a:hover { color: #1558c0; text-decoration: underline; }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-icon {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            pointer-events: none;
        }
        .form-input {
            width: 100%;
            padding: 13px 16px 13px 42px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: .9rem;
            color: #0d1b35;
            background: #fff;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-input::placeholder { color: #94a3b8; }
        .form-input:focus {
            border-color: #1d74e8;
            box-shadow: 0 0 0 3px rgba(29,116,232,.12);
        }
        .form-input.is-error { border-color: #ef4444; }
        .form-input.is-error:focus { box-shadow: 0 0 0 3px rgba(239,68,68,.1); }

        /* Toggle contraseña */
        .input-toggle {
            position: absolute;
            right: 14px;
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

        /* Remember me */
        .form-remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 26px;
        }
        .form-remember input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: #1d74e8;
            cursor: pointer;
        }
        .form-remember label {
            font-size: .85rem;
            color: #475569;
            cursor: pointer;
            user-select: none;
        }

        /* Botón submit */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1d74e8, #1440b0);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: .01em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: opacity .2s, transform .2s, box-shadow .2s;
            box-shadow: 0 6px 24px rgba(29,116,232,.4);
            margin-bottom: 24px;
        }
        .btn-login:hover {
            opacity: .93;
            transform: translateY(-1px);
            box-shadow: 0 10px 32px rgba(29,116,232,.5);
        }
        .btn-login:active { transform: translateY(0); }

        /* Spinner dentro del botón */
        .btn-spinner {
            display: none;
            width: 18px; height: 18px;
            border: 2.5px solid rgba(255,255,255,.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .btn-login.loading .btn-text  { display: none; }
        .btn-login.loading .btn-spinner { display: block; }

        /* Registro */
        .login-register {
            text-align: center;
            font-size: .875rem;
            color: #64748b;
        }
        .login-register a {
            color: #1d74e8;
            font-weight: 700;
            text-decoration: none;
            transition: color .2s;
        }
        .login-register a:hover { color: #1440b0; text-decoration: underline; }

        /* ── Responsive ── */
        @media (max-width: 680px) {
            body { padding: 16px; }
            .login-card { grid-template-columns: 1fr; max-width: 420px; }
            .login-left { display: none; }
            .login-right { padding: 36px 28px; }
        }
    </style>
</head>
<body>

<div class="login-card">

    {{-- ── Panel izquierdo ── --}}
    <div class="login-left">
        <a href="{{ url('/') }}" class="login-back">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Volver al inicio
        </a>

        <div class="login-left__body">
            <div class="login-logo-icon">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="3" width="20" height="14" rx="3" fill="white" fill-opacity="0.2" stroke="white" stroke-width="1.5"/>
                    <path d="M7 9h10M7 12h6" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M8 17v4M16 17v4M5 21h14" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>

            <h1 class="login-left__title">Gestión<br>Inteligente</h1>
            <p class="login-left__desc">
                Acceda al panel de control central para supervisar el inventario,
                procesar ventas y analizar el rendimiento en tiempo real.
            </p>
        </div>

        <div class="login-server-badge">
            <div class="server-dot">
                <div class="server-dot-inner"></div>
            </div>
            <div class="server-info">
                <strong>Servidor Conectado</strong>
                <span>Conexión cifrada SSL</span>
            </div>
        </div>
    </div>

    {{-- ── Panel derecho – Formulario ── --}}
    <div class="login-right">
        <h2 class="login-right__title">Bienvenido de nuevo</h2>
        <p class="login-right__sub">Ingrese sus credenciales para continuar</p>

        {{-- Error general --}}
        @if ($errors->any())
            <div class="login-alert">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                {{ $errors->first('movil') ?? $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" id="login-form">
            @csrf

            {{-- Móvil / Usuario --}}
            <div class="form-group">
                <label class="form-label" for="movil">Número de Móvil</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                            <line x1="12" y1="18" x2="12.01" y2="18"/>
                        </svg>
                    </span>
                    <input
                        type="text"
                        id="movil"
                        name="movil"
                        class="form-input @error('movil') is-error @enderror"
                        placeholder="3001234567"
                        value="{{ old('movil') }}"
                        required
                        autofocus
                        autocomplete="username"
                    >
                </div>
            </div>

            {{-- Contraseña --}}
            <div class="form-group">
                <label class="form-label" for="password">
                    Contraseña
                    <a href="#">¿Olvidó su contraseña?</a>
                </label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input @error('password') is-error @enderror"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="input-toggle" id="toggle-password" aria-label="Mostrar contraseña">
                        <svg id="eye-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Recordarme --}}
            <div class="form-remember">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Mantener sesión iniciada</label>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-login" id="btn-login">
                <span class="btn-text">Ingresar al Sistema →</span>
                <div class="btn-spinner"></div>
            </button>
        </form>

        <p class="login-register">
            ¿Nuevo empleado? <a href="{{ route('register') }}">Regístrese aquí</a>
        </p>
    </div>

</div>

<script>
    // Toggle mostrar/ocultar contraseña
    document.getElementById('toggle-password').addEventListener('click', function () {
        const input = document.getElementById('password');
        const icon  = document.getElementById('eye-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>';
        } else {
            input.type = 'password';
            icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
        }
    });

    // Spinner en submit
    document.getElementById('login-form').addEventListener('submit', function () {
        var btn = document.getElementById('btn-login');
        btn.classList.add('loading');
        btn.disabled = true;
    });
</script>

</body>
</html>
