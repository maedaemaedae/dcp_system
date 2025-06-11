<table class="min-w-full text-sm text-left border border-gray-300 shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-[#F59E0B] text-[#FFF] uppercase text-xs tracking-wider">
                                <tr>
                                    <th class="px-4 py-2 border">Region</th>
                                    <th class="px-4 py-2 border">Division</th>
                                    <th class="px-4 py-2 border">Recipient Type</th>
                                    <th class="px-4 py-2 border">School/Office Name</th>
                                    <th class="px-4 py-2 border">School/SDO Address</th>
                                    <th class="px-4 py-2 border">Package Type</th>
                                    <th class="px-4 py-2 border">Quantity</th>
                                    <th class="px-4 py-2 border">Contact Person</th>
                                    <th class="px-4 py-2 border">Position</th>
                                    <th class="px-4 py-2 border">Contact Number</th>
                                    <th class="px-4 py-2 border">Created By</th>
                                    <th class="px-4 py-2 border">Date Created</th>
                                    <th class="px-4 py-2 border">Modified By</th>
                                    <th class="px-4 py-2 border">Date Modified</th>
                                    <th class="px-4 py-2 border text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($recipients as $r)
                                    <tr class="hover:bg-gray-100 transition border-t">
                                        <td class="px-4 py-2 border">
                                            {{ $r->recipient_type === 'school'
                                                ? $r->school->division->regionalOffice->ro_office ?? '—'
                                                : $r->division->regionalOffice->ro_office ?? '—' }}
                                        </td>
                                        <td class="px-4 py-2 border">
                                            {{ $r->recipient_type === 'school'
                                                ? $r->school->division->division_name ?? '—'
                                                : $r->division->division_name ?? '—' }}
                                        </td>
                                        <td class="px-4 py-2 border">{{ ucfirst($r->recipient_type) }}</td>
                                        <td class="px-4 py-2 border">
                                            {{ $r->recipient_type === 'school'
                                                ? $r->school->school_name ?? '—'
                                                : $r->division->division_name ?? '—' }}
                                        </td>
                                        <td class="px-4 py-2 border">
                                            {{ $r->recipient_type === 'school'
                                                ? $r->school->school_address ?? '—'
                                                : $r->division->sdo_address ?? '—' }}
                                        </td>
                                        <td class="px-4 py-2 border">{{ $r->package->packageType->package_code ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $r->quantity ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $r->contact_person ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $r->position ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $r->contact_number ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $r->creator->name ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $r->created_at->format('Y-m-d') }}</td>
                                        <td class="px-4 py-2 border">{{ $r->modifier->name ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $r->updated_at->format('Y-m-d') }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex justify-center gap-x-2">
                                            <button 
                                                onclick="openEditRecipientModal({{ $r->id }}, '{{ $r->contact_person }}', '{{ $r->position }}', '{{ $r->contact_number }}', {{ $r->quantity }})"
                                                class="px-4 py-1.5 rounded-full bg-[#F59E0B] text-white hover:bg-[#D97706] transition shadow-sm text-sm font-medium"
                                            >
                                                Edit
                                            </button>
                                            <button 
                                                onclick="openDeleteModal('recipient', {{ $r->id }})" 
                                                class="px-4 py-1.5 rounded-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm text-sm font-medium">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

               