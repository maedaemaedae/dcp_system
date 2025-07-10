<div class="overflow-x-auto">
<table class="min-w-full text-sm text-left border border-gray-300 shadow-md rounded-lg">
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
                                        <td class="px-4 py-2 border">{{ $r->created_at?->format('Y-m-d') ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $r->modifier->name ?? '—' }}</td>
                                        <td class="px-4 py-2 border">{{ $r->updated_at?->format('Y-m-d') ?? '—' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <div 
                                                x-data="{
                                                    open: false,
                                                    flip: false,
                                                    dropdownStyle: '',
                                                    toggle($event) {
                                                        this.open = !this.open;
                                                        if (this.open) {
                                                            this.$nextTick(() => {
                                                                setTimeout(() => {
                                                                    const btn = $event.target.closest('button');
                                                                    if (btn) {
                                                                        const rect = btn.getBoundingClientRect();
                                                                        let top = rect.bottom + window.scrollY;
                                                                        let left = rect.right + window.scrollX - 160; // 160 = dropdown width
                                                                        // Flip if not enough space below
                                                                        if ((window.innerHeight - rect.bottom) < 120) {
                                                                            top = rect.top + window.scrollY - 8 - 48; // 48 = dropdown height, 8 = margin
                                                                            this.flip = true;
                                                                        } else {
                                                                            this.flip = false;
                                                                        }
                                                                        this.dropdownStyle = `position:fixed;top:${top}px;left:${left}px;z-index:9999;width:160px;`;
                                                                    }
                                                                }, 10);
                                                            });
                                                        }
                                                    }
                                                }" 
                                                class="relative inline-block text-left"
                                            >
                                                <button @click="toggle($event)" @click.outside="open = false"
                                                    class="p-3 hover:bg-gray-200 rounded-full transition duration-150 focus:outline-none focus:ring-2 focus:ring-yellow-400 flex items-center justify-center">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/>
                                                    </svg>
                                                </button>

                                                <div 
                                                    x-show="open"
                                                    x-transition
                                                    :style="dropdownStyle"
                                                    class="bg-white rounded-xl shadow-xl border border-gray-200 py-1"
                                                    @click.outside="open = false"
                                                    data-dropdown
                                                >
                                                    <button 
                                                        @click="openEditRecipientModal({{ $r->id }}, '{{ $r->contact_person }}', '{{ $r->position }}', '{{ $r->contact_number }}', {{ $r->quantity }}); open = false;" 
                                                        class="flex items-center gap-2 w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                                         <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-blue-600" viewBox="0 0 20 20">
                                                            <path d="M17.414 2.586a2 2 0 010 2.828l-1.828 1.828-2.828-2.828L14.586 2.586a2 2 0 012.828 0zM3 17.25V14.5a1 1 0 01.293-.707l8.5-8.5 2.828 2.828-8.5 8.5A1 1 0 009.5 17.25H3z"/>
                                                         </svg>
                                                        Edit
                                                    </button>
                                                    <button 
                                                        @click="openDeleteModal('recipient', {{ $r->id }}); open = false;" 
                                                        class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-red-600" viewBox="0 0 20 20">
                                                            <path d="M6 7a1 1 0 011 1v6a1 1 0 01-2 0V8a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0V8a1 1 0 011-1zm4-3h-2.5l-.71-.71A1 1 0 0010.5 3h-1a1 1 0 00-.71.29L8.09 4H5a1 1 0 000 2h10a1 1 0 100-2zM6 16a2 2 0 002 2h4a2 2 0 002-2V6H6v10z"/>
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                   </div>

