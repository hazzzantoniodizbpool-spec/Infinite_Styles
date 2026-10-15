<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Pantalla Stitch: "Editar perfil" (vip/perfil.blade.php).
 */
class PerfilController extends Controller
{
    public const DRINKS = [
        'espresso' => ['Café Espresso de Finca Geisha', 'Tueste artesanal, servido con chocolate 85%'],
        'whisky'   => ['Whisky Single Malt 18 Años', 'Esfera de hielo cristalina tallada en directo'],
        'agua'     => ['Agua Mineral Nórdica & Cítricos', 'Infusión fría de bergamota y hojas de menta'],
    ];

    public const TREATMENTS = [
        'cera_mate' => ['Cera Mate Atelier', 'Fijación sutil natural'],
        'elixir_oud' => ['Elixir de Oud & Argán', 'Cuidado de barba'],
    ];

    /** GET /perfil-vip */
    public function edit(Request $request)
    {
        return view('vip.perfil', [
            'user'       => $request->user(),
            'drinks'     => self::DRINKS,
            'treatments' => self::TREATMENTS,
            'styles'     => AuthController::STYLES,
        ]);
    }

    /** PUT /perfil-vip */
    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name'          => ['required', 'string', 'max:120'],
            'email'         => ['required', 'email', 'max:180', Rule::unique('users', 'email')->ignore($user->id)],
            'phone'         => ['nullable', 'string', 'max:30'],
            'birth_date'    => ['nullable', 'date', 'before:today'],
            'welcome_drink' => ['nullable', Rule::in(array_keys(self::DRINKS))],
            'treatments'    => ['nullable', 'array'],
            'treatments.*'  => [Rule::in(array_keys(self::TREATMENTS))],
        ], [], [
            'name' => 'nombre', 'email' => 'correo electrónico', 'phone' => 'teléfono',
            'birth_date' => 'fecha de nacimiento', 'welcome_drink' => 'bebida de bienvenida',
        ]);

        $data['treatments'] = $data['treatments'] ?? [];

        $user->update($data);

        return redirect()->route('vip.perfil')->with('status', 'Cambios guardados correctamente.');
    }
}
