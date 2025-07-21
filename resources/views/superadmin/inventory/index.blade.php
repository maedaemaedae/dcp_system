<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory | DCP Tracking Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-white font-['Poppins']" x-data="{ open: true }">
    <div class="flex">

         
            @include('layouts.sidebar') 
       

        <div class="fixed top-0 left-[300px] right-0 bg-white shadow-md h-20 z-10 transition-all duration-300" :class="open ? 'left-[300px]' : 'left-20'">
            @include('layouts.top-navbar') 
            <div class="flex items-center justify-between h-full px-8">
                
        </div>

    <main  :class="open ? 'ml-[5px]' : 'ml-5'" class="transition-all duration-300 p-8 pb-40 relative flex-1 overflow-y-auto h-screen">

    <div class="max-w-6xl mx-auto">
        <h2 class="text-[42px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide flex items-center gap-4">
            <i class="fa-solid fa-boxes-stacked text-blue-500 text-4xl w-10 h-10"></i>
            Inventory
        </h2>
<!-- Alpine wrapper -->
<div x-data="{
    search: '',
    matches(text) {
        return this.search === '' || text.toLowerCase().includes(this.search.toLowerCase());
    }
}" class="mb-10">
    
   <!-- Search bar -->
<label for="search" class="block font-medium text-sm mb-2 text-gray-700">Search School or Office</label>
<div class="relative">
    <!-- Font Awesome search icon (left) -->
    <i class="fa fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>

    <!-- Search input -->
    <input type="text" id="search" x-model="search"
           placeholder="e.g. Hinapulan ES or Division Office Name"
           class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 pl-10">

    <!-- Font Awesome clear icon (right) -->
    <button type="button" x-show="search" @click="search = ''"
            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
            title="Clear search">
        <i class="fa fa-times text-sm"></i>
    </button>
</div>



    <!-- Schools -->
    <div class="mt-8">
        <h3 class="text-2xl font-semibold mb-4 text-blue-600">Schools</h3>
        @foreach ($schoolInventories as $school)
            <div x-show="matches('{{ $school->school_name }}')" 
                x-data="{ open: false, updated: {{ $school->has_updates ? 'true' : 'false' }} }" 
                class="bg-white rounded-xl shadow-md mb-4 border transition">
                
                <button @click="open = !open; if (open) updated = false"
                    class="w-full text-left px-6 py-4 bg-gray-100 hover:bg-blue-100 text-blue-800 font-semibold text-lg rounded-t-xl transition duration-200 relative">
                    {{ $school->school_name }}

                    <template x-if="updated">
                        <span class="absolute top-3 right-4 flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                        </span>
                    </template>
                </button>



                <div x-show="open" x-transition class="px-6 py-4">
                    @if ($school->inventories->isEmpty())
                        <p class="text-gray-500 italic">No items found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                                <thead class="bg-blue-50 text-blue-700 text-xs uppercase">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Item Name</th>
                                        <th class="px-4 py-2 text-left">Quantity</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                        <th class="px-4 py-2 text-left">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($school->inventories as $item)
                                        <tr class="hover:bg-blue-50 transition">
                                            <td class="px-4 py-2">{{ $item->item_name }}</td>
                                            <td class="px-4 py-2">{{ $item->computed_quantity }}</td>
                                            <td class="px-4 py-2 capitalize">{{ $item->status ?? 'N/A' }}</td>
                                            <td class="px-4 py-2">{{ $item->remarks ?? '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Divisions -->
    <div class="mt-10">
        <h3 class="text-2xl font-semibold mb-4 text-green-600">Division Offices</h3>
        @foreach ($divisionInventories as $division)
            <div x-show="matches('{{ $division->division_name }}')" 
                x-data="{ open: false, updated: {{ $division->has_updates ? 'true' : 'false' }} }" 
                class="bg-white rounded-xl shadow-md mb-4 border transition">
                
                <button @click="open = !open; if (open) updated = false"
                    class="w-full text-left px-6 py-4 bg-gray-100 hover:bg-green-100 text-green-800 font-semibold text-lg rounded-t-xl transition duration-200 relative">
                    {{ $division->division_name }}

                    <template x-if="updated">
                        <span class="absolute top-3 right-4 flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                        </span>
                    </template>
                </button>



                <div x-show="open" x-transition class="px-6 py-4">
                    @if ($division->inventories->isEmpty())
                        <p class="text-gray-500 italic">No items found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                                <thead class="bg-green-50 text-green-700 text-xs uppercase">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Item Name</th>
                                        <th class="px-4 py-2 text-left">Quantity</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                        <th class="px-4 py-2 text-left">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($division->inventories as $item)
                                        <tr class="hover:bg-green-50 transition">
                                            <td class="px-4 py-2">{{ $item->item_name }}</td>
                                            <td class="px-4 py-2">{{ $item->computed_quantity }}</td>
                                            <td class="px-4 py-2 capitalize">{{ $item->status ?? 'N/A' }}</td>
                                            <td class="px-4 py-2">{{ $item->remarks ?? '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</main>
</div>
</div>

<script>
// Prevent zoom with Ctrl + Mouse Wheel and Ctrl + +/- on desktop
            document.addEventListener('wheel', function(e) {
                if (e.ctrlKey) {
                    e.preventDefault();
                }
            }, { passive: false });

            document.addEventListener('keydown', function(e) {
                // Prevent Ctrl + '+', Ctrl + '-', Ctrl + '0'
                if (e.ctrlKey && (e.key === '+' || e.key === '-' || e.key === '=' || e.key === '0')) {
                    e.preventDefault();
                }
            });
</script>
</body>
</html>
