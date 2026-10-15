@extends('layouts.app')

@section('title', 'Editar perfil - Infinite Styles')

@section('content')
@php
    $drinkIcons = [
        'espresso' => 'M4 8h13v5a5 5 0 01-5 5H9a5 5 0 01-5-5V8zm13 1h1.5a2.5 2.5 0 010 5H17M7 3v2m4-2v2',
        'whisky'   => 'M8 3h8v4l1.5 2v10a2 2 0 01-2 2h-7a2 2 0 01-2-2V9L8 7V3zm-1.5 9h11',
        'agua'     => 'M12 3s6 6.5 6 11a6 6 0 01-12 0c0-4.5 6-11 6-11z',
    ];
    $selectedDrink = old('welcome_drink', $user->welcome_drink ?? 'whisky');
    $selectedTreatments = old('treatments', $user->treatments ?? []);
@endphp

<form method="POST" action="{{ route('vip.perfil.update') }}" class="space-y-8" id="perfil-form">
    @csrf
    @method('PUT')

    {{-- Tarjeta del miembro --}}
    <section class="vip-card relative overflow-hidden text-center bg-[radial-gradient(ellipse_at_top,#2a2618_0%,#1b1b1c_60%)]">
        <div class="relative mx-auto w-32 h-32">
            <div class="w-full h-full rounded-2xl border-[3px] border-[#f2ca50] bg-gradient-to-br from-[#2a2a2b] to-[#0e0e0f] shadow-[0_0_35px_rgba(242,202,80,0.3)] flex items-center justify-center">
                <span class="font-heading text-4xl text-[#f2ca50]">{{ $user->initials() }}</span>
            </div>
            <span class="absolute -bottom-2 -right-2 flex h-10 w-10 items-center justify-center rounded-full border border-[#4d4635] bg-[#2a2a2b] text-[#f2ca50]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8h3l2-3h6l2 3h3v11H4V8z"/><circle cx="12" cy="13" r="3.5"/></svg>
            </span>
        </div>

        <h1 class="mt-6 font-heading text-3xl sm:text-4xl text-[#f4f1ec]">{{ $user->name }}</h1>

        <div class="mt-4 flex flex-wrap items-center justify-center gap-3">
            <span class="inline-flex items-center gap-2 rounded-full border border-[#d4af37]/60 bg-[#2a2510]/60 px-4 py-1.5 font-label text-xs uppercase tracking-[0.2em] text-[#f2ca50]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 3h12l3 6-9 12L3 9l3-6zM3 9h18M9 3l3 18 3-18"/></svg>
                {{ $user->membership_tier ?? 'Black Diamond Member' }}
            </span>
            <span class="rounded bg-[#0e0e0f] px-3 py-1.5 font-mono text-sm tracking-widest text-[#b8b0a0]">{{ $user->member_code ?? 'INF-0000' }}</span>
        </div>

        <p class="mt-5 text-[#b8b0a0] leading-relaxed">
            Socio distinguido desde {{ $user->created_at?->format('Y') }}. Configuración de perfil privado para atención confidencial y concierge de asiento.
        </p>
    </section>

    {{-- Datos personales --}}
    <section class="vip-card space-y-6">
        <header class="flex items-center justify-between border-b border-[#2a2a2b] pb-4">
            <h2 class="flex items-center gap-3 font-heading text-xl tracking-[0.15em] uppercase text-[#f4f1ec]">
                <svg class="w-5 h-5 text-[#f2ca50]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 20c1.5-4 4.5-6 8-6s6.5 2 8 6"/></svg>
                Datos personales
            </h2>
            <span class="font-label text-[11px] uppercase tracking-[0.2em] text-[#99907c]">Bóveda cifrada</span>
        </header>

        <div>
            <label for="name" class="vip-label">Nombre y apellidos</label>
            <input id="name" name="name" value="{{ old('name', $user->name) }}" required class="vip-input mt-3">
            @error('name') <p class="vip-error">{{ $message }}</p> @enderror
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="email" class="vip-label">Correo electrónico</label>
                <span class="inline-flex items-center gap-1.5 font-label text-xs uppercase tracking-wider text-[#f2ca50]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M12 3l2.4 1.8 3-.2.9 2.9 2.4 1.8-1 2.8 1 2.8-2.4 1.8-.9 2.9-3-.2L12 21l-2.4-1.8-3 .2-.9-2.9-2.4-1.8 1-2.8-1-2.8 2.4-1.8.9-2.9 3 .2L12 3z"/></svg>
                    Verificado
                </span>
            </div>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required class="vip-input mt-3">
            @error('email') <p class="vip-error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="phone" class="vip-label">Teléfono directo VIP</label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+34 644 892 104" class="vip-input mt-3">
            @error('phone') <p class="vip-error">{{ $message }}</p> @enderror
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="birth_date" class="vip-label">Fecha de nacimiento</label>
                <span class="font-label text-xs uppercase tracking-wider text-[#d4af37]">Cortesía de aniversario</span>
            </div>
            <input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date', $user->birth_date?->format('Y-m-d')) }}" class="vip-input mt-3 [color-scheme:dark]">
            <p class="mt-2 text-sm text-[#99907c]">Coordinaremos una botella reserva y protocolo completo de afeitado durante su semana homenaje.</p>
            @error('birth_date') <p class="vip-error">{{ $message }}</p> @enderror
        </div>
    </section>

    {{-- Preferencias de Lounge & Atelier --}}
    <section class="vip-card space-y-6">
        <header class="flex items-center justify-between border-b border-[#2a2a2b] pb-4">
            <h2 class="flex items-center gap-3 font-heading text-xl tracking-[0.15em] uppercase text-[#f4f1ec]">
                <svg class="w-5 h-5 text-[#f2ca50]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 18h18M5 18a7 7 0 0114 0M12 8V6m-1-1h2"/></svg>
                Preferencias de Lounge &amp; Atelier
            </h2>
            <span class="font-label text-[11px] uppercase tracking-[0.2em] text-[#99907c]">Concierge</span>
        </header>

        <div>
            <p class="vip-label">Barbero titular asignado</p>
            <div class="mt-3 flex items-center gap-4 rounded-lg border border-[#2a2a2b] bg-[#0e0e0f] p-4">
                <img src="{{ asset('images/barbero-mateo.jpg') }}" alt="Mateo Rivera, Master Barber" class="h-16 w-16 rounded-lg border border-[#d4af37]/60 object-cover">
                <div class="flex-1">
                    <p class="font-heading text-lg text-[#f4f1ec]">Mateo Rivera</p>
                    <p class="font-label text-xs uppercase tracking-wider text-[#d4af37]">Master Barber • Sillón 01 Privé</p>
                </div>
                <span class="rounded border border-[#4d4635] px-3 py-2 font-label text-xs uppercase tracking-widest text-[#d4af37]">Titular</span>
            </div>
        </div>

        <fieldset>
            <legend class="vip-label">Bebida de bienvenida en Sanctuary Lounge</legend>
            <div class="mt-3 space-y-3">
                @foreach ($drinks as $key => [$title, $sub])
                    <label class="flex cursor-pointer items-center gap-4 rounded-lg border border-[#2a2a2b] bg-[#0e0e0f] p-4 transition hover:border-[#d4af37]/40 has-[:checked]:border-[#d4af37]">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#2a2a2b] text-[#f2ca50]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $drinkIcons[$key] }}"/></svg>
                        </span>
                        <span class="flex-1">
                            <span class="block text-[#f4f1ec]">{{ $title }}</span>
                            <span class="block text-sm text-[#99907c]">{{ $sub }}</span>
                        </span>
                        <input type="radio" name="welcome_drink" value="{{ $key }}" {{ $selectedDrink === $key ? 'checked' : '' }} class="h-5 w-5 accent-[#f2ca50]">
                    </label>
                @endforeach
            </div>
            @error('welcome_drink') <p class="vip-error">{{ $message }}</p> @enderror
        </fieldset>

        <fieldset>
            <legend class="vip-label">Acabado &amp; tratamiento de cortesía</legend>
            <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach ($treatments as $key => [$title, $sub])
                    <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-[#2a2a2b] bg-[#0e0e0f] p-4 transition hover:border-[#d4af37]/40 has-[:checked]:border-[#d4af37]/70">
                        <input type="checkbox" name="treatments[]" value="{{ $key }}" {{ in_array($key, $selectedTreatments) ? 'checked' : '' }} class="mt-0.5 h-5 w-5 accent-[#f2ca50]">
                        <span>
                            <span class="block text-[#f4f1ec]">{{ $title }}</span>
                            <span class="block text-sm text-[#99907c]">{{ $sub }}</span>
                        </span>
                    </label>
                @endforeach
            </div>
        </fieldset>
    </section>

    {{-- Método de pago VIP --}}
    <section class="vip-card space-y-6">
        <header class="flex items-center justify-between border-b border-[#2a2a2b] pb-4">
            <h2 class="flex items-center gap-3 font-heading text-xl tracking-[0.15em] uppercase text-[#f4f1ec]">
                <svg class="w-5 h-5 text-[#f2ca50]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18"/></svg>
                Método de pago VIP
            </h2>
        </header>

        <div class="relative overflow-hidden rounded-xl border border-[#4d4635] bg-gradient-to-br from-[#2a2618] via-[#151515] to-[#0b0b0c] p-6 shadow-[0_12px_40px_rgba(0,0,0,0.6)]">
            <div class="flex items-start justify-between">
                <div>
                    <p class="font-label text-[11px] uppercase tracking-[0.3em] text-[#d4af37]">Infinite Sanctuary</p>
                    <p class="mt-1 font-heading text-2xl text-[#f4f1ec]">Infinite Obsidian Pass</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-xl border border-[#d4af37]/60 text-[#f2ca50]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M9 9v6m3-7v8m3-6v4"/></svg>
                </span>
            </div>
            <div class="mt-6 flex items-center gap-3">
                <span class="h-8 w-12 rounded border border-[#d4af37]/70 bg-gradient-to-br from-[#a8873a] to-[#5c4a1f]"></span>
                <span class="font-label text-xs uppercase tracking-[0.3em] text-[#99907c]">Pass Privé</span>
            </div>
            <p class="mt-6 font-mono text-lg tracking-[0.3em] text-[#e5e2e3]">•••• •••• •••• 4021</p>
            <div class="mt-3 flex items-center justify-between">
                <p class="font-label text-xs uppercase tracking-widest text-[#99907c]">Exp 09/28 • {{ $user->name }}</p>
                <span class="rounded-full border border-[#d4af37]/70 px-3 py-1 font-label text-[11px] uppercase tracking-wider text-[#f2ca50]">Principal</span>
            </div>
        </div>

        <p class="flex items-center gap-3 text-sm text-[#99907c]">
            <svg class="w-5 h-5 shrink-0 text-[#d4af37]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z"/></svg>
            Facturación sin contacto en lounge. Tokenización bancaria de máxima reserva.
        </p>
    </section>

    <button type="submit" class="btn-gold" id="btn-guardar">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        Guardar cambios
    </button>

    <div class="flex items-center justify-between font-label text-sm uppercase tracking-[0.15em]">
        <a href="{{ route('logout.confirm') }}" class="inline-flex items-center gap-2 text-[#d0c5af] hover:text-[#f2ca50]" id="link-seguridad">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 12a8 8 0 108-8 8 8 0 00-6 2.7M4 4v3h3"/><path d="M10 12h4v3h-4z"/></svg>
            Seguridad
        </a>
        <a href="{{ route('logout.confirm') }}" class="inline-flex items-center gap-2 text-[#e8a39b] hover:text-[#ffb4ab]" id="link-cerrar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17l5-5-5-5M20 12H9M12 21H5a1 1 0 01-1-1V4a1 1 0 011-1h7"/></svg>
            Cerrar sesión
        </a>
    </div>
</form>
@endsection
