<table class="min-w-full text-sm text-left border border-gray-300 shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-2 border">Region</th>
                                    <th class="px-4 py-2 border">Division ID</th>
                                    <th class="px-4 py-2 border">Division Name</th>
                                    <th class="px-4 py-2 border">Office</th>
                                    <th class="px-4 py-2 border">SDO Address</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($divisions as $division)
                                    <tr class="border-t">
                                        <td class="px-4 py-2 border">{{ $division->regionalOffice->ro_office ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $division->division_id }}</td>
                                        <td class="px-4 py-2 border">{{ $division->division_name }}</td>
                                        <td class="px-4 py-2 border">{{ $division->office ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $division->sdo_address ?? '—' }}</td>
                                        <td class="px-4 py-2 border flex gap-2">
                                            <button onclick='openEditDivisionModal(@json($division))' class="text-blue-600 hover:underline">Edit</button>
                                            <button onclick='openDeleteModal("division", {{ $division->division_id }})' class="text-red-600 hover:underline">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                <div class="mt-4">
                {{ $divisions->links('vendor.pagination.tailwind') }}
                </div>