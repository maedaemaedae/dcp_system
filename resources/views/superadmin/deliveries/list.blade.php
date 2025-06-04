<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Assigned Deliveries
        </h2>
    </x-slot>

    <div class="p-6">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2">Recipient</th>
                    <th class="px-4 py-2">Package</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Supplier</th>
                    <th class="px-4 py-2">Target Delivery</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Created By</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($deliveries as $delivery)
                    <tr>
                        <td class="px-4 py-2">
                            {{ $delivery->recipient->recipient_type === 'school'
                                ? $delivery->recipient->school->school_name
                                : $delivery->recipient->division->division_name }}
                        </td>
                        <td class="px-4 py-2">{{ $delivery->recipient->package->packageType->package_code }}</td>
                        <td class="px-4 py-2">{{ $delivery->recipient->quantity }}</td>
                        <td class="px-4 py-2">{{ $delivery->supplier->name }}</td>
                        <td class="px-4 py-2">{{ $delivery->target_delivery ?? '—' }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('superadmin.deliveries.updateStatus', $delivery->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" class="border px-2 py-1 rounded">
                                    <option value="pending" {{ $delivery->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="delivered" {{ $delivery->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $delivery->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-4 py-2">{{ $delivery->creator->name ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
