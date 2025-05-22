<!DOCTYPE html>
<html lang="en" x-data="{ open: true }">
<head>
    <meta charset="UTF-8">
    <title>Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-white font-['Poppins']" x-data="{ open: true }">
<div class="flex h-screen relative bg-white">

    <div class="w-[1440px] h-[1024px] relative bg-white overflow-hidden">
        <!-- Sidebar -->
        @php
            $authUser = auth()->user();
            $isSuperAdmin = $authUser && $authUser->role_id === 1;
            $isAdmin = $authUser && $authUser->role && $authUser->role->role_name === 'admin';
        @endphp

    <!-- Side Bar -->
    @include('layouts.sidebar')

    <!-- Top Nav Bar -->
    @include('layouts.top-navbar')

    <!-- Main Content -->
    <div :class="open ? 'ml-[300px]' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
    <h2 class="text-[45px] font-bold text-gray-800 mb-6 border-b border-gray-300 pb-2 tracking-wide">
        📦 Inventory
        </h2>

        <!-- Success Message -->
        <div class="mb-4 text-green-600 font-medium hidden" id="successMessage">✔ Item Added Successfully!</div>

        <!-- Add Item Button -->
        <button id="openAddModalBtn"  class="bg-[#4A90E2] hover:bg-[#357ABD] text-white font-medium px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out mb-4 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Add Item</span>
            </button>

            

   <!-- Summary of Items -->
@if ($nameTotals->count())
    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow p-6 mb-6">
        <h3 class="text-xl font-semibold text-[#033372] mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-[#4A90E2]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18M9 3v18M15 3v18M3 9h18M3 15h18"/>
            </svg>
            Inventory Summary by Item
        </h3>

        <ul class="space-y-2 text-sm text-gray-800 mb-4">
            @foreach ($nameTotals as $item)
                <li class="flex items-center justify-between border-b pb-1 last:border-none">
                    <span class="font-medium">{{ $item->item_name }}</span>
                    <span class="text-gray-600">{{ $item->total_quantity }} in stock</span>
                </li>
            @endforeach
        </ul>

        <div class="text-right text-sm text-gray-700 font-semibold border-t pt-3">
            Total Items in Inventory:
            <span class="text-[#4A90E2]">{{ $totalQuantity }}</span>
        </div>
    </div>
@endif

<!-- Inventory Table -->
<div class="w-full overflow-x-auto bg-white rounded-2xl shadow border">
    <table class="min-w-full text-sm divide-y divide-gray-200">
        <thead class="bg-[#4A90E2] text-white">
            <tr>
                <th class="px-4 py-2">Item Name</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Quantity</th>
                <th class="px-4 py-2">Created By</th>
                <th class="px-4 py-2">Modified By</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
            @forelse ($items as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 font-medium">{{ $item->item_name }}</td>
                    <td class="px-4 py-3">{{ $item->description }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-block bg-blue-100 text-blue-700 font-semibold text-xs px-2 py-1 ml-5 rounded-full ">
                            {{ $item->quantity }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $item->created_by ?? '—' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $item->modified_by ?? '—' }}</td>
                    <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                        <button 
                            onclick="openEditModal({{ $item->item_id }})"
                            class="px-4 py-1.5 rounded-full bg-[#4A90E2] text-white hover:bg-[#357ABD] transition shadow-sm text-sm font-medium">
                            Edit
                        </button>
                        <form 
                            action="{{ route('inventory.destroy', $item->item_id) }}" 
                            method="POST" 
                            class="inline"
                        >
                            @csrf
                            @method('DELETE')
                            <button 
                                onclick="return confirm('Are you sure you want to delete this item?')"
                                class="px-4 py-1.5 rounded-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm text-sm font-medium">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @include('inventory.partials.edit-modal', ['item' => $item])
            @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">No items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


    <!-- Add Modal Partial -->
    @include('inventory.partials.create-modal')

    
    
 <script>
    const addModal = document.getElementById('addModal');
    const openAddBtn = document.getElementById('openAddModalBtn');
    const closeAddBtn = document.getElementById('closeAddModalBtn');

    openAddBtn.addEventListener('click', () => {
        addModal.classList.remove('hidden');
        addModal.classList.add('flex');
    });

    closeAddBtn.addEventListener('click', () => {
        addModal.classList.add('hidden');
        addModal.classList.remove('flex');
    });

    function closeAddModal() {
        addModal.classList.add('hidden');
        addModal.classList.remove('flex');
    }

    

    function openEditModal(id) {
        const modal = document.getElementById(`editModal-${id}`);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal(id) {
        const modal = document.getElementById(`editModal-${id}`);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function showSuccess(message) {
        const msg = document.getElementById('successMessage');
        msg.textContent = '✔ ' + message;
        msg.classList.remove('hidden');
        setTimeout(() => {
            msg.classList.add('hidden');
        }, 3000);
    }

    window.addEventListener('click', function (e) {
        if (e.target.classList.contains('bg-opacity-50')) {
            e.target.classList.add('hidden');
            e.target.classList.remove('flex');
        }
    });
</script>

<style>
@keyframes fade-in-up {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}
@keyframes fade-out-down {
    0% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(20px); }
}
.animate-fade-in-up {
    animation: fade-in-up 0.4s ease-out forwards;
}
.animate-fade-out-down {
    animation: fade-out-down 0.4s ease-in forwards;
}
</style>

</body>
</html>