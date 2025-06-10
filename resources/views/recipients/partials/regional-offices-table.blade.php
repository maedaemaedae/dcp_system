 <table class="min-w-full text-sm text-left border border-gray-300 shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-2 border">RO ID</th>
                                    <th class="px-4 py-2 border">Region</th>
                                    <th class="px-4 py-2 border">RO Address</th>
                                    <th class="px-4 py-2 border">Person In Charge</th>
                                    <th class="px-4 py-2 border">Contact No.</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                           <tbody>
    @foreach($regionalOffices as $index => $ro)
        <tr class="border-t">
            <td class="px-4 py-2 border">{{ $ro->ro_id }}</td>
            <td class="px-4 py-2 border">{{ $ro->ro_office }}</td>
            <td class="px-4 py-2 border">{{ $ro->ro_address ?? '—' }}</td>
            <td class="px-4 py-2 border">{{ $ro->person_in_charge ?? '—' }}</td>
            <td class="px-4 py-2 border">{{ $ro->contact_no ?? '—' }}</td>
            <td class="px-4 py-2 border flex gap-2">
                <button onclick="openEditModal({{ $ro->ro_id }})" class="text-blue-600 hover:underline">Edit</button>
                <form method="POST" action="{{ route('regional-offices.destroy', $ro->ro_id) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
</table>

<div class="mt-4">
    {{ $regionalOffices->links('vendor.pagination.tailwind') }}
</div>