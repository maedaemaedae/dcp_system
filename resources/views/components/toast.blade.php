@props(['type' => 'success']) {{-- 'success', 'error', 'warning' --}}

@php
    $bgColor = [
        'success' => 'bg-green-500',
        'error' => 'bg-red-500',
        'warning' => 'bg-yellow-500',
    ][$type] ?? 'bg-gray-700';
@endphp

@if(session('toast'))
    <div x-data="{ show: true }" x-show="show"
         x-init="setTimeout(() => show = false, 3000)"
         class="mb-4 px-4 py-2 rounded-md text-white {{ $bgColor }} shadow-md transition-all duration-300 ease-in-out">
        {{ session('toast') }}
    </div>
@endif
