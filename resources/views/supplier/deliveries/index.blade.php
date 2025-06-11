<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            My Assigned Deliveries
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
                        <th class="px-4 py-3 border-b">Recipient</th>
                        <th class="px-4 py-3 border-b">Package</th>
                        <th class="px-4 py-3 border-b">Quantity</th>
                        <th class="px-4 py-3 border-b">Target Date</th>
                        <th class="px-4 py-3 border-b">Status</th>
                        <th class="px-4 py-3 border-b">Actions</th>
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
                            <td class="px-4 py-2">{{ $delivery->target_delivery ?? '—' }}</td>
                            <td class="px-4 py-2 capitalize">
                                {{ $delivery->status }}
                            </td>
                            <td class="px-4 py-2">
                                @if ($delivery->status === 'pending')
                                    <form method="POST"
                                          action="{{ route('supplier.deliveries.confirm', $delivery->id) }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        @if ($errors->any())
                                            <div class="mb-2 text-red-600 text-sm">
                                                {{ $errors->first('proof_file') }}
                                            </div>
                                        @endif

                                        <input type="file"
                                               name="proof_file"
                                               accept="application/pdf"
                                               required
                                               class="mb-2 block text-sm text-gray-600"
                                               onchange="if(this.files[0].size > 5 * 1024 * 1024) { alert('File must be less than 2MB'); this.value = ''; }" />

                                        <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                            Mark as Delivered
                                        </button>
                                    </form>
                                @else
                                    <span class="text-green-700 font-semibold">Delivered</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                No deliveries assigned yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
