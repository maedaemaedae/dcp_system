<h3 class="text-2xl font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
    <span>Projects</span>
</h3>
<div class="overflow-visible border bg-white shadow-sm">
    <table class="min-w-full text-sm text-left border border-gray-200">
        <thead class="bg-[#4A90E2] text-white uppercase text-xs">
            <tr>
                <th class="px-4 py-3 border">Project Name</th>
                <th class="px-4 py-3 border">Target Delivery</th>
                <th class="px-4 py-3 border">Target Arrival</th>
                <th class="px-4 py-3 border">Packages</th>
                <th class="px-4 py-3 border text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @foreach($projects as $project)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-4 py-2 border max-w-[220px]">
                        <span class="block font-medium text-gray-800 truncate" title="{{ $project->name }}">
                            {{ $project->name }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border text-gray-700">{{ $project->target_delivery_date ?? '—' }}</td>
                    <td class="px-4 py-2 border text-gray-700">{{ $project->target_arrival_date ?? '—' }}</td>
                    <td class="px-4 py-2 border">
                        <div class="space-y-2">
                            @foreach ($project->packages as $package)
                                <div class="p-2 bg-gray-50 rounded-lg border border-gray-200 shadow-sm">
                                    <div class="font-semibold text-blue-700 text-xs">{{ $package->packageType->package_code ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-600">{{ $package->description ?? 'No description' }}</div>
                                </div>
                            @endforeach
                        </div>
                        <button 
                            onclick="openModal('createPackageModal_{{ $project->id }}')" 
                            class="mt-3 inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-blue-500 text-white text-xs font-semibold shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Package
                        </button>
                        @include('projects.partials.create-package-modal', ['project' => $project, 'packageTypes' => $packageTypes])
                    </td>
                    <td class="px-4 py-2 border">
                        <div class="flex justify-center items-center">
                            <div 
                                x-data="{
                                    open: false,
                                    flip: false,
                                    toggle() {
                                        this.open = !this.open;
                                        if (this.open) {
                                            this.$nextTick(() => {
                                                const rect = this.$el.getBoundingClientRect();
                                                this.flip = (window.innerHeight - rect.bottom) < 120;
                                            });
                                        }
                                    }
                                }" 
                                class="relative inline-block text-left"
                            >
                                <!-- Toggle Button -->
                                <button @click="toggle" @click.outside="open = false"
                                    class="p-2 hover:bg-blue-100 rounded-full transition duration-150 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                    aria-label="Actions"
                                >
                                    <svg class="w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/>
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div 
                                    x-show="open"
                                    x-transition
                                    :class="flip ? 'bottom-full mb-2' : 'mt-2'"
                                    class="absolute right-0 z-30 w-40 bg-white rounded-xl shadow-xl border border-gray-200 py-1 text-sm"
                                    style="display: none;"
                                    @click.outside="open = false"
                                >
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
                                        class="flex items-center gap-2 w-full px-4 py-2 text-blue-600 hover:bg-blue-50 transition font-medium"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-blue-600" viewBox="0 0 20 20">
                                            <path d="M17.414 2.586a2 2 0 010 2.828l-1.828 1.828-2.828-2.828L14.586 2.586a2 2 0 012.828 0zM3 17.25V14.5a1 1 0 01.293-.707l8.5-8.5 2.828 2.828-8.5 8.5A1 1 0 019.5 17.25H3z"/>
                                        </svg>
                                        Edit
                                    </button>

                                    <!-- Delete -->
                                    <button
                                        type="button"
                                        onclick="openDeleteModal('{{ route('projects.destroy', $project->id) }}')"
                                        class="flex items-center gap-2 w-full px-4 py-2 text-red-600 hover:bg-red-50 transition font-medium"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-red-600" viewBox="0 0 20 20">
                                            <path d="M6 7a1 1 0 011 1v6a1 1 0 01-2 0V8a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0V8a1 1 0 011-1zm4-3h-2.5l-.71-.71A1 1 0 0010.5 3h-1a1 1 0 00-.71.29L8.09 4H5a1 1 0 000 2h10a1 1 0 100-2zM6 16a2 2 0 002 2h4a2 2 0 002-2V6H6v10z"/>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
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