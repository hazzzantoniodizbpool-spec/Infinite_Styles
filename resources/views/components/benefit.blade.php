@props([
    'icon' => '✨',
    'title' => '',
    'description' => ''
])

<div class="flex items-start gap-4 p-3.5 rounded-lg bg-[#2a2a2b]/40 border border-[#4d4635]/30 hover:border-[#d4af37]/40 transition-colors">
    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#e1c46e] to-[#aa820a] text-[#131314] flex items-center justify-center text-base flex-shrink-0 shadow-sm">
        {{ $icon }}
    </div>
    <div class="flex-grow">
        <h4 class="font-['Plus_Jakarta_Sans'] text-sm font-semibold text-[#f4f4f5]">
            {{ $title }}
        </h4>
        <p class="font-['Plus_Jakarta_Sans'] text-xs text-[#d0c5af] mt-0.5 leading-relaxed">
            {{ $description }}
        </p>
    </div>
</div>
