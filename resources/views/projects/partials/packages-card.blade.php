<h3 class="text-2xl font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
    <span>Packages</span>
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($packages as $package)
           <div class="relative bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                

                

                    <!-- Three Dots Dropdown Button -->
                    <div class="absolute top-2 right-2" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="hover:bg-gray-300 text-gray-700 rounded-full p-1.5 transition duration-150 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 14a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/>
                                </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false"
                            x-transition
                            class="absolute right-0 z-10 mt-2 w-36 bg-white border border-gray-200 rounded-xl shadow-lg py-1 text-sm">
                            
                            <button
                                @click="
                                    openEditPackageModal(
                                        {{ $package->id }},
                                        {{ $package->project_id }},
                                        {{ $package->package_type_id }},
                                        '{{ $package->batch }}',
                                        '{{ $package->lot }}',
                                        '{{ $package->description }}'
                                    );
                                    open = false"
                                class="flex items-center gap-2 block w-full text-left px-4 py-2 hover:bg-gray-100 text-blue-600"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-blue-600" viewBox="0 0 20 20">
                                    <path d="M17.414 2.586a2 2 0 010 2.828l-1.828 1.828-2.828-2.828L14.586 2.586a2 2 0 012.828 0zM3 17.25V14.5a1 1 0 01.293-.707l8.5-8.5 2.828 2.828-8.5 8.5A1 1 0 019.5 17.25H3z"/>
                                </svg>
                                Edit
                            </button>

                            <button
                                type="button"
                                onclick="openDeleteModal('{{ route('packages.destroy', $package->id) }}')"
                                class="flex items-center gap-2 block w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-red-600" viewBox="0 0 20 20">
                                    <path d="M6 7a1 1 0 011 1v6a1 1 0 01-2 0V8a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0V8a1 1 0 011-1zm4-3h-2.5l-.71-.71A1 1 0 0010.5 3h-1a1 1 0 00-.71.29L8.09 4H5a1 1 0 000 2h10a1 1 0 100-2zM6 16a2 2 0 002 2h4a2 2 0 002-2V6H6v10z"/>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>

                    <!-- Package Content -->
                    <div class="text-sm text-gray-600 mb-1 break-words pr-8">
                    Project: {{ $package->project->name }}
                    </div>
                        <div class="text-lg font-semibold text-gray-800">{{ $package->packageType->package_code }}</div>
                        <div class="text-sm">Batch: {{ $package->batch }}</div>
                        <div class="text-sm">Lot: {{ $package->lot }}</div>
                        <div class="text-sm mb-1">Description: {{ $package->description }}</div>
                    </div>
        @endforeach
    </div>
 <div class="mt-4">
     {{ $packages->appends(['type' => 'packages'])->links('vendor.pagination.tailwind') }}
    </div>