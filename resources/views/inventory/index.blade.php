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

        <a href="{{ route('inventory.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
            + Add Item
        </a>

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
                                <a href="{{ route('inventory.edit', $item->item_id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('inventory.destroy', $item->item_id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-gray-500">No items found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
