<h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
        📦 <span>Packages</span>
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($packages as $package)
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                <div class="text-sm text-gray-500 mb-1">Project: {{ $package->project->name }}</div>
                <div class="text-lg font-bold text-[#1F2937]">{{ $package->packageType->package_code }}</div>
                <div class="text-sm">Batch: {{ $package->batch }}</div>
                <div class="text-sm">Lot: {{ $package->lot }}</div>
                <div class="text-sm mb-3">Desc: {{ $package->description }}</div>

                <div class="flex gap-2 mt-2">
                    <button
                        onclick="openEditPackageModal(
                            {{ $package->id }},
                            {{ $package->project_id }},
                            {{ $package->package_type_id }},
                            '{{ $package->batch }}',
                            '{{ $package->lot }}',
                            '{{ $package->description }}'
                        )"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm"
                    >
                        ✏️ Edit
                    </button>
                    <form action="{{ route('packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Delete this package?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">🗑️ Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
 <div class="mt-4">
     {{ $packages->appends(['type' => 'packages'])->links('vendor.pagination.tailwind') }}
    </div>