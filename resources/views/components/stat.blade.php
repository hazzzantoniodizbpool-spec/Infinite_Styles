@props([
    'number',
    'label'
])

<div class="flex flex-col items-center justify-center p-4 rounded-lg bg-[#2a2a2b]/60 border border-[#4d4635]/30">
    <span class="font-['Syne'] text-2xl sm:text-3xl font-bold text-[#f2ca50] tracking-tight">
        {{ $number }}
    </span>
    <span class="font-['Plus_Jakarta_Sans'] text-xs sm:text-sm text-[#d0c5af] mt-1 text-center">
        {{ $label }}
    </span>
</div>
