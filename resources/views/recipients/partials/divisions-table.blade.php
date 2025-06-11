<table class="min-w-full text-sm text-left border border-gray-300 shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-[#7C3AED] text-white uppercase text-xs tracking-wider">
                                <tr>
                                    <th class="px-4 py-2 border">Region</th>
                                    <th class="px-4 py-2 border">Division ID</th>
                                    <th class="px-4 py-2 border">Division Name</th>
                                    <th class="px-4 py-2 border">Office</th>
                                    <th class="px-4 py-2 border">SDO Address</th>
                                    <th class="px-4 py-2 border text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($divisions as $division)
                                    <tr class="hover:bg-gray-100 transition border-t">
                                        <td class="px-4 py-2 border">{{ $division->regionalOffice->ro_office ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $division->division_id }}</td>
                                        <td class="px-4 py-2 border">{{ $division->division_name }}</td>
                                        <td class="px-4 py-2 border">{{ $division->office ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $division->sdo_address ?? '—' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex justify-center gap-x-2">
                                            <button onclick='openEditDivisionModal(@json($division))' class="px-4 py-1.5 rounded-full bg-[#7C3AED] text-white hover:bg-[#6B21A8] transition shadow-sm text-sm font-medium">Edit</button>
                                            <button onclick='openDeleteModal("division", {{ $division->division_id }})' class="px-4 py-1.5 rounded-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm text-sm font-medium">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                <div class="mt-4">
                {{ $divisions->links('vendor.pagination.tailwind') }}
                </div>