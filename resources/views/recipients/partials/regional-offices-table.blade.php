<table class="min-w-full text-sm text-left border border-gray-300 shadow-md rounded-lg overflow-hidden">
    <thead class="bg-[#4A90E2] text-white uppercase text-xs tracking-wider">
        <tr>
            <th class="px-4 py-3 border">RO ID</th>
            <th class="px-4 py-3 border">Region</th>
            <th class="px-4 py-3 border">RO Address</th>
            <th class="px-4 py-3 border">Person In Charge</th>
            <th class="px-4 py-3 border">Contact No.</th>
            <th class="px-4 py-3 border text-center">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white">
        @foreach($regionalOffices as $index => $ro)
            <tr class="hover:bg-gray-100 transition">
                <td class="px-4 py-3">{{ $ro->ro_id }}</td>
                <td class="px-4 py-3">{{ $ro->ro_office }}</td>
                <td class="px-4 py-3">{{ $ro->ro_address ?? '—' }}</td>
                <td class="px-4 py-3">{{ $ro->person_in_charge ?? '—' }}</td>
                <td class="px-4 py-3">{{ $ro->contact_no ?? '—' }}</td>
                <td class="px-4 py-3 text-center">
                    <div class="flex justify-center gap-x-2">
                        <button 
                            onclick="openEditModal({{ $ro->ro_id }})" 
                            class="px-4 py-1.5 rounded-full bg-[#4A90E2] text-white hover:bg-[#357ABD] transition shadow-sm text-sm font-medium">
                            Edit
                        </button>
                        <button onclick='openDeleteModal("regional", {{ $ro->ro_id }})'
                            class="px-4 py-1.5 rounded-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm text-sm font-medium">
                            Delete
                        </button>

                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $regionalOffices->links('vendor.pagination.tailwind') }}
</div>
