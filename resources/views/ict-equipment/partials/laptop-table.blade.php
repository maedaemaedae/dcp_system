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
                    <td class="p-2 border">{{ $laptop->condition }}</td>
                    <td class="p-2 border">{{ $laptop->note ?? '—' }}</td>
                    <td class="p-2 border text-center">
                    <button 
                    class="text-blue-600 hover:text-blue-800" 
                    data-modal-open="editLaptopModal-{{ $laptop->id }}">
                    Edit
                    </button>
                    <form action="{{ route('ict-equipment.destroy', ['category' => 'laptop', 'id' => $laptop->id]) }}" 
                    method="POST" 
                    onsubmit="return confirm('Are you sure you want to delete this laptop?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                </form>

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
</div>