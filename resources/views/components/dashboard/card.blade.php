@props(['title', 'value', 'icon'])

<div class="bg-white p-4 rounded shadow flex items-center space-x-4">
    <div class="text-blue-600 text-3xl">
        <i data-feather="{{ $icon }}"></i>
    </div>
    <div>
        <div class="text-gray-600 text-sm">{{ $title }}</div>
        <div class="text-xl font-bold">{{ $value }}</div>
    </div>
</div>
