<!DOCTYPE html>
<html lang="en">
<head>
    <title>Desktops | DCP Tracking Hub</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('images/final-portrait-logo.png') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-50 font-['Poppins'] text-gray-800">
<div class="min-h-screen relative">
    @include('layouts.top-navbar')
    <div class="relative px-6 py-8 max-w-8xl mx-auto">
        <a href="{{ route('ict-equipment.index') }}"
           class="absolute top-[6.5rem] left-6 text-[#4A90E2] hover:text-[#357ABD] text-base font-medium flex items-center transition-all duration-300 ease-in-out transform hover:-translate-x-1 bg-white dark:bg-gray-800 px-4 py-2 rounded-full shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transition-transform duration-300 group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to All Equipment
        </a>
        <h1 class="text-3xl md:text-4xl font-bold mt-48 mb-16 flex items-center gap-3">
            <i class="fa-solid fa-desktop text-purple-500 text-2xl"></i> Desktops
        </h1>
        <div class="bg-white shadow-md rounded-xl p-6 mb-8 border border-gray-100 flex flex-wrap gap-4 items-center justify-between">
            <div class="flex items-center gap-2 px-4 py-2 border border-purple-500 text-purple-500 rounded-lg bg-white">
                <span class="fa-solid fa-desktop"></span>
                <span class="font-semibold">Total Desktops:</span>
                <span class="text-2xl font-bold">{{ $desktops->count() }}</span>
            </div>
        </div>
        @include('ict-equipment.partials.desktop-table')
    </div>
</div>
</body>
</html>
