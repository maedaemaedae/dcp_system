<table class="min-w-full text-sm text-left border border-gray-300 shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-2 border">Region</th>
                                    <th class="px-4 py-2 border">Division</th>
                                    <th class="px-4 py-2 border">School ID</th>
                                    <th class="px-4 py-2 border">Name</th>
                                    <th class="px-4 py-2 border">Address</th>
                                    <th class="px-4 py-2 border">Internet?</th>
                                    <th class="px-4 py-2 border">ISP</th>
                                    <th class="px-4 py-2 border">Electricity</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schools as $school)
                                    <tr class="border-t">
                                        <td class="px-4 py-2 border">{{ $school->division->regionalOffice->ro_office ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border">{{ $school->division->division_name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border">{{ $school->school_id }}</td>
                                        <td class="px-4 py-2 border">{{ $school->school_name }}</td>
                                        <td class="px-4 py-2 border">{{ $school->school_address }}</td>
                                        <td class="px-4 py-2 border">{!! $school->has_internet ? '✅' : '❌' !!}</td>
                                        <td class="px-4 py-2 border">{{ $school->internet_provider }}</td>
                                        <td class="px-4 py-2 border">{{ $school->electricity_provider }}</td>
                                        <td class="px-4 py-2 border flex gap-2">
                                            <button onclick='openEditSchoolModal(@json($school))' class="text-blue-600 hover:underline">Edit</button>
                                            <button onclick='openDeleteModal("school", {{ $school->school_id }})' class="text-red-600 hover:underline">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                <div class="mt-4">
               {!! $schools->appends(request()->except('page'))->links('vendor.pagination.tailwind') !!}
                </div>