<table class="min-w-full text-sm text-left border border-gray-300 shadow-md rounded-lg overflow-visible">
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
                                            <div 
                                                x-data="{
                                                    open: false,
                                                    flip: false,
                                                    toggle() {
                                                        this.open = !this.open;

                                                        if (this.open) {
                                                            this.$nextTick(() => {
                                                                setTimeout(() => {
                                                                    const dropdown = $el.querySelector('[data-dropdown]');
                                                                    if (dropdown) {
                                                                        const rect = dropdown.getBoundingClientRect();
                                                                        this.flip = (window.innerHeight - rect.bottom) < 20;
                                                                    }
                                                                }, 10);
                                                            });
                                                        }
                                                    }
                                                }" 
                                                class="relative inline-block text-left"
                                            >
                                                <button @click="toggle" @click.outside="open = false"
                                                    class="p-3 hover:bg-gray-200 rounded-full transition duration-150 focus:outline-none focus:ring-2 focus:ring-yellow-400 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm0-6a2 2 0 114 0 2 2 0 01-4 0zm0 12a2 2 0 114 0 2 2 0 01-4 0z" />
                                                    </svg>
                                                </button>


                                                <div 
                                                    x-show="open"
                                                    x-transition
                                                    :class="flip ? 'bottom-full mb-2' : 'mt-2'"
                                                    class="absolute right-0 z-30 w-40 bg-white rounded-xl shadow-xl border border-gray-200 py-1"
                                                    @click.outside="open = false"
                                                    data-dropdown
                                                    style="display: none;"
                                                >
                                                    <button 
                                                        @click="openEditRecipientModal({{ $r->id }}, '{{ $r->contact_person }}', '{{ $r->position }}', '{{ $r->contact_number }}', {{ $r->quantity }}); open = false;" 
                                                        class="flex items-center gap-2 w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                                         Edit
                                                    </button>
                                                    <button 
                                                        @click="openDeleteModal('recipient', {{ $r->id }}); open = false;" 
                                                        class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                                         Delete
                                                    </button>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

               