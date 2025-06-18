<h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
        🗂 <span>Projects</span>
    </h3>
    <div class="overflow-hidden rounded-2xl">
        <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-[#4A90E2] text-[#ffff] uppercase text-xs">
                <tr>
                    <th class="px-4 py-2 border">Project Name</th>
                    <th class="px-4 py-2 border">Target Delivery</th>
                    <th class="px-4 py-2 border">Target Arrival</th>
                    <th class="px-4 py-2 border">Packages</th>
                    <th class="px-4 py-2 border text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($projects as $project)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $project->name }}</td>
                        <td class="px-4 py-2 border">{{ $project->target_delivery_date ?? '—' }}</td>
                        <td class="px-4 py-2 border">{{ $project->target_arrival_date ?? '—' }}</td>
                        <td class="px-4 py-2 border">
                            @foreach ($project->packages as $package)
                                <div class="mb-2 p-2 bg-gray-100 rounded">
                                    <div class="font-semibold text-sm">{{ $package->packageType->package_code ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-600">{{ $package->description ?? 'No description' }}</div>
                                </div>
                            @endforeach
                            <button onclick="openModal('createPackageModal_{{ $project->id }}')" class="mt-2 text-blue-500 hover:underline text-xs">
                                + Add Package
                            </button>
                            @include('projects.partials.create-package-modal', ['project' => $project, 'packageTypes' => $packageTypes])
                        </td>
                        <td class="px-4 py-2 border">
                            <button
                                onclick="openEditProjectModal({{ $project->id }}, '{{ $project->name }}', '{{ $project->target_delivery_date }}', '{{ $project->target_arrival_date }}')"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                ✏️ Edit
                            </button>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline-block mt-2" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                    🗑️ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
    {{ $projects->appends(['type' => 'projects'])->links('vendor.pagination.tailwind') }}

</div>
    </div>