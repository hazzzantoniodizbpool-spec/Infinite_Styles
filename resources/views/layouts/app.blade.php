<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('description', 'Infinite Styles Atelier Privé: membresía VIP de barbería de autor.')">
    <title>@yield('title', 'Infinite Styles Barber VIP')</title>

    <!-- Google Fonts: Playfair Display, Plus Jakarta Sans, Space Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Assets (Tailwind CSS & JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#131314] text-[#e5e2e3] font-body min-h-screen antialiased flex flex-col selection:bg-[#f2ca50] selection:text-[#3c2f00]">

    <!-- Header / Navbar Superior -->
    <header class="border-b border-[#2a2a2b] bg-[#131314]/90 backdrop-blur-md sticky top-0 z-50 px-4 sm:px-8 py-4">
        <div class="max-w-3xl mx-auto flex items-center justify-between gap-4">
            <a href="{{ auth()->check() ? route('vip.perfil') : route('login') }}" class="text-left leading-none">
                <span class="block font-label font-semibold tracking-[0.3em] text-sm text-[#f2ca50]">INFINITE STYLES</span>
                <span class="block font-label text-[10px] tracking-[0.3em] text-[#99907c] uppercase mt-1.5">Atelier Privé</span>
            </a>

            <nav class="flex items-center gap-2 sm:gap-3 text-xs font-label uppercase tracking-widest">
                @auth
                    <a href="{{ route('vip.perfil') }}"
                       class="px-3 py-2 rounded-md transition {{ request()->routeIs('vip.perfil') ? 'text-[#f2ca50] bg-[#2a2a2b]' : 'text-[#d0c5af] hover:text-[#f2ca50]' }}">
                        Perfil VIP
                    </a>
                    <a href="{{ route('logout.confirm') }}"
                       class="px-3 py-2 rounded-md transition {{ request()->routeIs('logout.confirm') ? 'text-[#f2ca50] bg-[#2a2a2b]' : 'text-[#d0c5af] hover:text-[#f2ca50]' }}">
                        Cerrar sesión
                    </a>
                    <span class="w-9 h-9 rounded-lg border border-[#d4af37]/70 bg-[#201f20] flex items-center justify-center font-heading text-sm text-[#f2ca50]">
                        {{ auth()->user()->initials() }}
                    </span>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 rounded-md transition {{ request('modo') !== 'registro' ? 'text-[#f2ca50] bg-[#2a2a2b]' : 'text-[#d0c5af] hover:text-[#f2ca50]' }}">Iniciar sesión</a>
                    <a href="{{ route('login', ['modo' => 'registro']) }}" class="px-3 py-2 rounded-md transition {{ request('modo') === 'registro' ? 'text-[#f2ca50] bg-[#2a2a2b]' : 'text-[#d0c5af] hover:text-[#f2ca50]' }}">Registro</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="flex-grow w-full max-w-xl mx-auto px-5 py-8 sm:py-12">
        @if (session('status'))
            <div class="mb-6 flex items-center gap-3 rounded-lg border border-[#d4af37]/50 bg-[#d4af37]/10 px-4 py-3 text-sm text-[#f2ca50] animate-[fadeIn_.4s_ease]">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-[#2a2a2b] bg-[#0e0e0f] py-6 px-4 text-center text-xs text-[#99907c] font-label">
        <div class="max-w-3xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <p>© {{ date('Y') }} Infinite Styles Barbershop. Todos los derechos reservados.</p>
            <p class="text-[#e1c46e]/80">Obsidian &amp; Gilded Precision UI</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
