<x-app-layout>
    <x-slot name="header">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Assign Deliveries to Suppliers
        </h2>

        <a href="{{ route('superadmin.deliveries.list') }}"
           class="inline-block mt-2 mb-4 text-sm text-blue-600 hover:text-blue-800 underline">
            → View Assigned Deliveries
        </a>
    </x-slot>

    <div class="p-6">
        <form method="GET" action="{{ route('superadmin.deliveries.index') }}" class="mb-6">
            <label for="search" class="block mb-1 font-semibold">Search Recipient</label>
            <input type="text" name="search" id="search"
                value="{{ request('search') }}"
                placeholder="Enter school or division name"
                class="w-full border-gray-300 rounded shadow-sm px-4 py-2">
        </form>
        <form action="{{ route('deliveries.bulkAssign') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="supplier_id" class="block mb-1 font-semibold">Select Supplier</label>
                    <select name="supplier_id" required class="w-full border-gray-300 rounded shadow-sm">
                        <option value="">-- Choose Supplier --</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="target_delivery" class="block mb-1 font-semibold">Target Delivery Date</label>
                    <input type="date" name="target_delivery" class="w-full border-gray-300 rounded shadow-sm">
                </div>
            </div>

            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-xs font-semibold uppercase text-gray-700">
                        <tr>
                            <th class="px-4 py-3 border-b"><input type="checkbox" id="select-all"></th>
                            <th class="px-4 py-3 border-b">Recipient</th>
                            <th class="px-4 py-3 border-b">Package</th>
                            <th class="px-4 py-3 border-b">Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($recipients as $recipient)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">
                                    <input type="checkbox" name="recipient_ids[]" value="{{ $recipient->id }}">
                                </td>
                                <td class="px-4 py-2">
                                    {{ $recipient->recipient_type === 'school'
                                        ? $recipient->school->school_name
                                        : $recipient->division->division_name }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $recipient->package->packageType->package_code ?? '-' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $recipient->quantity }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                    No unassigned deliveries available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 shadow">
                    Assign Selected
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('input[name="recipient_ids[]"]');

            if (selectAllCheckbox && checkboxes.length) {
                selectAllCheckbox.addEventListener('change', function () {
                    checkboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
                });
            }
        });
    </script>
</x-app-layout>
