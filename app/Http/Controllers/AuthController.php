<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* ══════════════════════════════════════
       HELPER DE REDIRECCIÓN POR ROL
    ══════════════════════════════════════ */

    private function redirectByRole()
    {
        if (Auth::user()?->isCliente()) {
            return redirect()->route('tienda');
        }

        return redirect()->route('dashboard');
    }

    /* ══════════════════════════════════════
       LOGIN
    ══════════════════════════════════════ */

    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'movil' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'movil.required' => 'Ingrese su correo electrónico o número de móvil.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $loginInput = trim((string) $request->input('movil'));
        $remember = $request->boolean('remember');

        // Determinar si ingresó correo o teléfono móvil
        $campo = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'movil';

        // Intentar con el campo detectado
        if (Auth::attempt([$campo => $loginInput, 'password' => $request->password], $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->isCliente()) {
                return redirect()->intended(route('tienda'));
            }

            return redirect()->intended(route('dashboard'));
        }

        // Si falló, intentar también con el campo alternativo por si acaso
        $campoAlternativo = ($campo === 'email') ? 'movil' : 'email';
        if (Auth::attempt([$campoAlternativo => $loginInput, 'password' => $request->password], $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->isCliente()) {
                return redirect()->intended(route('tienda'));
            }

            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withInput($request->only('movil'))
            ->withErrors(['movil' => 'Credenciales incorrectas. Verifique su usuario y contraseña.']);
    }

    /* ══════════════════════════════════════
       REGISTRO
    ══════════════════════════════════════ */

    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:80'],
            'apellido' => ['required', 'string', 'max:80'],
            'email' => ['nullable', 'email', 'max:120', 'unique:users,email'],
            'movil' => ['required', 'string', 'max:20', 'unique:users,movil'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'email.email' => 'Ingrese un correo válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'movil.required' => 'El número de móvil es obligatorio.',
            'movil.unique' => 'Este número de móvil ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = User::create([
            'rol' => 'cliente',
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email ?: null,
            'movil' => $request->movil,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('tienda')->with('bienvenida', '¡Bienvenido(a), '.$user->nombre.'!');
    }

    /* ══════════════════════════════════════
       LOGOUT
    ══════════════════════════════════════ */

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
