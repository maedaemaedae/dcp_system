<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">My Assigned Deliveries</h2>
    </x-slot>

    <div class="p-6">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
        @endif

        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2">Recipient</th>
                    <th class="px-4 py-2">Package</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Target Date</th>
                    <th class="px-4 py-2">Status</th>
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
                        <td class="px-4 py-2">{{ $delivery->target_delivery ?? '—' }}</td>
                        <td class="px-4 py-2 capitalize">{{ $delivery->status }}</td>
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
                                    accept="image/*"
                                    required
                                    class="mb-2 block text-sm text-gray-600"
                                    onchange="if(this.files[0].size > 2 * 1024 * 1024) { alert('Image must be less than 2MB'); this.value = ''; }" />

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
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
