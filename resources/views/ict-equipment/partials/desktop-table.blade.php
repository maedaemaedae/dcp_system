

<div class="mb-6 flex flex-wrap gap-4">
<!-- Printers -->
    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-lg shadow-sm border">
    <form method="POST" action="{{ route('ict-equipment.import.category', ['category' => 'desktop']) }}" 
          enctype="multipart/form-data" class="flex items-center gap-2" id="desktopImportForm">
        @csrf
        <label for="import-desktop-csv" 
               class="cursor-pointer px-3 py-2 bg-green-100 text-green-700 font-medium rounded-lg hover:bg-green-200 transition flex items-center gap-2 shadow-sm">
            <i class="fa-solid fa-file-import"></i> Import
        </label>
        <input id="import-desktop-csv" type="file" name="csv_file" accept=".csv" required class="hidden" />

        <!-- 📌 File name preview -->
        <span id="desktopFileName" class="text-gray-600 text-sm italic"></span>

        <!-- 📌 Upload button -->
        <button type="submit" 
                class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition hidden"
                id="desktopUploadBtn">
            Upload
        </button>
    </form>

    <a href="{{ route('ict-equipment.export', ['category' => 'printer']) }}" 
       class="px-3 py-2 bg-blue-100 text-blue-700 font-medium rounded-lg hover:bg-blue-200 transition flex items-center gap-2 shadow-sm">
        <i class="fa-solid fa-file-export"></i> Export
    </a>
</div>

<div class="bg-white shadow-md rounded-xl overflow-x-auto">
    <table class="min-w-full text-sm border border-gray-300">
        <thead class="bg-[#4A90E2] text-white sticky top-0">
            <tr>
                <th class="p-3 text-left whitespace-nowrap">Equipment ID</th>
                <th class="p-3 text-left">Description</th>
                <th class="p-3 text-left">Category</th>
                <th class="p-3 text-left whitespace-nowrap">PC Make</th>
                <th class="p-3 text-left whitespace-nowrap">PC Model</th>
                <th class="p-3 text-left whitespace-nowrap">Asset #</th>
                <th class="p-3 text-left">PC SN</th>
                <th class="p-3 text-left">Monitor SN</th>
                <th class="p-3 text-left">AVR SN</th>
                <th class="p-3 text-left">WiFi Adapter SN</th>
                <th class="p-3 text-left whitespace-nowrap">Keyboard SN</th>
                <th class="p-3 text-left">Mouse SN</th>
                <th class="p-3 text-left">Location</th>
                <th class="p-3 text-left whitespace-nowrap">Assigned To</th>
                <th class="p-3 text-left whitespace-nowrap">Purchase Date</th>
                <th class="p-3 text-left whitespace-nowrap">Warranty Expiry</th>
                <th class="p-3 text-left">Condition</th>
                <th class="p-3 text-left">Note</th>
                <th class="p-3 text-center sticky right-0 bg-[#4A90E2] z-10">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($desktops as $desktop)
                <tr class="hover:bg-blue-50 transition-colors duration-200">
                    <td class="p-2 border">{{ $desktop->equipment_id }}</td>
                    <td class="p-2 border">{{ $desktop->item_description }}</td>
                    <td class="p-2 border">{{ $desktop->category }}</td>
                    <td class="p-2 border">{{ $desktop->pc_make ?? '—' }}</td>
                    <td class="p-2 border">{{ $desktop->pc_model ?? '—' }}</td>
                    <td class="p-2 border">{{ $desktop->asset_number }}</td>
                    <td class="p-2 border">{{ $desktop->pc_sn ?? '—' }}</td>
                    <td class="p-2 border">{{ $desktop->monitor_sn ?? '—' }}</td>
                    <td class="p-2 border">{{ $desktop->avr_sn ?? '—' }}</td>
                    <td class="p-2 border">{{ $desktop->wifi_adapter_sn ?? '—' }}</td>
                    <td class="p-2 border">{{ $desktop->keyboard_sn ?? '—' }}</td>
                    <td class="p-2 border">{{ $desktop->mouse_sn ?? '—' }}</td>
                    <td class="p-2 border">{{ $desktop->location }}</td>
                    <td class="p-2 border">{{ $desktop->assigned_to }}</td>
                    <td class="p-2 border">{{ $desktop->purchase_date->format('Y-m-d') }}</td>
                    <td class="p-2 border">{{ $desktop->warranty_expiry->format('Y-m-d') }}</td>
                     <!-- Condition with badge -->
                        <td class="p-2 border text-center">
                            @if($desktop->condition === 'IN USE')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    IN USE
                                </span>
                            @elseif($desktop->condition === 'FOR REPAIR')
                                <span class="px-1 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                    FOR REPAIR
                                </span>
                            @else
                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                    {{ $desktop->condition }}
                                </span>
                            @endif
                        </td>


                        <td class="p-2 border">{{ $desktop->note ?? '—' }}</td>
            <td class="p-2 border text-center">
    <div x-data="{ openDropdown: false, openDelete: false }" class="relative inline-block text-left">

        <!-- 3 Dots -->
        <button @click="openDropdown = !openDropdown" @click.outside="openDropdown = false"
            class="p-2 hover:bg-gray-200 rounded-full transition duration-150">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/>
            </svg>
        </button>

        <!-- Dropdown -->
        <div x-show="openDropdown" x-transition
            class="absolute right-0 z-30 w-40 bg-white rounded-xl shadow-xl border border-gray-200 py-1"
            style="display: none;">

            <!-- Edit -->
            <button @click="openDropdown = false" 
                data-modal-open="editDesktopModal-{{ $desktop->id }}"
                class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-100 text-blue-600">
                ✏️ Edit
            </button>

            <!-- Delete -->
            <button @click="openDropdown = false; openDelete = true"
                class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                🗑 Delete
            </button>
        </div>

        <!-- Delete Modal -->
        <div x-show="openDelete" x-transition
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
            style="display: none;">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Confirm Delete</h2>
                <p class="text-gray-600 mb-6">
                    Are you sure you want to delete this desktop? This action cannot be undone.
                </p>

                <div class="flex justify-end gap-3">
                    <!-- Cancel -->
                    <button type="button" @click="openDelete = false"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                        Cancel
                    </button>

                    <!-- Confirm Delete -->
                    <form method="POST" action="{{ route('ict-equipment.destroy', ['category' => 'desktop', 'id' => $desktop->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</td>

                </tr>
                @include('ict-equipment.partials.edit-desktop', ['desktop' => $desktop])
            @empty
                <tr>
                    <td colspan="19" class="p-6 text-center text-gray-500">No desktops found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Desktops Pagination -->
<div class="mt-4 pagination">
{{ $desktops->appends(request()->query())->links('vendor.pagination.tailwind') }}
</div>
</div>
</div>