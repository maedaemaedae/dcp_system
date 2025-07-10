
    <table class="min-w-full text-sm text-left border border-gray-300 shadow-md rounded-2xl">
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

                    <!-- ✅ Allow overflow here -->
                    <td class="px-4 py-3 text-center relative z-20" style="overflow: visible;">
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
                                class="p-2 hover:bg-gray-200 rounded-full transition duration-150 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/>
                                </svg>
                            </button>

                            <!-- ✅ Dropdown content -->
                            <div 
                                x-show="open"
                                x-transition
                                :class="flip ? 'bottom-full mb-2' : 'mt-2'"
                                class="absolute right-0 z-50 w-32 bg-white rounded-xl shadow-xl border border-gray-200 py-1"
                                @click.outside="open = false"
                                data-dropdown
                                style="display: none;"
                            >
                                <button 
                                    @click="openEditModal({{ $ro->ro_id }}); open = false;" 
                                    class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-100 text-blue-600"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-blue-600" viewBox="0 0 20 20">
                                        <path d="M17.414 2.586a2 2 0 010 2.828l-1.828 1.828-2.828-2.828L14.586 2.586a2 2 0 012.828 0zM3 17.25V14.5a1 1 0 01.293-.707l8.5-8.5 2.828 2.828-8.5 8.5A1 1 0 019.5 17.25H3z"/>
                                    </svg>
                                    Edit
                                </button>
                                <button 
                                    @click="openDeleteModal('regional', {{ $ro->ro_id }}); open = false;" 
                                    class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600"
                                >
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
