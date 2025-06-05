<x-app-layout>
    <x-slot name="header">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
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
        <form action="{{ route('deliveries.bulkAssign') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="supplier_id" class="block mb-1 font-semibold">Select Supplier</label>
                <select name="supplier_id" required class="w-full border-gray-300 rounded">
                    <option value="">-- Choose Supplier --</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="target_delivery" class="block mb-1 font-semibold">Target Delivery Date</label>
                <input type="date" name="target_delivery" class="w-full border-gray-300 rounded">
            </div>

            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-2"><input type="checkbox" id="select-all"></th>
                        <th class="px-4 py-2 text-left">Recipient</th>
                        <th class="px-4 py-2 text-left">Package</th>
                        <th class="px-4 py-2 text-left">Quantity</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($recipients as $recipient)
                        <tr>
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
                            <td class="px-4 py-2">{{ $recipient->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Assign Selected
            </button>
        </form>

        @push('scripts')
        <script>
            document.getElementById('select-all')?.addEventListener('change', function () {
                document.querySelectorAll('input[name="recipient_ids[]"]').forEach(cb => cb.checked = this.checked);
            });
        </script>
        @endpush
    </div>
</x-app-layout>
