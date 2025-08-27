<!DOCTYPE html>
<html lang="en">
<head>
    <title>In Use Equipment | DCP Tracking Hub</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('images/final-portrait-logo.png') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-['Poppins'] text-gray-800">
<div class="min-h-screen relative">
    @include('layouts.top-navbar')
    <div class="relative px-6 py-8 max-w-8xl mx-auto">
        <a href="{{ route('ict-equipment.dashboard') }}" class="absolute top-[6.5rem] left-6 text-[#4A90E2] hover:text-[#357ABD] text-base font-medium flex items-center transition-all duration-300 ease-in-out transform hover:-translate-x-1 bg-white px-4 py-2 rounded-full shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            Back to Dashboard
        </a>
        <h1 class="text-3xl md:text-4xl font-bold mt-48 mb-16 flex items-center gap-3">
            <i class="fa-solid fa-check-circle text-green-500 text-2xl"></i> In Use Equipment
        </h1>
        <div class="bg-white shadow-md rounded-xl p-6 mb-8 border border-gray-100 flex flex-wrap gap-4 items-center justify-between">
            <span class="font-semibold">Total In Use:</span>
            <span class="text-2xl font-bold">{{ $inUseEquipments->count() }}</span>
        </div>
        <div class="bg-white shadow-md rounded-xl overflow-y-hidden overflow-x border border-gray-200">
            <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Equipment ID</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Brand</th>
                        <th class="px-4 py-2">Model</th>
                        <th class="px-4 py-2">Location</th>
                        <th class="px-4 py-2">Assigned To</th>
                        <th class="px-4 py-2">Condition</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($inUseEquipments as $equipment)
                    <tr>
                        <td class="px-4 py-2">{{ $equipment->equipment_id }}</td>
                        <td class="px-4 py-2">{{ $equipment->item_description }}</td>
                        <td class="px-4 py-2">{{ $equipment->category }}</td>
                        <td class="px-4 py-2">{{ $equipment->brand }}</td>
                        <td class="px-4 py-2">{{ $equipment->model }}</td>
                        <td class="px-4 py-2">{{ $equipment->location }}</td>
                        <td class="px-4 py-2">{{ $equipment->assigned_to }}</td>
                        <td class="px-4 py-2">{{ $equipment->condition }}</td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="px-4 py-2 text-center text-gray-500">No equipment found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
