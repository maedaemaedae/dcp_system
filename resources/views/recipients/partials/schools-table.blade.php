<table class="min-w-full text-sm text-left border border-gray-300 shadow-md rounded-lg">
                            <thead class="bg-[#10B981] text-[#FFFF] uppercase text-xs tracking-wider">
                                <tr>
                                    <th class="px-4 py-2 border">Region</th>
                                    <th class="px-4 py-2 border">Division</th>
                                    <th class="px-4 py-2 border">School ID</th>
                                    <th class="px-4 py-2 border">Name</th>
                                    <th class="px-4 py-2 border">Address</th>
                                    <th class="px-4 py-2 border">Internet?</th>
                                    <th class="px-4 py-2 border">ISP</th>
                                    <th class="px-4 py-2 border">Electricity</th>
                                    <th class="px-4 py-2 border text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($schools as $school)
                                    <tr class="hover:bg-gray-100 transition border-t">
                                        <td class="px-4 py-2 border">{{ $school->division->regionalOffice->ro_office ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border">{{ $school->division->division_name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border">{{ $school->school_id }}</td>
                                        <td class="px-4 py-2 border">{{ $school->school_name }}</td>
                                        <td class="px-4 py-2 border">{{ $school->school_address }}</td>
                                        <td class="px-4 py-2 border">{!! $school->has_internet ? '✅' : '❌' !!}</td>
                                        <td class="px-4 py-2 border">{{ $school->internet_provider }}</td>
                                        <td class="px-4 py-2 border">{{ $school->electricity_provider }}</td>
                                        <td class="px-4 py-3 text-center">

                                            <div 
                                                x-data="{
                                                    open: false,
                                                    flip: false,
                                                    toggle() {
                                                        this.open = !this.open;

                                                        if (this.open) {
                                                            this.$nextTick(() => {
                                                                const rect = this.$el.getBoundingClientRect();
                                                                this.flip = (window.innerHeight - rect.bottom) < 120;
                                                            });
                                                        }
                                                    }
                                                }"
                                                class="relative inline-block text-left"
                                            >
                                            <button @click="toggle" @click.outside="open = false"
                                             class="p-2 hover:bg-gray-200 rounded-full transition duration-150 focus:outline-none focus:ring-2 focus:ring-green-300">

                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/>
                                                </svg>
                                            </button>

                                            <div 
                                                x-show="open"
                                                x-transition
                                                :class="flip ? 'bottom-full mb-2' : 'mt-2'"
                                                class="absolute right-0 z-30 w-36 bg-white rounded-xl shadow-xl border border-gray-200 py-1"
                                                @click.outside="open = false"
                                                style="display: none;"
                                            >
                                                <button @click='openEditSchoolModal(@json($school)); open = false;'
                                                    class="flex items-center gap-2 w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-blue-600" viewBox="0 0 20 20">
                                                            <path d="M17.414 2.586a2 2 0 010 2.828l-1.828 1.828-2.828-2.828L14.586 2.586a2 2 0 012.828 0zM3 17.25V14.5a1 1 0 01.293-.707l8.5-8.5 2.828 2.828-8.5 8.5A1 1 0 019.5 17.25H3z"/>
                                                     </svg>
                                                        Edit
                                                </button>
                                                <button @click='openDeleteModal("school", {{ $school->school_id }}); open = false;'
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

                <div class="mt-4">
               {!! $schools->appends(request()->except('page'))->links('vendor.pagination.tailwind') !!}
                </div>