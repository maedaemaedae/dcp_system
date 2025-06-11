<table class="min-w-full text-sm text-left border border-gray-300 shadow-md rounded-lg overflow-hidden">
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
                                            <div class="flex justify-center gap-x-2">
                                            <button onclick='openEditSchoolModal(@json($school))'  class="px-4 py-1.5 rounded-full bg-[#10B981] text-white hover:bg-[#059669] transition shadow-sm text-sm font-medium">Edit</button>
                                            <button onclick='openDeleteModal("school", {{ $school->school_id }})' class="px-4 py-1.5 rounded-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm text-sm font-medium">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                <div class="mt-4">
               {!! $schools->appends(request()->except('page'))->links('vendor.pagination.tailwind') !!}
                </div>