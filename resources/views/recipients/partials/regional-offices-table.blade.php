<table class="min-w-full text-sm text-left border border-gray-300 shadow-md rounded-lg overflow-visible">
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
                   <div 
    x-data="{
        open: false,
        flip: false,
        toggle() {
            this.open = !this.open;

            if (this.open) {
                this.$nextTick(() => {
                    // Wait for dropdown to be visible
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
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
            <path d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm0-6a2 2 0 114 0 2 2 0 01-4 0zm0 12a2 2 0 114 0 2 2 0 01-4 0z" />
        </svg>
    </button>

    <div 
        x-show="open"
        x-transition
        :class="flip ? 'bottom-full mb-2' : 'mt-2'"
        class="absolute right-0 z-30 w-32 bg-white rounded-xl shadow-xl border border-gray-200 py-1"
        @click.outside="open = false"
        data-dropdown
        style="display: none;"
    >
        <button 
            @click="openEditModal({{ $ro->ro_id }}); open = false;" 
            class="flex items-center gap-2 w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
              Edit
        </button>
        <button 
            @click="openDeleteModal('regional', {{ $ro->ro_id }}); open = false;" 
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

<div class="mt-4">
    {{ $regionalOffices->links('vendor.pagination.tailwind') }}
</div>
