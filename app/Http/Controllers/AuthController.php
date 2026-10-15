<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Pantallas Stitch: "Iniciar sesion" (registro + acceso) y "Cerrar sesion".
 */
class AuthController extends Controller
{
    public const STYLES = [
        'cortes'   => ['Cortes de Autor', 'Tijera & Precision Fade'],
        'barba'    => ['Barba Clásica', 'Navaja & Toalla Caliente'],
        'facial'   => ['Ritual Facial', 'Vapor ozono & Arcillas'],
        'masterclass' => ['Masterclasses Pro', 'Formación de Alta Barbería'],
    ];

    /** GET /iniciar-sesion */
    public function create(Request $request)
    {
        return view('auth.iniciar-sesion', [
            'modo'   => $request->query('modo') === 'registro' ? 'registro' : 'login',
            'styles' => self::STYLES,
        ]);
    }

    /** POST /iniciar-sesion */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [], ['email' => 'correo electrónico', 'password' => 'contraseña']);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'Las credenciales no coinciden con ninguna membresía.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('vip.perfil'))
            ->with('status', 'Bienvenido de nuevo, ' . Auth::user()->name . '.');
    }

    /** POST /registro */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'             => ['required', 'string', 'max:120'],
            'email'            => ['required', 'email', 'max:180', 'unique:users,email'],
            'phone'            => ['nullable', 'string', 'max:30'],
            'password'         => ['required', 'confirmed', Password::min(8)],
            'style_preference' => ['required', Rule::in(array_keys(self::STYLES))],
            'terms'            => ['accepted'],
        ], [
            'terms.accepted' => 'Debes aceptar los Términos del Club VIP.',
        ], [
            'name' => 'nombre', 'email' => 'correo electrónico', 'phone' => 'teléfono',
            'password' => 'contraseña', 'style_preference' => 'preferencia de estilo',
        ]);

        $user = User::create([
            'name'             => $data['name'],
            'email'            => $data['email'],
            'phone'            => $data['phone'] ?? null,
            'password'         => $data['password'],
            'style_preference' => $data['style_preference'],
            'member_code'      => 'INF-' . random_int(1000, 9999),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('vip.perfil')
            ->with('status', '¡Membresía creada! Bienvenido al Infinite Club.');
    }

    /** GET /cerrar-sesion */
    public function confirmLogout(Request $request)
    {
        $activeSessions = DB::table('sessions')
            ->where('user_id', $request->user()->id)
            ->count();

        return view('auth.cerrar-sesion', [
            'user'           => $request->user(),
            'activeSessions' => $activeSessions,
            'device'         => $this->deviceLabel($request->userAgent()),
        ]);
    }

    /** POST /cerrar-sesion */
    public function logout(Request $request)
    {
        $user = $request->user();

        // "Cerrar sesión en todos los terminales": borra todas las sesiones del usuario
        if ($request->boolean('all_devices')) {
            DB::table('sessions')->where('user_id', $user->id)->delete();
            $user->setRememberToken(null);
            $user->save();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'Sesión finalizada de forma segura.');
    }

    private function deviceLabel(?string $ua): string
    {
        $ua = (string) $ua;
        $browser = match (true) {
            str_contains($ua, 'Edg')     => 'Edge',
            str_contains($ua, 'Chrome')  => 'Chrome',
            str_contains($ua, 'Firefox') => 'Firefox',
            str_contains($ua, 'Safari')  => 'Safari',
            default                      => 'Navegador',
        };
        $os = match (true) {
            str_contains($ua, 'Windows') => 'Windows',
            str_contains($ua, 'iPhone')  => 'iPhone',
            str_contains($ua, 'Android') => 'Android',
            str_contains($ua, 'Mac')     => 'macOS',
            str_contains($ua, 'Linux')   => 'Linux',
            default                      => 'Dispositivo',
        };

        return "$browser en $os";
    }
}
