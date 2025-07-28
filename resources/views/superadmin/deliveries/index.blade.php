<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deliveries | DCP Tracking Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>[x-cloak] { display: none !important; }</style>

</head>
<body class="bg-white font-['Poppins']" x-data="{ contentVisible: false }" x-init="setTimeout(() => contentVisible = true, 100)">

@if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 5000)" 
        x-show="show" 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
        class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 
               bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg 
               text-sm flex items-center gap-2"
    >
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
@endif


    <div class="flex">

         
            @include('layouts.sidebar') 
       

        <div class="fixed top-0 left-[300px] right-0 bg-white shadow-md h-20 z-10 transition-all duration-300" :class="open ? 'left-[300px]' : 'left-20'">
            @include('layouts.top-navbar') 
            <div class="flex items-center justify-between h-full px-8">
                
        </div>

    <main  :class="open ? 'ml-[5px]' : 'ml-5'" class="transition-all duration-300 p-8 pb-40 relative flex-1 overflow-y-auto h-screen" x-show="contentVisible" x-transition.opacity.duration.500ms x-cloak>

    <div class="max-w-6xl mx-auto">
        <h2 class="text-[42px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide flex items-center gap-4">
            <i class="fa-solid fa-list-check text-blue-500 text-4xl w-10 h-10"></i>
            Assign Suppliers
        </h2>

   <!-- Page Content -->
<div class="px-4 py-6 sm:px-6 lg:px-8">

    <!-- Assign Form -->
    <form action="{{ route('deliveries.bulkAssign') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Inputs Section with Enhanced Design -->
<div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">
        Delivery Assignment Info
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Supplier Selection -->
        <div>
            <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-1">Select Supplier</label>
            <select name="supplier_id" id="supplier_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white text-gray-700">
                <option value="" disabled selected class="text-gray-500">Select a supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>



        <!-- Target Delivery Date -->
        <div>
            <label for="target_delivery" class="block text-sm font-medium text-gray-700 mb-1">Target Delivery Date</label>
            <input type="date" name="target_delivery" id="target_delivery" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white text-gray-500">
        </div>
    </div>
</div>


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
    <!-- Search icon using Font Awesome -->
    <i class="fa fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500"></i>

    <!-- Input -->
    <input type="text" id="search" x-model="search"
           placeholder="e.g. Hinapulan ES or Division Office Name"
           class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 pl-10">

    <!-- Clear icon (right side) -->
    <button type="button" x-show="search" @click="search = ''"
            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
            title="Clear search">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div>

<!-- Recipient Tabs: Schools | Divisions -->
<!-- Alpine Tabs -->
<div x-data="{ tab: 'schools' }" class="bg-white rounded-xl shadow overflow-hidden mt-6 border border-gray-200">



    <!-- Tab Headers -->
    <div class="flex text-sm font-medium text-gray-600 bg-gray-50 border-b">
        <button type="button" @click="tab = 'schools'"
            :class="tab === 'schools' 
                ? 'text-blue-600 bg-white shadow-sm border-b-2 border-blue-600' 
                : 'hover:text-blue-500'"
            class="px-6 py-4 flex-1 text-center transition">
            Schools
        </button>
        <button type="button" @click="tab = 'divisions'"
            :class="tab === 'divisions' 
                ? 'text-blue-600 bg-white shadow-sm border-b-2 border-blue-600' 
                : 'hover:text-blue-500'"
            class="px-6 py-4 flex-1 text-center transition">
            Divisions
        </button>
       <!-- Scroll to Assign Button -->
<div class="flex justify-end mt-4">
    <button 
        type="button" 
        onclick="document.getElementById('assign-btn').scrollIntoView({ behavior: 'smooth' })"
        class="inline-flex items-center gap-2 px-5 py-2 text-sm bg-[#4A90E2] text-white border border-[#4A90E2] rounded-md shadow hover:bg-[#3b75bb] transition duration-200">
        <i class="fa-solid fa-arrow-down"></i>
    </button>
</div>

    </div>

    

    <!-- Schools Tab -->
    <div x-show="tab === 'schools'" x-cloak class="overflow-x-auto">
        <table class="min-w-full text-sm divide-y divide-gray-100 w-full">
            <thead class="bg-[#4A90E2] text-white uppercase text-xs font-semibold tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-center w-12"></th>
                    <th class="px-4 py-3 text-left">School Name</th>
                    <th class="px-4 py-3 text-left">Package</th>
                    <th class="px-4 py-3 text-center">Quantity</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($recipients->where('recipient_type', 'school') as $recipient)
                    <tr class="hover:bg-blue-50 transition cursor-pointer"
                        x-show="matches('{{ optional($recipient->school)->school_name }}')"
                        @click="const checkbox = $el.querySelector('input[type=checkbox]'); checkbox.checked = !checkbox.checked">
                        <!-- Custom Checkbox -->
                        <td class="px-4 py-4 text-center">
                            <div class="flex justify-center">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="recipient_ids[]" value="{{ $recipient->id }}"
                                           class="peer hidden" @click.stop>
                                    <div class="w-5 h-5 rounded-md border border-gray-300 
                                                peer-checked:bg-[#4A90E2] peer-checked:border-[#4A90E2] 
                                                flex items-center justify-center transition duration-200">

                                        <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </label>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-gray-800">{{ optional($recipient->school)->school_name ?? '-' }}</td>
                        <td class="px-4 py-4 text-gray-600">{{ $recipient->package->packageType->package_code ?? '-' }}</td>
                        <td class="px-4 py-4 text-center text-gray-800 font-medium">{{ $recipient->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Divisions Tab -->
    <div x-show="tab === 'divisions'" x-cloak class="overflow-x-auto">
        <table class="min-w-full text-sm divide-y divide-gray-100 w-full">
            <thead class="bg-[#4A90E2] text-white uppercase text-xs font-semibold tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-center w-12"></th>
                    <th class="px-4 py-3 text-left">Division Name</th>
                    <th class="px-4 py-3 text-left">Package</th>
                    <th class="px-4 py-3 text-center">Quantity</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($recipients->where('recipient_type', 'division') as $recipient)
                    <tr class="hover:bg-blue-50 transition cursor-pointer"
                        x-show="matches('{{ optional($recipient->division)->division_name }}')"
                        @click="const checkbox = $el.querySelector('input[type=checkbox]'); checkbox.checked = !checkbox.checked">
                        <td class="px-4 py-4 text-center">
                            <div class="flex justify-center">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="recipient_ids[]" value="{{ $recipient->id }}"
                                           class="peer hidden" @click.stop>
                                    <div class="w-5 h-5 rounded-md border border-gray-300 peer-checked:bg-blue-600 peer-checked:border-blue-600 
                                                flex items-center justify-center transition duration-200">
                                        <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </label>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-gray-800">{{ optional($recipient->division)->division_name ?? '-' }}</td>
                        <td class="px-4 py-4 text-gray-600">{{ $recipient->package->packageType->package_code ?? '-' }}</td>
                        <td class="px-4 py-4 text-center text-gray-800 font-medium">{{ $recipient->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


    @if ($recipients->isEmpty())
        <div class="px-6 py-4 text-center text-gray-500 italic">
            No unassigned deliveries available.
        </div>
    @endif

</div>






       <!-- Submit Button -->
        <!-- Submit Button -->
<div class="flex justify-end mt-6" id="assign-btn">
    <button type="submit"
            class="inline-flex items-center gap-2 px-6 py-2 bg-[#4A90E2] text-white font-medium text-sm rounded-md shadow hover:bg-[#3b75bb] transition duration-200 focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:ring-offset-1">
        <i class="fa-solid fa-paper-plane text-sm"></i>
        Assign Selected
    </button>
</div>



    </form>
</div>

</div>

    <!-- Select All Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('input[name="recipient_ids[]"]');

            if (selectAllCheckbox && checkboxes.length) {
                selectAllCheckbox.addEventListener('change', function () {
                    checkboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
                });
            }
        });

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
