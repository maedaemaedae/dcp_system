<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Inventory</h2>
    </x-slot>

    <div class="p-6">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
        @endif

        <!-- Add Item Button -->
        <button id="openAddModalBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">+ Add Item</button>

        <!-- Inventory Table -->
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Item Name</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2 text-left">Quantity</th>
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
                            <td class="px-4 py-2">{{ $item->quantity }}</td>
                            <td class="px-4 py-2">{{ $item->created_by }}</td>
                            <td class="px-4 py-2">{{ $item->modified_by }}</td>
                            <td class="px-4 py-2">
                                <button onclick="openEditModal({{ $item->item_id }})" class="text-blue-600 hover:underline">Edit</button>
                                <form method="POST" action="{{ route('inventory.destroy', $item->item_id) }}" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @include('inventory.partials.edit-modal', ['item' => $item])
                    @empty
                        <tr>
                            <td colspan="6" class="text-center px-4 py-4 text-gray-500">No items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('inventory.partials.create-modal')

    <script>
        document.getElementById("openAddModalBtn").addEventListener("click", () => {
            document.getElementById("addModal").classList.remove("hidden");
        });

        document.getElementById("closeAddModalBtn").addEventListener("click", () => {
            document.getElementById("addModal").classList.add("hidden");
        });

        function openEditModal(id) {
            document.getElementById("editModal-" + id).classList.remove("hidden");
        }

        function closeEditModal(id) {
            document.getElementById("editModal-" + id).classList.add("hidden");
        }
    </script>
</x-app-layout>
