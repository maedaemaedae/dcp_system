<div class="bg-white shadow-md rounded-xl overflow-x-auto">
    <table class="min-w-full text-sm border border-gray-300 ">
        <thead class="bg-[#4A90E2] text-white sticky top-0">
            <tr>
                <th class="p-3 text-left">Equipment ID</th>
                <th class="p-3 text-left">Description</th>
                <th class="p-3 text-left">Category</th>
                <th class="p-3 text-left">PC_MAKE</th>
                <th class="p-3 text-left">PC_MODEL</th>
                <th class="p-3 text-left">Asset #</th>
                <th class="p-3 text-left">PC_SN</th>
                <th class="p-3 text-left">MONITOR_SN</th>
                <th class="p-3 text-left">AVR_SN</th>
                <th class="p-3 text-left">WIFI ADAPTER_SN</th>
                <th class="p-3 text-left">KEYBOARD_SN</th>
                <th class="p-3 text-left">MOUSE_SN</th>
                <th class="p-3 text-left">Location</th>
                <th class="p-3 text-center">Assigned To</th>
                <th class="p-3 text-center">Purchase Date</th>
                <th class="p-3 text-center">Warranty Expiry</th>
                <th class="p-3 text-center">Condition</th>
                <th class="p-3 text-center">Note</th>
                <th class="p-3 text-center sticky right-0 bg-[#4A90E2] z-10">Action</th>
            </tr>
        </thead>
        <tbody id="desktop-table" class="divide-y divide-gray-100">
            @forelse ($desktops as $equip)
                <tr class="hover:bg-blue-50 transition-colors duration-200" data-id="{{ $equip->id }}">
                    <td class="p-2 border">{{ $equip->equipment_id }}</td>
                    <td class="p-2 border">{{ $equip->item_description }}</td>
                    <td class="p-2 border">{{ $equip->category }}</td>
                    <td class="p-2 border">{{ $equip->pc_make ?? '—' }}</td> <!-- PC_MAKE -->
                    <td class="p-2 border">{{ $equip->pc_build ?? $equip->model ?? '—' }}</td> <!-- PC_MODEL -->
                    <td class="p-2 border">{{ $equip->asset_number }}</td>
                    <td class="p-2 border">{{ $equip->pc_sn ?? '—' }}</td> <!-- PC_SN -->
                    <td class="p-2 border">{{ $equip->monitor_sn ?? '—' }}</td> <!-- MONITOR_SN -->
                    <td class="p-2 border">{{ $equip->avr_sn ?? '—' }}</td> <!-- AVR_SN -->
                    <td class="p-2 border">{{ $equip->wifi_adapter_sn ?? '—' }}</td> <!-- WIFI_ADAPTER_SN -->
                    <td class="p-2 border">{{ $equip->keyboard_sn ?? '—' }}</td> <!-- KEYBOARD_SN -->
                    <td class="p-2 border">{{ $equip->mouse_sn ?? '—' }}</td> <!-- MOUSE_SN -->
                    <td class="p-2 border">{{ $equip->location }}</td>
                    <td class="p-2 border">{{ $equip->assigned_to }}</td>
                    <td class="p-2 border">{{ $equip->purchase_date->format('Y-m-d') }}</td>
                    <td class="p-2 border">{{ $equip->warranty_expiry->format('Y-m-d') }}</td>
                    <td class="p-2 border">
                        @if($equip->condition === 'IN USE')
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded">IN USE</span>
                        @elseif($equip->condition === 'FOR REPAIR')
                            <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded">FOR REPAIR</span>
                        @endif
                    </td>
                    <td class="p-2 border">{{ $equip->note ?? '—' }}</td>
                    <td class="p-2 border text-center">
                        <button class="edit-btn text-blue-600 hover:text-blue-800">Edit</button>
                        <button class="delete-btn text-red-600 hover:text-red-800">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="14" class="p-6 text-center text-gray-500">No equipment found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>