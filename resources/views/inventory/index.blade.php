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

</head>

<body class="bg-gray-100 font-sans">
<div class="flex h-screen relative bg-white">

     <!-- Side Bar -->
     @include('components.sidebar')

     <!-- Top Navbar -->
<header class="w-full h-20 fixed top-0 left-0 bg-white shadow-md flex items-center justify-between px-8 z-10">
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/landscape-logo.png') }}" class="h-20 w-auto ml-[-20px]" alt="Logo">
    </div>

    <div class="relative" x-data="{ open: false }">
        <!-- User Name -->
        <div class="flex items-center gap-4">
            <span class="text-base text-black">{{ Auth::user()->name }}</span>

            <!-- Profile Dropdown Trigger -->
            <button @click="open = !open" class="w-14 h-14 bg-zinc-300 rounded-full flex items-center justify-center hover:ring-2 hover:ring-blue-500 transition focus:outline-none mr-[40px]">
                <!-- Optional icon or profile initials -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.779.63 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
        </div>

        <!-- Dropdown Menu -->
        <div x-show="open" @click.away="open = false"
             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20 text-sm text-gray-700 "
             x-transition>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
            </form>
        </div>
    </div>
</header>

    <!-- Main Content -->
    <div :class="open ? 'ml-[300px]' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
    <h2 class="text-[45px] font-bold text-gray-800 mb-6 border-b border-gray-300 pb-2 tracking-wide">
        📦 Inventory
        </h2>



        <!-- Add Item Button -->
        <button id="openAddModalBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
            + Add Item
        </button>

       <!-- Inventory Table -->
<div class="w-full overflow-x-auto bg-white shadow-lg rounded-xl">
    <table class="w-full min-w-[800px] text-sm text-left text-gray-700">
        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
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
                        <!-- Edit Button -->
                        <button onclick="openEditModal({{ $item->item_id }})"
                            class="inline-flex items-center bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-3 py-1.5 rounded text-xs shadow-sm transition">
                            ✏️ Edit
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('inventory.destroy', $item->item_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')"
                                class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1.5 rounded text-xs shadow-sm transition">
                                🗑 Delete
                            </button>
                        </form>
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
            document.addEventListener('DOMContentLoaded', function() {
                const toast = document.createElement('div');
                let message = "{{ session('success') }}";

                if (message.includes('Added')) {
                    message = '✔ ' + message;
                } else if (message.includes('Updated')) {
                    message = '\u270F\uFE0F ' + message;
                } else if (message.includes('Removed')) {
                    message = '🗑 ' + message;
                }

                toast.innerText = message;
                toast.className = "fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white py-4 px-8 rounded-lg shadow-lg z-50 text-center text-lg font-semibold";
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.remove();
                }, 3000);
            });
        </script>
    @endif
        </body>
    </html>
