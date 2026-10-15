<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaludoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta agregada por el Agente Autonomo
Route::get('/saludo', [SaludoController::class, 'index'])->name('saludo');

// Rutas generadas desde Google Stitch MCP (Haute Edition)

// Pantalla "Iniciar sesion" (acceso + registro de membresía)
Route::middleware('guest')->group(function () {
    Route::get('/iniciar-sesion', [AuthController::class, 'create'])->name('login');
    Route::post('/iniciar-sesion', [AuthController::class, 'login'])->name('login.store');
    Route::post('/registro', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    // Pantalla "Editar perfil"
    Route::get('/perfil-vip', [PerfilController::class, 'edit'])->name('vip.perfil');
    Route::put('/perfil-vip', [PerfilController::class, 'update'])->name('vip.perfil.update');

    // Pantalla "Cerrar sesion"
    Route::get('/cerrar-sesion', [AuthController::class, 'confirmLogout'])->name('logout.confirm');
    Route::post('/cerrar-sesion', [AuthController::class, 'logout'])->name('logout');
});
