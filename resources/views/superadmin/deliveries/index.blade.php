<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Deliveries to Suppliers</title>
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
            <i class="fa-solid fa-truck-ramp-box text-blue-500 text-4xl w-10 h-10"></i>
            My Deliveries
        </h2>
        
    
        <div class="max-w-7xl mx-auto">
            @if (session('success'))
                <div class="mb-4 text-green-600 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                Assign Deliveries to Suppliers
            </h2>
        </div>


    <main class="p-6 max-w-7xl mx-auto">
        <form method="GET" action="{{ route('superadmin.deliveries.index') }}" class="mb-6">
            <label for="search" class="block mb-1 font-semibold">Search Recipient</label>
            <input type="text" name="search" id="search"
                   value="{{ request('search') }}"
                   placeholder="Enter school or division name"
                   class="w-full border-gray-300 rounded shadow-sm px-4 py-2">
        </form>

        <form action="{{ route('deliveries.bulkAssign') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="supplier_id" class="block mb-1 font-semibold">Select Supplier</label>
                    <select name="supplier_id" required class="w-full border-gray-300 rounded shadow-sm">
                        <option value="">-- Choose Supplier --</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="target_delivery" class="block mb-1 font-semibold">Target Delivery Date</label>
                    <input type="date" name="target_delivery" class="w-full border-gray-300 rounded shadow-sm">
                </div>
            </div>

            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-[#4A90E2] text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 border-b"><input type="checkbox" id="select-all"></th>
                            <th class="px-4 py-3 border-b">Recipient</th>
                            <th class="px-4 py-3 border-b">Package</th>
                            <th class="px-4 py-3 border-b">Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($recipients as $recipient)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">
                                    <input type="checkbox" name="recipient_ids[]" value="{{ $recipient->id }}">
                                </td>
                                <td class="px-4 py-2">
                                    {{ $recipient->recipient_type === 'school'
                                        ? $recipient->school->school_name
                                        : $recipient->division->division_name }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $recipient->package->packageType->package_code ?? '-' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $recipient->quantity }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                    No unassigned deliveries available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 shadow">
                    Assign Selected
                </button>
            </div>
        </form>
    </main>

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
    </script>

</body>
</html>
