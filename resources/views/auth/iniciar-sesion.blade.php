@extends('layouts.app')

@section('title', ($modo === 'registro' ? 'Membresía Infinite Club' : 'Iniciar sesión') . ' - Infinite Styles')

@section('content')
<div class="space-y-8">

    {{-- Encabezado (Stitch: "Membresía Infinite Club") --}}
    <section class="text-center">
        <span class="inline-flex items-center gap-2 rounded-full border border-[#d4af37]/40 bg-[#201f20] px-4 py-1.5 font-label text-xs font-semibold uppercase tracking-[0.25em] text-[#f2ca50]">
            <span class="w-1.5 h-1.5 rounded-full bg-[#f2ca50] animate-pulse"></span>
            Membresía exclusiva
        </span>
        <h1 class="mt-5 font-heading text-4xl sm:text-5xl text-[#f4f1ec]">
            Membresía <em class="text-[#f2ca50]">Infinite Club</em>
        </h1>
        <p class="mt-4 text-[#b8b0a0] leading-relaxed">
            Acceso distinguido a servicios de autor, agenda de cortesía prioritaria y experiencias sartoriales reservadas.
        </p>
    </section>

    {{-- Privilegios --}}
    <section class="grid grid-cols-3 gap-3 rounded-xl border border-[#2a2a2b] bg-[#1b1b1c] p-3">
        @foreach ([
            ['Prioridad', 'Agenda 24/7', 'M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z'],
            ['Cortesía', 'Bar & Lounge', 'M8 3h8l-1 7a3 3 0 01-6 0L8 3zm4 10v6m-3 2h6'],
            ['Privilegio', '15% de Autor', 'M12 3l2.6 5.6 6 .7-4.5 4.1 1.2 6L12 16.5 6.7 19.4l1.2-6L3.4 9.3l6-.7L12 3z'],
        ] as [$t, $s, $icon])
            <div class="rounded-lg border border-[#2a2a2b] bg-[#161617] px-2 py-4 text-center">
                <svg class="mx-auto w-6 h-6 text-[#f2ca50]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
                <p class="mt-2 font-label text-xs font-semibold uppercase tracking-widest text-[#e5e2e3]">{{ $t }}</p>
                <p class="mt-1 text-xs text-[#99907c]">{{ $s }}</p>
            </div>
        @endforeach
    </section>

    {{-- Maestros del gremio --}}
    <section class="relative overflow-hidden rounded-xl border border-[#2a2a2b]">
        <img src="{{ asset('images/barber-tools.jpg') }}" alt="Herramientas de barbería de autor" class="absolute inset-0 h-full w-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-r from-[#131314] via-[#131314]/80 to-transparent"></div>
        <div class="relative flex items-center gap-4 px-6 py-8">
            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full border border-[#d4af37]/60 bg-[#2a2a2b] text-[#f2ca50]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M12 3l2.4 1.8 3-.2.9 2.9 2.4 1.8-1 2.8 1 2.8-2.4 1.8-.9 2.9-3-.2L12 21l-2.4-1.8-3 .2-.9-2.9-2.4-1.8 1-2.8-1-2.8 2.4-1.8.9-2.9 3 .2L12 3z"/></svg>
            </span>
            <div>
                <p class="font-label text-sm font-semibold uppercase tracking-[0.2em] text-[#f4f1ec]">Maestros del gremio</p>
                <p class="text-sm text-[#b8b0a0]">Atención personalizada bajo cita previa</p>
            </div>
        </div>
    </section>

    {{-- Selector de modo --}}
    <div class="grid grid-cols-2 rounded-lg border border-[#2a2a2b] bg-[#161617] p-1 font-label text-xs uppercase tracking-[0.2em]">
        <a href="{{ route('login') }}" id="tab-login"
           class="rounded-md py-3 text-center transition {{ $modo === 'login' ? 'bg-[#2a2a2b] text-[#f2ca50]' : 'text-[#99907c] hover:text-[#e5e2e3]' }}">Iniciar sesión</a>
        <a href="{{ route('login', ['modo' => 'registro']) }}" id="tab-registro"
           class="rounded-md py-3 text-center transition {{ $modo === 'registro' ? 'bg-[#2a2a2b] text-[#f2ca50]' : 'text-[#99907c] hover:text-[#e5e2e3]' }}">Crear membresía</a>
    </div>

    @if ($modo === 'login')
        {{-- ============ FORMULARIO DE ACCESO ============ --}}
        <form method="POST" action="{{ route('login.store') }}" class="space-y-6" id="login-form">
            @csrf
            <div>
                <label for="login-email" class="vip-label">Correo electrónico</label>
                <div class="relative mt-3">
                    <svg class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#99907c]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4zM4 7l8 6 8-6"/></svg>
                    <input id="login-email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="tu.estilo@ejemplo.com" class="vip-input pl-12">
                </div>
                @error('email') <p class="vip-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="login-password" class="vip-label">Contraseña de seguridad</label>
                <div class="relative mt-3">
                    <svg class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#99907c]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 11h12v9H6zM8 11V8a4 4 0 118 0v3"/></svg>
                    <input id="login-password" type="password" name="password" required autocomplete="current-password" placeholder="Tu contraseña" class="vip-input pl-12 pr-12" data-password>
                    <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#99907c] hover:text-[#f2ca50]" data-toggle-password aria-label="Mostrar contraseña">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                @error('password') <p class="vip-error">{{ $message }}</p> @enderror
            </div>

            <label class="flex items-center gap-3 text-sm text-[#b8b0a0] cursor-pointer">
                <input type="checkbox" name="remember" class="h-5 w-5 rounded border-[#4d4635] bg-[#0e0e0f] accent-[#f2ca50]">
                Mantener sesión iniciada en este dispositivo
            </label>

            <button type="submit" class="btn-gold" id="btn-login">
                Iniciar sesión
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6"/></svg>
            </button>

            <p class="text-center text-sm text-[#b8b0a0]">
                ¿Aún no eres miembro?
                <a href="{{ route('login', ['modo' => 'registro']) }}" class="ml-1 font-label font-semibold uppercase tracking-widest text-[#f2ca50] border-b border-[#f2ca50]">Crear membresía</a>
            </p>
        </form>
    @else
        {{-- ============ FORMULARIO DE REGISTRO (Stitch) ============ --}}
        <form method="POST" action="{{ route('register.store') }}" class="space-y-6" id="register-form">
            @csrf

            <div>
                <div class="flex items-center justify-between">
                    <label for="reg-name" class="vip-label">Nombre y apellidos</label>
                    <span class="font-label text-xs uppercase tracking-[0.2em] text-[#d4af37]">Obligatorio</span>
                </div>
                <div class="relative mt-3">
                    <svg class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#99907c]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 20c1.5-4 4.5-6 8-6s6.5 2 8 6"/></svg>
                    <input id="reg-name" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Ej. Alejandro Mendoza" class="vip-input pl-12">
                </div>
                @error('name') <p class="vip-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="reg-email" class="vip-label">Correo electrónico</label>
                <div class="relative mt-3">
                    <svg class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#99907c]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4zM4 7l8 6 8-6"/></svg>
                    <input id="reg-email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="tu.estilo@ejemplo.com" class="vip-input pl-12">
                </div>
                @error('email') <p class="vip-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="reg-phone" class="vip-label">Teléfono móvil</label>
                    <span class="font-label text-xs uppercase tracking-[0.15em] text-[#d4af37]">WhatsApp VIP</span>
                </div>
                <div class="relative mt-3">
                    <svg class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#99907c]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><rect x="7" y="3" width="10" height="18" rx="2"/><path stroke-linecap="round" d="M11 18h2"/></svg>
                    <input id="reg-phone" type="tel" name="phone" value="{{ old('phone') }}" autocomplete="tel" placeholder="+34 600 000 000" class="vip-input pl-12">
                </div>
                <p class="mt-2 text-xs text-[#99907c]">Canal exclusivo para confirmaciones discretas y recordatorios.</p>
                @error('phone') <p class="vip-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="reg-password" class="vip-label">Contraseña de seguridad</label>
                <div class="relative mt-3">
                    <svg class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#99907c]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 11h12v9H6zM8 11V8a4 4 0 118 0v3"/></svg>
                    <input id="reg-password" type="password" name="password" required minlength="8" autocomplete="new-password" placeholder="Mínimo 8 caracteres" class="vip-input pl-12 pr-12" data-password data-strength-source>
                    <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#99907c] hover:text-[#f2ca50]" data-toggle-password aria-label="Mostrar contraseña">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                <div class="mt-3 flex items-center justify-between font-label text-[11px] uppercase tracking-[0.2em] text-[#99907c]">
                    <span>Fortaleza de clave</span><span id="strength-label">Vacía</span>
                </div>
                <div class="mt-2 grid grid-cols-4 gap-1.5">
                    @for ($i = 0; $i < 4; $i++)
                        <span class="h-1 rounded-full bg-[#2a2a2b] transition-colors" data-strength-bar></span>
                    @endfor
                </div>
                @error('password') <p class="vip-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="reg-password-confirm" class="vip-label">Confirmar contraseña</label>
                <div class="relative mt-3">
                    <svg class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#99907c]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 12a8 8 0 108-8 8 8 0 00-6 2.7M4 4v3h3"/><path d="M10 12h4v3h-4zM11 12v-1a1 1 0 012 0v1"/></svg>
                    <input id="reg-password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repite tu contraseña" class="vip-input pl-12 pr-12" data-password>
                    <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#99907c] hover:text-[#f2ca50]" data-toggle-password aria-label="Mostrar contraseña">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>

            {{-- Preferencia inicial de estilo --}}
            <fieldset>
                <div class="flex items-center justify-between">
                    <legend class="font-label text-sm font-semibold uppercase tracking-[0.2em] text-[#e5e2e3]">Preferencia inicial de estilo</legend>
                    <span class="font-label text-xs uppercase tracking-[0.2em] text-[#d4af37]">Perfil Atelier</span>
                </div>
                <p class="mt-2 text-sm text-[#b8b0a0]">Selecciona el área principal para adaptar tu asesoría de imagen inicial.</p>
                @php
                    $styleIcons = [
                        'cortes' => 'M6 9a3 3 0 100-6 3 3 0 000 6zm0 12a3 3 0 100-6 3 3 0 000 6zM20 4L8.1 15.9M14.5 14.5L20 20M8.1 8.1L12 12',
                        'barba' => 'M12 21a9 9 0 100-18 9 9 0 000 18zM9 10h.01M15 10h.01M8 15c2.5 2 5.5 2 8 0',
                        'facial' => 'M12 21c-4-2-7-5.5-7-10 2 0 4.5 1 7 4 2.5-3 5-4 7-4 0 4.5-3 8-7 10zM12 15c-1.5-2-1.5-6 0-10 1.5 4 1.5 8 0 10z',
                        'masterclass' => 'M22 10L12 5 2 10l10 5 10-5zM6 12v5c3 2 9 2 12 0v-5',
                    ];
                    $selected = old('style_preference', 'cortes');
                @endphp
                <div class="mt-4 grid grid-cols-2 gap-3">
                    @foreach ($styles as $key => [$title, $sub])
                        <label class="group relative cursor-pointer rounded-lg border border-[#2a2a2b] bg-[#161617] p-4 transition hover:border-[#d4af37]/50 has-[:checked]:border-[#d4af37] has-[:checked]:bg-[#1f1d18]">
                            <input type="radio" name="style_preference" value="{{ $key }}" class="peer sr-only" {{ $selected === $key ? 'checked' : '' }}>
                            <span class="absolute right-4 top-4 h-5 w-5 rounded-full border border-[#99907c] peer-checked:border-[#f2ca50] peer-checked:bg-[radial-gradient(circle,#f2ca50_40%,transparent_45%)]"></span>
                            <svg class="w-6 h-6 text-[#f2ca50]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $styleIcons[$key] }}"/></svg>
                            <p class="mt-3 font-semibold text-[#f4f1ec]">{{ $title }}</p>
                            <p class="mt-1 text-xs text-[#99907c]">{{ $sub }}</p>
                        </label>
                    @endforeach
                </div>
                @error('style_preference') <p class="vip-error">{{ $message }}</p> @enderror
            </fieldset>

            <label class="flex gap-4 rounded-lg border border-[#2a2a2b] bg-[#161617] p-4 cursor-pointer">
                <input type="checkbox" name="terms" value="1" {{ old('terms') ? 'checked' : '' }} class="mt-1 h-5 w-5 shrink-0 accent-[#f2ca50]">
                <span class="text-sm leading-relaxed text-[#b8b0a0]">
                    Acepto los <span class="text-[#f2ca50] underline">Términos del Club VIP</span> y política de privacidad. Confirmo la recepción de beneficios de bienvenida de bar y prioridad exclusiva.
                </span>
            </label>
            @error('terms') <p class="vip-error -mt-4">{{ $message }}</p> @enderror

            <button type="submit" class="btn-gold" id="btn-register">
                Crear membresía VIP
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6"/></svg>
            </button>

            <p class="text-center text-sm text-[#b8b0a0]">
                ¿Ya dispones de membresía?
                <a href="{{ route('login') }}" class="ml-1 font-label font-semibold uppercase tracking-widest text-[#f2ca50] border-b border-[#f2ca50]">Iniciar sesión</a>
            </p>
        </form>
    @endif

    {{-- Privacidad --}}
    <section class="flex items-center gap-4 rounded-xl border border-[#2a2a2b] bg-[#161617] p-5">
        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg border border-[#d4af37]/40 bg-[#2a2510] text-[#f2ca50]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 11h12v9H6zM8 11V8a4 4 0 118 0v3"/></svg>
        </span>
        <div class="flex-1">
            <p class="font-label text-sm font-semibold uppercase tracking-wider text-[#f4f1ec]">Privacidad &amp; encriptación Atelier</p>
            <p class="text-sm text-[#99907c]">Confidencialidad absoluta y resguardo de datos personales.</p>
        </div>
        <svg class="w-6 h-6 text-[#99907c]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3zM9 12l2 2 4-4"/></svg>
    </section>
</div>
@endsection

@push('scripts')
<script>
    // Mostrar / ocultar contraseña
    document.querySelectorAll('[data-toggle-password]').forEach(btn => {
        btn.addEventListener('click', () => {
            const input = btn.parentElement.querySelector('[data-password]');
            input.type = input.type === 'password' ? 'text' : 'password';
        });
    });

    // Medidor de fortaleza de clave
    const src = document.querySelector('[data-strength-source]');
    if (src) {
        const bars = document.querySelectorAll('[data-strength-bar]');
        const label = document.getElementById('strength-label');
        const names = ['Vacía', 'Débil', 'Media', 'Buena', 'Excelente'];
        src.addEventListener('input', () => {
            const v = src.value;
            let score = 0;
            if (v.length >= 8) score++;
            if (/[A-Z]/.test(v) && /[a-z]/.test(v)) score++;
            if (/\d/.test(v)) score++;
            if (/[^A-Za-z0-9]/.test(v)) score++;
            if (!v.length) score = 0;
            bars.forEach((b, i) => b.style.background = i < score ? '#f2ca50' : '#2a2a2b');
            label.textContent = names[score];
        });
    }
</script>
@endpush
