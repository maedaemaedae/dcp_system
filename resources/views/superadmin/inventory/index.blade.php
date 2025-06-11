<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Inventory Overview
        </h2>
    </x-slot>

    <div class="p-6">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full text-sm text-left border border-gray-300">
                <thead class="bg-gray-100 text-xs font-semibold uppercase text-gray-700">
                    <tr>
                        <th class="px-4 py-3 border-b">Location</th>
                        <th class="px-4 py-3 border-b">Item Name</th>
                        <th class="px-4 py-3 border-b">Quantity</th>
                        <th class="px-4 py-3 border-b">Status</th>
                        <th class="px-4 py-3 border-b">Remarks</th>
                        <th class="px-4 py-3 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($inventories as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">
                                @if ($item->school)
                                    {{ $item->school->school_name }}
                                @elseif ($item->division)
                                    {{ $item->division->division_name }}
                                @else
                                    <span class="text-gray-500 italic">Unassigned</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $item->item_name }}</td>
                            <td class="px-4 py-2">{{ $item->computed_quantity ?? 0 }}</td>
                            <td class="px-4 py-2 capitalize">{{ $item->status }}</td>
                            <td class="px-4 py-2">{{ $item->remarks ?? '—' }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <a href="{{ route('inventory.edit', $item->id) }}"
                                   class="text-blue-600 hover:underline mr-2">
                                    Edit
                                </a>
                                <form action="{{ route('inventory.destroy', $item->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Delete this inventory item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                No inventory records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
