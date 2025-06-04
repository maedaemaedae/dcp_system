<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Inventory Overview
        </h2>
    </x-slot>

    <div class="p-6">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
        @endif

        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2">Location</th>
                    <th class="px-4 py-2">Item Name</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Remarks</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($inventories as $item)
                    <tr>
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
                        <td class="px-4 py-2">{{ $item->quantity }}</td>
                        <td class="px-4 py-2 capitalize">{{ $item->status }}</td>
                        <td class="px-4 py-2">{{ $item->remarks ?? '—' }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('inventory.edit', $item->id) }}"
                               class="text-blue-600 hover:underline mr-2">Edit</a>
                            <form action="{{ route('inventory.destroy', $item->id) }}"
                                  method="POST" class="inline-block"
                                  onsubmit="return confirm('Delete this inventory item?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
