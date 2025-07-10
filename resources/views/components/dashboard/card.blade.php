<!-- resources/views/components/dashboard/card.blade.php -->
@props(['title', 'value', 'icon'])

@php
    $iconColors = [
        'school' => 'text-indigo-500',
        'users' => 'text-pink-500',
        'box' => 'text-yellow-500',
        'clock' => 'text-orange-500',
        'check-circle' => 'text-green-500',
        'ban' => 'text-red-500',
    ];
@endphp

<div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm hover:shadow-md transition">
    <div class="flex items-center justify-between">
        <span class="text-sm text-gray-500 font-medium">{{ $title }}</span>
        <i class="fas fa-{{ $icon }} text-lg
            @if ($icon === 'school') text-blue-500
            @elseif ($icon === 'users') text-pink-500
            @elseif ($icon === 'box') text-yellow-500
            @elseif ($icon === 'clock') text-orange-500
            @elseif ($icon === 'check-circle') text-green-500
            @elseif ($icon === 'ban') text-red-500
            @else text-gray-500
            @endif
        "></i>
    </div>
    <div class="text-2xl font-bold text-gray-800 mt-1">{{ $value }}</div>
</div>
