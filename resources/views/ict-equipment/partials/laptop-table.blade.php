<div class="bg-white shadow-md rounded-xl overflow-hidden">
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
       <tbody id="laptop-table" class="divide-y divide-gray-100">
    @forelse ($laptops as $equip)
        <tr class="hover:bg-blue-50 transition-colors duration-200">
            <td class="p-2 border">{{ $equip->equipment_id }}</td>
            <td class="p-2 border">{{ $equip->item_description }}</td>
            <td class="p-2 border">{{ $equip->category }}</td>
            <td class="p-2 border">{{ $equip->brand }}</td>
            <td class="p-2 border">{{ $equip->model }}</td>
            <td class="p-2 border">{{ $equip->asset_number }}</td>
            <td class="p-2 border">{{ $equip->serial_number }}</td>
            <td class="p-2 border">{{ $equip->location }}</td>
            <td class="p-2 border">{{ $equip->assigned_to }}</td>
            <td class="p-2 border">{{ $equip->purchase_date?->format('Y-m-d') }}</td>
            <td class="p-2 border">{{ $equip->warranty_expiry?->format('Y-m-d') }}</td>
            <td class="p-2 border">
                @if($equip->condition === 'IN USE')
                    <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded">IN USE</span>
                @elseif($equip->condition === 'FOR REPAIR')
                    <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded">FOR REPAIR</span>
                @endif
            </td>
            <td class="p-2 border">{{ $equip->note ?? '—' }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="14" class="p-6 text-center text-gray-500">No laptop found.</td>
        </tr>
    @endforelse
</tbody>


    </table>
</div>

