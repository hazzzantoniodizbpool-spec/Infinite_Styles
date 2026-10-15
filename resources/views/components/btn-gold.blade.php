@props([
    'type' => 'button',
    'class' => ''
])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'w-full py-3.5 px-6 rounded-lg font-[\'Space_Grotesk\'] text-sm uppercase tracking-widest font-bold bg-gradient-to-r from-[#f5d77f] via-[#d4af37] to-[#aa820a] text-[#131314] hover:shadow-[0_0_20px_rgba(212,175,55,0.45)] hover:brightness-105 active:scale-[0.99] transition-all duration-200 cursor-pointer flex items-center justify-center gap-2 ' . $class]) }}>
    {{ $slot }}
</button>
