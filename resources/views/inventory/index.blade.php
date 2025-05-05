<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Inventory
        </h2>
    </x-slot>

    <div class="p-6">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Item Button -->
        <button id="openAddModalBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
            + Add Item
        </button>

        <!-- Inventory Table -->
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Item Name</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2 text-left">Created By</th>
                        <th class="px-4 py-2 text-left">Modified By</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $item->item_name }}</td>
                            <td class="px-4 py-2">{{ $item->description }}</td>
                            <td class="px-4 py-2">{{ $item->created_by ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $item->modified_by ?? '—' }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <!-- Edit Button -->
                                <button onclick="openEditModal({{ $item->item_id }})" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs hover:bg-yellow-600">
                                    Edit
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('inventory.destroy', $item->item_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal Partial -->
                        @include('inventory.partials.edit-modal', ['item' => $item])
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">No items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
</x-app-layout>
