<h3 class="text-2xl font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
    <span>Package Types</span>
</h3>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @php
        $displayedIds = [];
    @endphp
    @foreach($packageTypes as $type)
        @if(!in_array($type->id, $displayedIds))
            @php $displayedIds[] = $type->id; @endphp

            <div class="relative bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition">

                <!-- Three Dots Dropdown Button -->
                <div class="absolute top-2 right-2" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="hover:bg-gray-300 text-gray-700 rounded-full p-1.5 transition duration-150 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 14a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 z-10 mt-2 w-36 bg-white border border-gray-200 rounded-xl shadow-lg py-1 text-sm">

                        <button type="button"
                            onclick="openDeleteModal('{{ route('package_types.destroy', $type->id) }}')"
                            class="flex items-center gap-2 block w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-red-600"
                                viewBox="0 0 20 20">
                                <path
                                    d="M6 7a1 1 0 011 1v6a1 1 0 01-2 0V8a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0V8a1 1 0 011-1zm4-3h-2.5l-.71-.71A1 1 0 0010.5 3h-1a1 1 0 00-.71.29L8.09 4H5a1 1 0 000 2h10a1 1 0 100-2zM6 16a2 2 0 002 2h4a2 2 0 002-2V6H6v10z" />
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>

                <!-- Package Type Content -->
                <div class="text-lg font-semibold text-gray-800">{{ $type->package_code }}</div>
                <div class="text-base text-gray-600 mb-2">{{ $type->description }}</div>

                <ul class="text-sm list-disc list-inside text-gray-700">
                    @php
                        $displayedItems = [];
                    @endphp
                    @foreach($type->contents as $item)
                        @if(!in_array($item->item_name, $displayedItems))
                            @php $displayedItems[] = $item->item_name; @endphp
                            <li>{{ $item->quantity }} × {{ $item->item_name }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
    @endforeach
</div>

<div class="mt-4">
    {{ $packageTypes->appends(['type' => 'package_types'])->links('vendor.pagination.tailwind') }}
</div>
