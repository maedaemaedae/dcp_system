<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- Google Fonts: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


 <!-- Modal Scripts -->
    <script>
        // Add Modal
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

        // Edit Modals
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

        // Close modal on background click
        window.addEventListener('click', function (e) {
            if (e.target.classList.contains('bg-opacity-50')) {
                e.target.classList.add('hidden');
                e.target.classList.remove('flex');
            }
        });
    </script>

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let message = @json(session('success')).trim();

        const toast = document.createElement('div');

        // Defaults
        let icon = '✅';
        let bgColor = 'bg-green-500';

        // Match by keyword (case-insensitive)
        if (/added/i.test(message)) {
            icon = '✅';
            bgColor = 'bg-green-500';
        } else if (/updated/i.test(message)) {
            icon = '✏️';
            bgColor = 'bg-blue-500';
        } else if (/removed|deleted/i.test(message)) {
            icon = '🗑️';
            bgColor = 'bg-red-500';
        }

        // Toast content
        toast.innerHTML = `
            <div class="flex items-center justify-between space-x-4">
                <div class="flex items-center space-x-3">
                    <span class="text-xl">${icon}</span>
                    <span>${message}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-white text-xl hover:text-gray-200 transition">&times;</button>
            </div>
        `;

        toast.className = `
            fixed bottom-6 left-1/2 transform -translate-x-1/2
            ${bgColor} text-white px-6 py-3 rounded-xl shadow-lg
            text-sm font-medium z-50 min-w-[300px] max-w-md
            animate-fade-in-up
        `;

        document.body.appendChild(toast);

        // Auto-remove after 4s
        setTimeout(() => {
            toast.classList.remove("animate-fade-in-up");
            toast.classList.add("animate-fade-out-down");
            setTimeout(() => toast.remove(), 400);
        }, 4000);
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

    @endif

</head>

<body class="bg-gray-100 font-sans">
<div class="flex h-screen relative bg-white">

    <!-- Side Bar -->
    @include('components.sidebar')

    <!-- Top Nav Bar -->
    @include('components.top-navbar')

    <!-- Main Content -->
    <div :class="open ? 'ml-[300px]' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
    <h2 class="text-[45px] font-bold text-gray-800 mb-6 border-b border-gray-300 pb-2 tracking-wide">
        📦 Inventory
        </h2>



        <!-- Add Item Button -->
      <button 
            id="openAddModalBtn" 
            class="bg-[#4A90E2] hover:bg-[#357ABD] text-white font-medium px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out mb-4 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Add item</span>
            </button>


       <!-- Inventory Table -->
            <div class="overflow-x-auto bg-white rounded-2xl shadow border">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                    <thead class="bg-[#4A90E2] text-white">
            <tr>
                <th class="px-6 py-3">Item Name</th>
                <th class="px-6 py-3">Description</th>
                <th class="px-6 py-3">Created By</th>
                <th class="px-6 py-3">Modified By</th>
                <th class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($items as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium">{{ $item->item_name }}</td>
                    <td class="px-6 py-4">{{ $item->description }}</td>
                    <td class="px-6 py-4">{{ $item->created_by ?? '—' }}</td>
                    <td class="px-6 py-4">{{ $item->modified_by ?? '—' }}</td>
                    <td class="px-6 py-4 space-x-2 whitespace-nowrap">
                       <div class="flex items-center space-x-2">
                            <!-- Edit Button (Primary) -->
                            <button 
                                onclick="openEditModal({{ $item->item_id }})"
                                class="px-4 py-1.5 rounded-full bg-[#4A90E2] text-white hover:bg-[#357ABD] transition shadow-sm text-sm font-medium">
                                Edit
                            </button>

                            <!-- Delete Button (Secondary/Danger) -->
                            <form action="{{ route('inventory.destroy', $item->item_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button 
                                    onclick="return confirm('Are you sure?')"
                                    class="px-4 py-1.5 rounded-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm text-sm font-medium">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </td>
                </tr>

                <!-- Edit Modal Partial -->
                @include('inventory.partials.edit-modal', ['item' => $item])
            @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500">No items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


    <!-- Add Modal Partial -->
    @include('inventory.partials.create-modal')

        </body>
    </html>
