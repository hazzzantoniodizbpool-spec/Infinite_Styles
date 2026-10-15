@props([
    'class' => ''
])

<div {{ $attributes->merge(['class' => 'bg-[#201f20] border border-[#4d4635]/60 rounded-xl p-6 sm:p-8 shadow-[0_8px_32px_rgba(0,0,0,0.6)] backdrop-blur-md transition-all duration-300 hover:border-[#d4af37]/50 ' . $class]) }}>
    {{ $slot }}
</div>
