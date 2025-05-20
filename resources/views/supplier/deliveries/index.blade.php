<x-app-layout>
    <div class="max-w-7xl mx-auto py-6">
        <h2 class="text-2xl font-bold mb-4">Delivery Tracking (Supplier View)</h2>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('supplier.deliveries.index') }}" class="mb-4">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search deliveries..."
                class="border border-gray-300 px-3 py-2 rounded-md w-1/3"
            >
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Search</button>
        </form>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 text-left">
                    <tr>
                        <th class="px-4 py-2">Project</th>
                        <th class="px-4 py-2">School</th>
                        <th class="px-4 py-2">Package</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Delivery Date</th>
                        <th class="px-4 py-2">Date Delivered</th>
                        <th class="px-4 py-2">Remarks</th>
                        <th class="px-4 py-2">Proof</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($deliveries as $delivery)
                        <tr class="border-t">
                            <td>{{ $delivery->project->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $delivery->school->school_name }}</td>
                            <td class="px-4 py-2">
                                @if ($delivery->project && $delivery->project->packages->count())
                                    @foreach ($delivery->project->packages as $pkg)
                                        <div>{{ $pkg->packageType->description ?? 'Unnamed Package' }}</div>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $delivery->status }}</td>
                            <td class="px-4 py-2">{{ $delivery->delivery_date }}</td>
                            <td class="px-4 py-2">{{ $delivery->arrival_date }}</td>
                            <td class="px-4 py-2">{{ $delivery->remarks }}</td>
                            <td class="px-4 py-2">
                                @if($delivery->proof_path)
                                    <a href="{{ Storage::url($delivery->proof_path) }}" target="_blank" class="text-blue-600 underline">View</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-4 py-2">
                            <a href="{{ route('supplier.deliveries.edit', $delivery->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="px-4 py-2" colspan="7">No deliveries found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>