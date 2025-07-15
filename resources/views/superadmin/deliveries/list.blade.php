<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Deliveries</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<style>
    @keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeInUp {
    animation: fadeInUp 0.4s ease-out both;
}

</style>
<body class="bg-white font-['Poppins']" x-data="{ open: true }">

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

    <main  :class="open ? 'ml-[5px]' : 'ml-5'" class="transition-all duration-300 p-8 pb-40 relative flex-1 overflow-y-auto h-screen">

    <div class="max-w-6xl mx-auto">
        <h2 class="text-[42px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide flex items-center gap-4">
           <i class="fa-solid fa-truck text-blue-500 text-4xl w-10 h-10"></i>
            Assigned Deliveries
        </h2>

    <!-- Page Content -->
<div class="p-6">
    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-[#4A90E2] text-white text-xs uppercase font-semibold tracking-wide rounded-t-lg">
                <tr>
                    <th class="px-5 py-3">Recipient</th>
                    <th class="px-5 py-3">Package</th>
                    <th class="px-5 py-3">Quantity</th>
                    <th class="px-5 py-3">Supplier</th>
                    <th class="px-5 py-3">Target Delivery</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Created By</th>
                    <th class="px-5 py-3">Proof of Delivery</th>
                    <th class="px-5 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($deliveries as $delivery)
                    <tr class="hover:bg-blue-50 transition duration-200">
                        <td class="px-5 py-3">
                            {{ $delivery->recipient->recipient_type === 'school'
                                ? optional($delivery->recipient->school)->school_name
                                : optional($delivery->recipient->division)->division_name }}

                        </td>
                        <td class="px-5 py-3">
                            {{ $delivery->recipient->package->packageType->package_code }}
                        </td>
                        <td class="px-5 py-3 text-center">{{ $delivery->recipient->quantity }}</td>
                        <td class="px-5 py-3 pr-1">{{ $delivery->supplier->name }}</td>
                        <td class="px-5 py-3 pr-1">{{ $delivery->target_delivery ?? '—' }}</td>
                        <td class="px-5 py-3">
                            <form action="{{ route('superadmin.deliveries.updateStatus', $delivery->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status"
                                        onchange="this.form.submit()"
                                        class="border border-gray-300 px-2 py-1 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="pending" {{ $delivery->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="delivered" {{ $delivery->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $delivery->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-5 py-3">{{ $delivery->creator->name ?? '—' }}</td>
                        <td class="px-5 py-3">
                            @if ($delivery->proof_file)
                                <a href="{{ asset('storage/' . $delivery->proof_file) }}"
                                target="_blank"
                                class="inline-flex items-center gap-1 px-2 py-1 bg-[#4A90E2] hover:bg-[#357ABD] text-white text-sm font-medium rounded-lg shadow-sm transition">
                                    <i class="fa-solid fa-file-pdf text-sm"></i>
                                    View
                                </a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">
                            <!-- Unassign Button with Modal Confirmation -->
                            <div x-data="{ open: false }" class="relative inline-block">
                                <!-- Trigger Button -->
                               <button 
                                    @click="open = true"
                                    title="Unassign this delivery"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium rounded-lg bg-red-500 text-white hover:bg-red-600 transition focus:outline-none focus:ring-1 focus:ring-red-400 focus:ring-offset-1"
                                >
                                    <i class="fa-solid fa-circle-minus text-sm"></i>
                                    Unassign
                                </button>



                                <!-- Confirmation Modal -->
                                <div x-show="open" x-cloak
                                    class="fixed inset-0 flex items-center justify-center z-50 bg-black/40 backdrop-blur-sm"
                                    x-transition>
                                    <div @click.away="open = false"
                                        class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 space-y-4 animate-fadeInUp">
                                        <h2 class="text-lg font-semibold text-gray-800">Confirm Unassign</h2>
                                        <p class="text-sm text-gray-600">Are you sure you want to unassign this delivery?</p>
                                        
                                        
                                        <!-- Action Buttons -->
                                        <div class="flex justify-end gap-2">
                                            <button @click="open = false"
                                                    class="px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition">
                                                Cancel
                                            </button>

                                            <form action="{{ route('deliveries.unassign', $delivery->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                        class="px-4 py-2 text-sm bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                                    Yes, Unassign
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-5 py-6 text-center text-gray-500">
                            No assigned deliveries found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

    </main>
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
