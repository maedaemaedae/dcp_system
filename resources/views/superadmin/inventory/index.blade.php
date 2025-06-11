<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Inventory by School and Division
        </h2>
    </x-slot>

    <div class="p-6 space-y-10">

        {{-- SCHOOL INVENTORY --}}
        <div>
            <h3 class="text-lg font-bold mb-2">Schools</h3>
            @foreach ($schoolInventories as $school)
                <div x-data="{ open: false }" class="border rounded mb-3">
                    <button @click="open = !open"
                            class="w-full text-left px-4 py-2 bg-gray-100 font-semibold hover:bg-gray-200">
                        {{ $school->school_name }}
                    </button>
                    <div x-show="open" class="p-4">
                        @if ($school->inventories->isEmpty())
                            <p class="text-gray-500">No items found.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left border">
                                    <thead class="bg-gray-50 font-semibold text-xs uppercase text-gray-700">
                                        <tr>
                                            <th class="px-4 py-2">Item Name</th>
                                            <th class="px-4 py-2">Quantity</th>
                                            <th class="px-4 py-2">Status</th>
                                            <th class="px-4 py-2">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        @foreach ($school->inventories as $item)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-2">{{ $item->item_name }}</td>
                                                <td class="px-4 py-2">{{ $item->computed_quantity }}</td>
                                                <td class="px-4 py-2 capitalize">{{ $item->status ?? 'N/A' }}</td>
                                                <td class="px-4 py-2">{{ $item->remarks ?? '—' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- DIVISION INVENTORY --}}
        <div>
            <h3 class="text-lg font-bold mb-2">Division Offices</h3>
            @foreach ($divisionInventories as $division)
                <div x-data="{ open: false }" class="border rounded mb-3">
                    <button @click="open = !open"
                            class="w-full text-left px-4 py-2 bg-gray-100 font-semibold hover:bg-gray-200">
                        {{ $division->division_name }}
                    </button>
                    <div x-show="open" class="p-4">
                        @if ($division->inventories->isEmpty())
                            <p class="text-gray-500">No items found.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left border">
                                    <thead class="bg-gray-50 font-semibold text-xs uppercase text-gray-700">
                                        <tr>
                                            <th class="px-4 py-2">Item Name</th>
                                            <th class="px-4 py-2">Quantity</th>
                                            <th class="px-4 py-2">Status</th>
                                            <th class="px-4 py-2">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        @foreach ($division->inventories as $item)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-2">{{ $item->item_name }}</td>
                                                <td class="px-4 py-2">{{ $item->computed_quantity }}</td>
                                                <td class="px-4 py-2 capitalize">{{ $item->status ?? 'N/A' }}</td>
                                                <td class="px-4 py-2">{{ $item->remarks ?? '—' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
