<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaludoController extends Controller
{
    /**
     * Muestra un saludo dinámico con información del sistema.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $saludo = [
            'titulo' => '¡Bienvenido a Laravel!',
            'mensaje' => 'Este saludo dinámico proviene del controlador SaludoController, demostrando la arquitectura MVC de Laravel.',
            'autor' => 'Agente Inteligente de Laravel',
            'fecha' => date('d/m/Y'),
            'hora' => date('H:i:s'),
            'version_laravel' => app()->version(),
            'version_php' => PHP_VERSION,
            'tecnologias' => ['Laravel', 'PHP 8', 'Blade', 'AI Agents'],
        ];

        return view('saludo', compact('saludo'));
    }
}