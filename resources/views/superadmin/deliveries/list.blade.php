<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Assigned Deliveries
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full text-sm text-left border border-gray-300">
                <thead class="bg-gray-100 text-xs font-semibold uppercase text-gray-700">
                    <tr>
                        <th class="px-4 py-3 border-b">Recipient</th>
                        <th class="px-4 py-3 border-b">Package</th>
                        <th class="px-4 py-3 border-b">Quantity</th>
                        <th class="px-4 py-3 border-b">Supplier</th>
                        <th class="px-4 py-3 border-b">Target Delivery</th>
                        <th class="px-4 py-3 border-b">Status</th>
                        <th class="px-4 py-3 border-b">Created By</th>
                        <th class="px-4 py-3 border-b">Proof of Delivery</th>
                        <th class="px-4 py-3 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($deliveries as $delivery)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">
                                {{ $delivery->recipient->recipient_type === 'school'
                                    ? $delivery->recipient->school->school_name
                                    : $delivery->recipient->division->division_name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $delivery->recipient->package->packageType->package_code }}
                            </td>
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
                            <td class="px-4 py-2">
                                @if ($delivery->proof_file)
                                    <img src="{{ asset('storage/' . $delivery->proof_file) }}"
                                         alt="Proof"
                                         class="h-16 w-auto rounded border" />
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('deliveries.unassign', $delivery->id) }}" method="POST"
                                      onsubmit="return confirm('Unassign this delivery?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-red-600 hover:underline">Unassign</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-4 text-center text-gray-500">
                                No assigned deliveries found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
