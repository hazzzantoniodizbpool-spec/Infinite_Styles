@extends('layouts.app')

@section('title', 'Cerrar sesión - Infinite Styles')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between border-b border-[#2a2a2b] pb-4">
        <span class="font-label text-sm font-semibold uppercase tracking-[0.25em] text-[#d4af37]">Atelier Member Access</span>
        <span class="inline-flex items-center gap-2 rounded border border-[#353436] bg-[#1b1b1c] px-3 py-1.5 font-label text-xs uppercase tracking-[0.15em] text-[#d0c5af]">
            <span class="w-1.5 h-1.5 rounded-full bg-[#f2ca50]"></span>
            Bóveda cifrada
        </span>
    </div>

    {{-- Encabezado --}}
    <section class="relative text-center pt-4 bg-[radial-gradient(ellipse_at_top,rgba(212,175,55,0.12)_0%,transparent_60%)]">
        <div class="relative mx-auto w-20 h-20">
            <div class="flex h-full w-full items-center justify-center rounded-2xl border border-[#353436] bg-[#1f1f20] p-2.5">
                <div class="flex h-full w-full items-center justify-center rounded-lg border border-[#4d4635] bg-[#0e0e0f] text-[#f2ca50]">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 11h12v9H6zM8 11V8a4 4 0 118 0v3"/><circle cx="12" cy="15.5" r="1" fill="currentColor"/></svg>
                </div>
            </div>
            <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 flex h-7 w-7 items-center justify-center rounded-full border border-[#4d4635] bg-[#131314] text-[#f2ca50]">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z"/></svg>
            </span>
        </div>

        <p class="mt-7 font-label text-xs font-semibold uppercase tracking-[0.3em] text-[#f2ca50]">Privacidad &amp; seguridad de cuenta</p>
        <h1 class="mt-3 font-heading text-4xl sm:text-[2.6rem] text-[#f4f1ec]">¿Deseas finalizar tu sesión?</h1>
        <p class="mt-4 text-[#b8b0a0] leading-relaxed">
            Al desconectarte resguardaremos tus reservas agendadas, el acceso privilegiado a lanzamientos y tu saldo de cortesía en el Club VIP.
        </p>
    </section>

    {{-- Resumen de estado --}}
    <section class="vip-card space-y-3">
        <header class="flex items-center justify-between border-b border-[#2a2a2b] pb-4 mb-1">
            <span class="font-label text-xs uppercase tracking-[0.15em] text-[#d0c5af]">Resumen de estado</span>
            <span class="inline-flex items-center gap-1.5 text-sm text-[#f2ca50]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M12 3l2.4 1.8 3-.2.9 2.9 2.4 1.8-1 2.8 1 2.8-2.4 1.8-.9 2.9-3-.2L12 21l-2.4-1.8-3 .2-.9-2.9-2.4-1.8 1-2.8-1-2.8 2.4-1.8.9-2.9 3 .2L12 3z"/></svg>
                Sesión Protegida
            </span>
        </header>

        <div class="flex items-center gap-4 rounded-lg border border-[#2a2a2b] bg-[#1f1f20] p-3">
            <span class="flex h-11 w-11 items-center justify-center rounded-md bg-[#2a2a2b] text-[#f2ca50]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><rect x="7" y="3" width="10" height="18" rx="2"/><path stroke-linecap="round" d="M11 18h2"/></svg>
            </span>
            <div>
                <p class="text-[#f4f1ec]">Dispositivo activo</p>
                <p class="text-sm text-[#99907c]">{{ $device }} · {{ $activeSessions }} {{ $activeSessions === 1 ? 'sesión abierta' : 'sesiones abiertas' }}</p>
            </div>
        </div>

        <div class="flex items-center gap-4 rounded-lg border border-[#2a2a2b] bg-[#1f1f20] p-3">
            <span class="flex h-11 w-11 items-center justify-center rounded-md bg-[#2a2a2b] text-[#f2ca50]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><circle cx="12" cy="9" r="6"/><path stroke-linecap="round" stroke-linejoin="round" d="M8.5 14L7 21l5-3 5 3-1.5-7"/></svg>
            </span>
            <div>
                <p class="text-[#f4f1ec]">Membresía</p>
                <p class="text-sm text-[#f2ca50]">{{ $user->membership_tier ?? 'Black Diamond Member' }} · {{ $user->member_code }}</p>
            </div>
        </div>

        <div class="flex items-center gap-4 rounded-lg border border-[#2a2a2b] bg-[#1f1f20] p-3">
            <span class="flex h-11 w-11 items-center justify-center rounded-md bg-[#2a2a2b] text-[#f2ca50]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 3v3m8-3v3M4 9h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/></svg>
            </span>
            <div>
                <p class="text-[#f4f1ec]">Barbero titular</p>
                <p class="text-sm text-[#99907c]">Mateo Rivera · Sillón 01 Privé</p>
            </div>
        </div>
    </section>

    {{-- Formulario de cierre --}}
    <form method="POST" action="{{ route('logout') }}" class="space-y-4" id="logout-form">
        @csrf

        <label class="flex gap-4 rounded-xl border border-[#2a2a2b] bg-[#1b1b1c] p-5 cursor-pointer transition hover:border-[#d4af37]/40">
            <input type="checkbox" name="all_devices" value="1" class="mt-1 h-6 w-6 shrink-0 accent-[#f2ca50]">
            <span>
                <span class="block text-[#f4f1ec]">Cerrar sesión en todos los terminales</span>
                <span class="block mt-1 text-sm leading-relaxed text-[#99907c]">Revoca llaves de seguridad y tokens en computadoras de escritorio, tablets y navegadores compartidos.</span>
            </span>
        </label>

        <a href="{{ route('vip.perfil') }}" class="btn-gold" id="btn-mantener">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z"/></svg>
            Mantener sesión activa
        </a>

        <button type="submit" class="btn-ghost" id="btn-cerrar-sesion">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17l5-5-5-5M20 12H9M12 21H5a1 1 0 01-1-1V4a1 1 0 011-1h7"/></svg>
            Cerrar sesión
        </button>
    </form>

    <div class="pt-4 text-center">
        <p class="inline-flex items-center gap-2 text-[#99907c]">
            <svg class="w-5 h-5 text-[#d4af37]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 18h18M5 18a7 7 0 0114 0M12 8V6"/></svg>
            Atención personalizada y membresía
        </p>
        <a href="mailto:concierge@infinitestyles.com" class="mt-3 flex items-center justify-center gap-2 font-label text-sm font-semibold uppercase tracking-[0.2em] text-[#f2ca50] hover:brightness-110">
            Contactar a conserjería VIP
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6"/></svg>
        </a>
    </div>
</div>
@endsection
