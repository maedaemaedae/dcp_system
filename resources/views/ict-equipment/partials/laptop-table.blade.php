
 


<div class="mb-6 flex flex-wrap gap-4">
<!-- Laptops -->
    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-lg shadow-sm border">
    <form method="POST" action="{{ route('ict-equipment.import.category', ['category' => 'laptop']) }}" 
          enctype="multipart/form-data" class="flex items-center gap-2" id="laptopImportForm">
        @csrf
        <label for="import-laptop-csv" 
               class="cursor-pointer px-3 py-2 bg-green-100 text-green-700 font-medium rounded-lg hover:bg-green-200 transition flex items-center gap-2 shadow-sm">
            <i class="fa-solid fa-file-import"></i> Import
        </label>
        <input id="import-laptop-csv" type="file" name="csv_file" accept=".csv" required class="hidden" />

        <!-- 📌 File name preview -->
        <span id="laptopFileName" class="text-gray-600 text-sm italic"></span>

        <!-- 📌 Upload button -->
        <button type="submit" 
                class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition hidden"
                id="laptopUploadBtn">
            Upload
        </button>
    </form>

    <a href="{{ route('ict-equipment.export', ['category' => 'laptop']) }}" 
       class="px-3 py-2 bg-blue-100 text-blue-700 font-medium rounded-lg hover:bg-blue-200 transition flex items-center gap-2 shadow-sm">
        <i class="fa-solid fa-file-export"></i> Export
    </a>
</div>



<div class="bg-white shadow-md rounded-xl overflow-x-auto">
    <table class="min-w-full text-sm border border-gray-300">
        <thead class="bg-[#4A90E2] text-white sticky top-0">
            <tr>
                <th class="p-3 text-left">Equipment ID</th>
                <th class="p-3 text-left">Description</th>
                <th class="p-3 text-left">Category</th>
                <th class="p-3 text-left">Brand</th>
                <th class="p-3 text-left">Model</th>
                <th class="p-3 text-left">Asset #</th>
                <th class="p-3 text-left">Serial #</th>
                <th class="p-3 text-left">Location</th>
                <th class="p-3 text-left">Assigned To</th>
                <th class="p-3 text-left">Purchase Date</th>
                <th class="p-3 text-left">Warranty Expiry</th>
                <th class="p-3 text-left">Condition</th>
                <th class="p-3 text-left">Note</th>
                <th class="p-3 text-center sticky right-0 bg-[#4A90E2] z-10">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($laptops as $laptop)
                <tr class="hover:bg-blue-50 transition-colors duration-200">
                    <td class="p-2 border">{{ $laptop->equipment_id }}</td>
                    <td class="p-2 border">{{ $laptop->item_description }}</td>
                    <td class="p-2 border">{{ $laptop->category }}</td>
                    <td class="p-2 border">{{ $laptop->brand }}</td>
                    <td class="p-2 border">{{ $laptop->model }}</td>
                    <td class="p-2 border">{{ $laptop->asset_number }}</td>
                    <td class="p-2 border">{{ $laptop->serial_number }}</td>
                    <td class="p-2 border">{{ $laptop->location }}</td>
                    <td class="p-2 border">{{ $laptop->assigned_to }}</td>
                    <td class="p-2 border">{{ $laptop->purchase_date->format('Y-m-d') }}</td>
                    <td class="p-2 border">{{ $laptop->warranty_expiry->format('Y-m-d') }}</td>
                     <!-- Condition with badge -->
                        <td class="p-2 border text-center">
                            @if($laptop->condition === 'IN USE')
                                <span class="px-1 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    IN USE
                                </span>
                            @elseif($laptop->condition === 'FOR REPAIR')
                                <span class="px-1 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                    FOR REPAIR
                                </span>
                            @else
                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                    {{ $laptop->condition }}
                                </span>
                            @endif
                        </td>

                        <td class="p-2 border">{{ $laptop->note ?? '—' }}</td>
                    <td class="p-2 border text-center">
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
        <!-- 3 Dots Button -->
        <button @click="toggle" @click.outside="open = false"
            class="p-2 hover:bg-gray-200 rounded-full transition duration-150 focus:outline-none focus:ring-2 focus:ring-blue-300">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/>
            </svg>
        </button>

        <!-- Dropdown -->
        <div 
            x-show="open"
            x-transition
            :class="flip ? 'bottom-full mb-2' : 'mt-2'"
            class="absolute right-0 z-30 w-36 bg-white rounded-xl shadow-xl border border-gray-200 py-1"
            @click.outside="open = false"
            style="display: none;"
        >
            <!-- Edit -->
            <button 
                @click="open = false" 
                data-modal-open="editLaptopModal-{{ $laptop->id }}"
                class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-100 text-blue-600"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-blue-600" viewBox="0 0 20 20">
                    <path d="M17.414 2.586a2 2 0 010 2.828l-1.828 1.828-2.828-2.828L14.586 2.586a2 2 0 012.828 0zM3 17.25V14.5a1 1 0 01.293-.707l8.5-8.5 2.828 2.828-8.5 8.5A1 1 0 019.5 17.25H3z"/>
                </svg>
                Edit
            </button>

            <!-- Delete -->
            <form 
                action="{{ route('ict-equipment.destroy', ['category' => 'laptop', 'id' => $laptop->id]) }}" 
                method="POST" 
                onsubmit="return confirm('Are you sure you want to delete this laptop?');"
            >
                @csrf
                @method('DELETE')
                <button type="submit" 
                    class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
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
                @include('ict-equipment.partials.edit-laptop', ['laptop' => $laptop])

            @empty
            
                <tr>
                    <td colspan="14" class="p-6 text-center text-gray-500">No laptops found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
     <!-- Pagination (you can keep vendor pagination) -->
      <div class="mt-4 pagination">
       {{ $laptops->appends(request()->except('page'))->links('vendor.pagination.tailwind') }}
          </div>
</div>
</div>


