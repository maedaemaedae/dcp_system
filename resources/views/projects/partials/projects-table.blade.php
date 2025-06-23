<h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
        <path d="M2 6a2 2 0 012-2h4l2 2h6a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
    </svg>
    <span>Projects</span>
    </h3>
    <div class="overflow-hidden rounded-2xl border">
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
                          <div class="relative mt-1" x-data="{ open: false }">
                            <div class="flex justify-center items-center h-full">
                                <button @click="open = !open"
                                    class="hover:bg-gray-300 text-gray-700 rounded-full duration-150 p-1.5 transition focus:outline-none focus:ring-2 focus:ring-blue-300">
                                    <!-- Three Dots Icon -->
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/>
                                    </svg>
                                </button>
                            </div>


                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 z-10 mt-2 w-36 bg-white border border-gray-200 rounded-xl shadow-lg py-1 text-sm">

                                <!-- Edit -->
                                <button
                                    @click="
                                        openEditProjectModal(
                                            {{ $project->id }},
                                            '{{ $project->name }}',
                                            '{{ $project->target_delivery_date }}',
                                            '{{ $project->target_arrival_date }}'
                                        );
                                        open = false"
                                    class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-100 text-blue-600"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-blue-600" viewBox="0 0 20 20">
                                        <path d="M17.414 2.586a2 2 0 010 2.828l-1.828 1.828-2.828-2.828L14.586 2.586a2 2 0 012.828 0zM3 17.25V14.5a1 1 0 01.293-.707l8.5-8.5 2.828 2.828-8.5 8.5A1 1 0 019.5 17.25H3z"/>
                                    </svg>
                                    Edit
                                </button>

                                <!-- Delete -->
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-red-600" viewBox="0 0 20 20">
                                            <path d="M6 7a1 1 0 011 1v6a1 1 0 01-2 0V8a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0V8a1 1 0 011-1zm4-3h-2.5l-.71-.71A1 1 0 0010.5 3h-1a1 1 0 00-.71.29L8.09 4H5a1 1 0 000 2h10a1 1 0 100-2zM6 16a2 2 0 002 2h4a2 2 0 002-2V6H6v10z"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
    {{ $projects->appends(['type' => 'projects'])->links('vendor.pagination.tailwind') }}
</div>