<x-app-layout>
    <x-slot name="header">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
        @endif

        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Assign Deliveries to Suppliers
        </h2>
    </x-slot>

    <div class="p-6">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2 text-left">Recipient</th>
                    <th class="px-4 py-2 text-left">Package</th>
                    <th class="px-4 py-2 text-left">Quantity</th>
                    <th class="px-4 py-2 text-left">Assign Supplier</th>
                    <th class="px-4 py-2 text-left">Target Delivery Date</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($recipients as $recipient)
                    <tr>
                        <td class="px-4 py-2">
                            {{ $recipient->recipient_type === 'school' ? $recipient->school->school_name : $recipient->division->division_name }}
                        </td>
                        <td class="px-4 py-2">{{ $recipient->package->packageType->package_code }}</td>
                        <td class="px-4 py-2">{{ $recipient->quantity }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('superadmin.deliveries.assign') }}" method="POST">
                                @csrf
                                <input type="hidden" name="recipient_id" value="{{ $recipient->id }}">
                                <select name="supplier_id" class="border rounded px-2 py-1 w-full" required>
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                        </td>
                        <td class="px-4 py-2">
                            <input type="date" name="target_delivery" class="border rounded px-2 py-1 w-full">
                        </td>
                        <td class="px-4 py-2">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                    Assign
                                </button>
                            </form> {{-- Close form after all fields --}}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</x-app-layout>
